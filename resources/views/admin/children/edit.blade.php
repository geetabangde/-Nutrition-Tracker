@extends('admin.layouts.app')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row ledger-add-form">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <h4>✏️ Edit Child</h4>
                            <p>Update the details for this child.</p>
                        </div>
                        <a href="{{ route('admin.children.index') }}" class="btn btn-primary"
                            style="background-color: #38e079; color: white; border: none;">
                            ⬅ Back
                        </a>
                    </div>
                    <form action="{{ route('admin.children.update', $child->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <!-- Child Code -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Child Code</label>
                                        <input type="text" class="form-control" value="{{ $child->child_code }}" readonly>
                                    </div>
                                </div>
                                <!-- Child Name -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Child Name</label>
                                        <input type="text" name="child_name" class="form-control"
                                            value="{{ $child->child_name }}" required>
                                    </div>
                                </div>
                                <!-- Age -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Age</label>
                                        <input type="number" name="age" class="form-control"
                                            value="{{ $child->age }}" required>
                                    </div>
                                </div>
                                <!-- Gender -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Gender</label>
                                        <select name="gender" class="form-control" required>
                                            <option value="">-- Select Gender --</option>   
                                            <option value="Male" {{ $child->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                            <option value="Female" {{ $child->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Address -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Address</label>
                                        <textarea name="address" class="form-control" rows="1">{{ $child->address }}</textarea>
                                    </div>
                                </div>
                                <!-- mother Name -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Mother Name</label>
                                        <input type="text" name="mother_name" class="form-control"
                                            value="{{ $child->mother_name }}" required> 
                                    </div>
                                </div>
                                <!-- father name -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Father Name</label>   
                                        <input type="text" name="father_name" class="form-control"
                                            value="{{ $child->father_name }}" required>
                                    </div>
                                </div>
                            
                                <!-- Image Upload -->
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Image</label>
                                        <input type="file" name="image" class="form-control">
                                        @if($child->image)
                                        <img src="{{ asset($child->image) }}" alt="Child Image" style="width: 80px; margin-top: 5px;">

                                        @endif
                                    </div>
                                </div>
                                <!-- Anganwadi Center -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Anganwadi Center</label>
                                        <select name="anganwadi_center" class="form-control" required>  
                                            <option value="AWC Rampur-01" {{ $child->anganwadi_center == 'AWC Rampur-01' ? 'selected' : '' }}>AWC Rampur-01</option>
                                            <option value="AWC Rampur-02" {{ $child->anganwadi_center == 'AWC Rampur-02' ? 'selected' : '' }}>AWC Rampur-02</option>
                                            <option value="AWC Belaganj-04" {{ $child->anganwadi_center == 'AWC Belaganj-04' ? 'selected' : '' }}>AWC Belaganj-04</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Nutrition Status -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nutrition Status</label>
                                    <select name="nutrition_status" class="form-control">
                                        <option value="">Select Nutrition Status</option>
                                        <option value="Normal" {{ $child->nutrition_status == 'Normal' ? 'selected' : '' }}>Normal</option>
                                        <option value="Mam" {{ $child->nutrition_status == 'Mam' ? 'selected' : '' }}>Mam</option>
                                        <option value="Sam" {{ $child->nutrition_status == 'Sam' ? 'selected' : '' }}>Sam</option>
                                    </select>
                                </div>
                            </div>

                            <!--  -->
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Update Child</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection