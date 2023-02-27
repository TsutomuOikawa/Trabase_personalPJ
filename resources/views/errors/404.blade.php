@extends('layouts.app')

@section('title', __('Not Found'))
@section('content')
    @component('components.errors',
        ['code' => '404', 'message' => __($exception->getMessage() ?: 'Not Found')])
    @endcomponent
@endsection
