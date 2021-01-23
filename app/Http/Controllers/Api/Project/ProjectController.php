<?php

namespace App\Http\Controllers\Api\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\Project\CreateRequest;
use App\Http\Requests\Api\Project\UpdateRequest;
use App\Http\Requests\Api\Project\DeleteRequest;
use App\Http\Resources\Api\Project\ProjectResource;
use App\Services\Project\ProjectService;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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


    public function index(Request $request): AnonymousResourceCollection
    {

        $projects = $this->projectService->all($request->all());

        return ProjectResource::collection($projects);
    }



    public function get(Request $request, int $id)
    {

        $project = $this->projectService->get($id);
        
        if(!is_null($project)){
            return new ProjectResource($project);
        }else{
            return response()->json([
            'error' => [
                'message' => 'Projeto não encontrado'
            ]
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }



    }


    public function create(CreateRequest $request){

        $project = $this->projectService->create($request->all());

        return new ProjectResource($project);
    }

    public function update(UpdateRequest $request)
    {

        $project = $this->projectService->update($request);

        return new ProjectResource($project);

    }


    public function delete(DeleteRequest $request)
    {

        $delete = $this->projectService->delete($request->all());

        if($delete == true){

            return response()->json([
                'success' => [
                    'message' => 'Deletado com sucesso'
                ]
            ], Response::HTTP_OK);

        }

        return response()->json([
            'error' => [
                'message' => 'Não foi possivel deletar'
            ]
        ], Response::HTTP_UNPROCESSABLE_ENTITY);


    }


}
