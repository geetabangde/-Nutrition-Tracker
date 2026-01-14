@extends('admin.layouts.app')
@section('content')
<div class="page-content">
    <div class="container-fluid">

        <div class="row ledger-add-form">
            <div class="col-12">
                <div class="card">

                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>📒 Edit Anganwadi Operator</h4>

                        <a href="{{ route('admin.anganwadi-operator.list') }}"
                           class="btn btn-primary"
                           style="background:#ca2639;border:none;">
                            ⬅ Back
                        </a>
                    </div>

                    <form action="{{ route('admin.anganwadi-operator.update', $anganwadiOperator->id) }}"
                          method="POST">
                        @csrf
                        @method('PUT')

                        <div class="card-body">
                            <div class="row">

                                <!-- Project Manager -->
                                <div class="mb-3">
                                    <label class="form-label">Project Manager</label>
                                    <select name="project_id" class="form-control" required>
                                        <option value="">Select Project Manager</option>

                                        @foreach($projectManagers as $pm)
                                            <option value="{{ $pm->id }}"
                                                {{ $anganwadiOperator->project_id == $pm->id ? 'selected' : '' }}>
                                                {{ $pm->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text"
                                           name="name"
                                           class="form-control"
                                           value="{{ old('name', $anganwadiOperator->name) }}"
                                           required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email"
                                           name="email"
                                           class="form-control"
                                           value="{{ old('email', $anganwadiOperator->email) }}"
                                           required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Mobile Number</label>
                                    <input type="text"
                                           name="mobile_number"
                                           class="form-control"
                                           value="{{ old('mobile_number', $anganwadiOperator->mobile_number) }}"
                                           required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Address</label>
                                    <input type="text"
                                           name="address"
                                           class="form-control"
                                           value="{{ old('address', $anganwadiOperator->address) }}">
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">
                                    Update Anganwadi Operator
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
