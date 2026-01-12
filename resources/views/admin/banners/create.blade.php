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
                                        <h4>📒 Add Banner</h4>
                                        <p>Enter details for the new banner below.</p>
                                    </div>
                                    <a href="{{ route('admin.banners.index') }}" class="btn btn-primary"
                                        style="background-color: #38e079; color: white; border: none;">
                                        ⬅ Back
                                    </a>
                                </div>
                                <form action="{{ route('admin.banners.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row">
                                            <!-- Image -->
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label"> Banner Image</label>
                                                    <input type="file" name="image" class="form-control">
                                                </div>
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
                                            <button type="submit" class="btn btn-primary">Save Banner</button>
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