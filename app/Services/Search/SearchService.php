<?php

namespace App\Services\Search;

use App\Models\Event\Event;
use App\Models\Document\Document;
use App\Models\Project\Project;
use Illuminate\Support\Facades\DB;

/**
 * Class SearchService
 *
 * @package App\Services\Search
 */
class SearchService
{

    /**
     * SearchService constructor.
     *
     */
    public function __construct()
    {
        //
    }


    /**
     * #GetAllSearches
     * @param array $params
     *
     */

    public function search(array $params)
    {

        $events = Event::query();
        $documents = Document::query();
        $projects = Project::query();

        $events->select('id', 'title', 'description', 'state')->where(function($events) use ($params){
            $events->where('title', 'LIKE', "%{$params['search']}%");
            $events->orWhere('description', 'LIKE', "%{$params['search']}%");
            
        })->addSelect(DB::raw("initial_date as initial_date"))
        ->addSelect(DB::raw("'null' as file_id"))
        ->addSelect(DB::raw("'null' as type"))
        ->addSelect(DB::raw("'events' as typeSearched"));

        $documents->select('id', 'title', 'description', 'state')->where(function($documents) use ($params){
            $documents->where('title', 'LIKE', "%{$params['search']}%");
            $documents->orWhere('description', 'LIKE', "%{$params['search']}%");
            $documents->orWhere('type', 'LIKE', "%{$params['search']}%");

        })->addSelect(DB::raw("'null' as initial_date"))
        ->addSelect(DB::raw("file_id as file_id"))
        ->addSelect(DB::raw("type as type"))
        ->addSelect(DB::raw("'documents' as typeSearched"));


        $projects->select('id', 'title', 'description', 'state')->where(function($projects) use ($params){
            $projects->where('title', 'LIKE', "%{$params['search']}%");
            $projects->orWhere('description', 'LIKE', "%{$params['search']}%");

        }) ->addSelect(DB::raw("'null' as initial_date"))
        ->addSelect(DB::raw("'null' as file_id"))
        ->addSelect(DB::raw("'null' as type"))
        ->addSelect(DB::raw("'projects' as typeSearched"));

        

        return [
            'projects' => $projects->get(),
            'documents' => $documents->get(),
            'events' => $events->get(),
        ];
    }

    
}

