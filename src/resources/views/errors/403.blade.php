@extends('layouts.app')

@section('title', __('Forbidden'))
@section('content')
    @component('components.errors',
        ['code' => '403', 'message' => __($exception->getMessage() ?: 'Forbidden')])
    @endcomponent
@endsection