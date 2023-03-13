<?php

namespace App\Models;

use App\Http\Controllers\Request;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'status',
        'user_id',
    ];

    public static function create(array $data)
    {
        $project = new Project();
        $project->name = $data['name'];
        $project->description = $data['description'];
        $project->save();
    }

    public function getProjects()
    {
        return $this->all();
    }

    public function getProject($id)
    {
        return $this->find($id);
    }



}
