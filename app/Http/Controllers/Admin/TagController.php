<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule as ValidationRule;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::paginate(10);
        //dd($tags->first()->photos);
        return view('admin.tags.index', compact('tags'));
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
        //dd($request->all());
        $val_data = $request->validate([
            'name' => ['required', 'unique:tags']
        ]);
        //dd($val_data);
        $tag = Tag::create($val_data);
        //dd($tag);
        return redirect()->route('admin.tags.index')->with('message', " il tag $tag->name è stato creato con successo!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        //dd($tag->photos);
        return view('admin.tags.show', compact('tag'));
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
    public function update(Request $request, Tag $tag)
    {
        $val_data = $request->validate([
            'name' => ['required', ValidationRule::unique('tags')->ignore($tag)]
        ]);
        $tag->update($val_data);
        return redirect()->route('admin.tags.index')->with('message', " il tag $tag->name è stato aggiornato con successo!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('admin.tags.index')->with('message', " il tag $tag->name è stato eliminato con successo!");
    }
}
