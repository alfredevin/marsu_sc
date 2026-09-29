<?php
namespace Core;

/**
 * MarSU Centralized ERP - Form Validation Engine
 */
class Validator {
    private array $data;
    private array $rules;
    private array $customMessages;
    private array $errors = [];
    private array $validatedData = [];

    public function __construct(array $data, array $rules, array $customMessages = []) {
        $this->data = $data;
        $this->rules = $rules;
        $this->customMessages = $customMessages;
        $this->validate();
    }

    public static function make(array $data, array $rules, array $customMessages = []): self {
        return new self($data, $rules, $customMessages);
    }

    private function validate(): void {
        foreach ($this->rules as $field => $ruleSet) {
            $value = $this->data[$field] ?? null;
            $ruleList = is_array($ruleSet) ? $ruleSet : explode('|', $ruleSet);

            $isRequired = in_array('required', $ruleList, true);

            foreach ($ruleList as $rule) {
                $params = [];
                if (str_contains($rule, ':')) {
                    [$ruleName, $paramStr] = explode(':', $rule, 2);
                    $params = explode(',', $paramStr);
                } else {
                    $ruleName = $rule;
                }

                // If not required and value is empty, skip remaining checks
                if (!$isRequired && ($value === null || $value === '')) {
                    continue;
                }

                $this->applyRule($field, $ruleName, $params, $value);
            }

            if (!isset($this->errors[$field])) {
                $this->validatedData[$field] = $value;
            }
        }
    }

    private function applyRule(string $field, string $rule, array $params, $value): void {
        $humanField = ucwords(str_replace(['_', '-'], ' ', $field));

        switch ($rule) {
            case 'required':
                if ($value === null || (is_string($value) && trim($value) === '') || (is_array($value) && empty($value))) {
                    $this->addError($field, "{$humanField} is required.");
                }
                break;

            case 'email':
                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($field, "{$humanField} must be a valid email address.");
                }
                break;

            case 'numeric':
                if (!is_numeric($value)) {
                    $this->addError($field, "{$humanField} must be a valid number.");
                }
                break;

            case 'integer':
                if (!filter_var($value, FILTER_VALIDATE_INT) && $value !== '0' && $value !== 0) {
                    $this->addError($field, "{$humanField} must be an integer.");
                }
                break;

            case 'min':
                $min = (int)($params[0] ?? 0);
                if (is_numeric($value) && $value < $min) {
                    $this->addError($field, "{$humanField} must be at least {$min}.");
                } elseif (is_string($value) && mb_strlen($value) < $min) {
                    $this->addError($field, "{$humanField} must be at least {$min} characters.");
                }
                break;

            case 'max':
                $max = (int)($params[0] ?? 0);
                if (is_numeric($value) && $value > $max) {
                    $this->addError($field, "{$humanField} may not be greater than {$max}.");
                } elseif (is_string($value) && mb_strlen($value) > $max) {
                    $this->addError($field, "{$humanField} may not exceed {$max} characters.");
                }
                break;

            case 'in':
                if (!in_array((string)$value, $params, true)) {
                    $this->addError($field, "Selected {$humanField} is invalid.");
                }
                break;

            case 'date':
                if (!strtotime((string)$value)) {
                    $this->addError($field, "{$humanField} must be a valid date.");
                }
                break;

            case 'confirmed':
                $confirmationField = $field . '_confirmation';
                $confirmationValue = $this->data[$confirmationField] ?? null;
                if ($value !== $confirmationValue) {
                    $this->addError($field, "{$humanField} confirmation does not match.");
                }
                break;

            case 'unique':
                // syntax: unique:table,column,exceptId
                $table = $params[0] ?? '';
                $column = $params[1] ?? $field;
                $exceptId = $params[2] ?? null;

                $sql = "SELECT COUNT(*) FROM `{$table}` WHERE `{$column}` = :val AND deleted_at IS NULL";
                $queryParams = ['val' => $value];

                if ($exceptId !== null && $exceptId !== '' && $exceptId !== 'NULL') {
                    $sql .= " AND `id` != :exceptId";
                    $queryParams['exceptId'] = $exceptId;
                }

                $count = (int)Database::fetchColumn($sql, $queryParams);
                if ($count > 0) {
                    $this->addError($field, "This {$humanField} is already registered.");
                }
                break;
        }
    }

    private function addError(string $field, string $defaultMessage): void {
        if (!isset($this->errors[$field])) {
            $msg = $this->customMessages[$field] ?? $defaultMessage;
            $this->errors[$field] = $msg;
        }
    }

    public function passes(): bool {
        return empty($this->errors);
    }

    public function fails(): bool {
        return !empty($this->errors);
    }

    public function errors(): array {
        return $this->errors;
    }

    public function firstError(?string $field = null): ?string {
        if ($field) {
            return $this->errors[$field] ?? null;
        }
        return reset($this->errors) ?: null;
    }

    public function validated(): array {
        return $this->validatedData;
    }
}
