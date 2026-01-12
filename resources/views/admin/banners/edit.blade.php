@extends('admin.layouts.app')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row ledger-add-form">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <h4>✏️ Edit Banner</h4>
                            <p>Update the details for this banner.</p>
                        </div>
                        <a href="{{ route('admin.banners.index') }}" class="btn btn-primary"
                            style="background-color: #38e079; color: white; border: none;">
                            ⬅ Back
                        </a>
                    </div>
                    <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <!-- Image Upload -->
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label"> Banner Image</label>
                                        <input type="file" name="image" class="form-control">
                                        @if($banner->image)
                                        <img src="{{ $banner->image }}" alt="Banner Image"
                                            style="width: 80px; margin-top: 5px;">
                                        @endif
                                    </div>
                                </div>
                                <!-- status -->
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-control">
                                            <option value="1" {{ $banner->status == 1?'selected' : '' }}>Active</option>
                                            <option value="0" {{ $banner->status == 0?'selected' : '' }}>Inactive
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Update Banner</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection