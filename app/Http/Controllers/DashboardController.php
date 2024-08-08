<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailables\Content;

class DashboardController extends Controller
{

    public function index()
    {

        // $ideas = Idea::withCount('likes')->orderBy('created_at', 'DESC');

        // if(request()->has('search')){
        //     $ideas = $ideas->search(request('search',''));
        // }

        $ideas = Idea::when(request()->has('search'), function($query){
            $query->search(request('search',''));
        })->orderBy('created_at','DESC');

        return view('dashboard', [
            'ideas' => $ideas->paginate(5),
        ]);
    }
}
