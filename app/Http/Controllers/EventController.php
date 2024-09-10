<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Models\EventUser;
use App\Models\User;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        $events = $user->events;

        return view('user.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::getAllExceptLoggedIn(); // Obtém todos os usuários
        return view('user.events.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'string|nullable',
            'user_ids' => 'array|nullable',
            'user_ids.*' => 'exists:users,id',
        ]);

        $user = Auth::user();

        $event = Event::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'user_id' => $user->id,
        ]);

        $now = now();
        $eventUsers = [
            ['event_id' => $event->id, 'user_id' => $user->id, 'created_at' => $now, 'updated_at' => $now]
        ];

        if (isset($validatedData['user_ids'])) {
            foreach ($validatedData['user_ids'] as $userId) {
                $eventUsers[] = ['event_id' => $event->id, 'user_id' => $userId, 'created_at' => $now, 'updated_at' => $now];
            }
        }

        $insertUsersInEvent = EventUser::insert($eventUsers);

        return redirect()->route('user.event.index')->with('success', 'Evento criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
