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
                                        <h4>📒 Add </h4>
                                        <p>Enter details for the new child below.</p>
                                    </div>
                                    <a href="{{ route('admin.children.index') }}" class="btn btn-primary"
                                        style="background-color: #38e079; color: white; border: none;">
                                        ⬅ Back
                                    </a>
                                </div>
                                <form action="{{ route('admin.children.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row">
                                            <!-- child code -->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Child Code</label>

                                                    <input type="text" class="form-control"
                                                        value="Auto Generated (AWxxxx)" readonly>
                                                </div>
                                            </div>
                                            <!-- Child Name -->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Child Name</label>
                                                    <input type="text" name="child_name" class="form-control"
                                                        value="{{ old('child_name') }}" required>
                                                </div>
                                            </div>
                                            <!-- Age -->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Age</label>
                                                    <input type="number" name="age" class="form-control"
                                                        value="{{ old('age') }}" required>
                                                </div>
                                            </div>
                                            <!-- Gender -->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Gender</label>
                                                    <select name="gender" class="form-control" required>
                                                        <option value="">
                                                            <!-- -- Select Gender -- -->
                                                        </option>
                                                        <option value="male"
                                                            {{ old('gender') == 'male'?'selected' : '' }}>
                                                            Male
                                                        </option>
                                                        <option value="female"
                                                            {{ old('gender') == 'female'?'selected' : '' }}>
                                                            Female
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- Mother Name -->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Mother Name</label>
                                                    <input type="text" name="mother_name" class="form-control"
                                                        value="{{ old('mother_name') }}" required>
                                                </div>
                                            </div>
                                            <!-- Father Name -->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Father Name</label>
                                                    <input type="text" name="father_name" class="form-control"
                                                        value="{{ old('father_name') }}" required>
                                                </div>
                                            </div>

                                            <!-- Anganwadi Center -->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Anganwadi Center</label>
                                                    <select name="anganwadi_center" class="form-control" required>
                                                        <option value="AWC Rampur-01">AWC Rampur-01</option>
                                                        <option value="AWC Rampur-02">AWC Rampur-02</option>
                                                        <option value="AWC Belaganj-04">AWC Belaganj-04</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- Image -->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label"> Child Image</label>
                                                    <input type="file" name="image" class="form-control">
                                                </div>
                                            </div>
                                            <!-- address -->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Address</label>
                                                    <textarea type="text" name="address" class="form-control"
                                                        rows="1">{{ old('address') }}</textarea>
                                                </div>
                                            </div>
                                            <!-- nutrition_status -->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Nutrition Status</label>
                                                    <select name="nutrition_status" class="form-control">
                                                        <option value="">Select Nutrition Status</option>
                                                        <option value="Normal">Normal</option>
                                                        <option value="Mam">Mam</option>
                                                        <option value="Sam">Sam</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="text-end">
                                                <button type="submit" class="btn btn-primary">Save Child</button>
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