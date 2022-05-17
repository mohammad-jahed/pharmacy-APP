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
    {{ trans('main_trans.pharmacies') }}

@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="/dist/output.css" rel="stylesheet">
        <title></title>
    </head>
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
                    {{--                            @role('User')--}}

                    @can('add pharmacy')
                        <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                            {{ trans('pharmacy_trans.add_pharmacy') }}

                        </button>
                    @endcan
                    {{--                        @endrole--}}
                    <br><br>

                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                               data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ trans('pharmacy_trans.username') }}</th>
                                <th>{{ trans('pharmacy_trans.email') }}</th>
                                <th>{{ trans('pharmacy_trans.Processes') }}</th>
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
                                        {{--                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"--}}
                                        {{--                                                data-target="#edit{{ $pharmacy->id }}"--}}
                                        {{--                                                title="{{ trans('pharmacy_trans.Edit') }}"><i class="fa fa-edit"></i></button>--}}
                                        {{--                                                title="Edit"><i class="fa fa-edit"></i></button>--}}
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $pharmacy->id }}"
                                                {{--                                                title="{{ trans('pharmacy_trans.Delete') }}"><i--}}
                                                title="Delete"><i
                                                class="fa fa-trash"></i></button>
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
                                <div class="modal fade" id="delete{{ $pharmacy->id }}" tabindex="-1" role="dialog"
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
                                                <form action="{{ route('pharmacy.destroy', [$pharmacy->id]) }}"
                                                      method="post">
                                                    {{ method_field('Delete') }}
                                                    @csrf
                                                    {{ trans('pharmacy_trans.warning_pharmacy') }}
                                                    <input id="id" type="hidden" name="id" class="form-control"
                                                           value="{{ $pharmacy->id }}">
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
                        <form action="{{ route('pharmacy.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <label for="Name" class="mr-sm-2">{{ trans('pharmacy_trans.username') }}:</label>
                                    <input id="Name" type="text" name="username" class="form-control">
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">{{ trans('pharmacy_trans.email') }}:</label>
                                <input class="form-control" type="email" name="email" id="exampleFormControlTextarea1"
                                       rows="3">
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

                            <div>
                                <div class="row">
                                    <div class="col">
                                        <label for="Name" class="mr-sm-2">{{ trans('pharmacy_trans.state') }}:</label>
                                        <?php $i = 0; ?>
                                        <select id="state" type="number" name="state_id" class="form-control">
                                            @foreach($states as $state)
                                                <?php $i++; ?>
                                                <option hidden>choose state</option>
                                                <option value="{{$state->id}}">{{ $state->name  }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="Name" class="mr-sm-2">{{ trans('pharmacy_trans.city') }}:</label>
                                        <select id="city" type="number" name="city_id" class="form-control">
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="Name" class="mr-sm-2">{{ trans('pharmacy_trans.area') }}:</label>
                                        <select id="area" type="number" name="area_id" class="form-control">
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="Name" class="mr-sm-2">{{ trans('pharmacy_trans.street') }}
                                            :</label>
                                        <input id="image" type="text" name="street" class="form-control">


                                    </div>
                                </div>
                                <script src="{{ asset('js/app.js') }}"></script>
                                <script type="text/javascript">
                                    $('#state').on('change', function (e) {
                                        let state = this.value
                                        console.log(state);
                                        $.ajax({
                                            url: "/state/" + state + '/cities',
                                            dataType: 'json',
                                            success:
                                                function (res) {
                                                    for (let i = 0; i < res.data.length; i++) {
                                                        $('#city').append($(
                                                            '<option>', {
                                                                value: res.data[i].id,
                                                                text: res.data[i].name,
                                                            }
                                                        ));
                                                    }
                                                }

                                        })
                                    });
                                    $('#city').on('change', function (e) {
                                        let city = this.value
                                        console.log(city)
                                        $.ajax({
                                            url: "/city/" + city + '/areas',
                                            dataType: 'json',
                                            success:
                                                function (res) {
                                                    for (let i = 0; i < res.data.length; i++) {
                                                        $('#area').append($(
                                                            '<option>', {
                                                                value: res.data[i].id,
                                                                text: res.data[i].name,
                                                            }
                                                        ));
                                                    }
                                                }

                                        })
                                    });
                                </script>


                            </div>
                            <div>

                                    <div class="row">
                                        <div class="col">
                                            <label for="Name" class="mr-sm-2">{{ trans('pharmacy_trans.day') }}:</label>
                                            <select id="day" type="number" name="day" class="form-control">
                                                <option value=0>{{trans('days_trans.saturday')}}</option>
                                                <option value=1>{{trans('days_trans.sunday')}}</option>
                                                <option value=2>{{trans('days_trans.monday')}}</option>
                                                <option value=3>{{trans('days_trans.tuesday')}}</option>
                                                <option value=4>{{trans('days_trans.wednesday')}}</option>
                                                <option value=5>{{trans('days_trans.thursday')}}</option>
                                                <option value=6>{{trans('days_trans.friday')}}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <label for="Name" class="mr-sm-2">{{ trans('pharmacy_trans.from') }}
                                                :</label>
                                            <input id="image" type="time" name="from" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label for="Name" class="mr-sm-2">{{ trans('pharmacy_trans.to') }}
                                                :</label>
                                            <input id="image" type="time" name="to" class="form-control">
                                        </div>
                                    </div>

                                </div>

                            <br><br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ trans('pharmacy_trans.close') }}</button>
                        <button type="submit"
                                class="btn btn-success">{{ trans('pharmacy_trans.submit') }}</button>
                    </div>
                    </form>

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
