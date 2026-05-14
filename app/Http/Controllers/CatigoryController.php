<?php

namespace App\Http\Controllers;
use App\Models\Catigory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CatigoryController extends Controller
{
        public function index():JsonResponse
        {
            $catigories = Catigory::all();
            return response()->json($catigories);
        }
    
        public function store(Request $request):JsonResponse
        {
            $validation=validator($request->all(),[
                'type'=>'required|string|max:30',
                'description'=>'nullable|string',
            ]); 
            if($validation->fails()){
                return response()->json(['errors'=>$validation->errors()],422);
            }
            $data=$validation->validated();

            $catigory = Catigory::create([
               "type"=>$data['type'],
                "description"=>$data['description'],
        ]);
            return response()->json($catigory, 201);
        }
    
        public function show(Catigory $catigory):JsonResponse
        {
           
            return response()->json($catigory);
        }
    
        public function update(Request $request,Catigory $catigory):JsonResponse
        {
              $validation=validator($request->all(),[
               'type'=>'required|string|max:30',
                'description'=>'nullable|string',
              ]);

              if($validation->fails()){
                return response()->json(['errors'=>$validation->errors()],422);
            }
            $catigory->update( $validation->validated());
            return response()->json($catigory);
        }
    
        public function delete(Catigory $catigory)
        {
            Catigory::destroy($catigory);
            return response()->json(null, 204);
        }
}
