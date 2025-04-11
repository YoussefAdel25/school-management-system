@extends('layouts.master')

@section('css')
    <style>
        .custom-button {
            margin-top: 10px;
            margin-bottom: 20px;
        }
        .custom-select {
            width: 100%;
            margin-bottom: 20px;
        }
        .btn-action {
            margin-left: 10px;
        }
        .modal-body input, .modal-body select {
            margin-bottom: 10px;
        }
    </style>
@endsection

@section('title')
    {{ trans('main-sidebar.ClassroomsList') }}
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">{{ trans('main-sidebar.Classrooms') }}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                    <li class="breadcrumb-item"><a href="#" class="default-color">{{ trans('main-sidebar.Grades') }}</a></li>
                    <li class="breadcrumb-item active">{{ trans('main-sidebar.ClassroomsList') }}</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <button type="button" class="button x-small custom-button" data-toggle="modal" data-target="#exampleModal">
                        {{ trans('classes.addClass') }}
                    </button>

                    <br>

                    <form action="{{ route('classrooms.filter') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="gradeFilter" class="control-label"></label>
                            <select name="gradeId" id="gradeFilter" data-style="btn-info" class="selectpicker custom-select" onchange="this.form.submit()" required>
                                <option value="" selected disabled>{{ trans('classes.searchByGrade') }}</option>
                                @foreach ($grades as $grade)
                                    <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>

                    <button type="button" class="button x-small custom-button" id="btnDeleteAll" style="display:none;">
                        {{ trans('classes.DeleteAll') }}
                    </button>

                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered p-0">
                            <thead>
                                <tr>
                                    <th><input name="select_all" id="example-select-all" type="checkbox" onclick="CheckAll('box1', this)" /></th>
                                    <th>#</th>
                                    <th>{{ trans('classes.name') }}</th>
                                    <th>{{ trans('grades.name') }}</th>
                                    <th>{{ trans('classes.processes') }}</th>
                                </tr>
                            </thead>

                            <?php
                            if (isset($filterClasses)){
                                $listClasses = $filterClasses;
                            }else{
                                $listClasses = $classrooms;
                            }

                            ?>
                            <tbody>
                                @foreach ($listClasses as $class)
                                    <tr>
                                        <td><input type="checkbox" value="{{ $class->id }}" class="box1"></td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $class->name }}</td>
                                        <td>{{ $class->grades->name }}</td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm btn-action" data-toggle="modal" data-target="#edit{{ $class->id }}" title="{{ trans('classes.edit') }}">
                                                <i class="fa fa-edit"></i>
                                            </button>

                                            <button type="button" class="btn btn-danger btn-sm btn-action" data-toggle="modal" data-target="#delete{{ $class->id }}" title="{{ trans('classes.delete') }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Add Form --}}
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">{{ trans('classes.addClass') }}</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="{{ route('classrooms.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="repeater">
                                <div data-repeater-list="classrooms">
                                    <div data-repeater-item>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <label>{{ trans('classes.arabicClass') }}</label>
                                                <input type="text" class="form-control" name="name_ar" required>
                                            </div>
                                            <div class="col">
                                                <label>{{ trans('classes.englishClass') }}</label>
                                                <input type="text" class="form-control" name="name_en" required>
                                            </div>
                                            <div class="col">
                                                <label>{{ trans('classes.nameGrade') }}</label>
                                                <select name="gradeId" class="form-control" required>
                                                    @foreach ($grades as $grade)
                                                        <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-1 d-flex align-items-end">
                                                <input data-repeater-delete type="button" class="btn btn-danger" value="X">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <input data-repeater-create type="button" class="btn btn-info" value="+ {{ trans('classes.addRow') }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('classes.close') }}</button>
                            <button type="submit" class="btn btn-success">{{ trans('classes.submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Edit Form --}}
        @foreach ($classrooms as $class)
            <div class="modal fade" id="edit{{ $class->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{ $class->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="exampleModalLabel{{ $class->id }}">{{ trans('classes.editClass') }}</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <form action="{{ route('classrooms.update', $class->id) }}" method="POST">
                                @csrf
                                @method('PATCH')

                                <div class="row">
                                    <div class="col">
                                        <label for="name_ar_{{ $class->id }}">{{ trans('classes.arabicClass') }}:</label>
                                        <input id="name_ar_{{ $class->id }}" type="text" name="name_ar" class="form-control" value="{{ $class->getTranslation('name', 'ar') }}" required>
                                        <input type="hidden" name="id" value="{{ $class->id }}">
                                    </div>

                                    <div class="col">
                                        <label for="name_en_{{ $class->id }}">{{ trans('classes.englishClass') }}:</label>
                                        <input id="name_en_{{ $class->id }}" type="text" name="name_en" class="form-control" value="{{ $class->getTranslation('name', 'en') }}" required>
                                    </div>
                                </div>

                                <br>

                                <div class="form-group">
                                    <label for="gradeId">{{ trans('classes.nameGrade') }}:</label>
                                    <select class="form-control" name="gradeId">
                                        @foreach ($grades as $grade)
                                            <option value="{{ $grade->id }}" {{ $grade->id == $class->grades->id ? 'selected' : '' }}>
                                                {{ $grade->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <br>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('classes.close') }}</button>
                                    <button type="submit" class="btn btn-success">{{ trans('classes.submit') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        {{-- Delete Form --}}
        @foreach ($classrooms as $class)
            <div class="modal fade" id="delete{{ $class->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{ $class->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="{{ route('classrooms.destroy', $class->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title" id="exampleModalLabel{{ $class->id }}">{{ trans('classes.deleteClass') }}</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <p>{{ trans('classes.confirmDelete') }} {{ $class->name }}</p>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('classes.close') }}</button>
                                <button type="submit" class="btn btn-danger">{{ trans('classes.delete') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
    <!-- row -->
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            // Show delete button when any checkbox is checked
            $("#datatable input[type=checkbox]").change(function() {
                var selected = $("#datatable input[type=checkbox]:checked").length;
                $("#btnDeleteAll").toggle(selected > 0);
            });

            // Delete all selected items
            $("#btnDeleteAll").click(function() {
                var selected = $("#datatable input[type=checkbox]:checked").map(function() {
                    return this.value;
                }).get();

                if (selected.length > 0) {
                    $('#delete_all').modal('show');
                    $('#deleteAllId').val(selected);
                }
            });
        });
    </script>
@endsection
