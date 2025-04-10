@extends('layouts.master')
@section('css')


@section('title')
    {{ trans('main-sidebar.Grades List') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ trans('main-sidebar.Grades') }}</h4>

        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{ trans('main-sidebar.Grades') }}</a>
                </li>
                <li class="breadcrumb-item active">{{ trans('main-sidebar.Grades List') }}</li>
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

                <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                    {{ trans('classes.addClass') }}
                </button><br><br>

                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered p-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ trans('classes.name') }}</th>
                                <th>{{ trans('grades.name') }}</th>
                                <th>{{ trans('classes.processes') }}</th>


                            </tr>
                        </thead>

                        <?php $i = 0; ?>
                        <tbody>
                            @foreach ($classes as $class)
                                <?php $i++; ?>
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $class->name }}</td>
                                    <td>{{ $class->grades->name }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#edit" data-id="{{ $class->id }}"
                                            data-name-ar="{{ $class->getTranslation('name', 'ar') }}"
                                            data-name-en="{{ $class->getTranslation('name', 'en') }}"
                                            data-notes="{{ $class->grades->name }}"
                                            title="{{ trans('classes.edit') }}">
                                            <i class="fa fa-edit"></i>
                                        </button>

                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#delete" title="{{ trans('classes.delete') }}"><i
                                                class="fa fa-trash"></i></button>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>

                        </tfoot>

                    </table>
                </div>
            </div>
        </div>
    </div>

    {{--  add_form  --}}

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">

                    <h3 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                        {{ trans('classes.addClass') }}
                    </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class=" row mb-30" action="{{ route('classrooms.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="repeater">
                                <div data-repeater-list="listClasses">
                                    <div data-repeater-item>
                                        <div class="row">
                                            <div class="col">
                                                <label for="Name" class="mr-sm-2">
                                                    {{ trans('classes.arabicClass') }}
                                                </label>
                                                <input type="text" class="form-control" name="name_ar">
                                            </div>

                                            <div class="col">
                                                <label for="Name" class="mr-sm-2">
                                                    {{ trans('classes.englishClass') }}
                                                </label>
                                                <input type="text" class="form-control" name="name_en">
                                            </div>

                                            <div class="col">
                                                <label for="nameEn" class="mr-sm-2">
                                                    {{ trans('classes.nameGrade') }}
                                                </label>

                                                <div class="box">
                                                    <select name="gradeId" class="fancyselect">
                                                        @foreach ($grades as $grade)
                                                            <option value="{{ $grade->id }}">{{ $grade->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label for="nameEn" class="mr-sm-2">
                                                    {{ trans('classes.processes') }}
                                                </label>
                                                <input type="button" class="btn btn-danger btn-block"
                                                    data-repeater-delete value="{{ trans('classes.deleteRow') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-20">
                                    <div class="col-12">
                                        <input type="button" class="button" data-repeater-create
                                            value="{{ trans('classes.addRow') }}">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">{{ trans('classes.close') }}</button>

                                        <button type="submit" class="btn btn-success">{{ trans('classes.submit') }}</button>



                                </div>





                            </div>
                        </div>
                </div>

                {{--  edit_form  --}}

                {{--  delete_form  --}}


            </div>
        </div>
    </div>
    </div>


    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render


    {{--  <script>
    $('#edit').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // الزر اللي ضغط عليه
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
</script>  --}}

@endsection
