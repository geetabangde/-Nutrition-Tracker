@extends('admin.layouts.app')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row ledger-add-form">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <h4>📒 Add Project Manager</h4>
                        </div>
                        <a href="{{ route('admin.project-manager.list') }}"
                           class="btn btn-primary"
                           style="background-color:#ca2639;border:none;">
                            ⬅ Back
                        </a>
                    </div>

                    <form action="{{ route('admin.project-manager.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="row">

                                <!-- Regional Manager Dropdown -->
                                <div class="mb-3">
                                    <label class="form-label">Regional Manager</label>
                                    <select name="regional_id" class="form-control" required>
                                        <option value="">Select Regional Manager</option>
                                        @foreach($regionalManagers as $regional)
                                            <option value="{{ $regional->id }}">
                                                {{ $regional->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name"
                                           class="form-control"
                                           value="{{ old('name') }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email"
                                           class="form-control"
                                           value="{{ old('email') }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" name="password"
                                           class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Mobile Number</label>
                                    <input type="text" name="mobile_number"
                                           class="form-control"
                                           value="{{ old('mobile_number') }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Address</label>
                                    <input type="text" name="address"
                                           class="form-control"
                                           value="{{ old('address') }}">
                                </div>

                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">
                                    Create Project Manager
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
