@extends('layouts.master')
@section('css')

    @toastr_css

@section('title')
    {{ trans('user_trans.title_page') }}

@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('main_trans.users') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">

    @if ($errors->any())
        <div class="error">{{ $errors->first('Name') }}</div>
    @endif


    <div class="col-xl-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                               data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ trans('user_trans.username') }}</th>
                                <th>{{ trans('user_trans.email') }}</th>
                                <th>{{ trans('user_trans.address') }}</th>
                                <th>{{ trans('user_trans.Processes') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; ?>
                            @foreach ($users as $user)
                                <tr>
                                    <?php $i++; ?>
                                    <td>{{ $i }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{trans('user_trans.state')}} :  {{ $user->address->state->name }}<br>
                                        {{trans('user_trans.city')}} :  {{$user->address->city->name}}<br>
                                        {{trans('user_trans.area')}} :  {{$user->address->area->name}}<br>
                                        {{trans('user_trans.street')}} :  {{$user->address->street}}
                                    </td>

                                    <td>

                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $user->id }}"
                                                title="{{ trans('user_trans.Delete') }}"><i
                                                class="fa fa-trash"></i></button>
                                    </td>
                                </tr>



                                <!-- delete_modal_Grade -->

                                {{--                                delete-modle--}}
                                <div class="modal fade" id="delete{{ $user->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    {{ trans('pharmacy_trans.delete_pharmacy') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('users.destroy', [$user->id]) }}"
                                                      method="post">
                                                    {{ method_field('Delete') }}
                                                    @csrf
                                                    {{ trans('pharmacy_trans.warning_pharmacy') }}
                                                    <input id="id" type="hidden" name="id" class="form-control"
                                                           value="{{ $user->id }}">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ trans('pharmacy_trans.close') }}</button>
                                                        <button type="submit"
                                                                class="btn btn-danger">{{ trans('pharmacy_trans.submit') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


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
@endsection
