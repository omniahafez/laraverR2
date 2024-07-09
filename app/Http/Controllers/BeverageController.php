<?php

namespace App\Http\Controllers;
use App\Traits\Traits\UploadFile;
use Illuminate\Http\Request;
use App\Models\Beverage;
use App\Models\Taq;
use App\Models\Message;

class BeverageController extends Controller
{

    use UploadFile;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title ='beverages';
        $beverages= Beverage::get ();
        $unreadCount = Message::where('readable', 0)->count();
        $nodifications = Message::where('readable', 0)->take(3)->get();
        return view('dashboard.beverages', compact('beverages', 'title','unreadCount','nodifications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title ='Add beverage';
        $taqs = Taq::all();
        $unreadCount = Message::where('readable', 0)->count();
        $nodifications = Message::where('readable', 0)->take(3)->get();
        return view('dashboard.addBeverage', compact('taqs', 'title','unreadCount','nodifications'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
        
            'title' => 'required|string|max:150',
            'content' => 'required|string|max:5000',
            'price' => 'nullable|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'taq_id' => 'required|exists:taqs,id',

         ]);

        // Handle the image
        $fileName= $this->upload($request->image, 'assets/img');
        $data['image'] = $fileName;

        // Handle the published checkbox
        $data['published'] = isset ($request->published);

        // Handle the special checkbox
        $data['special'] = isset ($request->special);



       Beverage::create($data);
        return redirect('dashboard/beverages');
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
        $title ='Edit beverage';
        $beverage = Beverage::findOrFail($id);
        $taqs = Taq::all();
        $unreadCount = Message::where('readable', 0)->count();
        $nodifications = Message::where('readable', 0)->take(3)->get();
        return view('dashboard.editBeverage', compact('beverage', 'taqs','title','unreadCount','nodifications'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $beverage = Beverage::findOrFail($id);
        $data = $request->validate([
        
            'title' => 'required|string|max:150',
            'content' => 'required|string|max:5000',
            'price' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'taq_id' => 'required|exists:taqs,id',

         ]);


        // Handle image upload
        if (isset($request->image) && $request->hasFile('image')) {
        // Delete the old image if it exists
        if (isset($beverage->image) && $beverage->image) {
        $oldImagePath =('assets/img/' . $beverage->image);
        if (file_exists($oldImagePath)) {
            unlink($oldImagePath);
        }
        }
        // Store the new image
        $fileName= $this->upload($request->image, 'assets/img');
        $data['image'] = $fileName;
        } else {
        // Keep the old image if no new image is uploaded
        $data['image'] = $beverage->image;
    }

    $data['active'] = isset ($request->active);


    $beverage->update($data);
    return redirect()->route('dashboard.beverages')->with('success', 'beverage updated successfully');

    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        Beverage:: where('id', $id)->delete();
        return redirect('dashboard/beverages');
    }
}
