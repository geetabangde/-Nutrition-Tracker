@extends('admin.layouts.app')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row ledger-add-form">
            <div class="col-12">
                <div class="card">

                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <h4>✏️ Edit Video</h4>
                            <p>Update YouTube video details.</p>
                        </div>
                        <a href="{{ route('admin.videos.index') }}" class="btn btn-primary"
                            style="background-color:#38e079;color:white;border:none;">
                            ⬅ Back
                        </a>
                    </div>

                    <form action="{{ route('admin.videos.update', $video->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="card-body">
                            <div class="row">

                                <!-- YouTube Link -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">YouTube Video Link</label>
                                        <input type="text"
                                            name="youtube_url"
                                            id="youtube_url"
                                            class="form-control"
                                            value="{{ $video->youtube_url }}"
                                            onkeyup="previewVideo()"
                                            placeholder="https://www.youtube.com/watch?v=xxxx">
                                    </div>
                                </div>

                                <!-- Preview -->
                                <div class="col-md-6">
                                    <label class="form-label">Preview</label>
                                    <div id="videoPreview">
                                        @php
                                            preg_match('/(youtu\.be\/|v=)([^&]+)/', $video->youtube_url, $matches);
                                            $videoId = $matches[2] ?? null;
                                        @endphp

                                        @if($videoId)
                                            <iframe width="100%" height="200"
                                                src="https://www.youtube.com/embed/{{ $videoId }}"
                                                frameborder="0"
                                                allowfullscreen>
                                            </iframe>
                                        @endif
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="col-md-4 mt-3">
                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-control">
                                            <option value="1" {{ $video->status == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ $video->status == 0 ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">
                                    Update Video
                                </button>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

{{-- Live Preview Script --}}
<script>
function previewVideo() {
    let url = document.getElementById('youtube_url').value;
    let videoId = '';

    if (url.includes('watch?v=')) {
        videoId = url.split('watch?v=')[1].substring(0, 11);
    } else if (url.includes('youtu.be/')) {
        videoId = url.split('youtu.be/')[1].substring(0, 11);
    }

    if (videoId) {
        document.getElementById('videoPreview').innerHTML = `
            <iframe width="100%" height="200"
                src="https://www.youtube.com/embed/${videoId}"
                frameborder="0"
                allowfullscreen>
            </iframe>
        `;
    }
}
</script>
@endsection
