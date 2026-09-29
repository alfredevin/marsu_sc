<?php
namespace Core;

/**
 * MarSU Centralized ERP - High-Performance Dual-Mode Router
 * Supports Pretty URLs (.htaccess) and query string fallback (?r=)
 */
class Router {
    private array $routes = [];
    private array $namedRoutes = [];
    private array $middlewareAliases = [
        'auth'       => \Core\Middleware\AuthMiddleware::class,
        'guest'      => \Core\Middleware\GuestMiddleware::class,
        'csrf'       => \Core\Middleware\CsrfMiddleware::class,
        'permission' => \Core\Middleware\PermissionMiddleware::class
    ];

    public function get(string $path, $handler, array $middleware = []): self {
        return $this->addRoute('GET', $path, $handler, $middleware);
    }

    public function post(string $path, $handler, array $middleware = []): self {
        return $this->addRoute('POST', $path, $handler, $middleware);
    }

    public function put(string $path, $handler, array $middleware = []): self {
        return $this->addRoute('PUT', $path, $handler, $middleware);
    }

    public function delete(string $path, $handler, array $middleware = []): self {
        return $this->addRoute('DELETE', $path, $handler, $middleware);
    }

    public function match(array $methods, string $path, $handler, array $middleware = []): self {
        foreach ($methods as $method) {
            $this->addRoute(strtoupper($method), $path, $handler, $middleware);
        }
        return $this;
    }

    private function addRoute(string $method, string $path, $handler, array $middleware = []): self {
        $cleanPath = '/' . trim($path, '/');
        // Convert route pattern with parameters like {id} or {slug}
        $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[^/]+)', $cleanPath);
        $pattern = '#^' . $pattern . '$#';

        $this->routes[$method][] = [
            'path'       => $cleanPath,
            'pattern'    => $pattern,
            'handler'    => $handler,
            'middleware' => $middleware
        ];

        return $this;
    }

    /**
     * Dispatch the current HTTP request
     */
    public function dispatch(): void {
        Session::start();

        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        // Support method spoofing for PUT/DELETE via POST _method field
        if ($method === 'POST' && isset($_POST['_method'])) {
            $method = strtoupper($_POST['_method']);
        }

        $uri = $this->resolveCurrentUri();

        $routesForMethod = $this->routes[$method] ?? [];
        foreach ($routesForMethod as $route) {
            if (preg_match($route['pattern'], $uri, $matches)) {
                // Extract named parameter matches
                $params = [];
                foreach ($matches as $key => $value) {
                    if (is_string($key)) {
                        $params[$key] = $value;
                    }
                }

                // Execute middleware pipeline
                if (!$this->runMiddleware($route['middleware'])) {
                    return; // Middleware aborted the request (redirect or error)
                }

                // Execute handler
                $this->executeHandler($route['handler'], $params);
                return;
            }
        }

        // Route Not Found: 404
        http_response_code(404);
        View::render('errors/404', ['title' => 'Page Not Found', 'uri' => $uri]);
    }

    /**
     * Extract clean URI from request (pretty URL or ?r= fallback)
     */
    private function resolveCurrentUri(): string {
        // 1. Fallback query string ?r=path
        if (isset($_GET['r']) && !empty($_GET['r'])) {
            return '/' . trim($_GET['r'], '/');
        }

        // 2. REQUEST_URI with path normalization
        $uri = $_SERVER['REQUEST_URI'] ?? '/';
        if (false !== ($pos = strpos($uri, '?'))) {
            $uri = substr($uri, 0, $pos);
        }

        // Strip base script directory if running in subdirectory
        $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
        // If scriptDir ends with /public, strip it
        $subfolder = preg_replace('#/public$#', '', $scriptDir);
        if ($subfolder && $subfolder !== '/' && str_starts_with($uri, $subfolder)) {
            $uri = substr($uri, strlen($subfolder));
        }

        $cleanUri = '/' . trim($uri, '/');
        return $cleanUri === '//' ? '/' : $cleanUri;
    }

    /**
     * Run middleware chain
     */
    private function runMiddleware(array $middlewareList): bool {
        foreach ($middlewareList as $item) {
            $param = null;
            if (str_contains($item, ':')) {
                [$name, $param] = explode(':', $item, 2);
            } else {
                $name = $item;
            }

            $handlerClass = $this->middlewareAliases[$name] ?? null;
            if ($handlerClass && class_exists($handlerClass)) {
                $mwInstance = new $handlerClass();
                if (!$mwInstance->handle($param)) {
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * Execute controller method or callable
     */
    private function executeHandler($handler, array $params = []): void {
        if (is_callable($handler)) {
            call_user_func_array($handler, $params);
            return;
        }

        if (is_array($handler) && count($handler) === 2) {
            [$class, $method] = $handler;
            if (class_exists($class)) {
                $controller = new $class();
                if (method_exists($controller, $method)) {
                    call_user_func_array([$controller, $method], $params);
                    return;
                }
            }
        }

        throw new \Exception("Route handler could not be executed.");
    }
}
