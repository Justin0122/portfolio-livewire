<?php

namespace App\Http\Livewire\Project;

use App\Models\Framework;
use App\Models\Language;
use App\Models\Project;
use Exception;
use Github\Client;
use Github\HttpClient\Builder;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProjectEdit extends Component
{
    use WithFileUploads;

    public $name;
    public $description;
    public $github_link;
    public $photos = [];
    public $images = [];
    public $active;
    public $pinned;

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
        return view('livewire.project.project-edit', [
            'project' => $this->project,
            'images' => $this->images,
            'photos' => $this->photos,
        ]);
    }

    public function edit($id)
    {
        session()->flash('status', 'project-updated');

        $this->validate([
            'name' => 'required',
            'description' => 'required',
            'github_link' => '',
            'active' => 'boolean',
            'pinned' => 'boolean',
        ]);

        if ($this->pinned) {
            $this->active = true;
        }

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

        //if the github link is not empty, update the project with the github api
        if ($this->github_link) {
            $this->updateWithGithubApi($this->github_link);
        }

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
        $this->emit('projectUpdated', true);

        $this->photos = [];

        $project->update($data);
        $this->project = $project;
        $this->images = $project->getFiles($project);

        $this->render();
    }

    public function updateWithGithubApi($githubLink): void
    {
        $urlParts = parse_url($githubLink);
        $pathInfo = pathinfo($urlParts['path']);
        $repo = $pathInfo['basename'];

        $client = new Client();
        $client->authenticate(env('GITHUB_TOKEN'), null, Client::AUTH_ACCESS_TOKEN);

        $languages = $client->api('repo')->languages('Justin0122', $repo);
        $languageNames = array_keys($languages);

        $languageIds = $this->getLanguageIds($languageNames);

        $this->project->languages()->sync($languageIds);
        try{
        $frameworks = $client->api('repo')->contents()->show('Justin0122', $repo, 'package.json');
            $frameworkNames = $this->getFrameworkNames($frameworks);

            $frameworkIds = $this->getFrameworkIds($frameworkNames);

            $this->project->frameworks()->sync($frameworkIds);
        } catch (Exception $e) {
            $this->project->frameworks()->sync([]);
        }

    }


    public function getLanguageIds($languages): array
    {
        $languageIds = [];
        foreach ($languages as $language) {
            $language = Language::where('name', $language)->first();
            if ($language) {
                $languageIds[] = $language->id;
            }
        }
        return $languageIds;
    }


    public function getFrameworkIds($frameworks): array
    {
        $frameworkIds = [];
        foreach ($frameworks as $framework) {
            $framework = Framework::where('name', $framework)->first();
            if ($framework) {
                $frameworkIds[] = $framework->id;
            }
        }
        return $frameworkIds;
    }

    public function getFrameworkNames($frameworks): array
    {
        $frameworks = json_decode(base64_decode($frameworks['content']));
        $frameworkNames = [];
        if (isset($frameworks->frameworks)) {
            foreach (get_object_vars($frameworks->frameworks) as $name => $version) {
                $frameworkNames[] = $name;
            }
        }

        return $frameworkNames;
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
