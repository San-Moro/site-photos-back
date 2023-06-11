<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function index() {
        $photos = Photo::with('tags')->get();
        return response()->json([
            'success' => true,
            'results' => $photos
        ]);
    }

    public function show($id)
    {
        $photo = Photo::with('tags')->find($id);
        if (!$photo) {
            return response()->json([
                'success' => false,
                'message' => 'Foto non trovata'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'photo' => $photo,
            'tags' => $photo->tags
        ]);
    }

    public function getPhotosByTag($tagId)
    {
        $tagPhotos = Photo::whereHas('tags', function ($query) use ($tagId) {
            $query->where('tags.id', $tagId);
        })->get();

        return response()->json([
            'success' => true,
            'photosTag' => $tagPhotos
        ]);
    }
}
