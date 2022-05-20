@extends('layouts.master')
@section('css')

    @toastr_css
@endsection
@section('title')
    {{ trans('area_trans.title_page') }}

@endsection

<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('area_trans.title_page') }}

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
                        {{ trans('area_trans.add_area') }}

                    </button>
                    <br><br>

                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                               data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ trans('area_trans.name_en') }}</th>
                                <th>{{ trans('area_trans.name_ar') }}</th>
                                <th>{{ trans('area_trans.city') }}</th>
                                <th>{{ trans('area_trans.Processes') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; ?>
                            @foreach ($areaes as $area)
                                <tr>
                                    <?php $i++; ?>
                                    <td>{{ $i }}</td>
                                    <td>{{ $area->name_en }}</td>
                                    <td>{{ $area->name_ar }}</td>
                                    <td>{{ $area->city->name }}</td>

                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#edit{{ $area->id }}"
                                                title="{{ trans('area_trans.Edit') }}"><i class="fa fa-edit"></i></button>

                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $area->id }}"
                                                title="{{ trans('area_trans.Delete') }}"><i

                                                class="fa fa-trash"></i></button>
                                    </td>
                                </tr>

                                <!-- edit_modal_Grade -->
                                                                <div class="modal fade" id="edit{{ $area->id }}" tabindex="-1" role="dialog"
                                                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                                                    id="exampleModalLabel">
                                                                                    {{ trans('area_trans.edit_area') }}
                                                                                    Edit pharmacy
                                                                                </h5>
                                                                                <button type="button" class="close" data-dismiss="modal"
                                                                                        aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <!-- add_form -->
                                                                                <form action="{{ route('areaes.update', [$area->id]) }}" method="post">
                                                                                    {{ method_field('patch') }}
                                                                                    @csrf
                                                                                    <div class="row">
                                                                                        <div class="col">
                                                                                            <label for="Name"
                                                                                                   class="mr-sm-2">{{ trans('area_trans.name_en') }}
                                                                                                :</label>
                                                                                            <input id="username" type="text" name="name_en"
                                                                                                   class="form-control"
                                                                                                   value="{{ $area->name_en }}"
                                                                                                   required>
                                                                                        </div>

                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label
                                                                                            for="exampleFormControlTextarea1">{{ trans('area_trans.name_ar') }}

                                                                                            :</label>
                                                                                        <input class="form-control" name="name_ar"
                                                                                                  id="exampleFormControlTextarea1"
                                                                                                  rows="3" value="{{ $area->name_ar }}">
                                                                                    </div>


                                                                                    <div class="row">
                                                                                        <div class="col">
                                                                                            <label for="Name" class="mr-sm-2">{{ trans('area_trans.city') }}:</label>
                                                                                            <select id="Name" type="text" name="city_id" class="form-control">
                                                                                                @foreach($cities as $city)
                                                                                                    <option hidden>choose city</option>
                                                                                                    <option value="{{$city->id}}">{{ $city->name  }} </option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </div>

                                                                                    </div>

                                                                                    <br><br>

                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-secondary"
                                                                                                data-dismiss="modal">{{ trans('area_trans.close') }}</button>
                                                                                        <button type="submit"
                                                                                                class="btn btn-success">{{ trans('area_trans.submit') }}</button>
                                                                                    </div>
                                                                                </form>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                <!-- delete_modal_Grade -->

                                {{--                                delete-modle--}}
                                <div class="modal fade" id="delete{{ $area->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    {{ trans('area_trans.delete_area') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('areaes.destroy', [$area->id])}}"
                                                      method="post">
                                                    {{ method_field('Delete') }}
                                                    @csrf
                                                    {{ trans('area_trans.warning_area') }}
{{--                                                    <input id="id" type="hidden" name="id" class="form-control"--}}
{{--                                                           value="{{ $area->id }}">--}}
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ trans('area_trans.close') }}</button>
                                                        <button type="submit"
                                                                class="btn btn-danger">{{ trans('area_trans.submit') }}</button>
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
                            {{ trans('area_trans.add_area') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- add_form -->
                        <form action="{{ route('areaes.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <label for="Name" class="mr-sm-2">{{ trans('area_trans.name_en') }}:</label>
                                    <input id="Name" type="text" name="name_en" class="form-control">
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">{{ trans('area_trans.name_ar') }}:</label>
                                <input class="form-control" type="text" name="name_ar" id="exampleFormControlTextarea1"
                                       rows="3">
                            </div>


                            <div class="row">
                                <div class="col">
                                    <label for="Name" class="mr-sm-2">{{ trans('area_trans.city') }}:</label>
                                    <select id="Name" type="text" name="city_id" class="form-control">
                                        @foreach($cities as $city)
                                            <option hidden>choose city</option>
                                            <option value="{{$city->id}}">{{ $city->name  }} </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            <br><br>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">{{ trans('area_trans.close') }}</button>
                                <button type="submit"
                                        class="btn btn-success">{{ trans('area_trans.submit') }}</button>
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
