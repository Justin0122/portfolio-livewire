<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index()
    {
        return view('projects.projects');
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store()
    {
        return view('projects.store');
    }

    public function show()
    {
        return view('projects.show');
    }

    public function edit()
    {
        return view('projects.edit');
    }

    public function update()
    {
        return view('projects.update');
    }

    public function destroy()
    {
        return view('projects.destroy');
    }
}
