<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Idea;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    public function index(){

        $ideas = Idea::latest()->paginate(5);
        return view('admin.idea.index', compact('ideas'));
    }
}
