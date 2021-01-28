<?php

namespace App\Http\Controllers\Api\Search;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Search\SearchService;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Api\Search\SearchRequest;
use App\Http\Resources\Api\Search\SearchResource;

class SearchController extends Controller
{
    /**
     * @var searchService
     */
    private $searchService;

    

    /**
     * SearchController constructor.
     *
     * @param SearchService $SearchService
     */
    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
        
    }


    public function index(SearchRequest $request)
    {

        $searcheds = $this->searchService->search($request->all());

        $documents =  SearchResource::collection($searcheds['documents']);
        $projects =  SearchResource::collection($searcheds['projects']);
        $events =  SearchResource::collection($searcheds['events']);

        return response()->json([
                'data' => [
                    'documents' => $documents,
                    'events' => $events,
                    'projects' => $projects,
                ]
            ], Response::HTTP_OK);
    }




}
