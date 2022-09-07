@extends('layouts.app')
@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">File Uploads - Edit</h3>
        <div class="card-tools">
            <span class="badge">
                <a class="btn btn-dark btn-sm" href="{{ route('file_uploads.index') }}"> Back </a>
            </span>
        </div>
    </div>

    <div class="card-body">
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

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

        {{-- body here --}}
        {!! Form::model($file_upload, ['method' => 'PATCH','route' => ['file_uploads.update', $file_upload->id], 'files'=>'true']) !!}
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Title:</strong>
                    {!! Form::text('title', null, array('placeholder' => 'Title','class' => 'form-control', 'required')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Description:</strong>
                    {!! Form::text('description', null, array('placeholder' => 'Description','class' => 'form-control', 'required')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>File Base64 Encoded:</strong><br/>
                    <textarea style="resize:none;" class="col-md-12" rows="7" disabled>{{$file_upload->encoded_file}}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Filename:</strong><br/>
                    <h5> {{$file_upload->file_name}} </h5>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Replace File:</strong><br/>
                    {!! Form::file('uploaded_file', null, array('placeholder' => 'Upload files here','class' => 'form-control')) !!}
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
