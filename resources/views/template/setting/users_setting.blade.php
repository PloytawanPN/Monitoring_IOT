@extends('template.layout.main')

@section('style')
    <style>

        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }

        .container_load {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
@endsection

@section('title')
    <title>Datatables | Hyper - Responsive Bootstrap 4 Admin Dashboard</title>
@endsection
{{-- @section('style')
@endsection --}}
@section('content')
    <livewire:user-setting />
@endsection
{{-- @section('script')

@endsection --}}
