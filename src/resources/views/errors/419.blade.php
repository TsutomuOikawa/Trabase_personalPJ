@extends('layouts.app')

@section('title', __('Page Expired'))
@section('content')
    @component('components.errors',
        ['code' => '419', 'message' => __('Page Expired')])
    @endcomponent
@endsection