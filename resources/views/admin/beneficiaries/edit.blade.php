@extends('admin.layouts.app')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row ledger-add-form">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <h4>✏️ Edit Beneficiary</h4>
                            <p>Update the details for this beneficiary.</p>
                        </div>
                        <a href="{{ route('admin.beneficiaries.index') }}" class="btn btn-primary"
                            style="background-color: #38e079; color: white; border: none;">
                            ⬅ Back
                        </a>
                    </div>
                    <form action="{{ route('admin.beneficiaries.update', $beneficiary->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <!-- child dropdown -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Child</label>
                                        <select name="child_id" class="form-control" required>
                                            <option value="">-- Select Child --</option>
                                            @foreach($children as $child)
                                            <option value="{{ $child->id }}"
                                                {{ $beneficiary->child_id == $child->id ? 'selected' : '' }}>
                                                {{ $child->child_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- monitoring date -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Monitoring Date</label>
                                        <input type="date" name="monitoring_date" class="form-control"
                                            value="{{ \Carbon\Carbon::parse($beneficiary->monitoring_date)->format('Y-m-d') }}"
                                            required>
                                    </div>
                                </div>
                                <!-- weight -->
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Weight (kg)</label>
                                        <input type="text" name="weight" class="form-control"
                                            value="{{ $beneficiary->weight }}">
                                    </div>
                                </div>
                                <!-- height -->
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Height (cm)</label>
                                        <input type="text" name="height" class="form-control"
                                            value="{{ $beneficiary->height }}">

                                    </div>
                                </div>
                                <!-- muac -->
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">MUAC (cm)</label>
                                        <input type="text" name="muac" class="form-control"
                                            value="{{ $beneficiary->muac }}">
                                    </div>
                                </div>
                                <!-- bilateral pitting edema -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label d-block">Bilateral Pitting Edema</label>
                                        <div class="form-check form-switch">
                                            <!-- Hidden input for unchecked state -->
                                            <input type="hidden" name="bilateral_pitting_edema" value="0">
                                            <input class="form-check-input" type="checkbox"
                                                name="bilateral_pitting_edema" value="1"
                                                {{ $beneficiary->bilateral_pitting_edema ? 'checked' : '' }}>
                                            <label class="form-check-label">
                                                Check for the in swelling of both feet
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
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