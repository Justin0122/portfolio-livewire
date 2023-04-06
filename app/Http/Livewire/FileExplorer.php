<?php

namespace App\Http\Livewire;

use App\Models\Snippets;
use App\Models\Tags;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class FileExplorer extends Component
{
    public $snippets;
    public $tags;
    public $selectedTagId;
    public $selectedSnippetId = 1;
    public $selectedSnippet = null;
    public $tagName = '';
    public $snippetName = '';
    public $newSnippetName = '';
    public $snippetContent = '';

    public function mount(): void
    {
        $this->tags = Tags::fetchAll();
    }

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.file-explorer', [
            'snippets' => $this->snippets,
            'tags' => $this->tags,
            'selectedTagId' => $this->selectedTagId,
            'selectedSnippetId' => $this->selectedSnippetId,
            'selectedSnippet' => $this->selectedSnippet,
        ]);
    }

    public function fetchAllSnippets(): Collection
    {
        return Snippets::fetchAll();
    }

    public function fetchSnippetByTag($tagId): Collection
    {
        return Snippets::fetchSnippetByTag($tagId);
    }

    public function toggleFetchSnippetByTag($tagId): void
    {
        if ($this->selectedTagId === $tagId) {
            $this->selectedTagId = null;
            $this->snippets = null;

        } else {
            $this->selectedTagId = $tagId;
            $this->snippets = $this->fetchSnippetByTag($tagId);
            $snippet = $this->snippets->find($this->selectedSnippetId);
            if ($snippet) {
                $this->selectedSnippet = $snippet;
            } else {
                $this->selectedSnippet = null;
            }
        }
    }

    public function selectSnippet($snippetId): void
    {
        $this->selectedSnippetId = $snippetId;
        $this->selectedSnippet = $this->snippets->find($snippetId);
    }

    public function createTag(): void
    {
        $data = [
            'name' => $this->tagName,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        Tags::create($data);
        session()->flash('message', 'Tag created successfully.');
        $this->tags = Tags::fetchAll();
    }

    public function createSnippet(): void
    {
        $language = explode('.', $this->newSnippetName)[1];
        $title = explode('.', $this->newSnippetName)[0];
        $base_title = $title;
        $count = 0;

        do {
            $count++;
            $title = $base_title . '(' . $count . ')';
            $existing_snippet = Snippets::where('title', '=', $title)->first();
        } while ($existing_snippet);
        $this->newSnippetName = $title;
        $data = [
            'title' => $this->newSnippetName,
            'language' => $language,
            'tag_id' => $this->selectedTagId,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $this->newSnippetName = '';

        Snippets::create($data);
        session()->flash('message', 'Snippet created successfully.');
        $this->snippets = $this->fetchSnippetByTag($this->selectedTagId);
    }

    public function updateSnippet(): void
    {
        $snippet = Snippets::find($this->selectedSnippetId);
        $snippet->content = $this->snippetContent;
        $snippet->title = $this->snippetName;
        $snippet->save();
        session()->flash('message', 'Snippet updated successfully.');

        $this->snippets = $this->fetchSnippetByTag($this->selectedTagId);
    }

    public function deleteTag($id): void
    {
        $tag = Tags::find($id);
        $tag->delete();
        session()->flash('message', 'Tag deleted successfully.');
        $this->tags = Tags::fetchAll();
    }

    public function deleteSnippet($id): void
    {
        $snippet = Snippets::find($id);
        $snippet->delete();
        session()->flash('message', 'Snippet deleted successfully.');
        $this->snippets = $this->fetchSnippetByTag($this->selectedTagId);
        $this->selectedSnippet = null;
    }
}
