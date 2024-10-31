<?php
namespace LibraryApp\Models;

use LibraryApp\Abstract\LibraryItem;
use LibraryApp\Traits\Loggable;

class Book extends LibraryItem {
    use Loggable;

    private $publicationYear;

    public function __construct($title, $author, $publicationYear) {
        parent::__construct($title, $author);
        $this->publicationYear = $publicationYear;
    }

    public function getDetails() {
        return "Title: {$this->title}, Author: {$this->author}, Year: {$this->publicationYear}";
    }

    // Magic Method __toString
    public function __toString() {
        return $this->getDetails();
    }
}
