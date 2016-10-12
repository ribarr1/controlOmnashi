@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')

	@include('dashboard.smallBox')
	@include('layouts.partials.inbox')
	@include('req.reqModal')

@endsection
