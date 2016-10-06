<?php namespace Project\Controllers;

use Import;

class Simplicity extends Controller
{
    public function main(string $params = NULL) : void
    {
        Import::view('welcome.wizard');
    }

    public function try() : void
    {
        // Simplicity is our choice, how about yours ?
    }
}
