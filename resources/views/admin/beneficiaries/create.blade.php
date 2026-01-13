@extends('admin.layouts.app')

@section('content')
<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">

                    <!-- Header -->
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <h4>📒 Add Beneficiary (Health Record)</h4>
                            <p>Enter child monitoring details</p>
                        </div>
                        <a href="{{ route('admin.beneficiaries.index') }}" class="btn btn-success">
                            ⬅ Back
                        </a>
                    </div>

                    <!-- Form -->
                    <form action="{{ route('admin.beneficiaries.store') }}" method="POST">
                        @csrf

                        <div class="card-body">
                            <div class="row">

                                <!-- Child Dropdown -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Select Child</label>
                                    <select name="child_id" class="form-control" required>
                                        <option value="">-- Select Child --</option>
                                        @foreach($children as $child)
                                        <option value="{{ $child->id }}">
                                            {{ $child->child_code }} - {{ $child->child_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Monitoring Date (Current Date) -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Monitoring Date</label>
                                    <input type="date" name="monitoring_date" class="form-control"
                                        value="{{ date('Y-m-d') }}" required>
                                </div>

                                <!-- Weight -->
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Weight (kg)</label>
                                    <input type="text" name="weight" class="form-control" placeholder="e.g. 8.5">
                                </div>

                                <!-- Height -->
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Height (cm)</label>
                                    <input type="text" name="height" class="form-control" placeholder="e.g. 72">
                                </div>

                                <!-- MUAC -->
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">MUAC (cm)</label>
                                    <input type="text" name="muac" class="form-control" placeholder="e.g. 11.2">
                                </div>

                                <!-- Bilateral Pitting Edema -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label d-block">Bilateral Pitting Edema</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="bilateral_pitting_edema"
                                            value="1">
                                        <label class="form-check-label">
                                            Check for the in swelling of both feet
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit -->
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">
                                    💾 Save Beneficiary
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