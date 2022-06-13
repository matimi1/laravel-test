<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActorController extends Controller
{
    public function popular()
    {
        return '<h1>Most popular actors NOW!</h1>';
    }
}
