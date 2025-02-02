<?php

namespace App\Http\Controllers\Admin\Events;

use App\Http\Controllers\Controller;
use App\Models\Events\Event;
use App\Models\Events\EventStatu;
use App\Models\Events\EventType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all();
        $data = [
            'page_name' => 'Events',
            'page_title' => 'Events',
            'events' => $events,
        ];
        return view('admin.events.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = EventType::all();
        $status = EventStatu::all();
        $instructors = User::whereRoleIs('instructor')->get();

        $data = [
            'page_name' => 'Create Event',
            'page_title' => 'Create Event',
            'types' => $types,
            'status' => $status,
            'instructors' => $instructors,
        ];
        return view('admin.events.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'string|max:255',
            'description' => 'string',
            'type_id' => 'required',
            'statu_id' => 'required',
            'start_date' => [
                'required',
                'date',
                'before:' . Carbon::now()->addYears(2),
            ],
            'end_date' => [
                'required',
                'date',
                'after_or_equal:start_date'
            ],
        ]);

        $data = [
            'title' => $request->title,
            'start_date' => $request->start_date,
            'statu_id' => $request->statu_id,
        ];

        $rule =  [
            'title' => [
                Rule::unique('events', 'title')
                    ->where('start_date', $request->start_date)->where('statu_id', $request->statu_id)
            ]
        ];
        $message = [
            'title.unique' => 'Same Event already registered!, Please review start date and event status',
        ];
        $validator = Validator::make($data, $rule, $message);
        if ($validator->fails()) {
            session()->flash('alert_message', ['message' => 'Same Event already registered!, Please review start date and event status', 'icon' => 'danger']);
            return redirect()->back()->withInput();
        }

        $event =  Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'type_id' => $request->type_id,
            'statu_id' => $request->statu_id,
            'instructor_id' => $request->instructor_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'location' => $request->location,
            'video_url' => $request->video_url,
            'register_link' => $request->register_link,
            'email' => $request->email,
            'featured' => $request->boolean(key: 'featured'),
            'user_id' => Auth::id(),
        ]);

        // change event thumbnail image


        if ($request->has('event_img')) {
            $request->validate(
                ['event_img' => 'image|max:5000'],
                [
                    'event_img.image' => 'The file must be an image (JPEG, PNG, BMP, GIF, or SVG).',
                    'event_img.max' => 'The file size must not exceed 5 MB.'
                ]
            );
            $event->clearMediaCollection('event_img');
            $event->addMediaFromRequest('event_img')
                ->toMediaCollection('event_img');
        }

        session()->flash('alert_message', ['message' => 'New Event has been created successfully', 'icon' => 'success']);
        return redirect()->route('events.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        $types = EventType::all();
        $status = EventStatu::all();
        $instructors = User::whereRoleIs('instructor')->get();

        $data = [
            'page_name' => 'Edit Event',
            'page_title' => 'Edit Event',
            'types' => $types,
            'status' => $status,
            'instructors' => $instructors,
            'event' => $event,
        ];
        return view('admin.events.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {

        $request->validate([
            'title' => 'string|max:255',
            'description' => 'string',
            'type_id' => 'required',
            'statu_id' => 'required',
            'start_date' => [
                'required',
                'date',
                'before:' . Carbon::now()->addYears(2),
            ],
            'end_date' => [
                'required',
                'date',
                'after_or_equal:start_date'
            ],
        ]);

        $data = [
            'title' => $request->title,
            'start_date' => $request->start_date,
            'statu_id' => $request->statu_id,
        ];

        // $rule =  [
        //     'title' => [
        //         Rule::unique('events', 'title')
        //             ->where('start_date', $request->start_date)->where('statu_id', $request->statu_id)
        //     ]
        // ];
        // $message = [
        //     'title.unique' => 'Same Event already registered!, Please review start date and event status',
        // ];
        // $validator = Validator::make($data, $rule, $message);
        // if ($validator->fails()) {
        //     session()->flash('alert_message', ['message' => 'Same Event already registered!, Please review start date and event status', 'icon' => 'danger']);
        //     return redirect()->back()->withInput();
        // }

        $event->update([
            'title' => $request->title,
            'description' => $request->description,
            'type_id' => $request->type_id,
            'statu_id' => $request->statu_id,
            'instructor_id' => $request->instructor_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'location' => $request->location,
            'video_url' => $request->video_url,
            'register_link' => $request->register_link,
            'email' => $request->email,
            'featured' => $request->boolean(key: 'featured'),
        ]);

        // change event thumbnail image

        if ($request->has('event_img')) {
            $request->validate(
                ['event_img' => 'image|max:5000'],
                [
                    'event_img.image' => 'The file must be an image (JPEG, PNG, BMP, GIF, or SVG).',
                    'event_img.max' => 'The file size must not exceed 5 MB.'
                ]
            );
            $event->clearMediaCollection('event_img');
            $event->addMediaFromRequest('event_img')
                ->toMediaCollection('event_img');
        }

        session()->flash('alert_message', ['message' => 'Event Updated Successfully', 'icon' => 'success']);
        return redirect()->route('events.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();
        session()->flash('alert_message', ['message' => 'The Event has been deleted successfully', 'icon' => 'success']);
        return redirect()->back();
    }
}
