@extends('layouts.app')

@section('content')

<div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Full Names</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th class="text-center">Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($users as $data)
                  <tr>
                    <td>{{$data->id}}</td>
                    <td>{{$data->name}}</td>
                    <td>{{$data->username}}</td>
                    <td>{{$data->email}}</td>
                    <td>
                      @if($data->role->name)
                    {{ $data->role->name }}
                    @else
                    No role
                    @endif
                  </td>
                    <td class="project-actions text-center">
                    <a class="btn btn-primary btn-sm" href="{{ route('users.show', [$data->id]) }}">
                              <i class="fas fa-folder">
                              </i>
                              View
                          </a>
                          <a class="btn btn-info btn-sm" href="#">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Edit
                          </a>
                          <a class="btn btn-danger btn-sm" href="#">
                              <i class="fas fa-trash">
                              </i>
                              Delete
                          </a>
                          
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>

@endsection
