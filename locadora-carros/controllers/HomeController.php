<?php

require 'vendor/autoload.php';

class HomeController {
    public function index() {
        include __DIR__ . '/../views/home.php';
    }
}

?>