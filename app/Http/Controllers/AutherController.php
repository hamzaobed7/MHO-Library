<?php

namespace App\Http\Controllers;
use App\Models\author;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Js;

class AutherController extends Controller
{

function index():JsonResponse
{
$auther=author::all();
return response()->json($auther);   
}

function store(Request $request):JsonResponse
{
    $validation=validator($request->all(),[
     "name"=>"required|string|unique:authors,name|max:40",
     "email"=>"required|email|unique:authors,email",
     "bio"=>"nullable|string",
     "gender"=>"required|in:Male,Female",
     "birth_date"=>"required|date|before:today",
    ]) ;  

$data=$validation->validate();

if($validation->fails()){
    return response()->json([
        'message' => 'Validation failed',
        'errors' => $validation->errors(),
    ], 422);
}

    Author::create([
        'name' => $data["name"],
        'email' => $data["email"],
        'bio' => $data["bio"] ,
        'gender' => $data["gender"],
        'birth_date' => $data["birth_date"],
    ]);

    return response()->json([
        'message' => 'Author created successfully',
    ], 201);
}

function show(Request $request,author $author):JsonResponse{

return response()->json($author);
}

function delete(author $author):JsonResponse{
    $author->delete();
    return response()->json([
        'message' => 'Author deleted successfully',
    ]);
}

public function update(Request $request, author $author): JsonResponse
{
    $validation = validator($request->all(), [
        // استثناء المعرف الحالي للمؤلف لتجنب رفض التحديث
        "name"       => "required|string|max:40|unique:authors,name," . $author->id,
        "email"      => "required|email|unique:authors,email," . $author->id,
        "bio"        => "nullable|string",
        "gender"     => "required|in:Male,Female",
        "birth_date" => "required|date|before:today",
    ]);

    // 1. التحقق من الفشل أولاً
    if ($validation->fails()) {
        return response()->json([
            'message' => 'Validation failed',
            'errors'  => $validation->errors(),
        ], 422);
    }

    $data = $validation->validated();

    $author->update($data);

    return response()->json([
        'message' => 'تم تحديث بيانات المؤلف بنجاح',
        'author'  => $author
    ]);
}

}