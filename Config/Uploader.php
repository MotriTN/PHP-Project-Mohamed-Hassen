<?php

declare(strict_types=1);

class Uploader
{
    private string $targetDirectory;
    private array $allowedMimeTypes;
    private int $maxFileSize;

    public function __construct()
    {
        // Uploads will go into Public/uploads/
        $this->targetDirectory = BASE_PATH . '/Public/uploads/';
        
        // Ensure the directory exists
        if (!is_dir($this->targetDirectory)) {
            mkdir($this->targetDirectory, 0755, true);
        }

        // Allow common image formats
        $this->allowedMimeTypes = ['image/jpeg', 'image/png', 'image/webp'];
        
        // Max size 5MB
        $this->maxFileSize = 5 * 1024 * 1024;
    }

    /**
     * Handles the file upload securely.
     * Returns the relative path to the uploaded file on success, or throws Exception.
     */
    public function upload(array $fileArray): string
    {
        if (!isset($fileArray['error']) || is_array($fileArray['error'])) {
            throw new RuntimeException('Invalid parameters.');
        }

        switch ($fileArray['error']) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                throw new RuntimeException('No file sent.');
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                throw new RuntimeException('Exceeded filesize limit.');
            default:
                throw new RuntimeException('Unknown errors.');
        }

        if ($fileArray['size'] > $this->maxFileSize) {
            throw new RuntimeException('Exceeded filesize limit.');
        }

        // Check MIME Type securely using Fileinfo
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        if (false === $ext = array_search(
            $finfo->file($fileArray['tmp_name']),
            $this->allowedMimeTypes,
            true
        )) {
            throw new RuntimeException('Invalid file format.');
        }

        // Create a secure, unique filename
        // Extension mapping
        $extMap = [
            'image/jpeg' => 'jpg',
            'image/png'  => 'png',
            'image/webp' => 'webp',
        ];
        $extension = $extMap[$finfo->file($fileArray['tmp_name'])];
        
        $filename = sprintf('%s.%s', sha1_file($fileArray['tmp_name']) . '_' . time(), $extension);
        $destination = $this->targetDirectory . $filename;

        if (!move_uploaded_file($fileArray['tmp_name'], $destination)) {
            throw new RuntimeException('Failed to move uploaded file.');
        }

        // Return relative path for the database and views
        return BASE_URL . '/uploads/' . $filename;
    }
}
