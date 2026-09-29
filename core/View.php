<?php
namespace Core;

/**
 * MarSU Centralized ERP - View Engine
 * Renders views, wraps layouts, and injects partials.
 */
class View {
    public static function render(string $viewPath, array $data = [], ?string $layout = 'main'): void {
        // Extract data for view
        extract($data);

        // Determine view file path
        $viewFile = self::resolveViewPath($viewPath);
        if (!file_exists($viewFile)) {
            http_response_code(500);
            echo "View file not found: " . htmlspecialchars($viewPath);
            return;
        }

        // Buffer view content
        ob_start();
        include $viewFile;
        $content = ob_get_clean();

        // If no layout is specified, output raw content
        if ($layout === null || $layout === 'none') {
            echo $content;
            return;
        }

        // Buffer and render layout
        $layoutFile = dirname(__DIR__) . "/app/Views/layouts/{$layout}.php";
        if (!file_exists($layoutFile)) {
            echo $content;
            return;
        }

        // Expose view data to layout as well
        include $layoutFile;
    }

    public static function partial(string $partialName, array $data = []): void {
        extract($data);
        $partialFile = dirname(__DIR__) . "/app/Views/layouts/{$partialName}.php";
        if (file_exists($partialFile)) {
            include $partialFile;
        }
    }

    private static function resolveViewPath(string $viewPath): string {
        $baseAppViews = dirname(__DIR__) . '/app/Views/';
        
        // 1. Check namespace syntax: "housing::index" -> modules/housing/Views/index.php
        if (str_contains($viewPath, '::')) {
            [$moduleSlug, $subView] = explode('::', $viewPath, 2);
            return dirname(__DIR__) . "/modules/{$moduleSlug}/Views/{$subView}.php";
        }

        // 2. Check if path starts with "modules/"
        if (str_starts_with($viewPath, 'modules/')) {
            return dirname(__DIR__) . '/' . ltrim($viewPath, '/') . '.php';
        }

        // 3. Check if path is "{slug}/Views/{view}" e.g. "expense4ps/Views/index"
        if (preg_match('#^([a-zA-Z0-9_\-]+)/Views/(.+)$#', $viewPath, $matches)) {
            $candidate = dirname(__DIR__) . "/modules/{$matches[1]}/Views/{$matches[2]}.php";
            if (file_exists($candidate)) {
                return $candidate;
            }
        }

        // 4. Default to core app/Views/
        return $baseAppViews . ltrim($viewPath, '/') . '.php';
    }
}
