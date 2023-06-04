@extends('layouts.app')

@section('title', __('Payment Required'))
@section('content')
    @component('components.errors',
        ['code' => '402', 'message' => __('Payment Required')])
    @endcomponent
@endsection