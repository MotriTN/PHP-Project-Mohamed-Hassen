<?php

declare(strict_types=1);

abstract class BaseController
{
    /**
     * Render a view file.
     *
     * @param string $view Name of the view file (without .php)
     * @param array $data Data to extract into the view scope
     */
    protected function render(string $view, array $data = []): void
    {
        extract($data);
        
        $viewFile = VIEWS_PATH . '/' . $view . '.php';
        
        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            die("View {$viewFile} not found.");
        }
    }

    /**
     * Return a JSON response.
     *
     * @param array $data Data to encode as JSON
     * @param int $statusCode HTTP status code
     */
    protected function json(array $data, int $statusCode = 200): void
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    /**
     * Redirect to a specific URL.
     *
     * @param string $url The destination URL
     */
    protected function redirect(string $url): void
    {
        header("Location: {$url}");
        exit;
    }
}
