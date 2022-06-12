<?php
@extends('layouts.master')
@section('css')
    @toastr_css
@endsection
@section('title')
    {{ trans('pharmacy_trans.title_page') }}
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @endsection
@section('PageTitle')
    {{ trans('main_trans.pharmacies') }}
@endsection
@section('content')
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <title></title>
    </head>
    <body>
    <h1 class="text-3xl font-bold underline">
        Hello world!
    </h1>
    </body>
    </html>
@endsection
@section('js')
    @toastr_js()
    @toastr_render
    <script src="{{\Illuminate\Support\Facades\URL::asset('js/app.js')}}"></script>
@endsection
