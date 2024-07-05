<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = Message::get();


       $nodifications = $nodifications = Message::where('readable', 0)->take(3)->get();
// Add a human-readable time difference to each notification
foreach ($nodifications as $nodification) {
    $nodification->time_diff = Carbon::parse($nodification->created_at)->diffForHumans();
}


        $unreadCount = Message::where('readable', 0)->count();
        $title ='messages';
        return view('dashboard.messages', compact('messages', 'title','nodifications','unreadCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'fullName' => 'required|string|max:100',
            'email' => 'required|string|max:100',
            'messageContent' =>'required|string|max:250',
        ]);
        
         // Save the message
         $message = Message::create($data);

         // Send the email
         Mail::to('recipient@example.com')->send(new ContactMail($data));
 
         //return 'Message added and email sent.';

         $title ='messages';
         $messages= Message::get ();
         $unreadCount = Message::where('readable', 0)->count();
         $nodifications = Message::where('readable', 0)->take(3)->get();
         return view('dashboard.messages', compact('title','messages','unreadCount','nodifications'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = " Show message";
        $nodifications = Message::where('readable', 0)->take(3)->get();
        $message = Message::findOrFail($id);
        $unreadCount = Message::where('readable', 0)->count();
        Message::where('id',$id)->update(['readable'=> 1]);
        return view('dashboard.showMessage', compact('message','title','unreadCount','nodifications')); 
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
