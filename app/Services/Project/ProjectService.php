<?php

namespace App\Services\Project;

use App\Models\Project\Project;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\File\File;
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


        if(!is_null($project) && !is_null($project->file_id)){
            $file = File::find($project->file_id);

            $file->originalName = $data['image']['originalName'] ?? $file->originalName;
            $file->mimetype = $data['image']['mimetype'];
            $file->size = $data['image']['size'];
            $file->key = $data['image']['key'];
            $file->url = $data['image']['url'];
            
            $file->save();

        }else{
            $file = File::create([
                'originalName' => $data['image']['originalName'] ?? null,
                'mimetype' => $data['image']['mimetype'],
                'size' => $data['image']['size'],
                'key' => $data['image']['key'],
                'url' => $data['image']['url']
            ]);
        }

        return $file;
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

        if(isset($data['image']) && !is_null($data['image']) && isset($data['image']['url']) && !is_null($data['image']['url'])){
            $image = $this->createFile($data);
        }
        
        $project = Project::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'file_id' => $image->id ?? null,
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