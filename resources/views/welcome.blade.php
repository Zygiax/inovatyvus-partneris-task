@extends('layout.app')
@section('content')
    <div class="container">
        @if(\Session::has('success'))
            <div class="alert alert-success">
                <p>{{Session::get('success')}}</p>
            </div>
        @endif
        @if(\Session::has('error'))
            <div class="alert alert-danger">
                <p>{{Session::get('error')}}</p>
            </div>
        @endif
            <div class="text-center">
                <h1>Task</h1>
            </div>
        <div class="">
            {!! form($form) !!}
        </div>
    </div>
@endsection
