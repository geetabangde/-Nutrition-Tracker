@extends('admin.layouts.app')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Beneficiaries (Health Records)</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Beneficiaries</li>
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
                            <h4 class="card-title">📋 Beneficiaries List</h4>
                        </div>
                        <a href="{{ route('admin.beneficiaries.create') }}" class="btn btn-primary"
                           style="background-color: #38e079; color: white; border: none;">
                            <i class="fas fa-plus"></i> Add
                        </a>
                    </div>

                    <div class="card-body">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Child Code</th>
                                    <th>Child Name</th>
                                    <th>Monitoring Date</th>
                                    <th>Weight (kg)</th>
                                    <th>Height (cm)</th>
                                    <th>MUAC (cm)</th>
                                    <th>Bilateral Pitting Edema</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($beneficiaries as $beneficiary)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $beneficiary->child->child_code ?? '-' }}</td>
                                    <td>{{ $beneficiary->child->child_name ?? '-' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($beneficiary->monitoring_date)->format('d-m-Y') }}</td>
                                    <td>{{ $beneficiary->weight ?? '-' }}</td>
                                    <td>{{ $beneficiary->height ?? '-' }}</td>
                                    <td>{{ $beneficiary->muac ?? '-' }}</td>
                                    <td>{{ $beneficiary->bilateral_pitting_edema ? 'Yes' : 'No' }}</td>
                                    <td>
                                        <a href="{{ route('admin.beneficiaries.edit', $beneficiary->id) }}"
                                           class="btn btn-sm btn-warning">
                                           <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.beneficiaries.destroy', $beneficiary->id) }}"
                                              method="POST" class="d-inline">
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
                                @if($beneficiaries->isEmpty())
                                <tr>
                                    <td colspan="10" class="text-center">No records found</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
