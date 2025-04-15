@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
    @toastr_css

    <style>
        /* Table Styles */
        .table th,
        .table td {
            padding: 10px;
            text-align: center;
        }

        .table th {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }

        /* Button Styles */
        .btn-custom {
            font-size: 14px;
            padding: 8px 15px;
            border-radius: 25px;
        }

        .btn-custom:hover {
            opacity: 0.8;
        }

        .btn-success-custom {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-danger-custom {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-info-custom {
            background-color: #24c135;
            border-color: #24c135;

        }

        /* Modal Styles */
        .modal-header {
            background-color: #f1f1f1;
            border-bottom: 1px solid #ddd;
        }

        .modal-footer {
            border-top: 1px solid #ddd;
        }

        /* Accordion Styles */
        .accordion .acd-heading {
            font-size: 18px;
            font-weight: bold;
            background-color: #f8f9fa;
            padding: 10px;
            border-radius: 5px;
        }

        .accordion .acd-heading:hover {
            background-color: #e9ecef;
        }

        .accordion .acd-des {
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 5px;
        }

        /* Custom Form Input Styles */
        .form-control {
            border-radius: 20px;
        }

        .custom-select {
            border-radius: 20px;
            padding: 5px;
        }
    </style>
@endsection

@section('title')
    {{ trans('main-sidebar.sections') }}
@stop

@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ trans('main-sidebar.sectionsList') }}
@stop
<!-- breadcrumb -->
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <a class="btn btn-custom btn-info-custom" href="#" data-toggle="modal" data-target="#exampleModal">
                    {{ trans('sections.addSection') }}
                </a>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="accordion gray plus-icon round">
                @foreach ($grades as $grade)
                    <div class="acd-group">
                        <a href="#" class="acd-heading">{{ $grade->name }}</a>
                        <div class="acd-des">
                            <div class="row">
                                <div class="col-xl-12 mb-30">
                                    <div class="card card-statistics h-100">
                                        <div class="card-body">
                                            <div class="d-block d-md-flex justify-content-between">
                                                <div class="d-block"></div>
                                            </div>
                                            <div class="table-responsive mt-15">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr class="text-dark">
                                                            <th>#</th>
                                                            <th>{{ trans('sections.name') }}</th>
                                                            <th>{{ trans('sections.nameClass') }}</th>
                                                            <th>{{ trans('sections.status') }}</th>
                                                            <th>{{ trans('sections.processes') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 0; ?>
                                                        @foreach ($grade->sections as $list_Sections)
                                                            <tr>
                                                                <?php $i++; ?>
                                                                <td>{{ $i }}</td>
                                                                <td>{{ $list_Sections->name }}</td>
                                                                <td>{{ $list_Sections->classroom->name }}</td>
                                                                <td>
                                                                    @if ($list_Sections->status === 1)
                                                                        <label
                                                                            class="badge badge-success">{{ trans('sections.status1') }}</label>
                                                                    @else
                                                                        <label
                                                                            class="badge badge-danger">{{ trans('sections.status2') }}</label>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <!-- Edit Button -->
                                                                    <a href="#"
                                                                        class="btn btn-outline-info btn-sm btn-info-custom"
                                                                        data-toggle="modal"
                                                                        data-target="#edit{{ $list_Sections->id }}">{{ trans('sections.edit') }}</a>
                                                                    <!-- Delete Button -->
                                                                    <a href="#"
                                                                        class="btn btn-outline-danger btn-sm btn-danger-custom"
                                                                        data-toggle="modal"
                                                                        data-target="#delete{{ $list_Sections->id }}">{{ trans('sections.delete') }}</a>
                                                                </td>
                                                            </tr>

                                                            {{-- Edit Section Modal --}}
                                                            <div class="modal fade" id="edit{{ $list_Sections->id }}"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="editModalLabel{{ $list_Sections->id }}"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="editModalLabel{{ $list_Sections->id }}">
                                                                                {{ trans('sections.editSection') }}
                                                                            </h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form
                                                                                action="{{ route('sections.update', $list_Sections->id) }}"
                                                                                method="POST">
                                                                                @csrf
                                                                                @method('PATCH')
                                                                                <div class="row">
                                                                                    <div class="col">
                                                                                        <label for="inputName"
                                                                                        class="control-label">{{ trans('sections.arabicSection') }}</label>
                                                                                        <input type="text"
                                                                                            name="name_ar"
                                                                                            class="form-control"
                                                                                            value="{{ $list_Sections->getTranslation('name', 'ar') }}">
                                                                                    </div>
                                                                                    <div class="col">
                                                                                        <label for="inputName"
                                                                                        class="control-label">{{ trans('sections.englishSection') }}</label>
                                                                                        <input type="text"
                                                                                            name="name_en"
                                                                                            class="form-control"
                                                                                            value="{{ $list_Sections->getTranslation('name', 'en') }}">
                                                                                    </div>
                                                                                </div><br>

                                                                                <div class="col">
                                                                                    <label for="inputName"
                                                                                        class="control-label">{{ trans('sections.nameClass') }}</label>
                                                                                    <select name="Class_id"
                                                                                        class="custom-select">
                                                                                        <option
                                                                                            value="{{ $list_Sections->classroom->id }}">
                                                                                            {{ $list_Sections->classroom->name }}
                                                                                        </option>
                                                                                    </select>
                                                                                </div><br>

                                                                                <div class="col">
                                                                                    <label for="inputName" class="control-label">{{ trans('teacher.nameTeacher') }}</label>
                                                                                    <select name="teacher_id[]" id="teacherSelect" class="form-control form-select-sm shadow-sm border border-primary"
                                                                                            multiple data-live-search="true" title="{{ trans('teacher.selectTeacher') }}">

                                                                                        <!-- المدرسين المختارين مسبقًا -->
                                                                                        @foreach ($list_Sections->teachers as $teacher)
                                                                                            <option value="{{ $teacher['id'] }}" selected>{{ $teacher['name'] }}</option>
                                                                                        @endforeach

                                                                                        <!-- باقي المدرسين -->
                                                                                        @foreach ($teachers as $teacher)
                                                                                            @if (!in_array($teacher->id, $list_Sections->teachers->pluck('id')->toArray()))
                                                                                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div><br>


                                                                                <div class="col">
                                                                                    <div class="form-check">
                                                                                        <input type="checkbox"
                                                                                            class="form-check-input"
                                                                                            name="status"
                                                                                            id="status{{ $list_Sections->id }}"
                                                                                            value="1"
                                                                                            {{ $list_Sections->status == 1 ? 'checked' : '' }}
                                                                                            <label
                                                                                            for="status{{ $list_Sections->id }}"
                                                                                            class="form-check-label">{{ trans('sections.status') }}</label>
                                                                                    </div>
                                                                                </div>



                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                        class="btn btn-secondary"
                                                                                        data-dismiss="modal">{{ trans('sections.close') }}</button>
                                                                                    <button type="submit"
                                                                                        class="btn btn-success">{{ trans('sections.submit') }}</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            {{-- Delete Section Modal --}}
                                                            <div class="modal fade"
                                                                id="delete{{ $list_Sections->id }}" tabindex="-1"
                                                                role="dialog"
                                                                aria-labelledby="deleteModalLabel{{ $list_Sections->id }}"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="deleteModalLabel{{ $list_Sections->id }}">
                                                                                {{ trans('sections.delete') }}
                                                                            </h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal"
                                                                                aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form
                                                                                action="{{ route('sections.destroy', $list_Sections->id) }}"
                                                                                method="POST">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <p>{{ trans('sections.warning') }}</p>
                                                                                <input type="hidden" name="id"
                                                                                    value="{{ $list_Sections->id }}">

                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                        class="btn btn-secondary"
                                                                                        data-dismiss="modal">{{ trans('sections.close') }}</button>
                                                                                    <button type="submit"
                                                                                        class="btn btn-danger">{{ trans('sections.delete') }}</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Add New Section Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ trans('sections.addSection') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('sections.store') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="col">
                                    <input type="text" name="name_ar" class="form-control"
                                        placeholder="{{ trans('sections.arabicSection') }}" required>
                                </div>
                                <div class="col">
                                    <input type="text" name="name_en" class="form-control"
                                        placeholder="{{ trans('sections.englishSection') }}" required>
                                </div>
                            </div><br>

                            <div class="form-group">
                                <label for="gradeId" class="control-label">{{ trans('sections.nameGrade') }}</label>
                                <select name="gradeId" class="custom-select" required>
                                    <option value="" selected disabled>{{ trans('sections.selectGrade') }}
                                    </option>

                                    @foreach ($listGrades as $list_Grade)
                                        <option value="{{ $list_Grade->id }}">{{ $list_Grade->name }}</option>
                                    @endforeach
                                </select>
                            </div><br>

                            <div class="form-group">
                                <label for="Class_id" class="control-label">{{ trans('sections.nameClass') }}</label>
                                <select name="Class_id" class="custom-select" required>
                                    <option value="" selected disabled>{{ trans('sections.selectClass') }}
                                    </option>
                                    <!-- Class options will be populated dynamically here -->
                                </select>
                            </div><br>

                            <!-- Redesigned Teacher Select -->
                            <div class="form-group">
                                <label for="teacherSelect" class="form-label fw-bold text-primary">
                                    {{ trans('teacher.nameTeacher') }}
                                </label>
                                <select name="teacher_id[]" id="teacherSelect"
                                    class="form-control form-select-sm shadow-sm border border-primary" multiple
                                    data-live-search="true" title="{{ trans('teacher.selectTeacher') }}">

                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ trans('sections.close') }}</button>
                        <button type="submit" class="btn btn-success">{{ trans('sections.submit') }}</button>
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
        // When the grade dropdown value changes
        $('select[name="gradeId"]').on('change', function() {
            var gradeId = $(this).val(); // Get the selected grade ID

            if (gradeId) {
                // Send AJAX request to fetch the corresponding classes
                $.ajax({
                    url: "{{ URL::to('classes') }}/" + gradeId, // Dynamic URL
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="Class_id"]')
                            .empty(); // Clear the existing class options
                        $.each(data, function(key, value) {
                            // Append each class as an option
                            $('select[name="Class_id"]').append('<option value="' +
                                key + '">' + value + '</option>');
                        });
                    },
                    error: function() {
                        console.log('AJAX request failed');
                    }
                });
            } else {
                console.log('No grade selected');
            }
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
<script>
    $(document).ready(function() {
        $('.selectpicker').selectpicker(); // تفعيل Bootstrap Select
    });
</script>

@endsection
