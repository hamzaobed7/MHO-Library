<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    function index(){
        return Book::all();
    }


    function getBooksWithAuthors(){
        return Book::with('authors')->get();
    }

    function getBooksWithCatigory(){
        return Book::with('category')->get();
    }

    
    // function store(Request $request){
    //   $book=Book::create($request->all());
    //   return $book;
    // }

function store(Request $request)
{
    $book = Book::create([
        'ISBN' => $request->ISBN,
        'name' => $request->name,
        'price' => $request->price,
        'publication_date' => $request->publication_date,
        'category_id' => $request->category_id,
    ]);

    $book->authors()->sync($request->authors);
    // $book=Book::factory(1)->create();

    return response()->json([
        'message' => 'تم إنشاء الكتاب',
        'book' => $book->load('authors','category')
    ]);
}

public function search(Request $request)
{
    // جلب القيمة من الرابط (مثلاً: ?name=MyFirstLove)
    $name = $request->query('name');

    if (!$name) {
        return response()->json(['message' => 'يرجى إدخال نص للبحث'], 400);
    }

    $books = Book::where('name', 'LIKE', "%{$name}%")->get();

    return response()->json($books);
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

    function testManytoMany(){
     $book1=Book::findOrFail("123123123123");
    return $book1->authors;
    
    }

}
