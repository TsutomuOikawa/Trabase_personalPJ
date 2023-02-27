@extends('layouts.app')

@section('title', __('Too Many Requests'))
@section('content')
    @component('components.errors',
        ['code' => '429', 'message' => __('Too Many Requests')])
    @endcomponent
@endsection