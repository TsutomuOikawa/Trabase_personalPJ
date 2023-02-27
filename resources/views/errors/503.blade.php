@extends('layouts.app')

@section('title', __('Service Unavailable'))
@section('content')
    @component('components.errors',
        ['code' => '503', 'message' => __('Service Unavailable')])
    @endcomponent
@endsection