<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Idea;
use Illuminate\Support\Facades\Gate;

class IdeaController extends Controller
{
    public function show(Idea $idea ){
        return view('idea.show', compact('idea'));
    }

    public function edit(Idea $idea){

        Gate::authorize('idea.edit' , $idea);

        $editing = true;
        return view('idea.show', compact('idea','editing'));
    }

    public function update(Idea $idea ){

        Gate::authorize('idea.edit' , $idea);

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
        Gate::authorize('idea.delete' , $idea);

        $id->delete();

        return redirect()->route('dashboard')->with('success', 'Idea was deleted successfully!');
    }
}
