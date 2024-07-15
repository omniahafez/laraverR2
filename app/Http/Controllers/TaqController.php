<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Taq;
use App\Models\Message;
use Carbon\Carbon;

class TaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title ='categories';
        // Retrieve all categories (Taqs)
        $taqs= Taq::get ();
        // Count unread messages
        $unreadCount = Message::where('readable', 0)->count();
        // Retrieve the latest 3 unread messages
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
        return view('dashboard.categories', compact('taqs', 'title','unreadCount','nodifications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title ='Add category';
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
        return view('dashboard.addCategory', compact('title','unreadCount','nodifications'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $data = $request->validate([
        
            'taqName' => 'required|string|max:100',
        ]);

        Taq::create($data);
       
        return redirect('dashboard/categories');
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
        $title ='Edit category';
        $taq = Taq::findOrFail($id);
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
        return view('dashboard.editCategory', compact('taq', 'title','unreadCount','nodifications'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $taq = Taq::findOrFail($id);
        $data = $request->validate([
        
            'taqName' => 'required|string|max:100',
        ]);

        $taq->update($data);
       
        return redirect('dashboard/categories');
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Request $request)
    // {
    //     $id = $request->id;
        
    //     $taq = Taq::findOrFail($id);

    // // if ($taq->beverages()->exists()) {
    // //     return redirect()->route('dashboard/categories')->with('error', 'Category cannot be deleted because it has associated beverages.');
    // // }

    // $taq->delete();
    // return redirect('dashboard/categories');

    // }

    public function destroy(Request $request)
    {
        $id = $request->id;
        try {
            $taq = Taq::findOrFail($id);
            $taq->delete();
            return redirect()->route('dashboard.categories')->with('success', 'Category deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('dashboard.categories')->with('error', $e->getMessage());
        }
    }

}
