<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->get();
        return view('blogs.index', compact('blogs'));
    }

    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        return view('blogs.show', compact('blog'));
    }
}
