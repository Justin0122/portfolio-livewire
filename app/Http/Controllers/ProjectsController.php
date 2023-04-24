<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Helpers\ImageHelper;

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
        $files = ImageHelper::getImages($project->id, 'projects');

        return view('projects.project.edit', [
            'project' => $project,
            'files' => $files,
        ]);
    }

    public function show(Project $project)
    {
        $files = ImageHelper::getImages($project->id, 'projects');

        return view('projects.project.show', [
            'project' => $project,
            'files' => $files,
        ]);
    }

}


