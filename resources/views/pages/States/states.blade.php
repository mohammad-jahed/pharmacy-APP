@extends('layouts.master')
@section('css')

    @toastr_css
@endsection
@section('title')
    {{ trans('state_trans.title_page') }}

@endsection

<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('state_trans.title_page') }}

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
                        {{ trans('state_trans.add_state') }}

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
                                <th>{{ trans('state_trans.Processes') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; ?>
                            @foreach ($states as $state)
                                <tr>
                                    <?php $i++; ?>
                                    <td>{{ $i }}</td>
                                    <td>{{ $state->name_en }}</td>
                                    <td>{{ $state->name_ar }}</td>

                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#edit{{ $state->id }}"
                                                title="{{ trans('state_trans.Edit') }}"><i class="fa fa-edit"></i></button>

                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $state->id }}"
                                                title="{{ trans('state_trans.Delete') }}"><i

                                                class="fa fa-trash"></i></button>
                                    </td>
                                </tr>

                                <!-- edit_modal_Grade -->
                                                                <div class="modal fade" id="edit{{ $state->id }}" tabindex="-1" role="dialog"
                                                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                                                    id="exampleModalLabel">
                                                                                    {{ trans('state_trans.edit_state') }}
                                                                                    Edit pharmacy
                                                                                </h5>
                                                                                <button type="button" class="close" data-dismiss="modal"
                                                                                        aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <!-- add_form -->
                                                                                <form action="{{ route('states.update', [$state->id]) }}" method="post">
                                                                                    {{ method_field('patch') }}
                                                                                    @csrf
                                                                                    <div class="row">
                                                                                        <div class="col">
                                                                                            <label for="Name"
                                                                                                   class="mr-sm-2">{{ trans('state_trans.name_en') }}
                                                                                                :</label>
                                                                                            <input id="username" type="text" name="name_en"
                                                                                                   class="form-control"
                                                                                                   value="{{ $state->name_en }}"
                                                                                                   required>
                                                                                        </div>

                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label
                                                                                            for="exampleFormControlTextarea1">{{ trans('state_trans.name_ar') }}

                                                                                            :</label>
                                                                                        <input class="form-control" name="name_ar"
                                                                                                  id="exampleFormControlTextarea1"
                                                                                                  rows="3" value="{{ $state->name_ar }}">
                                                                                    </div>
                                                                                    <br><br>

                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-secondary"
                                                                                                data-dismiss="modal">{{ trans('state_trans.close') }}</button>
                                                                                        <button type="submit"
                                                                                                class="btn btn-success">{{ trans('state_trans.submit') }}</button>
                                                                                    </div>
                                                                                </form>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                <!-- delete_modal_Grade -->

                                {{--                                delete-modle--}}
                                <div class="modal fade" id="delete{{ $state->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    {{ trans('state_trans.delete_state') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('states.destroy', [$state->id]) }}"
                                                      method="post">
                                                    {{ method_field('Delete') }}
                                                    @csrf
                                                    {{ trans('state_trans.warning_state') }}
                                                    <input id="id" type="hidden" name="id" class="form-control"
                                                           value="{{ $state->id }}">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ trans('state_trans.close') }}</button>
                                                        <button type="submit"
                                                                class="btn btn-danger">{{ trans('state_trans.submit') }}</button>
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
                            {{ trans('state_trans.add_state') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- add_form -->
                        <form action="{{ route('states.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <label for="Name" class="mr-sm-2">{{ trans('state_trans.name_en') }}:</label>
                                    <input id="Name" type="text" name="name_en" class="form-control">
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">{{ trans('state_trans.name_ar') }}:</label>
                                <input class="form-control" type="text" name="name_ar" id="exampleFormControlTextarea1"
                                       rows="3">
                            </div>

                            <br><br>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">{{ trans('state_trans.close') }}</button>
                                <button type="submit"
                                        class="btn btn-success">{{ trans('state_trans.submit') }}</button>
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
