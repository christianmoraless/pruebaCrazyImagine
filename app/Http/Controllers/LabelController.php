<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Label;

class LabelController extends Controller
{
    public function store(Request $request){
        $label = new Label();
        $label->title = $request->title;
        $label->note_id = $request->id;
        $label->save();
        return $label;
    }

    public function show($id){
        return response()->json(Label::all()->where('note_id','=',$id),200);
    }

    public function destroy($id){
        $note = Label::find($id);
        $note->delete();
    }
}
