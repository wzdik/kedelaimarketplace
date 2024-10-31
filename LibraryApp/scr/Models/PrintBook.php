<?php
namespace LibraryApp\Models;

class PrintBook extends Book {
    private $pageCount;

    public function __construct($title, $author, $publicationYear, $pageCount) {
        parent::__construct($title, $author, $publicationYear);
        $this->pageCount = $pageCount;
    }

    public function getDetails() {
        return parent::getDetails() . ", Pages: {$this->pageCount}";
    }
}
