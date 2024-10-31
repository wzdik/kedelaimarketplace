<?php
namespace LibraryApp\Abstract;

abstract class LibraryItem {
    protected $title;
    protected $author;

    public function __construct($title, $author) {
        $this->title = $title;
        $this->author = $author;
    }

    // Abstract method to display item details
    abstract public function getDetails();
}
