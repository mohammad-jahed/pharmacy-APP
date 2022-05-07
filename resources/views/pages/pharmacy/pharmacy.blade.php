<!doctype html>
<html>
@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('pharmacy_trans.title_page') }}

@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ trans('main_trans.pharmacyes') }}

@stop
<!-- breadcrumb -->
@endsection

@section('content')
    <!-- row -->


    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <title></title>
    </head>
    <body>
    <div class="row" xmlns="http://www.w3.org/1999/html">


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
                    {{--                            @role('User')--}}

                    @can('add pharmacy')
                        <button
                            class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded"
                            data-toggle="modal"
                            data-target="#exampleModal">
                            {{ trans('pharmacy_trans.add_pharmacy') }}

                        </button>
                    @endcan
                    {{--                        @endrole--}}
                    <br><br>

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table id="datatable"
                               class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
                               data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr class="px-6 py-3">
                                <th>#</th>
                                <th scope="col">{{ trans('pharmacy_trans.username') }}</th>
                                <th scope="col">{{ trans('pharmacy_trans.Email') }}</th>
                                <th scope="col">{{ trans('pharmacy_trans.Processes') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; ?>
                            @foreach ($pharmacies as $pharmacy)
                                <tr>
                                    <?php $i++; ?>
                                    <td>{{ $i }}</td>
                                    <td>{{ $pharmacy->username }}</td>
                                    <td>{{ $pharmacy->email }}</td>
                                    <td>
<!--                                        <button class="bg-green-500 text-white btn-sm"
                                                data-toggle="modal"
                                                data-target="#edit{{ $pharmacy->id }}"
                                                title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </button>-->
                                        <button class="bg-red-600 text-white  btn-sm "
                                                data-toggle="modal"
                                                data-target="#delete{{ $pharmacy->id }}"
                                                {{--                                                title="{{ trans('pharmacy_trans.Delete') }}"><i--}}
                                                title="Delete">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- edit_modal_Grade -->
                                {{--                                <div class="modal fade" id="edit{{ $pharmacy->id }}" tabindex="-1" role="dialog"--}}
                                {{--                                     aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
                                {{--                                    <div class="modal-dialog" role="document">--}}
                                {{--                                        <div class="modal-content">--}}
                                {{--                                            <div class="modal-header">--}}
                                {{--                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"--}}
                                {{--                                                    id="exampleModalLabel">--}}
                                {{--                                                    {{ trans('pharmacy_trans.edit_pharmacy') }}--}}
                                {{--                                                    Edit pharmacy--}}
                                {{--                                                </h5>--}}
                                {{--                                                <button type="button" class="close" data-dismiss="modal"--}}
                                {{--                                                        aria-label="Close">--}}
                                {{--                                                    <span aria-hidden="true">&times;</span>--}}
                                {{--                                                </button>--}}
                                {{--                                            </div>--}}
                                {{--                                            <div class="modal-body">--}}
                                {{--                                                <!-- add_form -->--}}
                                {{--                                                <form action="{{ route('pharmacy.update', 'test') }}" method="post">--}}
                                {{--                                                    {{ method_field('patch') }}--}}
                                {{--                                                    @csrf--}}
                                {{--                                                    <div class="row">--}}
                                {{--                                                        <div class="col">--}}
                                {{--                                                            <label for="Name"--}}
                                {{--                                                                   class="mr-sm-2">{{ trans('Grades_trans.stage_name_ar') }}--}}
                                {{--                                                                   class="mr-sm-2">Usename--}}
                                {{--                                                                :</label>--}}
                                {{--                                                            <input id="username" type="text" name="username"--}}
                                {{--                                                                   class="form-control"--}}
                                {{--                                                                   value="{{ $pharmacy->username }}"--}}
                                {{--                                                                   required>--}}
                                {{--                                                            <input id="id" type="hidden" name="id" class="form-control"--}}
                                {{--                                                                   value="{{ $pharmacy->id }}">--}}
                                {{--                                                        </div>--}}

                                {{--                                                    </div>--}}
                                {{--                                                    <div class="form-group">--}}
                                {{--                                                        <label--}}
                                {{--                                                            for="exampleFormControlTextarea1">{{ trans('Grades_trans.Email') }}--}}
                                {{--                                                            for="exampleFormControlTextarea1">Email--}}
                                {{--                                                            :</label>--}}
                                {{--                                                        <textarea class="form-control" name="Email"--}}
                                {{--                                                                  id="exampleFormControlTextarea1"--}}
                                {{--                                                                  rows="3">{{ $pharmacy->email }}</textarea>--}}
                                {{--                                                    </div>--}}
                                {{--                                                    <br><br>--}}

                                {{--                                                    <div class="modal-footer">--}}
                                {{--                                                        <button type="button" class="btn btn-secondary"--}}
                                {{--                                                                data-dismiss="modal">{{ trans('pharmacy_trans.Close') }}</button>--}}
                                {{--                                                                data-dismiss="modal">close</button>--}}
                                {{--                                                        <button type="submit"--}}
                                {{--                                                                class="btn btn-success">{{ trans('pharmacy_trans.submit') }}</button>--}}
                                {{--                                                                class="btn btn-success">submit</button>--}}
                                {{--                                                    </div>--}}
                                {{--                                                </form>--}}

                                {{--                                            </div>--}}
                                {{--                                        </div>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}


                                <!-- delete_modal_Grade -->

                                {{--                                delete-modle--}}
                                <div class="modal fade"
                                     id="delete{{ $pharmacy->id }}"
                                     tabindex="-1"
                                     role="dialog"
                                     aria-labelledby="exampleModalLabel"
                                     aria-hidden="true">
                                    <div class="modal-dialog"
                                         role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;"
                                                    class="modal-title"
                                                    id="exampleModalLabel">
                                                    {{ trans('pharmacy_trans.delete_pharmacy') }}
                                                </h5>
                                                <button class="close"
                                                        data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('pharmacy.destroy', [$pharmacy->id]) }}"
                                                    method="post">
                                                    {{ method_field('Delete') }}
                                                    @csrf
                                                    {{ trans('pharmacy_trans.Warning_pharmacy') }}
                                                    <input id="id"
                                                           type="hidden"
                                                           name="id"
                                                           class="form-control"
                                                           value="{{ $pharmacy->id }}">
                                                    <div class="modal-footer">
                                                        <button class="btn btn-light"
                                                                data-dismiss="modal">
                                                            {{ trans('pharmacy_trans.Close') }}
                                                        </button>
                                                        <button type="submit"
                                                                class="btn btn-light">
                                                            {{ trans('pharmacy_trans.submit') }}
                                                        </button>
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


        <!-- add_modal_Grade -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                            {{ trans('pharmacy_trans.add_pharmacy') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- add_form -->
                        <form action="{{ route('pharmacy.store') }}"
                              method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <label for="Name"
                                           class="mr-sm-2">
                                        {{ trans('pharmacy_trans.username') }}
                                    </label>
                                    <input id="Name" type="text" name="username" class="form-control">
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">{{ trans('pharmacy_trans.Email') }}
                                    :</label>
                                <input class="form-control" type="email" name="email" id="exampleFormControlTextarea1"
                                       rows="3"/>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label for="Name" class="mr-sm-2">{{ trans('pharmacy_trans.password') }}
                                        :</label>
                                    <input id="password" type="password" name="password" class="form-control">
                                </div>

                            </div>


                            <div class="row">
                                <div class="col">
                                    <label for="Name" class="mr-sm-2">{{ trans('pharmacy_trans.image') }}
                                        :</label>
                                    <input id="image" type="file" name="imagePath" class="form-control">
                                </div>

                            </div>


                            <div class="row">
                                <div class="col">
                                    <label for="Name" class="mr-sm-2">{{ trans('pharmacy_trans.address') }}
                                        :</label>
                                    <input id="image" type="text" name="address_id" class="form-control">
                                </div>

                            </div>

                            <div class="row">
                                <div class="col">
                                    <label for="Name" class="mr-sm-2">{{ trans('pharmacy_trans.worke_times') }}
                                        :</label>
                                    <input id="image" type="text" name="work_times_id" class="form-control">
                                </div>

                            </div>

                            <br><br>
                            <div class="modal-footer">
                                <button class="btn-light"
                                        data-dismiss="modal">{{ trans('pharmacy_trans.Close') }}</button>
                                <button type="submit"
                                        class="btn-light">{{ trans('pharmacy_trans.submit') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </body>


    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection

</html>
