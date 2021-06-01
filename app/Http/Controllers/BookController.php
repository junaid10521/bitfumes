<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class BookController extends Controller
{
    public function index($name){
        // DB::connection()->enableQueryLog();

        $books = Book::with(['author', 'usersbooks'])
            ->Search($name)
            ->get();

        // $queries = DB::getQueryLog();
//        dd($queries);

        return response()->json(['data', $books]);
    }

    public function store(Request $request){
        $book = new Book;

        $book->title = $request->title;
        $book->description = $request->description;
        $book->author_id = $request->author_id;

        $book->save();

        return response()->json(['message'=>"Book saved successfully"]);
    }
}
