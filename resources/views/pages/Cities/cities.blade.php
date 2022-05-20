@extends('layouts.master')
@section('css')

    @toastr_css
@endsection
@section('title')
    {{ trans('city_trans.title_page') }}

@endsection

<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('city_trans.title_page') }}

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


                    <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                        {{ trans('city_trans.add_city') }}

                    </button>
                    <br><br>

                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                               data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ trans('state_trans.name_en') }}</th>
                                <th>{{ trans('state_trans.name_ar') }}</th>
                                <th>{{ trans('state_trans.state') }}</th>
                                <th>{{ trans('state_trans.Processes') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; ?>
                            @foreach ($cities as $city)
                                <tr>
                                    <?php $i++; ?>
                                    <td>{{ $i }}</td>
                                    <td>{{ $city->name_en }}</td>
                                    <td>{{ $city->name_ar }}</td>
                                    <td>{{ $city->state->name }}</td>

                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#edit{{ $city->id }}"
                                                title="{{ trans('city_trans.Edit') }}"><i class="fa fa-edit"></i></button>

                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $city->id }}"
                                                title="{{ trans('city_trans.Delete') }}"><i

                                                class="fa fa-trash"></i></button>
                                    </td>
                                </tr>

                                <!-- edit_modal_Grade -->
                                                                <div class="modal fade" id="edit{{ $city->id }}" tabindex="-1" role="dialog"
                                                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                                                    id="exampleModalLabel">
                                                                                    {{ trans('city_trans.edit_state') }}
                                                                                    Edit pharmacy
                                                                                </h5>
                                                                                <button type="button" class="close" data-dismiss="modal"
                                                                                        aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <!-- add_form -->
                                                                                <form action="{{ route('cities.update', [$city->id]) }}" method="post">
                                                                                    {{ method_field('patch') }}
                                                                                    @csrf
                                                                                    <div class="row">
                                                                                        <div class="col">
                                                                                            <label for="Name"
                                                                                                   class="mr-sm-2">{{ trans('city_trans.name_en') }}
                                                                                                :</label>
                                                                                            <input id="username" type="text" name="name_en"
                                                                                                   class="form-control"
                                                                                                   value="{{ $city->name_en }}"
                                                                                                   required>
                                                                                        </div>

                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label
                                                                                            for="exampleFormControlTextarea1">{{ trans('city_trans.name_ar') }}

                                                                                            :</label>
                                                                                        <input class="form-control" name="name_ar"
                                                                                                  id="exampleFormControlTextarea1"
                                                                                                  rows="3" value="{{ $city->name_ar }}">
                                                                                    </div>


                                                                                    <div class="row">
                                                                                        <div class="col">
                                                                                            <label for="Name" class="mr-sm-2">{{ trans('city_trans.state') }}:</label>
                                                                                            <select id="Name" type="text" name="state_id" class="form-control">
                                                                                                @foreach($states as $state)
                                                                                                    <option hidden>choose state</option>
                                                                                                    <option value="{{$state->id}}">{{ $state->name  }} </option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </div>

                                                                                    </div>

                                                                                    <br><br>

                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-secondary"
                                                                                                data-dismiss="modal">{{ trans('city_trans.close') }}</button>
                                                                                        <button type="submit"
                                                                                                class="btn btn-success">{{ trans('city_trans.submit') }}</button>
                                                                                    </div>
                                                                                </form>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                <!-- delete_modal_Grade -->

                                {{--                                delete-modle--}}
                                <div class="modal fade" id="delete{{ $city->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    {{ trans('city_trans.delete_city') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('cities.destroy', [$city->id]) }}"
                                                      method="post">
                                                    {{ method_field('Delete') }}
                                                    @csrf
                                                    {{ trans('city_trans.warning_city') }}
                                                    <input id="id" type="hidden" name="id" class="form-control"
                                                           value="{{ $city->id }}">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ trans('city_trans.close') }}</button>
                                                        <button type="submit"
                                                                class="btn btn-danger">{{ trans('city_trans.submit') }}</button>
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



{{------------------------------------------add model---------------------------------------------------------}}
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                            {{ trans('city_trans.add_city') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- add_form -->
                        <form action="{{ route('cities.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <label for="Name" class="mr-sm-2">{{ trans('city_trans.name_en') }}:</label>
                                    <input id="Name" type="text" name="name_en" class="form-control">
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">{{ trans('city_trans.name_ar') }}:</label>
                                <input class="form-control" type="text" name="name_ar" id="exampleFormControlTextarea1"
                                       rows="3">
                            </div>


                            <div class="row">
                                <div class="col">
                                    <label for="Name" class="mr-sm-2">{{ trans('city_trans.state') }}:</label>
                                    <select id="Name" type="text" name="state_id" class="form-control">
                                        @foreach($states as $state)
                                            <option hidden>choose state</option>
                                            <option value="{{$state->id}}">{{ $state->name  }} </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            <br><br>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">{{ trans('city_trans.close') }}</button>
                                <button type="submit"
                                        class="btn btn-success">{{ trans('city_trans.submit') }}</button>
                            </div>
                        </form>
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
