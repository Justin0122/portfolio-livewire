<?php

namespace App\Http\Controllers;

use App\Http\Requests\Projects\ProjectCreateRequest;
use App\Http\Requests\Projects\ProjectUpdateRequest;
use App\Models\Project;

class ProjectsController extends Controller
{

    public function index()
    {
        $projectModel = new Project();
        $projects = $projectModel->getProjects();

        return view('projects.projects', compact('projects'));
    }
    public function create(ProjectCreateRequest $request)
    {
        $project = Project::create($request->validated());

        return redirect()->route('projects.show', $project);
    }

    public function update(ProjectUpdateRequest $request, Project $project)
    {
        $project->update($request->validated());

        return redirect()->route('projects.show', $project);
    }

    public function edit(Project $project)
    {
        return view('projects.project.edit', [
            'project' => $project,
        ])->layout('layouts.app');
    }


}


