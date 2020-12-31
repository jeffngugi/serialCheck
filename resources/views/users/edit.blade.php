@extends('layouts.app')

@section('content')
<section class="content">
      <div class="container-fluid">
        <div class="row">
 <!-- left column -->
 <div class="col-md-8">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit User </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" action="{{ route('users.update',$user->id) }}">
              @csrf
              @method('PUT')
                    @php
                    $name = $user->name;
                    $names = explode(" ", $name)
                    @endphp
                <div class="card-body">
                <div class="row">

                  <div class="col-6">
                  <div class="form-group">
                    <label for="inputFirstname">First Name</label>
                    <input type="text" class="form-control" id="inputFirstname" value="{{$names[0]}}" name="first_name">
                  </div>
                  </div>
                  

                  <div class="col-6">
                  <div class="form-group">
                                      <label for="inputLastname">Last Name</label>
                                      <input type="text" class="form-control" id="inputLastname" value="{{$names[1]}}" name="last_name">
                                    </div>
                  </div>
                </div>

                  <div class="form-group">
                    <label for="inputEmail">Email</label>
                    <input type="text" class="form-control" id="inputEmail" value="{{$user->email}}" name="username">
                  </div>

                  <div class="form-group">
                  <label for="phone">Phone</label>
                    <input type="tel" class="form-control" id="inputPhone" value="{{$user->phone}}" name="phone">
                  </div>
                  <div class="form-group">
                        <label>Role</label>
                        <select class="form-control" name="role_id">
                          <option value='{{$user->role->id}}'>{{$user->role->name}}</option>
                          @foreach($roles as $role)
                          <option value='{{$role->id}}'>{{$role->name}}</option>
                          @endforeach
                        </select>
                      </div>
                  

                 
                  
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->


          </div>
          <!--/.col (left) -->
</div>
</div>
</section>
@endsection