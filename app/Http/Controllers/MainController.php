<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController
{

    public function index()
    {
        echo "I'm inside the app!";
    }

    public function newNote()
    {
        echo "I'm creating a new note!";
    }
}
