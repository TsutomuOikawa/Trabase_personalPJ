@extends('layouts.app')

@section('title', __('Unauthorized'))
@section('content')
    @component('components.errors',
        ['code' => '401', 'message' => __('Unauthorized')])
    @endcomponent
@endsection