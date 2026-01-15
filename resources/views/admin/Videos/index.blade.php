@extends('admin.layouts.app')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Banners</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Banners</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row listing-form">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="card-title">🧾 Video List</h4>
                        </div>
                        <a href="{{ route('admin.videos.create') }}" class="btn btn-primary"
                            style="background-color: #38e079; color: white; border: none;">
                            <i class="fas fa-plus"></i> Add
                        </a>
                    </div>
                    <div class="card-body">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Video</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($videos as $video)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <!-- YouTube Video -->
                                    <td>
                                        @if($video->youtube_url)
                                        @php
                                        preg_match('/(youtu\.be\/|v=)([^&]+)/', $video->youtube_url, $matches);
                                        $videoId = $matches[2] ?? null;
                                        @endphp

                                        @if($videoId)
                                        <iframe width="200" height="120"
                                            src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0"
                                            allowfullscreen>
                                        </iframe>
                                        @else
                                        Invalid Link
                                        @endif
                                        @else
                                        N/A
                                        @endif
                                    </td>

                                    <!-- Status -->
                                    <td>
                                        @if($video->status == 1)
                                        <span class="badge bg-success">Active</span>
                                        @else
                                        <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>

                                    <!-- Actions -->
                                    <td>
                                        <a href="{{ route('admin.videos.edit', $video->id) }}"
                                            class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('admin.videos.destroy', $video->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Are you sure?')"
                                                class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection