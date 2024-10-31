<?php
require_once __DIR__ . '/src/Abstract/LibraryItem.php';
require_once __DIR__ . '/src/Traits/Loggable.php';
require_once __DIR__ . '/src/Models/Book.php';
require_once __DIR__ . '/src/Models/DigitalBook.php';
require_once __DIR__ . '/src/Models/PrintBook.php';

use LibraryApp\Models\DigitalBook;
use LibraryApp\Models\PrintBook;

// Creating instances of DigitalBook and PrintBook
$digitalBook = new DigitalBook("Digital Marketing 101", "John Doe", 2021, 2.5);
$printBook = new PrintBook("PHP for Beginners", "Jane Smith", 2020, 300);

// Display details using polymorphism
echo $digitalBook->getDetails() . "<br>";
echo $printBook->getDetails() . "<br>";

// Using the Loggable trait to log messages
$digitalBook->log("Digital book accessed.");
$printBook->log("Print book accessed.");
?>
