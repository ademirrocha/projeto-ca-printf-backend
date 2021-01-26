<?php

namespace App\Http\Controllers\Api\SchoolClass;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Resources\Api\SchoolClass\SchoolClassResource;
use App\Services\SchoolClass\SchoolClassService;
use App\Services\Document\DocumentService;

class SchoolClassController extends Controller
{
    /**
     * @var SchoolClassService
     */
    private $schoolClassService;

    private $documentService;


    /**
     * SchoolClassController constructor.
     *
     * @param SchoolClassService $SchoolClassService
     */
    public function __construct(SchoolClassService $schoolClassService, DocumentService $documentService)
    {
        $this->schoolClassService = $schoolClassService;
        $this->documentService = $documentService;
    }


    public function index(Request $request)
    {

        $schoolClasss = $this->schoolClassService->all($request->all());

        $typeDocuments = $this->documentService->types($request->all());
        
         return response()->json([
                'data' => [
                    'schoolClasss' => SchoolClassResource::collection($schoolClasss),
                    'typeDocuments' => $typeDocuments,
                ]
            ], Response::HTTP_OK);
    }
}
