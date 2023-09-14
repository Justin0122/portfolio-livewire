<?php

namespace App\Http\Controllers;

use App\Models\Project;

class ProjectsController extends Controller
{
    public function index()
    {
        $projectModel = new Project();
        $projects = $projectModel->getProjects();
        return view('projects.projects', compact('projects'));
    }

    public function edit(Project $project)
    {
        $files = $project->getFiles($project);

        return view('projects.project.edit', [
            'project' => $project,
            'files' => $files,
        ]);
    }

    public function show(Project $project)
    {
        $files = $project->getFiles($project);

        return view('projects.project.show', [
            'project' => $project,
            'files' => $files,
        ]);
    }

    public function api()
    {
        //if secure_token is not the same as the one in the .env file, return an empty array
        if(request()->get('secure_token') != $_ENV['SECURE_TOKEN']){
            return [];
        }
        $amount = request()->get('amount') ?? 10;
        $offset = request()->get('offset') ?? 0;
        $projectModel = new Project();
        $projects = $projectModel->getProjects($amount, $offset);
        return $projects;
    }

}


