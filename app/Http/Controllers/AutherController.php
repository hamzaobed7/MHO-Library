<?php

namespace App\Http\Controllers;
use App\Models\author;
use Illuminate\Http\Request;

class AutherController extends Controller
{

function index()
{
$auther=author::all();
return $auther;
}

function store(Request $request)
{
    Author::create([
        'name' => $request->name,
        'email' => $request->email,
        'bio' => $request->bio,
        'gender' => $request->gender,
        'birth_date' => $request->birth_date,
    ]);

    return "تم";
}

function show(Request $request,$id){
$author=author::findOrFail($id);
return $author;
}

function delete($id){
    $author=author::findOrFail($id);
    $author->delete();
    return "تم الحذف";
}

function update(Request $request,$id){
    $author=author::findOrFail($id);
    $author->update([
        'name' => $request->name,
        'email' => $request->email,
        'bio' => $request->bio,
        'gender' => $request->gender,
        'birth_date' => $request->birth_date,
]);
return $author;
}

}