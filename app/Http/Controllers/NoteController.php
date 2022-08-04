<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Note;

class NoteController extends Controller
{
    public function index(){
        $user=auth()->id();
        return response()->json(Note::all()->where('user_id','=',$user),200);
    }
    public function store(Request $request){
        $note = new Note();
        $note->title = $request->title;
        $note->description = $request->description; 
        $note->user_id = auth()->id();
        $note->save();
        return $note;
    }
    public function destroy($id){
        $note = Note::find($id);
        $note->delete();
    }

    public function archived(){
        $user=auth()->id();
        $notesTrashed = Note::onlyTrashed()->where('user_id','=',$user)->orderBy('id','desc')->get();
        return response()->json($notesTrashed);
    }

    public function show($id){
        $note = Note::find($id);
        return response()->json($note);
    }

    public function update(Request $request, $id){
        $note = Note::find($id);
        $note->update($request->all());
        return response($note);
    }
}
