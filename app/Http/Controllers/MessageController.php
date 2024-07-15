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
        // Retrieve all messages
        $messages = Message::get();

        // Retrieve the latest 3 unread messages
        $nodifications = Message::where('readable', 0)->take(3)->get();

        // Add a human-readable time difference to each notification
        foreach ($nodifications as $nodification) {
            $nodification->time_diff = Carbon::parse($nodification->created_at)->diffForHumans();

            // Get the first 5 words from messageContent
            $words = explode(' ', $nodification->messageContent);
            if (count($words) > 5) {
                $nodification->short_message = implode(' ', array_slice($words, 0, 5)) . '...';
            } else {
                $nodification->short_message = $nodification->messageContent;
            }
        }

        // Count unread messages
        $unreadCount = Message::where('readable', 0)->count();

        // Set the page title
        $title = 'messages';
        return view('dashboard.messages', compact('messages', 'title', 'nodifications', 'unreadCount'));
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
        // Validate the incoming request data
        $data = $request->validate([
            'fullName' => 'required|string|max:100',
            'email' => 'required|string|max:100',
            'messageContent' =>'required|string|max:250',
        ]);
        
         // Save the message to the database
         $message = Message::create($data);

         //Send the email
         Mail::to('recipient@example.com')->send(new ContactMail($data));
 
         //return to the same page with Message sent
        return redirect()->to(url('/') . '#contact')->with('success', 'Your message has been sent successfully!');
        //return to the home page with Message sent
         // return back()->with('success', 'Your message has been sent successfully!');
        
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       // Set the page title
       $title = "Show message";

       // Retrieve the latest 3 unread messages
       $nodifications = Message::where('readable', 0)->take(3)->get();

       // Add a human-readable time difference to each notification
       foreach ($nodifications as $nodification) {
           $nodification->time_diff = Carbon::parse($nodification->created_at)->diffForHumans();

           // Get the first 5 words from messageContent
           $words = explode(' ', $nodification->messageContent);
           if (count($words) > 5) {
               $nodification->short_message = implode(' ', array_slice($words, 0, 5)) . '...';
           } else {
               $nodification->short_message = $nodification->messageContent;
           }
        }

        // Retrieve the message by ID or fail
        $message = Message::findOrFail($id);

        // Count unread messages
        $unreadCount = Message::where('readable', 0)->count();

        // Mark the message as read
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
    public function destroy(Request $request)
    {
        $id = $request->id;
        Message:: where('id', $id)->delete();
        return redirect('dashboard/messages');
    }

}
