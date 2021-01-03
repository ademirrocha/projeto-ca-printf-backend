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

    private function getDocument($document){

        if($document->local == 's3'){

            if (Storage::disk('s3')->exists('documents/' . $document->file)) {
                $contents = Storage::disk('s3')->get('documents/' . $document->file);

                return $contents;
            }

        }else{
            if (Storage::disk('local')->exists('documents/' . $document->file)) {
                $contents = Storage::disk('local')->get('documents/' . $document->file);

                return $contents;
            }
        }
    }


    public function download(array $params)
    {

        $document = Document::find($params['file']);

        $nameFile = preg_replace('/[ _]+/' , '_' , $document->title);

        $extension = explode('.', $document->file);

        $nameFile = $nameFile.'.'.$extension[1];

        if($document->local == 's3'){

            if (Storage::disk('s3')->exists('documents/' . $document->file)) {
                $contents = Storage::disk('s3')->download('documents/' . $document->file, $nameFile);

                return $contents;
            }

        }else{
            if (Storage::disk('local')->exists('documents/' . $document->file)) {
                $contents = Storage::disk('local')->download('documents/' . $document->file, $nameFile);

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

        $file = $this->createFile($data);

        $document = Document::create([
            'title' => $data['title'],
            'file' => $file[0],
            'local' => $file[1],
        ]);

        return $document;
    }


    private function createFile($data){
        if(env('FILESYSTEM_EXTERNAL') == true){
            $file = Storage::disk('s3')->put('documents', $data['file']);
            $local = 's3';
        }else{
            $file = Storage::disk('local')->put('documents', $data['file']);
            $local = 'local';
        }

        $nameFile = explode('documents/', $file);

        return [$nameFile[1], $local];
    }


    private function deleteFile($document){

        if($document->local == 's3'){

            if (Storage::disk('s3')->exists('documents/' . $document->file)) {
                Storage::disk('s3')->delete('documents/' . $document->file);
            }

        }else{
            if (Storage::disk('local')->exists('documents/' . $document->file)) {
                Storage::disk('local')->delete('documents/' . $document->file);

            }
        }

    }

    /**
     * #UpdateDocument
     * @param object $data
     */
    public function update(object $data): Document
    {
        $document = Document::find($data['id']);

        if($data->hasFile('file')){
            $this->deleteFile($document);

            $file = $this->createFile($data);

        }

        $document->title = $data['title'];
        $document->file = $file[0] ?? $document->file;
        $document->local = $file[1] ?? $document->local;

        $document->save();
        

        return $document;
    }


    /**
     * #DeleteDocument
     * @param array $data
     */
    public function delete(array $data){
        $document = Document::find($data['id']);

        $this->deleteFile($document);
        
        return $document->delete();

    }


    
}