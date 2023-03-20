<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Storage;
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

        $project = Project::find($id);
        $projectName = strtolower(str_replace(' ', '-', $this->name));
        $imageCount = count($project->getFiles($project));
        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'updated_at' => now(),
            'is_active' => $this->active,
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
