@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Users</div>
                
                <div class="panel-body">
                    <div class="text-center"><a href="{{ route('admin/add-user') }}" class="btn btn-primary">Add New</a></div>
                    <table class="table">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                           @foreach ($users as $user)
                          <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td><a href="{{ route('admin/edit-user',['id'=>$user->id]) }}"><i class="fa fa-edit"></i></a>&nbsp;<a href="javascript:void(0)" onclick="confirmDelete('{{ route('admin/delete-user',['id'=>$user->id]) }}','Are you sure, you want to delete?')"><i class="fa fa-trash"></i></a></td>
                          </tr>
                           @endforeach
                        </tbody>
                      </table>
                    <div class="text-center">{{ $users->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

      @section('script')

<script>


  @endsection