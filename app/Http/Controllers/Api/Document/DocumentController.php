<?php

namespace App\Http\Controllers\Api\Document;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Document\DocumentService;
use App\Http\Requests\Api\Document\CreateRequest;
use App\Http\Requests\Api\Document\UpdateRequest;
use App\Http\Requests\Api\Document\DeleteRequest;
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



    public function types(CreateRequest $request)
    {
    	$typeDocuments = $this->documentService->types($request->all());

        return $typeDocuments;
    }


    public function create(CreateRequest $request)
    {
        $document = $this->documentService->create($request->all());

        return new DocumentResource($document);
    }


    public function index(Request $request)
    {

    	$documents = $this->documentService->all($request->all());

        return DocumentResource::collection($documents);
    }

    public function get(Request $request, int $id)
    {

        $document = $this->documentService->get($id);
        
        if(!is_null($document)){
            return new DocumentResource($document);
        }else{
            return response()->json([
                'error' => [
                    'message' => 'Documento não encontrado'
                ]
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
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


    public function delete(DeleteRequest $request)
    {

        $delete = $this->documentService->delete($request->all());
        
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
