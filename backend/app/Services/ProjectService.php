<?php

namespace App\Services;

use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;

class ProjectService
{
    public function getAll(): Collection
    {
        return Project::all();
    }

    public function getById(int $id)
    {
        return Project::where('id', $id)->first();
    }

    public function store($data): void
    {
        Project::create($data);
    }

    public function update(int $id, array $data): void
    {
        $project = $this->getById($id);
        if (!$project) { return; }

        $project->update($data);
    }

    public function delete(int $id): void
    {
        $project = $this->getById($id);
        if (!$project) { return; }

        $project->delete();
    }
}
