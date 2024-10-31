<?php
namespace LibraryApp\Traits;

trait Loggable {
    public function log($message) {
        echo "[LOG]: " . $message . "<br>";
    }
}
