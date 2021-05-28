<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserBookRequest;
use App\Models\User;
use App\Models\UserBooks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserBooksController extends Controller
{
    public function store(UserBookRequest $request){

        DB::table('user_books')->insert(['book_id'=>$request->book_id, 'user_id'=>$request->user_id]);

        return response()->json(['message'=>"Success"]);
    }

    public function userBooks(){
        $users = User::with('books')->get();

        return response()->json(['data', $users]);
    }
}
