<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\CreateTaskRequest;
use App\Http\Requests\Task\ListTasksRequest;
use App\Http\Requests\Task\ReorderTasksRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Http\Services\ProjectService;
use App\Http\Services\TaskService;
use Illuminate\Http\JsonResponse;

class ProjectController extends Controller
{
    protected ?ProjectService $projectService = null;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    public function index()
    {
        $projects = (new ProjectService())->getAll();

        return view('projects.index', [
            'projects' => $projects,
        ]);
    }

}
