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
                <h3 class="card-title">Create User </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" action="{{route('users.store')}}">
              @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="inputName">Names</label>
                    <input type="text" class="form-control" id="inputName" placeholder="Enter User name" name="name">
                  </div>

                  <div class="form-group">
                    <label for="inputEmail">Email</label>
                    <input type="email" class="form-control" id="inputCode" placeholder="Enter email" name="email">
                  </div>
                  <div class="form-group">
                        <label>Role</label>
                        <select class="form-control" name="role_id">
                          <option value=''>select</option>
                          @foreach($roles as $role)
                          <option value='{{$role->id}}'>{{$role->name}}</option>
                          @endforeach
                        </select>
                      </div>
                  

                  <div class="form-group">
                    <label for="inputEmail">Password</label>
                    <input type="password" class="form-control" id="inputPassword"  name="password">
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