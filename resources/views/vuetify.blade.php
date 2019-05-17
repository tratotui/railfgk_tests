@extends('layouts.base')

@section('title', 'Vuetify')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection


@section('content')
    <div id="app">
        <application></application>
    </div>
@endsection

@section('script')
    <script src="/js/manifest.js"></script>
    <script src="/js/vendor.js"></script>
    <script src="/js/app.js"></script>
@endsection