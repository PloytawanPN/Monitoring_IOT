@extends('layout.main')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dashboard.css') }}">
@endsection
@section('title')
<title>Homepage</title>
@endsection
@section('content')
<livewire:dashboard />
@endsection
@section('scripts')
<script>
</script>
@endsection