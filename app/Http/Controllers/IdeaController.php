<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Idea;

class IdeaController extends Controller
{
    public function show(Idea $idea ){
        return view('idea.show', compact('idea'));
    }

    public function edit(Idea $idea){

        if(auth() -> id() != $idea->user_id){
            abort(404);
        }

        $editing = true;
        return view('idea.show', compact('idea','editing'));
    }

    public function update(Idea $idea ){

        if(auth() -> id() != $idea->user_id){
            abort(404);
        }

        $validated = request()->validate([
            'content' => 'required|min:5|max:240',
        ]);

        $idea->update($validated);

        return redirect()-> route('idea.show',$idea->id)-> with('success','Idea '.$idea->id. ' updated successfully!');
    }

    public function store()
    {
        $validated = request()->validate([
            'content' => 'required|min:5|max:240',
        ]);

        $validated['user_id'] = auth()->id();

        Idea::create($validated);

        return redirect()->route('dashboard')->with('success', 'Idea was created successfully!');
    }

    public function destroy(Idea $id)
    {
        if(auth() -> id() != $idea->user_id){
            abort(404);
        }
        $id->delete();

        return redirect()->route('dashboard')->with('success', 'Idea was deleted successfully!');
    }
}
