@extends('layouts.master')
@section('css')
    @toastr_css
@endsection

@section('title')
       Notifications
@endsection

@section('page-header')
    <!-- breadcrumb -->
@endsection
@section('PageTitle')
    Notifications

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
                        @foreach ($notifications as $notification)
                            <tr>
                                <?php $i++; ?>
                                <td>{{ $i }}</td>
                                <td>{{ $notification->data["title"] }}</td>

                             @if($notification->type=='App\Notifications\PrescriptionNotification')
{{--                                   <td>Prescription Pathe : {{ $notification->data["subject"] }}</td>--}}
                                        <td> <img src="{{asset('storage/images/'.$notification->data["subject"])}}"alt=""> </td>
                               @endif
                             @if($notification->type=='App\Notifications\UserNotification')
                                    <td>User Name : {{ $notification->data["subject"] }}</td>
                               @endif
                                <td>{{ $notification->created_at}}</td>

                            </tr>
                        @endforeach
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
