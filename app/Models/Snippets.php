<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Snippets extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'code',
        'language',
        'tag_id',
    ];

    public static function fetchAll()
    {
        return Snippets::all();
    }

    public static function fetchSnippetByTag($tag)
    {
        return Snippets::where('tag_id', $tag)->get();
    }

    public static function create(array $data)
    {
        $snippet = new Snippets();
        $data['title'] = explode('.', $data['title'])[0];
        $snippet->title = $data['title'];
        $snippet->content = " ";
        $snippet->language = $data['language'];
        $snippet->tag_id = $data['tag_id'];
        $snippet->save();
    }

}
