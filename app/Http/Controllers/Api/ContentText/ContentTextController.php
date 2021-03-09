<?php

namespace App\Http\Controllers\Api\ContentText;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ContentText\ContentTextService;
use App\Http\Requests\Api\ContentText\UpdateRequest;
use App\Http\Resources\Api\ContentText\ContentTextResource;
use Symfony\Component\HttpFoundation\Response;

class ContentTextController extends Controller
{
    private $contentTextService;

    public function __construct(ContentTextService $contentTextService)
    {
        $this->contentTextService = $contentTextService;
    }

    public function index(Request $request)
    {
    	$contenTexts = $this->contentTextService->all($request->all());

        return ContentTextResource::collection($contenTexts);
    }

    public function get(Request $request, int $id)
    {

        $contenText = $this->contentTextService->get($id);
        
        if(!is_null($contenText)){
            return new ContentTextResource($contenText);
        }else{
            return response()->json([
                'error' => [
                    'message' => 'Conteúdo não encontrado'
                ]
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function update(UpdateRequest $request)
    {

        $contenText = $this->contentTextService->update($request->all());
        
        return new ContentTextResource($contenText);
    }
}
