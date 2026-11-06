<?php
namespace Modules\Analytics\Support;

/**
 * CSV download helper.
 */
class Csv
{
    public static function download(string $filename, array $headers, iterable $rows): never
    {
        $safe = preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $filename);
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $safe . '"');
        header('Cache-Control: no-store');
        $out = fopen('php://output', 'w');
        fwrite($out, "\xEF\xBB\xBF");
        fputcsv($out, $headers);
        foreach ($rows as $row) {
            fputcsv($out, array_map(fn($v) => self::neutralize($v), array_values($row)));
        }
        fclose($out);
        exit;
    }

    /**
     * Prevent spreadsheet formula injection in exported cells.
     */
    private static function neutralize(mixed $value): string
    {
        $v = (string) ($value ?? '');
        if ($v !== '' && in_array($v[0], ['=', '+', '-', '@'], true) && !is_numeric($v)) {
            return "'" . $v;
        }
        return $v;
    }

    /**
     * Parse an uploaded CSV file into rows of trimmed strings.
     */
    public static function parseUpload(array $file, int $maxBytes = 1048576): array
    {
        if (($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK || !is_uploaded_file($file['tmp_name'] ?? '')) {
            throw new \RuntimeException('No CSV file was uploaded.');
        }
        if ((int) $file['size'] > $maxBytes) {
            throw new \RuntimeException('The CSV file is larger than 1 MB.');
        }
        $ext = strtolower(pathinfo((string) $file['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, ['csv', 'txt'], true)) {
            throw new \RuntimeException('Only .csv files are accepted.');
        }
        $rows = [];
        $fh = fopen($file['tmp_name'], 'r');
        while (($cols = fgetcsv($fh)) !== false) {
            $cols = array_map(fn($c) => trim(preg_replace('/^\xEF\xBB\xBF/', '', (string) $c)), $cols);
            if (count(array_filter($cols, fn($c) => $c !== '')) === 0) {
                continue;
            }
            $rows[] = $cols;
        }
        fclose($fh);
        return $rows;
    }
}
