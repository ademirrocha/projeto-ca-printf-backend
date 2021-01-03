<?php

namespace App\Services\Project;

use App\Models\Project\Project;
use Illuminate\Support\Facades\Storage;

use App\Models\Image\Image;
/**
 * Class ProjectService
 *
 * @package App\Services\Project
 */
class ProjectService
{

    /**
     * ProjectService constructor.
     *
     */
    public function __construct()
    {
        //
    }


    private function createFile($data, $project = null){
        if(env('FILESYSTEM_EXTERNAL') == true){
            $file = Storage::disk('s3')->put('images', $data['image']);
            $local = 's3';
        }else{
            $file = Storage::disk('local')->put('images', $data['image']);
            $local = 'local';
        }

        $nameImage = explode('images/', $file);

        if(!is_null($project) && !is_null($project->image_id)){
            $image = Image::find($project->image_id);

            $image->name = $nameImage[1];
            $image->local = $local;
            $image->save();

        }else{
            $image = Image::create([
                'name' => $nameImage[1],
                'local' => $local
            ]);
        }
        

        return $image;
    }


    /**
     * #GetProjects
     * @param array $params
     *
     */

    public function get(array $params)
    {

        $query = Project::query();

        $query->orderBy('created_at', 'DESC');

        return $query->paginate($params['paginate'] ?? 10);
    }

    private function deleteFile($project){

        if($project->image->local == 's3'){

            if (Storage::disk('s3')->exists('images/' . $project->image->name)) {
                Storage::disk('s3')->delete('images/' . $project->image->name);
            }

        }else{
            if (Storage::disk('local')->exists('images/' . $project->image->name)) {
                Storage::disk('local')->delete('images/' . $project->image->name);

            }
        }

    }
    
    /**
     * #CreateProject
     * @param array $data
     * @return Project
     */

    public function create(array $data): Project
    {

        if(isset($data['image'])){
            $image = $this->createFile($data);
        }
        
        $project = Project::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'image_id' => $image->id ?? null,
        ]);

        return $project;
    }

    /**
     * #UpdateProject.
     * @param object $data
     * @return Project
     */
    public function update(object $data): Project
    {
        $project = Project::find($data['id']);

        if($data->hasFile('image')){
            $this->deleteFile($project);

            $image = $this->createFile($data, $project);

        }

        $project->title = $data['title'];
        $project->description = $data['description'];
        $project->image_id = $image->id ?? $project->image_id;

        $project->save();
        
        return $project;
    }


    /**
     * #DeleteProject
     * @param array $data
     */
    public function delete(array $data){

        $project = Project::find($data['id']);

        if(!is_null($project->image_id)){

            $this->deleteFile($project);
            
            $imageId = $project->image_id;
            $project->image_id = null;
            $project->save();

            Image::where('id', $imageId)->delete();

        }
        
        return $project->delete();

    }
    
}