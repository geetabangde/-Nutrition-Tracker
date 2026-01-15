<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    // LIST
    public function index()
    {
        $videos = Video::latest()->get();
        return view('admin.videos.index', compact('videos'));
    }
    
    // CREATE FORM
    public function create()
    {
        return view('admin.videos.create');
    }

    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'youtube_url' => 'required|url',
            'status' => 'required',
        ]);

        Video::create([
            'youtube_url' => $request->youtube_url,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.videos.index')
            ->with('success', 'Video added successfully');
    }


    // EDIT FORM
    public function edit($id)
    {
        $video = Video::findOrFail($id);
        return view('admin.videos.edit', compact('video'));
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $video = Video::findOrFail($id);

        $video->youtube_url = $request->youtube_url;
        $video->status = $request->status;
        $video->save();

        return redirect()->route('admin.videos.index')
            ->with('success', 'Video updated successfully');
    }


    // DELETE
    public function destroy($id)
    {
        $video = Video::findOrFail($id);
        $video->delete();

        return redirect()->route('admin.videos.index')
            ->with('success', 'Video deleted successfully');
    }
}
