@extends('layout.main')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dashboard.css') }}">
    <style>
        @media only screen and (max-width: 700px) {
            .body_content {
                background-color: #eb050500;
                box-shadow: none;
            }
        }
    </style>
@endsection
@section('title')
    <title>Homepage</title>
@endsection
@section('content')
    <livewire:dashboard />
@endsection
@section('scripts')
    <script></script>
@endsection
