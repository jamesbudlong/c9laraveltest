@extends('layouts.app')
@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">User Roles Management - Create</h3>
        <div class="card-tools">
            <span class="badge">
                <a class="btn btn-dark btn-sm" href="{{ route('roles.index') }}"> Back </a>
            </span>
        </div>
    </div>

    <div class="card-body">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong>Something went wrong.<br><br>
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
        @endif

        {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control', 'required')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Permissions:</strong>
                    <br/><br/>
                    @foreach($permission->split($permission->count()/2) as $row)
                    <div class="row">
                        @foreach($row as $service)
                        <div class="col-md-3">
                            <label>{{ Form::checkbox('permission[]', $service->id, false, array('class' => 'name')) }}
                            {{ $service->name }}</label>
                        </div>
                        @endforeach
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>

@endsection
