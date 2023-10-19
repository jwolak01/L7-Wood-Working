<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{
    public function index()
    {
        return view('images.index');
    }

    // ****************************************** //

    public function show()
    {
        //return all images
        return Image::where('cover_image', 0)->latest()->pluck('name')->toArray();
    }

    // ****************************************** //

    public function showCover()
    {
        //return all images
        return Image::where('cover_image', 1)->latest()->pluck('name')->toArray();
    }

    // ****************************************** //

    public function store(Request $request)
    {
        // validate the incoming file

        if ($request->hasFile('coverImage')) {
            if (!$request->hasFile('coverImage')) {
                return response()->json(['error' => 'There is no image present.'], 400);
            }

            $request->validate([
                'coverImage' => 'required|file|image|mimes:png,jpg,jpeg'
            ]);


            // save the file in storage
            $path = $request->file('coverImage')->store('public/images/coverImage');

            if (!$path) {
                return response()->json(['error', 'The file could not be saved'], 500);
            }

            $uploadedFile = $request->file('coverImage');

            //create image object
            $coverImage = Image::create([
                'name' => $uploadedFile->hashName(),
                'extension' => $uploadedFile->extension(),
                'size' => $uploadedFile->getSize(),
                'cover_image' => 1
            ]);

            // return that image object back to the frontend
            return $coverImage->name;

        } else if ($request->hasFile('image')) {
            // validate the incoming file
            if (!$request->hasFile('image')) {
                return response()->json(['error' => 'There is no image present.'], 400);
            }

            $request->validate([
                'image' => 'required|file|image|mimes:png,jpg,jpeg'
            ]);


            // save the file in storage
            $path = $request->file('image')->store('public/images');

            if (!$path) {
                return response()->json(['error', 'The file could not be saved'], 500);
            }

            $uploadedFile = $request->file('image');

            //create image object
            $image = Image::create([
                'name' => $uploadedFile->hashName(),
                'extension' => $uploadedFile->extension(),
                'size' => $uploadedFile->getSize(),
                'cover_image' => 0
            ]);

            // return that image object back to the frontend
            return $image->name;
        }
    }

    // ****************************************** //

    public function revert()
    {
        // Delete Image object from the Images database
        $imageObject = Image::where('name', request()->getContent());
        $imageObject->delete();

        $directory =  public_path() . "/storage/images/";

        $imageFiles = File::allFiles($directory);
        
        foreach ($imageFiles as $image) {
            if (basename($image) == (request()->getContent())) {
                File::delete($image);
            }
        }
    }

}
