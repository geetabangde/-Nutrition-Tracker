@extends('admin.layouts.app')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Project Manager</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Project Manager</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row listing-form">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="card-title">🧾 Project Managers List</h4>
                        </div>
                        <a href="{{ route('admin.project-manager.create') }}" class="btn btn-primary"
                            style="background-color: #ca2639; color: white; border: none;">
                            <i class="fas fa-plus"></i> Add
                        </a>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>State</th>
                                    <th>Regional</th>
                                    <th>Project Name</th>
                                    <th>Email</th>
                                    <th>Mobile Number</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                            @foreach($projectManagers as $m)
                                @php
                                    // Regional Manager
                                    $regional = $regionalManagers->firstWhere('id', $m->regional_id);

                                    // State Manager (Regional ke state_id se)
                                    $state = $regional
                                        ? $states->firstWhere('id', $regional->state_id)
                                        : null;
                                @endphp

                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        {{ $state ? $state->name : 'N/A' }}
                                    </td>

                                    <td>
                                        {{ $regional ? $regional->name : 'N/A' }}
                                    </td>

                                    <td>{{ $m->name }}</td>
                                    <td>{{ $m->email }}</td>
                                    <td>{{ $m->mobile_number }}</td>

                                    <td>
                                        <a href="{{ route('admin.project-manager.edit', $m->id) }}"
                                        class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('admin.project-manager.delete', $m->id) }}"
                                            method="POST"
                                            style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        <!-- container-fluid -->
    </div>
    @endsection