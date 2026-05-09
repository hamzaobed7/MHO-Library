<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    function index(){
        return Book::all();
    }

    function store(Request $request){
      $book=Book::create($request->all());
      return $book;
    }
    function delete($ISBN){
        Book::destroy($ISBN);
        return "Is Done";
    }

    function show($ISBN)
{
    $book = Book::findOrFail($ISBN);

    if (!$book) {
        return response()->json([
            'message' => 'Book not found'
        ], 404);
    }

    return response()->json($book);
}

    function update(Request $request,$ISBN){
        $book=Book::findOrFail($ISBN);
        $book->update($request->all());
        return $book;
    }


}
