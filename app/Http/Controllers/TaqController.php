<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Taq;

class TaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title ='categories';
        $taqs= Taq::get ();
        return view('dashboard.categories', compact('taqs', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title ='Add category';
        return view('dashboard.addCategory', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
        return view('dashboard.editCategory', compact('taq', 'title'));
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
