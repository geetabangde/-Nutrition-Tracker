@extends('admin.layouts.app')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- Add Ledger Form -->
        <div class="row ledger-add-form">
            <div class="col-12">
                <div class="card">
                    <!-- Add Ledger Form -->
                    <div class="row ledger-add-form">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <div>
                                        <h4>📒 Add Videos</h4>
                                        <p>Enter details for the new video below.</p>
                                    </div>
                                    <a href="{{ route('admin.videos.index') }}" class="btn btn-primary"
                                        style="background-color: #38e079; color: white; border: none;">
                                        ⬅ Back
                                    </a>
                                </div>
                                <form action="{{ route('admin.videos.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row">
                                            <!-- Image -->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                        <label class="form-label">YouTube Video Link</label>
                                                        <input type="text" name="youtube_url" id="youtube_url"
                                                            class="form-control"
                                                            placeholder="https://www.youtube.com/watch?v=xxxx"
                                                            onkeyup="previewVideo()">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label">Preview</label>
                                                    <div id="videoPreview"></div>
                                                </div>

                                            <!-- status -->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Status</label>
                                                    <select name="status" class="form-control" required>
                                                        <option value="">-- Select Status --</option>
                                                        <option value="1" {{ old('status') == 1?'selected' : '' }}>
                                                            Active</option>
                                                        <option value="0" {{ old('status') == 0?'selected' : '' }}>
                                                            Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary">Save Video</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

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
                frameborder="0" allowfullscreen>
            </iframe>
        `;
    }
}
</script>
