<?php

namespace App\Http\Controllers\Api\Image;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Image\ImageService;
use Symfony\Component\HttpFoundation\Response;

class ImageController extends Controller
{
    
	/**
     * @var ImageService
     */
    private $imageService;


    /**
     * ImageController constructor.
     *
     * @param ImageService $imageService
     */
    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index(Request $request)
    {

        return [];
    }

    public function get(Request $request, $id)
    {

        $image = $this->imageService->get($id);

        if(isset($image['errors'])){
            return response()->json([
                'errors' => $image['errors']
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return $image;
    }
}
