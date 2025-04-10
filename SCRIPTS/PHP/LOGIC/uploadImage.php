
<?php
class ImageUploader {
    private $targetDir;
    private $maxFileSize;
    private $allowedTypes;

    public function __construct($targetDir = "/xampp/htdocs/DailyGreen-Project/IMAGES/", $maxFileSize = 2000000, $allowedTypes = ['jpg', 'jpeg', 'png', 'gif']) {
        $this->targetDir = $targetDir;
        $this->maxFileSize = $maxFileSize;
        $this->allowedTypes = $allowedTypes;

        if (!file_exists($this->targetDir)) {
            mkdir($this->targetDir, 0755, true);
        }
    }

    public function upload($file) {
        if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
            return "Error during file upload.";
        }

        $fileName = basename($file['name']);
        $fileSize = $file['size'];
        $fileTmp = $file['tmp_name'];
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $targetFile = $this->targetDir . uniqid() . '.' . $fileExt;

        if (!in_array($fileExt, $this->allowedTypes)) {
            return "Invalid file type. Allowed: " . implode(", ", $this->allowedTypes);
        }
        if ($fileSize > $this->maxFileSize) {
            return "File size exceeds the limit of " . ($this->maxFileSize / 1000000) . " MB.";
        }
        if (move_uploaded_file($fileTmp, $targetFile)) {
            echo "Image uploaded successfully: <a href='$targetFile' target='_blank'>$targetFile</a>";
            return $targetFile;
        } else {
            return "Failed to upload the file.";
        }
    }
}
