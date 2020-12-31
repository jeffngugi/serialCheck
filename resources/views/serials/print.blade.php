@extends('layouts.app')

@section('content')

<section class="content">
      <div class="container-fluid">
        <div class="row">
 <!-- left column -->
 <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Print Codes</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <div class="card-body">
                <form role="form" method='post' action=""> 
                @csrf
                  <div class="row">
                    <div class="col-sm-3">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Package</label>
                        <select  class="form-control" name='package'>
                          <option value=''>Select Package</option>
                          <option value='2'>2 Kg</option>
                          <option value='50'>50 kg</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Lot Number</label>
                        <input type="text" class="form-control" placeholder="Enter" name='lot_no'>
                      </div>
                    </div>

                    <div class="col-sm-2">
                      <div class="form-group">
                        <label>Number to print</label>
                        <input type="text" class="form-control" placeholder="Enter" name='count'>
                      </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="form-group">
                        <label>Manufacture date</label>
                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" name='manufacture_date'/>
                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                        <label>Expiry date</label>
                            <div class="input-group date" id="expirydate" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" data-target="#expirydate" name='expiry_date'/>
                                <div class="input-group-append" data-target="#expirydate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                  </div>
                  <div class="card-footer">
                  <button type="submit" class="btn btn-primary mr-5 ">Submit</button>
                </div>
                  <!-- input states -->
                </form>
              </div>
            </div>
            <!-- /.card -->


          </div>
          <!--/.col (left) -->
</div>

</div>
<div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Print Codes</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Lot Number</th>
                      <th>Package</th>
                      <th>Total codes</th>
                      <th>Manufacture Date</th>
                      <th>Exipiry Date</th>
                      <th> Downloaded By</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach($lots as $data)
                    <tr>
                      <td>{{$data->id}}</td>
                      <td>{{$data->lot_no}}</td>
                     <td>{{$data->package}} kg </td>
                      <td>{{$data->count}}</td>
                      <td>{{date('d/m/Y', strtotime($data->manufacture_date))}}</td>
                      <td>{{date('d/m/Y', strtotime($data->expiry_date))}}</td>
                      @if($data->status)
                      <td>{{$data->user->name}}</td>
                      @else
                      <td>Not downloaded</td>
                      @endif

                      <td>
                      <form action="{{route('download')}}" method="post">
                      @csrf
                      <input type="hidden" value="{{$data->id}}" name="lot_id">
                        @if($data->status)
                        Downloaded
                        @else
                        <button type="submit" class="btn btn-primary mr-5 "><i class="fas fa-download">
                              </i>
                              Download
                          </button>
                        @endif
                          
                      </form>
                          
                          
                          </td>
                    </tr>
                    @endforeach
                   
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        
</section>

@endsection
@section('script')
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });
    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'DD/MM/YYYY'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })
    
    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

  })
</script>
@endsection