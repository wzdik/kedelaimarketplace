<?php
namespace LibraryApp\Models;

class DigitalBook extends Book {
    private $fileSize;

    public function __construct($title, $author, $publicationYear, $fileSize) {
        parent::__construct($title, $author, $publicationYear);
        $this->fileSize = $fileSize;
    }

    public function getDetails() {
        return parent::getDetails() . ", File Size: {$this->fileSize} MB";
    }
}
