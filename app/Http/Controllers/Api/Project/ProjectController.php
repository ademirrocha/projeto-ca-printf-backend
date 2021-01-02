<?php

namespace App\Http\Controllers\Api\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\Project\CreateRequest;
use App\Http\Resources\Api\Project\ProjectResource;
use App\Services\Project\ProjectService;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProjectController extends Controller
{
    /**
     * @var ProjectService
     */
    private $ProjectService;


    /**
     * ProjectController constructor.
     *
     * @param ProjectService $projectService
     */
    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }


    public function get(Request $request): AnonymousResourceCollection
    {

        $projects = $this->projectService->get($request->all());

        return ProjectResource::collection($projects);
    }


    public function create(CreateRequest $request)
    {

        $project = $this->projectService->create($request->all());
        
        return new ProjectResource($project);
    }
}
