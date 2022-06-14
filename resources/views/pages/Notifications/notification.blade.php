@extends('layouts.master')
@section('css')
    @toastr_css
@endsection

@section('title')
       Notification
@endsection

@section('page-header')
    <!-- breadcrumb -->
@endsection
@section('PageTitle')
    Notification

    <!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                           data-page-length="50" style="text-align: center">

                        <thead>
                        <tr>
                            <th>#</th>
                            <th>title</th>
                            <th>subject</th>
                            <th>date</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 0; ?>
                            <tr>

                                <td>{{ $i }}</td>
                                <td>{{ $not1->data["title"] }}</td>

                             @if($not1->type=='App\Notifications\PrescriptionNotification')
                                   <td>Prescription Pathe : {{ $not1->data["subject"] }}</td>
                               @endif
                             @if($not1->type=='App\Notifications\UserNotification')
                                    <td>User Name : {{ $not1->data["subject"] }}</td>
                               @endif
                                <td>{{ $not1->created_at}}</td>

                            </tr>

                    </table>

                </div>


            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
    <script src="{{\Illuminate\Support\Facades\URL::asset('js/app.js')}}"></script>
@endsection
