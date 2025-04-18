@extends('layouts.master')

@section('css')
@livewireStyles
<!-- إضافة أي CSS هنا إذا لزم الأمر -->
@endsection

@section('title')
    {{ trans('main-sidebar.Add_Parent') }}
@stop

@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('main-sidebar.Add_Parent') }}
@stop
<!-- breadcrumb -->
@endsection

@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <!-- استدعاء الـ Livewire component -->
                @livewire('add-parent')
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection

@section('js')
    @livewireScripts
@endsection
