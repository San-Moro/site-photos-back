<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index() {
        $user = auth()->user();
        $comments = Comment::whereIn('photo_id', function ($query) use ($user) {
            $query->select('id')->from('photos')->where('user_id', '=', $user->id); 
        })
        ->orderBy('created_at', 'desc')->get();
        return view('admin.photos.comment', compact('comments'));
    }
}
