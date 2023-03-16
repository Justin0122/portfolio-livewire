<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Project;
use Livewire\WithFileUploads;

class ProjectEdit extends Component
{
    use WithFileUploads;

    public $name;
    public $description;
    public $photos = [];
    public $images = [];
    public $active = false;

    public function mount(Project $project)
    {
        $this->name = $project->name;
        $this->description = $project->description;
        $this->project = $project;
        $this->images = $project->getFiles($project);
        $this->active = $project->is_active;
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
            'photos.*' => 'image|max:1024', // 1MB Max
            'active' => 'boolean',
        ]);

        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'updated_at' => now(),
            'is_active' => $this->active,
            ];

        if ($this->photos) {
            $project = Project::find($id);
            foreach ($this->photos as $photo) {
                $photo->storeAs('public/' . $project->id, $photo->getClientOriginalName());
            }
        }
        $project = Project::find($id);
        $project->update($data);
        $this->project = Project::find($id);
        $this->images = $this->project->getFiles($this->project);
        $this->reset('photos');
        $this->render();
        $this->emit('projectUpdated');
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
