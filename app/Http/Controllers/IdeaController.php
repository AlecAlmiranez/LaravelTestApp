<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateIdeaRequest;
use App\Http\Requests\UpdateIdeaRequest;
use Illuminate\Http\Request;
use App\Models\Idea;
use Illuminate\Support\Facades\Gate;

class IdeaController extends Controller
{
    public function show(Idea $idea ){
        return view('idea.show', compact('idea'));
    }

    public function edit(Idea $idea){

        Gate::authorize('update' , $idea);

        $editing = true;
        return view('idea.show', compact('idea','editing'));
    }

    public function update(UpdateIdeaRequest $request, Idea $idea ){

        Gate::authorize('update' , $idea);

        $validated = $request->validated();

        $idea->update($validated);

        return redirect()-> route('idea.show',$idea->id)-> with('success','Idea '.$idea->id. ' updated successfully!');
    }

    public function store(CreateIdeaRequest $request)
    {
        $validated = $request->validated();

        $validated['user_id'] = auth()->id();

        Idea::create($validated);

        return redirect()->route('dashboard')->with('success', 'Idea was created successfully!');
    }

    public function destroy(Idea $id)
    {
        Gate::authorize('delete' , $id);

        $id->delete();

        return redirect()->route('dashboard')->with('success', 'Idea was deleted successfully!');
    }
}
