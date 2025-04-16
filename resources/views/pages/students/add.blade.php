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
            border-radius: 12px;
            background-color: #ffffff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }
        .section-title {
            font-size: 1.6rem;
            color: #111827;
            margin-bottom: 25px;
            font-weight: bold;
        }
        .form-group label {
            font-weight: 500;
            color: #374151;
        }
        .form-group input,
        .form-group select {
            border-radius: 8px;
            border: 1px solid #d1d5db;
            padding: 12px;
            width: 100%;
            font-size: 1rem;
            background-color: #f9fafb;
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
        .container-fluid {
            padding:0px;
            margin-top: 0; /* نضمن مفيش مسافة زايدة */
        }
    </style>
@endsection

@section('title')
    {{ trans('students.addStudent') }}
@endsection

@section('page-header')
@section('page-header')
    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between bg-gradient-light p-4 rounded shadow-sm mb-4" style="border-bottom: 4px solid #ccc;">
            <div class="d-flex align-items-center gap-4">
                <div class="bg-primary text-white d-flex justify-content-center align-items-center rounded-circle" style="width: 55px; height: 55px;">
                    <i class="fas fa-user-plus fa-lg"></i>
                </div>
                <div>
                    <h2 class="mb-0 text-dark" style="font-size: 1.75rem; font-weight: 600;">
                        {{ trans('students.addStudent') }}
                    </h2>
                    <p class="text-muted mb-0" style="font-size: 1rem;">
                        {{ trans('students.addNewStudentInfo') ?? 'أدخل بيانات الطالب الجديد بطريقة منظمة وسهلة' }}
                    </p>
                </div>
            </div>

        </div>
    </div>
@endsection

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

                    <form method="POST" action="{{ route('students.store') }}" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        <!-- Personal Information -->
                        <div class="form-section">
                            <div class="section-title">{{ trans('students.personalInformation') }}</div>
                            <div class="form-row">
                                {{-- Email --}}
                                <div class="form-group">
                                    <label class="required">{{ trans('students.Email') }}</label>
                                    <input type="email" name="email" required>
                                </div>

                                {{-- Password --}}
                                <div class="form-group">
                                    <label class="required">{{ trans('students.Password') }}</label>
                                    <input type="password" name="password" required>
                                </div>

                                {{-- Name Arabic --}}
                                <div class="form-group">
                                    <label class="required">{{ trans('students.NameAr') }}</label>
                                    <input type="text" name="nameAr" required>
                                </div>

                                {{-- Name English --}}
                                <div class="form-group">
                                    <label class="required">{{ trans('students.NameEn') }}</label>
                                    <input type="text" name="nameEn" required>
                                </div>

                                {{-- National ID --}}
                                <div class="form-group">
                                    <label class="required">{{ trans('students.nationalId') }}</label>
                                    <input type="text" name="nationalId" required>
                                </div>

                                {{-- Gender --}}
                                <div class="form-group">
                                    <label class="required">{{ trans('students.gender') }}</label>
                                    <select name="genderId" required>
                                        <option disabled selected>{{ trans('Parent_trans.Choose') }}...</option>
                                        @foreach ($Genders as $Gender)
                                            <option value="{{ $Gender->id }}">{{ $Gender->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Religion --}}
                                <div class="form-group">
                                    <label class="required">{{ trans('students.religion') }}</label>
                                    <select name="religionId" required>
                                        <option disabled selected>{{ trans('Parent_trans.Choose') }}...</option>
                                        @foreach ($religions as $r)
                                            <option value="{{ $r->id }}">{{ $r->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Nationality --}}
                                <div class="form-group">
                                    <label class="required">{{ trans('students.nationality') }}</label>
                                    <select name="nationalityId" required>
                                        <option disabled selected>{{ trans('Parent_trans.Choose') }}...</option>
                                        @foreach ($nationals as $nal)
                                            <option value="{{ $nal->id }}">{{ $nal->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Blood Type --}}
                                <div class="form-group">
                                    <label>{{ trans('students.blood') }}</label>
                                    <select name="bloodId">
                                        <option disabled selected>{{ trans('Parent_trans.Choose') }}...</option>
                                        @foreach ($bloods as $bg)
                                            <option value="{{ $bg->id }}">{{ $bg->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Birth Date --}}
                                <div class="form-group full-width">
                                    <label>{{ trans('students.birthDate') }}</label>
                                    <input type="text" id="datepicker-action" name="dateBirth" data-date-format="yyyy-mm-dd">
                                </div>
                            </div>
                        </div>

                        <!-- Academic Information -->
                        <div class="form-section">
                            <div class="section-title">{{ trans('students.studentInformation') }}</div>
                            <div class="form-row">

                                {{-- Grade --}}
                                <div class="form-group">
                                    <label class="required">{{ trans('grades.name') }}</label>
                                    <select name="gradeId" id="gradeId" required>
                                        <option disabled selected>{{ trans('Parent_trans.Choose') }}...</option>
                                        @foreach ($grades as $grade)
                                            <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Class --}}
                                <div class="form-group">
                                    <label class="required">{{ trans('classes.name') }}</label>
                                    <select name="classId" id="classId" required></select>
                                </div>

                                {{-- Section --}}
                                <div class="form-group">
                                    <label>{{ trans('sections.name') }}</label>
                                    <select name="sectionId" id="sectionId"></select>
                                </div>

                                {{-- Parent --}}
                                <div class="form-group">
                                    <label class="required">{{ trans('students.fatherName') }}</label>
                                    <select name="parentId" required>
                                        <option disabled selected>{{ trans('Parent_trans.Choose') }}...</option>
                                        @foreach ($parents as $parent)
                                            <option value="{{ $parent->id }}">{{ $parent->fatherName }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Academic Year --}}
                                <div class="form-group">
                                    <label class="required">{{ trans('students.academicYear') }}</label>
                                    <select name="academicYear" required>
                                        <option disabled selected>{{ trans('Parent_trans.Choose') }}...</option>
                                        @php $current_year = date("Y"); @endphp
                                        @for ($year = $current_year; $year <= $current_year + 1; $year++)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endfor
                                    </select>
                                </div>

                                {{-- Attachments --}}
                                <div class="form-group full-width">
                                    <label class="required">{{ trans('students.attachments') }}</label>
                                    <input type="file" accept="image/*" name="photos[]" multiple>
                                </div>
                            </div>
                        </div>


                        <!-- Submit Button -->
                        <div class="submit-btn">
                            <button type="submit" class="btn btn-success btn-lg">
                                {{ trans('students.submit') }}
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
        $(document).ready(function () {
            let chooseText = "{{ trans('Parent_trans.Choose') }}...";

            $('#gradeId').on('change', function () {
                let gradeId = $(this).val();
                if (gradeId) {
                    $.ajax({
                        url: "{{ url('students/Get_classrooms') }}/" + gradeId,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('#classId').empty().append('<option disabled selected>' + chooseText + '</option>');
                            $('#sectionId').empty().append('<option disabled selected>' + chooseText + '</option>');
                            $.each(data, function (key, value) {
                                $('#classId').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                        error: function () {
                            alert('Error fetching classrooms');
                        }
                    });
                }
            });

            $('#classId').on('change', function () {
                let classId = $(this).val();
                if (classId) {
                    $.ajax({
                        url: "{{ url('students/Get_Sections') }}/" + classId,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('#sectionId').empty().append('<option disabled selected>' + chooseText + '</option>');
                            $.each(data, function (key, value) {
                                $('#sectionId').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                        error: function () {
                            alert('Error fetching sections');
                        }
                    });
                }
            });
        });
    </script>
@endsection
