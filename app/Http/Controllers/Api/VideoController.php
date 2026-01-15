<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Video;

class VideoController extends Controller
{
    public function videos(Request $request)
    {
    $query = Video::orderBy('id', 'desc');

    // Status filter (optional)
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    } else {
        $query->where('status', 1); // default only active
    }

    $videos = $query->get()->map(function ($video) {

        // Extract YouTube ID
        preg_match('/(youtu\.be\/|v=)([^&]+)/', $video->youtube_url, $matches);
        $videoId = $matches[2] ?? null;

        return [
            'id' => $video->id,
            'youtube_url' => $video->youtube_url,
            'embed_url' => $videoId ? "https://www.youtube.com/embed/".$videoId : null,
            'status' => $video->status,
            'created_at' => $video->created_at->toDateTimeString(),
        ];
    });

    return response()->json([
        'status' => true,
        'message' => 'Videos fetched successfully',
        'data' => $videos
    ], 200);
}


}