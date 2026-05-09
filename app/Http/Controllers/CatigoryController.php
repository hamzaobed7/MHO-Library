<?php

namespace App\Http\Controllers;
use App\Models\Catigory;
use Illuminate\Http\Request;

class CatigoryController extends Controller
{
        public function index()
        {
            $catigories = Catigory::all();
            return response()->json($catigories);
        }
    
        public function store(Request $request)
        {
            $catigory = Catigory::create($request->all());
            return response()->json($catigory, 201);
        }
    
        public function show($id)
        {
            $catigory = Catigory::findOrFail($id);
            return response()->json($catigory);
        }
    
        public function update(Request $request, $id)
        {
            $catigory = Catigory::findOrFail($id);
            $catigory->update($request->all());
            return response()->json($catigory);
        }
    
        public function delete($id)
        {
            Catigory::destroy($id);
            return response()->json(null, 204);
        }
}
