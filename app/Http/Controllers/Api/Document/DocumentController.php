<?php

namespace App\Http\Controllers\Api\Document;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Document\DocumentService;
use App\Http\Requests\Api\Document\CreateRequest;
use App\Http\Requests\Api\Document\UpdateRequest;
use App\Http\Requests\Api\Document\DownloadRequest;
use App\Http\Resources\Api\Document\DocumentResource;
use Symfony\Component\HttpFoundation\Response;


class DocumentController extends Controller
{

	/**
     * @var DocumentService
     */
    private $documentService;


    /**
     * DocumentController constructor.
     *
     * @param DocumentService $documentService
     */
    public function __construct(DocumentService $documentService)
    {
        $this->documentService = $documentService;
    }



    public function create(CreateRequest $request)
    {
    	$document = $this->documentService->create($request->all());

        return new DocumentResource($document);
    }


    public function get(Request $request)
    {

    	$documents = $this->documentService->get($request->all());

        return DocumentResource::collection($documents);
    }


    public function download(DownloadRequest $request)
    {

    	$document = $this->documentService->download($request->all());

        if(isset($document->errors)){
            return response()->json([
                'errors' => $document['errors']
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return $document;
    }

    public function update(UpdateRequest $request)
    {

        $document = $this->documentService->update($request);
        
        return new DocumentResource($document);
    }



}
