@extends('dashboard')

@section('header')
	@include('layouts.dashboard.header')
@endsection

@section('menu')
	@include('layouts.dashboard.menu')
@endsection


@section('content')
	<admin></admin>
@endsection

@section('footer')
	@include('layouts.view.footer')
@endsection


