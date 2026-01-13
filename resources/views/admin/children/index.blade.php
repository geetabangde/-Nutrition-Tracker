@extends('admin.layouts.app')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Children</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Children</li>
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
                            <h4 class="card-title">🧾 Children List</h4>
                        </div>
                        <a href="{{ route('admin.children.create') }}" class="btn btn-primary"
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
                                    <th>Age</th>
                                    <th>Gender</th>
                                    <th>Parent Name</th>
                                    <th>Anganwadi Center</th>
                                    <th>Image</th>
                                    <th>Nutrition Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($children as $child)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $child->child_code }}</td>
                                    <td>{{ $child->child_name }}</td>
                                    <td>{{ $child->age }}</td>
                                    <td>{{ $child->gender }}</td>
                                    <td>{{ $child->mother_name }}</td>
                                    <td>{{ $child->anganwadi_center }}</td>
                                    <td>
                                        @if($child->image)
                                        <img src="{{ $child->image }}" alt="{{ $child->child_name }}" width="50"
                                            height="50">
                                        @else
                                        N/A
                                        @endif
                                    </td>
                                    <td>{{ $child->nutrition_status }}</td>
                                    <td>
                                        <a href="{{ route('admin.children.edit', $child->id) }}"
                                            class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.children.destroy', $child->id) }}" method="POST"
                                            class="d-inline">
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection