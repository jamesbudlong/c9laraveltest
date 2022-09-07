@extends('layouts.app')
@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">File Uploads Management</h3>
        <div class="card-tools">
            {{-- <span class="badge">
                <a class="btn btn-success btn-sm" href="{{ route('file_uploads.create') }}"> Create </a>
            </span> --}}
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

        @if (!$data->isEmpty())
            <table style="table-layout:fixed;" class="table table-bordered table-striped table-hover">
                <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Filename</th>
                <th class="col-3">Encoded File</th>
                <th>Action</th>
                </tr>

                @foreach ($data as $key => $file_upload)
                <tr>
                <td>{{ $file_upload->title }}</td>
                <td>{{ $file_upload->description }}</td>
                <td>{{ $file_upload->file_name }}</td>
                <td>
                        <div style="white-space: nowrap; width: auto; overflow: hidden; text-overflow: ellipsis;">
                            {{ $file_upload->encoded_file}}
                        </div>
                </td>
                <td>
                    <form action="{{ route('file_uploads.destroy',$file_upload->id) }}" method="POST" >
                        {{-- <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a> --}}
                        <a class="btn btn-primary btn-sm" href="{{ route('file_uploads.edit',$file_upload->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this file?')">Delete</button>
                    </form>
                </td>
                </tr>
                @endforeach
            </table>
        @else
            No data to display.
        @endif
        {{-- {!! $data->render() !!} --}}
        <br/>
        {!! $data->withQueryString()->links('pagination::bootstrap-5') !!}
    </div>
</div>



@endsection
