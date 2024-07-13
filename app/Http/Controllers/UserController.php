<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title ='users';
        $users= user::get ();
        $unreadCount = Message::where('readable', 0)->count();
        $nodifications = Message::where('readable', 0)->take(3)->get();

        // Add a human-readable time difference to each notification
        foreach ($nodifications as $nodification) {
            $nodification->time_diff = Carbon::parse($nodification->created_at)->diffForHumans();
    
            // Get first 5 words from messageContent
            $words = explode(' ', $nodification->messageContent);
            if (count($words) > 5) {
                $nodification->short_message = implode(' ', array_slice($words, 0, 5)) . '...';
            } else {
                $nodification->short_message = $nodification->messageContent;
            }
        }
        return view('dashboard.users', compact('users','title','unreadCount','nodifications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title ='Add user';
        $unreadCount = Message::where('readable', 0)->count();
        $nodifications = Message::where('readable', 0)->take(3)->get();

        // Add a human-readable time difference to each notification
        foreach ($nodifications as $nodification) {
            $nodification->time_diff = Carbon::parse($nodification->created_at)->diffForHumans();
    
            // Get first 5 words from messageContent
            $words = explode(' ', $nodification->messageContent);
            if (count($words) > 5) {
                $nodification->short_message = implode(' ', array_slice($words, 0, 5)) . '...';
            } else {
                $nodification->short_message = $nodification->messageContent;
            }
        }
        return view('dashboard.addUser', compact('title','unreadCount','nodifications'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
        
            'name' => 'required|string|max:100',
            'userName' => 'required|string|max:50',
            'email'=>'required|email:rfc',
            'password'=>'nullable|string|max:255',
            
        ]);

        // Handle the active checkbox
        $data['active'] = isset ($request->active);
       // Hash the password if it is provided
        if (!empty($data['password'])) {
        $data['password'] = bcrypt($data['password']);
        } else {
       // Remove the password key if it's not set
       unset($data['password']);
       }

        User::create($data);
       
        return redirect('dashboard/users');
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
        $title ='Edit user';
        $user = User::findOrFail($id);
        $unreadCount = Message::where('readable', 0)->count();
        $nodifications = Message::where('readable', 0)->take(3)->get();

        // Add a human-readable time difference to each notification
        foreach ($nodifications as $nodification) {
            $nodification->time_diff = Carbon::parse($nodification->created_at)->diffForHumans();
    
            // Get first 5 words from messageContent
            $words = explode(' ', $nodification->messageContent);
            if (count($words) > 5) {
                $nodification->short_message = implode(' ', array_slice($words, 0, 5)) . '...';
            } else {
                $nodification->short_message = $nodification->messageContent;
            }
        }
        return view('dashboard.editUser', compact('user','title','unreadCount','nodifications'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $data = $request->validate([
        
            'name' => 'required|string|max:100',
            'userName' => 'required|string|max:50',
            'email'=>'required|email:rfc',
            'password'=>'nullable|string|max:255',
            
        ]);

        // Handle the active checkbox
        $data['active'] = isset ($request->active);

       // If a new password is provided, hash it. Otherwise, use the existing password.
    if (!empty($data['password'])) {
        $data['password'] = bcrypt($data['password']);
    } else {
        // Use the existing password
        $data['password'] = $user->password;
    }
        //User:: where('id', $id)->update($data);
       $user->update($data);
       
        return redirect('dashboard/users');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
