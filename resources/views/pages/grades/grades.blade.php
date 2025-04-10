@extends('layouts.master')

@section('css')
@endsection

@section('title')
    {{ trans('main-sidebar.Grades List') }}
@stop

@section('page-header')
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">{{ trans('main-sidebar.Grades') }}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                    <li class="breadcrumb-item"><a href="#" class="default-color">{{ trans('main-sidebar.Grades') }}</a>
                    </li>
                    <li class="breadcrumb-item active">{{ trans('main-sidebar.Grades List') }}</li>
                </ol>
            </div>
        </div>
    </div>
@endsection

@section('content')
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

                    <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                        {{ trans('grades.addGrade') }}
                    </button><br><br>

                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered p-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ trans('grades.name') }}</th>
                                    <th>{{ trans('grades.notes') }}</th>
                                    <th>{{ trans('grades.processes') }}</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($grades as $index => $grade)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $grade->name }}</td>
                                        <td>{{ $grade->notes }}</td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#edit" data-id="{{ $grade->id }}"
                                                data-name-ar="{{ $grade->getTranslation('name', 'ar') }}"
                                                data-name-en="{{ $grade->getTranslation('name', 'en') }}"
                                                data-notes="{{ $grade->notes }}" title="{{ trans('grades.edit') }}">
                                                <i class="fa fa-edit"></i>
                                            </button>

                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete" data-id="{{ $grade->id }}"
                                                title="{{ trans('grades.delete') }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">{{ trans('grades.noGrades') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{--  add_form  --}}
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                            {{ trans('grades.addGrade') }}
                        </h1>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('grades.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <label for="Name" class="mr-sm-2">{{ trans('grades.arabicStage') }}:</label>
                                    <input id="Name" type="text" name="name_ar" class="form-control">
                                </div>

                                <div class="col">
                                    <label for="Name_en" class="mr-sm-2">{{ trans('grades.englishStage') }}:</label>
                                    <input type="text" class="form-control" name="name_en">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">{{ trans('grades.notes') }}:</label>
                                <textarea class="form-control" name="notes" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                            <br><br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            {{ trans('grades.close') }}
                        </button>
                        <button type="submit" class="btn btn-success">
                            {{ trans('grades.submit') }}
                        </button>
                    </div>
                    </form>

                </div>
            </div>
        </div>

        {{--  edit_form  --}}
        <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                            {{ trans('grades.editStage') }}
                        </h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('grades.update') }}" method="post">
                            {{ method_field('patch') }}
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <label for="name_ar" class="mr-sm-2">{{ trans('grades.arabicStage') }}:</label>
                                    <input id="name_ar" type="text" name="name_ar" class="form-control"
                                        value="{{ old('name_ar') }}" required>
                                    <input id="id" type="hidden" name="id" class="form-control"
                                        value="{{ old('id') }}">
                                </div>
                                <div class="col">
                                    <label for="name_en" class="mr-sm-2">{{ trans('grades.englishStage') }}:</label>
                                    <input type="text" class="form-control" name="name_en"
                                        value="{{ old('name_en') }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">{{ trans('grades.notes') }}:</label>
                                <textarea class="form-control" name="notes" id="exampleFormControlTextarea1" rows="3">{{ old('notes') }}</textarea>
                            </div>
                            <br><br>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">{{ trans('grades.close') }}</button>
                                <button type="submit" class="btn btn-success">{{ trans('grades.submit') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{--  delete_form  --}}
        <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                            {{ trans('grades.deleteStage') }}</h3>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('grades.destroy') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            {{ trans('grades.warning') }}
                            <input type="hidden" name="id" id="delete_id" value="">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">{{ trans('grades.close') }}</button>
                                <button type="submit" class="btn btn-danger">{{ trans('grades.delete') }}</button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('js')
    @toastr_js
    @toastr_render

    <script>
        $('#edit').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // الزر الذي ضغط عليه
            var id = button.data('id');
            var nameAr = button.data('name-ar');
            var nameEn = button.data('name-en');
            var notes = button.data('notes');

            var modal = $(this);
            modal.find('#id').val(id);
            modal.find('#name_ar').val(nameAr);
            modal.find('[name="name_en"]').val(nameEn);
            modal.find('textarea[name="notes"]').val(notes);
        });
    </script>


    <script>
        $('#delete').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id'); // خد الـ id من الزر
            var modal = $(this);
            modal.find('#delete_id').val(id);
        });
    </script>

@endsection
