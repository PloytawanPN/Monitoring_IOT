@extends('layout.main')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dashboard.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/insertdevice.css') }}">
@endsection
@section('title')
<title>Insert</title>
@endsection
@section('content')
<livewire:insert-device />
@endsection
@section('scripts')
<script>
</script>
@endsection