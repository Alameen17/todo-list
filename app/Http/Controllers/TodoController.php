<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index(){
        $todo = Todo::all();
        return response()->json(['todos'=>$todo], 200);
    }

    public function show($id){
        $todo = Todo::find($id);
        if ($todo) {
            return response()->json(['todos'=>$todo], 200);
        }

        return response()->json(['message'=>'No Todo-list Found'], 404);
    }

    public function store(Request $request){

        request()->validate([
            'title' => 'required'
        ]);

        $todo = Todo::create([
            "title"=>$request->title
        ]);
        return response()->json(['message'=>'Todo Added Succesfully'], 200);
    }

    public function update(Request $request, $id){

        request()->validate([
            'title' => 'required'
        ]);

        $todo = Todo::find($id);
        if ($todo) {
            $todo->update($request->all());
            
            return response()->json(['message'=>'Todo Updated Succesfully'], 200);
        }else{
            return response()->json(['message'=>'No Todo-list Found'], 404);
        }
    }

    public function patch(Request $request, $id){

        request()->validate([
            'title' => 'required'
        ]);

        $todo = Todo::find($id);
        if ($todo) {
            $todo->update($request->all());
            
            return response()->json(['message'=>'Todo Updated Succesfully'], 200);
        }else{
            return response()->json(['message'=>'No Todo-list Found'], 404);
        }
    }

    public function destroy($id){
        $todo = Todo::find($id);
        if ($todo) {
            $todo->delete();
            return response()->json(['message'=>"Todo Deleted Successfully"], 200);
        }else{
            return response()->json(['message'=>"Todo not found"], 404);
        }
    }
}
