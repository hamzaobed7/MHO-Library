<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Psy\Util\Json;

class BookController extends Controller
{
    function index():JsonResponse
    {
        return response()->json(Book::all());
    }


    function getBooksWithAuthors():JsonResponse
    {
        return response()->json(Book::with('authors')->get());
    }

    function getBooksWithCatigory():JsonResponse{
        return response()->json(Book::with('category')->get());
    }

    
   

function store(Request $request):JsonResponse
{
    
     $validation=validator($request->all(),[
        'ISBN' => 'required|unique:books|max:13',
        'name' => 'required|string|max:30',
        'price' => 'required|numeric|min:2',
        'publication_date' => 'required|date',
        'category_id' => 'required|exists:catygories,id',
        'authors' => 'required|array',
        'authors.*' => 'exists:authors,id',
     ]);

    if ($validation->fails()) {
        return response()->json(['errors' => $validation->errors()], 422);
    }

    $data=$validation->validated();
    $book = Book::create([
        'ISBN' => $data['ISBN'],
        'name' => $data['name'],
        'price' => $data['price'],
        'publication_date' => $data['publication_date'],
        'category_id' => $data['category_id'],
    ]);

    $book->authors()->sync($data['authors']);

    return response()->json([
        'message' => 'تم إنشاء الكتاب',
        'book' => $book->load('authors','category')
    ]);
}

public function search(Request $request):JsonResponse
{
     $name = $request->query('name');
    if (!$name) {
        return response()->json(['message' => 'يرجى إدخال نص للبحث'], 400);
    }

    $books = Book::where('name', 'LIKE', "%{$name}%")->get();

    return response()->json($books);
}


    function delete(Book $book){
        Book::destroy($$book);
        return "Is Done";
    }

    function show(Book $book):JsonResponse
{
    if (!$book) {
        return response()->json([
            'message' => 'Book not found'
        ], 404);
    }

    return response()->json($book);
}

    function update(Request $request,Book $book):JsonResponse
    {
        $validation=validator($request->all(),[
        'name' => 'required|string|max:30',
        'price' => 'required|numeric|min:2',
        'publication_date' => 'required|date',
        'category_id' => 'required|exists:catygories,id',
        'authors' => 'required|array',
        'authors.*' => 'exists:authors,id',
     ]);
      
    if ($validation->fails()) {
        return response()->json(['errors' => $validation->errors()], 422);
    }

    $data=$validation->validated();
    $book->authors()->sync($data['authors']);
    $book->update($data);
    return response()->json([
        'message' => 'تم تحديث الكتاب بنجاح',
        'book'    => $book->load('authors', 'category')
    ]);
    }
}
