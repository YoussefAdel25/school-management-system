@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('teacher.addTeacher') }}
@stop



@section('page-header')
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">{{ trans('teacher.addTeacher') }}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                    <li class="breadcrumb-item"><a href="#"
                            class="default-color">{{ trans('main-sidebar.teachers') }}</a>
                    </li>
                    <li class="breadcrumb-item active">{{ trans('teacher.addTeacher') }}</li>
                </ol>
            </div>
        </div>
    </div>
@endsection
<!-- breadcrumb -->
{{--  @section('PageTitle')
    {{ trans('teacher.addTeacher') }}
@stop  --}}
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->

<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                @if (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('error') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">


                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif


                <div class="col-xs-12">
                    <div class="col-md-12">

                        <br>
                        <form action="{{ route('teachers.store') }}" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="col">
                                    <label for="title">{{ trans('teacher.email') }}</label>
                                    <input type="email" name="email" class="form-control">
                                    @error('Email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="title">{{ trans('teacher.password') }}</label>
                                    <input type="password" name="password" class="form-control">
                                    @error('Password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>


                            <div class="form-row">
                                <div class="col">
                                    <label for="title">{{ trans('teacher.nameAr') }}</label>
                                    <input type="text" name="nameAr" class="form-control">
                                    @error('Name_ar')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="title">{{ trans('teacher.nameEn') }}</label>
                                    <input type="text" name="nameEn" class="form-control">
                                    @error('Name_en')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="inputCity">{{ trans('teacher.specialization') }}</label>
                                    <select class="custom-select my-1 mr-sm-2" name="specialization_id">
                                        <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                        @foreach ($specializations as $specialization)
                                            <option value="{{ $specialization->id }}">{{ $specialization->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('Specialization_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col">
                                    <label for="inputState">{{ trans('teacher.gender') }}</label>
                                    <select class="custom-select my-1 mr-sm-2" name="gender_id">
                                        <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                        @foreach ($genders as $gender)
                                            <option value="{{ $gender->id }}">{{ $gender->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('Gender_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>

                            <div class="form-row">
                                <div class="col">
                                    <label for="title">{{ trans('teacher.joiningDate') }}</label>
                                    <div class='input-group date'>
                                        <input class="form-control" type="text" id="datepicker-action"
                                            name="joiningDate" data-date-format="yyyy-mm-dd" required>
                                    </div>
                                    @error('Joining_Date')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>

                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">{{ trans('teacher.address') }}</label>
                                <textarea class="form-control" name="address" id="exampleFormControlTextarea1" rows="4"></textarea>
                                @error('Address')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                                type="submit">{{ trans('Parent_trans.Next') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render
@endsection
