<?php

namespace App\Livewire\Project;

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

    public $project;
    public array $photos = [];
    public array $images;

    public string $name;
    public string $description;
    public string $github_link;


    public function mount(): void
    {
        $id = request()->segment(2);
        $this->project = Project::find($id);

        $this->name = $this->project->name;
        $this->description = $this->project->description ?? '';
        $this->github_link = $this->project->github_link ?? '';
        $this->is_active = $this->project->is_active;
        $this->is_pinned = $this->project->is_pinned;
    }

    public function render()
    {
        return view('livewire.project.project-edit', [
            'project' => $this->project,
            'images' => $this->images ?? [],
        ]);
    }

    public function edit()
    {
        $this->validate([
            'name' => 'required',
            'description' => 'required',
            'github_link' => '',
        ]);

        $this->project->update([
            'name' => $this->name,
            'description' => $this->description,
            'github_link' => $this->github_link,
        ]);

        if ($this->github_link) {
            $this->updateWithGithubApi($this->github_link);
        }

        if ($this->photos) {
            $imageCount = count($this->project->getFiles($this->project));
            foreach ($this->photos as $photo) {
                $imageCount++;
                $photoName = $this->project->name . '-' . $imageCount . '.' . $photo->getClientOriginalExtension();
                $photo->storeAs('public/' . $this->project->id, $photoName);
            }
        }

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
        try {
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

    public function togglePinned($id): void
    {
        $project = Project::find($id);
        $project->is_pinned = !$project->is_pinned;
        if ($project->is_pinned) {
            $project->is_active = true;
        }
        $project->save(['is_pinned', 'is_active']);
        session()->flash('message', 'project updated successfully.');
    }


    public function toggleActive($id): void
    {
        $project = Project::find($id);
        $project->is_active = !$project->is_active;
        if (!$project->is_active) {
            $project->is_pinned = false;
        }
        $project->save(['is_pinned', 'is_active']);
        session()->flash('message', 'project updated successfully.');
    }
}
