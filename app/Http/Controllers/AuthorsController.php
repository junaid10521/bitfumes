<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorsController extends Controller
{
    public function index(){
        $authors = Author::with('book')->get();

        return response()->json(['data'=>$authors]);
    }
}
