@extends('layout.main')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dashboard.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/device.css') }}">
@endsection
@section('title')
<title>Device : {{$id}}</title>
@endsection
@section('content')
@livewire('device-show', ['id' => $id])
@endsection