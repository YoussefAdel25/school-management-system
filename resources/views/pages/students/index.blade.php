@extends('layouts.master')

@section('css')
@toastr_css
<style>

    .add-btn {
        background-color: #fff;
        color: #16a34a;
        border: 2px solid #16a34a;
        transition: all 0.3s ease-in-out;
    }

    .add-btn:hover {
        background-color: #16a34a;
        color: #fff;
    }

    .table-container {
        background-color: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
    }

    table th {
        background-color: #f9fafb;
        font-weight: bold;
    }

    .table-actions a,
    .table-actions button {
        margin: 0 4px;
    }
</style>
@endsection

@section('title')
    {{ trans('main-sidebar.studentsList') }}
@endsection

@section('page-header')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center bg-light p-4 rounded shadow-sm mb-4">
        <div>
            <h2 class="text-dark" style="font-size: 1.75rem; font-weight: 600;">{{ trans('main-sidebar.studentsList') }}</h2>
            <small class="text-muted" style="font-size: 1rem;">{{ trans('students.totalStudents') }}: {{ $students->count() }}</small>
        </div>
        <a href="{{ route('students.create') }}" class="btn btn-primary d-flex align-items-center">
            <i class="fa fa-plus mr-2"></i> {{ trans('students.addStudent') }}
        </a>
    </div>
</div>
@endsection


@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="table-container">
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered text-center align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ trans('students.name') }}</th>
                                <th>{{ trans('students.Email') }}</th>
                                <th>{{ trans('grades.name') }}</th>
                                <th>{{ trans('classes.name') }}</th>
                                <th>{{ trans('sections.name') }}</th>
                                <th>{{ trans('students.gender') }}</th>
                                <th>{{ trans('students.religion') }}</th>
                                <th>{{ trans('students.Processes') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td>{{ $student->grade->name }}</td>
                                    <td>{{ $student->classroom->name }}</td>
                                    <td>{{ $student->gender->name }}</td>
                                    <td>{{ $student->religion->name }}</td>
                                    <td>{{ $student->section->name }}</td>
                                    <td class="table-actions">
                                        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-sm btn-info" title="{{ trans('students.edit') }}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#Delete_Student{{ $student->id }}" title="{{ trans('students.delete') }}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <a href="#" class="btn btn-sm btn-warning" title="{{ trans('students.view') }}">
                                            <i class="far fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @include('pages.students.delete')
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    @toastr_js
    @toastr_render
@endsection
