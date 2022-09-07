@extends('layouts.app')
@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">User Roles Management</h3>
        <div class="card-tools">
            <span class="badge">
                <a class="btn btn-success btn-sm" href="{{ route('roles.create') }}"> Create </a>
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

        <table class="table table-bordered">
            <tr>
              <th>Name</th>
              <th width="280px">Action</th>
            </tr>
            @foreach ($data as $key => $role)
             <tr>
               <td>{{ $role->name }}</td>
               <td>
                <form action="{{ route('roles.destroy',$role->id) }}" method="POST" >
                    {{-- <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Show</a> --}}
                    <a class="btn btn-primary btn-sm" href="{{ route('roles.edit',$role->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this role?')">Delete</button>
                 </form>
               </td>
             </tr>
            @endforeach
        </table>
        {{-- {!! $data->render() !!} --}}
        <br/>
        {!! $data->withQueryString()->links('pagination::bootstrap-5') !!}
    </div>
</div>



@endsection
