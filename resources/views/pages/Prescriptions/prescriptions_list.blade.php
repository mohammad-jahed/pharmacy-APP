@extends('layouts.master')
@section('css')
    @toastr_css
@endsection

@section('title')
    {{ trans('prescription_trans.title') }}
@endsection

@section('page-header')
    <!-- breadcrumb -->
@endsection
@section('PageTitle')
    {{ trans('prescription_trans.title') }}

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

                <br><br>


    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                           data-page-length="50" style="text-align: center">

                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ trans('prescription_trans.user_id') }}</th>
                            <th>{{ trans('prescription_trans.Prescription') }}</th>
                            <th>{{ trans('prescription_trans.date') }}</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 0; ?>
                        @foreach ($prescriptions as $prescription)
                            <tr>
                                <?php $i++; ?>
                                <td>{{ $i }}</td>
                                <td>{{ $prescription->user_id }}</td>
                                <td> <img src="{{asset('storage/images/'.$prescription->imagePath)}}"alt=""> </td>
                                <td>{{ $prescription->created_at}}</td>

                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#edit{{ $prescription->id }}"
                                                title="{{ trans('prescription_trans.Processes') }}"><i class="fa fa-edit"></i></button>
                                    </td>

                            </tr>


                            <!-- edit_modal_Grade -->
                            <div class="modal fade" id="edit{{ $prescription->id }}" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('prescription_trans.Processes') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- add_form -->
                                            <form action="{{ route('prescriptionResponse')}}" method="post">
                                                @csrf
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="Name"
                                                               class="mr-sm-2">{{ trans('prescription_trans.firstName') }}
                                                            :</label>
                                                        <?php $i = 0; ?>
                                                        <select id="state" type="text" name="medicines[]" class="form-control">
                                                        @foreach($medicines as $medicine)
                                                            <?php $i++; ?>
                                                                <option value="{{$medicine->name}}">{{ $medicine->name  }} </option>
                                                            @endforeach
                                                        </select>

                                                    </div>

                                                </div>
                                                <div class="form-group">
                                                    <label
                                                        for="exampleFormControlTextarea1">{{ trans('prescription_trans.secondName') }}

                                                        :</label>
                                                    <?php $i = 0; ?>
                                                    <select id="state" type="text" name="medicines[]" class="form-control">
                                                    @foreach($medicines as $medicine)
                                                        <?php $i++; ?>
                                                            <option value="none" selected disabled hidden>{{ trans('prescription_trans.selectmedicine') }}</option>
                                                            <option value="{{$medicine->name}}">{{ $medicine->name  }} </option>

                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label
                                                        for="exampleFormControlTextarea1">{{ trans('prescription_trans.thirdName') }}

                                                        :</label>
                                                    <?php $i = 0; ?>
                                                    <select  id="state" type="text" name="medicines[]" class="form-control">
                                                    @foreach($medicines as $medicine)
                                                        <?php $i++; ?>
                                                            <option value="none" selected disabled hidden>{{ trans('prescription_trans.selectmedicine') }}</option>
                                                            <option  value="{{$medicine->name}}" >{{ $medicine->name  }} </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label
                                                        for="exampleFormControlTextarea1">{{ trans('prescription_trans.fourthName') }}

                                                        :</label>
                                                    <?php $i = 0; ?>
                                                    <select  id="state" type="text" name="medicines[]" class="form-control">
                                                        @foreach($medicines as $medicine)
                                                            <?php $i++; ?>
                                                            <option value="none" selected disabled hidden>{{ trans('prescription_trans.selectmedicine') }}</option>
                                                            <option  value="{{$medicine->name}}" >{{ $medicine->name  }} </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label
                                                        for="exampleFormControlTextarea1">{{ trans('prescription_trans.FifthName') }}

                                                        :</label>
                                                    <?php $i = 0; ?>
                                                    <select  id="state" type="text" name="medicines[]" class="form-control">
                                                        @foreach($medicines as $medicine)
                                                            <?php $i++; ?>
                                                            <option value="none" selected disabled hidden>{{ trans('prescription_trans.selectmedicine') }}</option>
                                                            <option  value="{{$medicine->name}}" >{{ $medicine->name  }} </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label
                                                        for="exampleFormControlTextarea1">{{ trans('prescription_trans.sixthName') }}

                                                        :</label>
                                                    <?php $i = 0; ?>
                                                    <select  id="state" type="text" name="medicines[]" class="form-control">
                                                        @foreach($medicines as $medicine)
                                                            <?php $i++; ?>
                                                            <option value="none" selected disabled hidden>{{ trans('prescription_trans.selectmedicine') }}</option>
                                                            <option  value="{{$medicine->name}}" >{{ $medicine->name  }} </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <input id="id" type="hidden" name="area_id" class="form-control"
                                                       {{$user=\App\Models\User::find($prescription->user_id)}}
                                                       value="{{ $user->address->area_id}}">

                                                <input id="id" type="hidden" name="user_id" class="form-control"
                                                       value="{{ $prescription->user_id}}">

                                                <input id="id" type="hidden" name="prescription_id" class="form-control"
                                                       value="{{ $prescription->id}}">
                                                <br><br>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ trans('prescription_trans.close') }}</button>
                                                    <button type="submit"
                                                            class="btn btn-success">{{ trans('prescription_trans.submit') }}</button>
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
    <script src="{{\Illuminate\Support\Facades\URL::asset('js/app.js')}}"></script>


@endsection
