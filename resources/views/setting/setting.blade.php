@extends('layout.main')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dashboard.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/mqtt_setting.css') }}">
@endsection
@section('title')
<title>Setting</title>
@endsection
@section('content')
<livewire:mqtt-setting />
@endsection
@section('scripts')
<script>
    
</script>
@endsection
