<?php

namespace App\Services\Document;

use App\Models\Document\Document;

use Illuminate\Support\Facades\Storage;

/**
 * Class DocumentService
 *
 * @package App\Services\Document
 */
class DocumentService
{

    /**
     * DocumentService constructor.
     *
     */
    public function __construct()
    {
        //
    }


    /**
     * #GetDocuments
     * @param array $params
     *
     */

    public function get(array $params)
    {

        $query = Document::query();

        $query->orderBy('title', 'ASC');

        return $query->paginate($params['paginate'] ?? 10);

        //$contents = Storage::get('documents/DbVowhUHGDckKpnSUIenlOiOk8o1OraM1LWh1tFk.png');
        //
        //Storage::disk('local')->put('documents', $request->file);


    }

    public function download(array $params)
    {

        $document = Document::find($params['file']);

        if(env('FILESYSTEM_EXTERNAL') == true){

            if (Storage::disk('s3')->exists('documents/' . $document->file)) {
                $contents = Storage::disk('s3')->download('documents/' . $document->file);

                return $contents;
            }

        }else{
            if (Storage::disk('local')->exists('documents/' . $document->file)) {
                $contents = Storage::disk('local')->download('documents/' . $document->file);

                return $contents;
            }
        }
        

        return [
            'errors' => [
                'file' => ['Arquivo não encontrado']
            ]
        ];
        
    }
    
    /**
     * #CreateEvent
     * @param array $data
     * @return Document
     */

    public function create(array $data): Document
    {

        if(env('FILESYSTEM_EXTERNAL') == true){
            $file = Storage::disk('s3')->put('documents', $data['file']);
        }else{
            $file = Storage::disk('local')->put('documents', $data['file']);
        }

        $nameFile = explode('documents/', $file);


        $document = Document::create([
            'title' => $data['title'],
            'file' => $nameFile[1]
        ]);

        return $document;
    }

    /**
     * #UserUpdate-CaseUse.
     * @param User $user
     * @param array $data
     * @return User
     */
    public function update(User $user, array $data): User
    {
        return $this->userRepository->update($user, $data);
    }


    
}