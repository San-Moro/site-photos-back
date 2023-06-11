<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use App\Http\Requests\StorePhotoRequest;
use App\Http\Requests\UpdatePhotoRequest;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$photos = Photo::all();
        $photos = Photo::paginate(5);
        return view('admin.photos.index', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tag::all();
        return view('admin.photos.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePhotoRequest $request)
    {
        //dd($request->validated());

        $val_data = $request->validated();
        //if the image file is there then save in storage/app/public/uploads_img
        if($request->hasFile('image')) {
            $image_path = Storage::put('uploads_img', $request->image);
            $val_data['image'] = $image_path;
        }
        $photo = Photo::create($val_data);

        //dd($request->all()); //ok, ora ho l'array di tags che vengono riconosciuti tramite value, altrimenti senza il value avevo l'array dei tag ON

        //if there are tags then add in the pivot table
        if($request->has('tags')) {
            $photo->tags()->attach($request->tags);
        }

        return redirect()->route('admin.photos.index')->with('message', "$photo->image è stato creato con successo!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Photo $photo)
    {
        return view('admin.photos.show', compact('photo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Photo $photo)
    {
        $tags = Tag::all();
        return view('admin.photos.edit', compact('photo', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePhotoRequest $request, Photo $photo)
    {
        $val_data = $request->validated();
        if($request->hasFile('image')) {
            // delete previous image if it exists
            if($photo->image) {
                Storage::delete($photo->image);
            }
            $image_path = Storage::put('uploads_img', $request->image);
            $val_data['image'] = $image_path;
        }
        $photo->update($val_data);

        if($request->has('tags')) {
            $photo->tags()->sync($request->tags);
        } else {
            $photo->tags()->detach();
        }
        return redirect()->route('admin.photos.index')->with('message', "$photo->image è stato aggiornato");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Photo $photo)
    {
        $photo->delete();
        return redirect()->route('admin.photos.index')->with('message', "$photo->image è stato eliminato");
    }
}
