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
                                        <h4>📒 Edit Regional Manager</h4>
                                    </div>
                                    <a href="{{ route('admin.regional-manager.list') }}" class="btn btn-primary"
                                        style="background-color: #ca2639; color: white; border: none;">
                                        ⬅ Back
                                    </a>
                                </div>
                                <form action="{{ route('admin.regional-manager.update', $regionalManager->id) }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="card-body">
                                        <div class="row">
                                            <!-- state -->
                                            <div class="mb-3">
                                                <label class="form-label">State</label>
                                                <select name="state_id" class="form-control" required>
                                                    <option value="">Select State</option>
                                                    @foreach($states as $state)
                                                    <option value="{{ $state->id }}"
                                                        {{ $regionalManager->state_id == $state->id ? 'selected' : '' }}>
                                                        {{ $state->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Name</label>
                                                <input type="text" name="name" id="name" class="form-control"
                                                    value="{{ old('name', $regionalManager->name) }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" name="email" id="email" class="form-control"
                                                    value="{{ old('email', $regionalManager->email) }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="mobile_number" class="form-label">Mobile Number</label>
                                                <input type="text" name="mobile_number" id="mobile_number"
                                                    class="form-control"
                                                    value="{{ old('mobile_number', $regionalManager->mobile_number) }}"
                                                    required>
                                            </div>
                                            <!-- address -->
                                            <div class="mb-3">
                                                <label for="address" class="form-label">Address</label>
                                                <input type="text" name="address" id="address" class="form-control"
                                                    value="{{ old('address', $regionalManager->address) }}">
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary">Update Regional
                                                Manager</button>
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