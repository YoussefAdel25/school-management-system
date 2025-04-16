@extends('layouts.master')

@section('css')
    @toastr_css
    <style>
        .required::after {
            content: '*';
            color: red;
        }
        .form-section {
            padding: 40px;
            margin-bottom: 30px;
            border-radius: 8px;
            background-color: #f9f9f9;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .section-title {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 25px;
            font-weight: bold;
        }
        .form-group label {
            font-weight: 500;
        }
        .form-group input,
        .form-group select {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 12px;
            width: 100%;
            font-size: 1rem;
        }
        .form-group select {
            cursor: pointer;
        }
        .form-group {
            margin-bottom: 25px;
        }
        .form-row {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }
        .form-row .form-group {
            flex: 1 1 48%;
        }
        .form-row .form-group.full-width {
            flex: 1 1 100%;
        }
        .submit-btn {
            display: flex;
            justify-content: flex-end;
            margin-top: 30px;
        }
        /* Full page container */
        .container-fluid {
            max-width: 100%;
            padding: 20px;
        }
        .row {
            justify-content: center;
        }
        .page-header h2 {
            font-size: 1.8rem;
            font-weight: 600;
        }

        .page-header .icon {
            background: linear-gradient(to right, #3b82f6, #2563eb);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
        }

        .breadcrumb a {
            font-weight: 500;
            text-decoration: none;
        }

        .breadcrumb .breadcrumb-item + .breadcrumb-item::before {
            content: "›";
            color: #999;
            padding: 0 5px;
        }

    </style>
@section('title')
    {{ trans('students.editStudent') }}
@stop

@section('page-header')
    <div class="page-header py-4 px-3 mb-4 rounded shadow-sm" style="background-color: #f1f5f9;">
        <div class="d-flex align-items-center justify-content-between flex-wrap">
            <div class="d-flex align-items-center gap-3">
                <div class="icon bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                    <i class="fas fa-user-graduate fa-lg"></i>
                </div>
                <div>
                    <h2 class="mb-1 fw-bold text-dark" style="font-size: 1.75rem;">
                        {{ trans('students.editStudent') }}
                    </h2>
                    <small class="text-muted">
                        {{ trans('students.editStudent') }} / {{ $students->getTranslation('name', app()->getLocale()) }}
                    </small>
                </div>
            </div>
            <nav aria-label="breadcrumb" class="mt-3 mt-sm-0">
                <ol class="breadcrumb bg-transparent m-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('students.index') }}" class="text-primary">{{ trans('main-sidebar.studentsList') }}</a>
                    </li>
                    <li class="breadcrumb-item active text-dark" aria-current="page">
                        {{ trans('students.editStudent') }}
                    </li>
                </ol>
            </nav>
        </div>
    </div>
@endsection

@section('PageTitle')
    {{ trans('students.editStudent') }}
@stop
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm">
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

                    <form method="POST" action="{{ route('students.update') }}" autocomplete="off">
                        @csrf
                        @method('PATCH')

                        <!-- Personal Information Section -->
                        <div class="form-section">
                            <div class="section-title">{{ trans('students.personalInformation') }}</div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="required">{{ trans('students.Email') }}</label>
                                    <input type="email" name="email" value="{{ $students->email }}" required>
                                </div>
                                <input type="hidden" name="id" value="{{$students->id}}">
                                <div class="form-group">
                                    <label class="required">{{ trans('students.Password') }}</label>
                                    <input type="password" name="password" required value="{{ $students->password }}">
                                </div>
                                <div class="form-group">
                                    <label class="required">{{ trans('students.NameAr') }}</label>
                                    <input type="text" name="nameAr" required value="{{ $students->getTranslation('name','ar') }}">
                                </div>
                                <div class="form-group">
                                    <label class="required">{{ trans('students.NameEn') }}</label>
                                    <input type="text" name="nameEn" required value="{{ $students->getTranslation('name','en') }}">
                                </div>
                                <div class="form-group">
                                    <label class="required">{{ trans('students.nationalId') }}</label>
                                    <input type="text" name="nationalId" required value="{{ $students->nationalId }}">
                                </div>
                                <div class="form-group">
                                    <label class="required">{{ trans('students.gender') }}</label>
                                    <select name="genderId" required>
                                        <option disabled selected>{{ trans('Parent_trans.Choose') }}...</option>
                                        @foreach ($Genders as $Gender)
                                        <option value="{{$Gender->id}}" {{$Gender->id == $students->genderId ? 'selected' : ""}}>{{ $Gender->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="required">{{ trans('students.gender') }}</label>
                                    <select name="religionId" required>
                                        <option disabled selected>{{ trans('Parent_trans.Choose') }}...</option>
                                        @foreach ($religions as $r)
                                        <option value="{{$r->id}}" {{$r->id == $students->religionId ? 'selected' : ""}}>{{ $r->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="required">{{ trans('students.nationality') }}</label>
                                    <select name="nationalityId" required>
                                        <option disabled selected>{{ trans('Parent_trans.Choose') }}...</option>
                                        @foreach ($nationals as $nal)
                                        <option value="{{ $nal->id }}" {{$nal->id == $students->nationalityId ? 'selected' : ""}}>{{ $nal->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>{{ trans('students.blood') }}</label>
                                    <select name="bloodId">
                                        <option disabled selected>{{ trans('Parent_trans.Choose') }}...</option>
                                        @foreach ($bloods as $bg)
                                        <option value="{{ $bg->id }}" {{$bg->id == $students->bloodId ? 'selected' : ""}}>{{ $bg->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group full-width">
                                    <label>{{ trans('students.birthDate') }}</label>
                                    <input class="form-control" type="text" id="datepicker-action" name="dateBirth" data-date-format="yyyy-mm-dd" value="{{ $students->dateBirth }}">
                                </div>
                            </div>
                        </div>

                        <!-- Academic Information Section -->
                        <div class="form-section">
                            <div class="section-title">{{ trans('students.studentInformation') }}</div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="required">{{ trans('grades.name') }}</label>
                                    <select name="gradeId" required>
                                        <option disabled selected>{{ trans('Parent_trans.Choose') }}...</option>
                                        @foreach ($grades as $Grade)
                                        <option value="{{ $Grade->id }}" {{$Grade->id == $students->gradeId ? 'selected' : ""}}>{{ $Grade->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="required">{{ trans('classes.name') }}</label>
                                    <select name="classId" required>
                                        <option value="{{$students->classId}}">{{$students->classroom->name}}</option>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>{{ trans('sections.name') }}</label>
                                    <select name="sectionId">
                                        <option value="{{$students->sectionId}}"> {{$students->section->name}}</option>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="required">{{ trans('students.fatherName') }}</label>
                                    <select name="parentId" required>
                                        <option disabled selected>{{ trans('Parent_trans.Choose') }}...</option>
                                        @foreach ($parents as $parent)
                                        <option value="{{ $parent->id }}" {{ $parent->id == $students->parentId ? 'selected' : ""}}>{{ $parent->fatherName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="required">{{ trans('students.academicYear') }}</label>
                                    <select name="academicYear" required>
                                        <option disabled selected>{{ trans('Parent_trans.Choose') }}...</option>
                                        @php $current_year = date("Y"); @endphp
                                        @for ($year = $current_year; $year <= $current_year + 1; $year++)
                                        <option value="{{ $year}}" {{$year == $students->academicYear ? 'selected' : ' '}}>{{ $year }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="submit-btn">
                            <button type="submit" class="btn btn-success btn-lg">
                                {{ trans('students.edit') }}
                            </button>
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
        $(document).ready(function() {
            $('select[name="Grade_id"]').on('change', function() {
                var Grade_id = $(this).val();
                if (Grade_id) {
                    $.ajax({
                        url: "{{ URL::to('Get_classrooms') }}/" + Grade_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="Classroom_id"]').empty().append(
                                '<option disabled selected>{{ trans('Parent_trans.Choose') }}...</option>');
                            $.each(data, function(key, value) {
                                $('select[name="Classroom_id"]').append(
                                    '<option value="' + key + '">' + value + '</option>');
                            });
                        },
                    });
                }
            });

            $('select[name="Classroom_id"]').on('change', function() {
                var Classroom_id = $(this).val();
                if (Classroom_id) {
                    $.ajax({
                        url: "{{ URL::to('Get_Sections') }}/" + Classroom_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="section_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="section_id"]').append(
                                    '<option value="' + key + '">' + value + '</option>');
                            });
                        },
                    });
                }
            });
        });
    </script>
@endsection
