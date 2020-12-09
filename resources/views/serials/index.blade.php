@extends('layouts.app')

@section('content')
    
<div mx-212>

@if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div>
  @endif
<h3>Total Serials : {{ $totalSerials }}</h3>
<form role="form" action="{{route('serials.store')}}" method="post">
@csrf
        <div class="card-body">
            
            <div class="form-group">
            <label for="serialCount">Total Serials to generate</label>
            <input type="number" class="form-control" placeholder="total" name="count" required>
            </div>  
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
</form>
</div>
@endsection