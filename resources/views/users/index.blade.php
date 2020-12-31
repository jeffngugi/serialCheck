@extends('layouts.app')

@section('content')

<div class="card">
              <div class="card-header">
                <h3 class="card-title">Users</h3>
               
               
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Full Names</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th class="text-center">Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($users as $data)
                  <tr>
                    <td>{{$data->id}}</td>
                    <td>{{$data->name}}</td>
                    <td>{{$data->email}}</td>
                    <td>{{$data->phone}}</td>
                    <td>
                      @if($data->role->name)
                    {{ $data->role->name }}
                    @else
                    No role
                    @endif
                  </td>
                    <td class="project-actions text-center">
                    <form action="{{ route('users.destroy', $data->id) }}" method="post">
                          <a class="btn btn-info btn-sm" href="{!! route('users.edit', [$data->id]) !!}">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Edit
                          </a>
                          <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('User will be deleted?')">
                          <i class="fas fa-trash"></i>Delete
                          </button>
                          @csrf
                          @method('DELETE')
                          </form>
                          
                          
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>

  

@endsection



