@extends('layouts.app')

@section('title', __('Server Error'))
@section('content')
    @component('components.errors',
        ['code' => '500', 'message' => __('Server Error')])
    @endcomponent
@endsection