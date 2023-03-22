<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use App\Models\Project;
use Livewire\WithFileUploads;

class ProjectEdit extends Component
{
    use WithFileUploads;

    public $name;
    public $description;
    public $github_link;
    public $photos = [];
    public $images = [];
    public $active = false;
    public $pinned = false;

    public function mount(Project $project)
    {
        $this->name = $project->name;
        $this->description = $project->description;
        $this->github_link = $project->github_link;
        $this->project = $project;
        $this->images = $project->getFiles($project);
        $this->active = $project->is_active;
        $this->pinned = $project->is_pinned;
    }

    public function render()
    {
        return view('livewire.project-edit', [
            'project' => $this->project,
            'images' => $this->images,
        ]);
    }

    public function edit($id)
    {
        $this->validate([
            'name' => 'required',
            'description' => 'required',
            'github_link' => '',
            'active' => 'boolean',
            'pinned' => 'boolean',
        ]);

        $project = Project::find($id);
        $projectName = strtolower(str_replace(' ', '-', $this->name));
        $imageCount = count($project->getFiles($project));
        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'github_link' => $this->github_link,
            'updated_at' => now(),
            'is_active' => $this->active,
            'is_pinned' => $this->pinned,
        ];

        if ($this->photos) {
            foreach ($this->photos as $photo) {
                $imageCount++;
                $photoName = $projectName . $imageCount . '.' . $photo->getClientOriginalExtension();
                $photo->storeAs('public/' . $project->id, $photoName);
            }
        } else {
            $files = Storage::files('public/' . $project->id);
            foreach ($files as $file) {
                $oldName = basename($file);
                $pattern = '/^' . preg_quote($project->name) . '/i';
                $newName = preg_replace($pattern, $projectName, $oldName, 1);
                Storage::move($file, 'public/' . $project->id . '/' . $newName);
            }
        }
        session()->flash('message', 'Image added successfully.');
        $project->update($data);
        $this->project = $project;
        $this->images = $project->getFiles($project);
        $this->render();
    }


    public function removePhoto($id, $photo)
    {
        $path = storage_path('app/public/' . $id . '/' . $photo);
        if (file_exists($path)) {
            unlink($path);
        }
        $this->images = $this->project->getFiles($this->project);
        $this->render();
    }
}
