<?php

namespace App\Services\Event;

use App\Models\Event\Event;

/**
 * Class EventService
 *
 * @package App\Services\Event
 */
class EventService
{

    /**
     * EventService constructor.
     *
     */
    public function __construct()
    {
        //
    }


    /**
     * #GetEvents
     * @param array $params
     *
     */

    public function get(array $params)
    {

        $query = Event::query();

        $query->orderBy('initial_date', 'DESC');
        
        return $query->paginate($params['paginate'] ?? 10);
    }
    
    /**
     * #CreateEvent
     * @param array $data
     * @return Event
     */

    public function create(array $data): Event
    {

        $event = Event::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'initial_date' => $data['initial_date'],
            'final_date' => $data['final_date'],
            'state' => $data['state'] ?? 'Ativo',
        ]);

        return $event;
    }

    /**
     * #UpdateEvent
     * @param array $data
     * @return Event
     */
    public function update(array $data): Event
    {
        $event = Event::find($data['id']);

        $event->title = $data['title'];
        $event->description = $data['description'];
        $event->initial_date = $data['initial_date'];
        $event->final_date = $data['final_date'];
        $event->state = $data['state'];

        $event->save();
        

        return $event;
    }


    
}