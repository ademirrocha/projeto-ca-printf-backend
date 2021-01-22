<?php

namespace App\Http\Controllers\Api\Event;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\Event\CreateRequest;
use App\Http\Requests\Api\Event\UpdateRequest;
use App\Http\Requests\Api\Event\DeleteRequest;
use App\Http\Resources\Api\Event\EventResource;
use App\Services\Event\EventService;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class EventController extends Controller
{
    /**
     * @var EventService
     */
    private $eventService;


    /**
     * EventController constructor.
     *
     * @param EventService $eventService
     */
    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    public function index(Request $request): AnonymousResourceCollection
    {

        $events = $this->eventService->all($request->all());

        $res =  EventResource::collection($events);

        $res->withPath(env('APP_URL_FRONT').'/eventos');

        return ($res);
    }

    public function get(Request $request, int $id)
    {

        $event = $this->eventService->get($id);
        if(!is_null($event)){
            return new EventResource($event);
        }else{
            return response()->json([
            'error' => [
                'message' => 'Evento não encontrado'
            ]
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        
    }


    public function create(CreateRequest $request)
    {

        $event = $this->eventService->create($request->all());
        
        return new EventResource($event);
    }

    public function update(UpdateRequest $request)
    {

        $event = $this->eventService->update($request->all());
        
        return new EventResource($event);
    }


    public function delete(DeleteRequest $request)
    {

        $delete = $this->eventService->delete($request->all());

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
