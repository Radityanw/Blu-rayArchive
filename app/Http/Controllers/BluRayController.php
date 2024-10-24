<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BluRay;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class BluRayController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        return view('blurays.create', compact('categories'));
    }

    // Store the new Blu-ray
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'price' => 'required|numeric|min:0',
            'categories' => 'required|array',
        ]);

        // Handle the image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $request->title . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/cover'), $imageName);
        }
        // Create the Blu-ray
        $bluray = BluRay::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imageName,
            'price' => $request->price,
        ]);
        

        // Attach the selected categories
        $bluray->categories()->attach($request->input('categories'));


        return redirect()->route('admindashboard')->with('success', 'Blu-ray added successfully');
    }
    public function destroy($id)
    {
        $bluray = BluRay::findOrFail($id);
        $bluray->categories()->detach(); // Detach all categories first
        $bluray->delete();
    
        return redirect()->route('admindashboard')->with('success', 'Blu-ray deleted successfully');
    }
public function edit($id)
{
    // Find the Blu-ray by ID and pass it to the edit view
    $bluray = BluRay::findOrFail($id);
    $categories = Category::all(); // For the category selection

    return view('blurays.edit', compact('bluray', 'categories'));
}
public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'price' => 'required|numeric|min:0',
        'categories' => 'required|array',
    ]);

    $bluray = BluRay::findOrFail($id);

    // Handle the image upload
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = $request->title . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/cover'), $imageName);
        $bluray->image = $imageName; // Update the image field only if a new image is uploaded
    }

    // Update Blu-ray details
    $bluray->update([
        'title' => $request->title,
        'description' => $request->description,
        'price' => $request->price,
    ]);

    // Sync the selected categories
    $bluray->categories()->sync($request->input('categories'));

    return redirect()->route('admindashboard')->with('success', 'Blu-ray updated successfully');
}
public function show($id)
{
    // Retrieve the specific Blu-ray by ID
    $bluray = BluRay::findOrFail($id);
    $relatedBlurays = Bluray::where('title', $bluray->title)->get();
    $bluray_ids = Bluray::select('id', 'status')->where('title', $bluray->title)->get();

    // Pass the Blu-ray data to the view
    return view('bluraydetail', compact('bluray','relatedBlurays', 'bluray_ids'));
}
public function searchByTitle(Request $request)
{
    // Get the search query from the request
    $searchTerm = $request->input('search');

    // Query the Blu-rays by title
    $blurays = Bluray::where('title', 'LIKE', "%{$searchTerm}%")->get();

    // Pass the search term and the Blu-rays found to the view
    return view('alltitle', [
        'blurays' => $blurays,
        'searchTerm' => $searchTerm,
    ]);
}


}
