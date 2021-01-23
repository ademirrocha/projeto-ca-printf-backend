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
     * #GetAllEvents
     * @param array $params
     *
     */

    public function all(array $params)
    {

        $query = Event::query();

        $query->orderBy('initial_date', 'DESC');
        
        return $query->paginate($params['paginate'] ?? 10);
    }

    /**
     * #GetEvent
     * @param int $id
     *
     */

    public function get(int $id)
    {

        $event = Event::find($id);
        
        return $event;
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


    /**
     * #DeleteEvent
     * @param array $data
     */
    public function delete(array $data){
        $event = Event::find($data['id']);

        return $event->delete();

    }



    
}