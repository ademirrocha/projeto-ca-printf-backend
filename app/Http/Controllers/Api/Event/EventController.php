<?php

namespace App\Http\Controllers\Api\Event;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\Event\CreateRequest;
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


    public function get(Request $request): AnonymousResourceCollection
    {

        $events = $this->eventService->get($request->all());

        return EventResource::collection($events);
    }


    public function create(CreateRequest $request)
    {

        $event = $this->eventService->create($request->all());
        
        return new EventResource($event);
    }



}
