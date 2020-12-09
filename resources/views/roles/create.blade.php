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
                <h3 class="card-title">Create Role </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" action="{{route('roles.store')}}">
              @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="inputName">Name</label>
                    <input type="text" class="form-control" id="inputName" placeholder="Enter Role Name" name="name">
                  </div>

                  <div class="form-group">
                    <label for="inputCode">RoleCode</label>
                    <input type="text" class="form-control" id="inputCode" placeholder="Enter Role Name" name="code">
                  </div>
                  
                  <div class="form-group">
                    <label for="inputDescription">Description</label>
                    <input type="text" class="form-control" id="inputDescription" placeholder="Describe Role" name="description">
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