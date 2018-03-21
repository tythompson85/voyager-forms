@extends('voyager::master')

@section('page_title', __('voyager.generic.'.(isset($form->id) ? 'edit' : 'add')).' '.$dataType->display_name_singular)

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ __('voyager.generic.'.(isset($form->id) ? 'edit' : 'add')).' '.$dataType->display_name_singular }}
    </h1>
@stop

@section('content')
    <div class="page-content container-fluid">
        @include('voyager::alerts')
        <div class="row">

            @if (isset($form->id))
                <div class="col-md-3 col-lg-2">
                    <div class="panel panel-bordered panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Add Field</h3>
                            <div class="panel-actions">
                                <a class="panel-collapse-icon voyager-angle-down" data-toggle="block-collapse"
                                   aria-hidden="true"></a>
                            </div> <!-- /.panel-actions -->
                        </div> <!-- /.panel-heading -->

                        <div class="panel-body">
                            <form role="form" action="{{ route('voyager.forms.update', $form->id) }}" method="POST"
                                  enctype="multipart/form-data">
                                {{ csrf_field() }}

                                @if (isset($form->id))
                                    {{ method_field("PUT") }}
                                @endif

                                <div class="form-group">
                                    <label for="type">Field Type</label>
                                    <select class="form-control" name="input" id="input">
                                        <option value="">-- Select --</option>
                                        <option value="text">Text</option>
                                        <option value="number">Number</option>
                                        <option value="email">Email</option>
                                        <option value="text_area">Text Area</option>
                                        <option value="checkbox">Checkbox</option>
                                        <option value="select">Select</option>
                                        <option value="radio">Radio</option>
                                    </select>
                                </div> <!-- /.form-group -->

                                <input type="hidden" name="form_id" value="{{ $form->id }}"/>
                                <button type="submit"
                                        class="btn btn-success btn-sm">{{ __('voyager.generic.add') }}</button>
                            </form>
                        </div> <!-- /.panel-body -->
                        {{--<div class="panel panel-bordered panel-warning">--}}
                        {{--<div class="panel-heading">--}}
                        {{--<h3 class="panel-title">Page Layout</h3>--}}
                        {{--<div class="panel-actions">--}}
                        {{--<a class="panel-collapse-icon voyager-angle-down" data-toggle="block-collapse" aria-hidden="true"></a>--}}
                        {{--</div> <!-- /.panel-actions -->--}}
                        {{--</div> <!-- /.panel-heading -->--}}

                        {{--<div class="panel-body">--}}
                        {{--<form role="form" action="{{ route('voyager.forms.layout', $form->id) }}" method="POST"--}}
                        {{--enctype="multipart/form-data">--}}
                        {{--{{ csrf_field() }}--}}

                        {{--<div class="form-group">--}}
                        {{--<label for="layout">Change Form Layout</label>--}}
                        {{--<select class="form-control" name="layout" id="layout">--}}
                        {{--<option value="default">-- Select --</option>--}}
                        {{--@foreach($formLayouts as $layout)--}}
                        {{--<option--}}
                        {{--value="{{ $layout }}"--}}
                        {{--@if ($form->layout === $layout)--}}
                        {{--selected="selected"--}}
                        {{--@endif--}}
                        {{-->--}}
                        {{--{{ ucwords(str_replace(array('_', '-'), ' ', $layout)) }}--}}
                        {{--</option>--}}
                        {{--@endforeach--}}
                        {{--</select>--}}
                        {{--</div> <!-- /.form-group -->--}}

                        {{--<input type="hidden" name="page_id" value="{{ $form->id }}"/>--}}
                        {{--<button type="submit" class="btn btn-success btn-sm">{{ __('voyager.generic.update') }}</button>--}}
                        {{--</form>--}}
                        {{--</div> <!-- /.panel-body -->--}}
                        {{--</div> <!-- /.panel -->--}}
                    </div>
                </div>
            @endif

            <div class="col-md-9">
                <div class="panel panel-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form
                        role="form"
                        action="@if (isset($form->id))
                        {{ route('voyager.'.$dataType->slug.'.update', $form->id) }}
                        @else
                        {{ route('voyager.'.$dataType->slug.'.store') }}
                        @endif"
                        method="POST"
                        enctype="multipart/form-data">

                        {{ csrf_field() }}

                        @if (isset($form->id))
                            {{ method_field("PUT") }}
                        @endif
                        <label for="title">Title</label><br>
                        <input name="title" class="form-control" type="text"
                               @if (isset($form->title)) value="{{ $form->title }}" @endif required>

                        <label for="view">View</label><br>
                        <input name="view" class="form-control" type="text"
                               @if (isset($form->view)) value="{{ $form->view }}" @endif>

                        <label for="mailto">Mail To (Separate multiple with ',')</label><br>
                        <input name="mailto" class="form-control" type="text"
                               @if (isset($form->mailto)) value="{{ $form->mailto }}" @endif required>

                        <label for="hook">Event Hook (Fires after form is submitted)</label><br>
                        <input name="hook" class="form-control" type="text"
                               @if (isset($form->hook)) value="{{ $form->hook }}" @endif>

                        <div class="panel-footer">
                            <button type="submit" class="btn btn-primary">{{ __('voyager.generic.submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop