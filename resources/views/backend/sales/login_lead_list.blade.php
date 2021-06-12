@include('backend.sales.layout.header')
 <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Lead <small>List</small></h3>
              </div>

              <div class="title_right" >

                @if (Auth::user()->role=="Sales")
	             <a href="{{ url('add_lead_sales')}}"><button class="btn btn-primary" data-toggle="tooltip" title="Lead Ganerate" style="float: right;"><i class="fa fa-plus-circle"></i></button></a>
                 @endif
              </div>
             </div>

            <div class="clearfix"></div>

            <div class="row">

                    @if ($message = Session::get('error'))
                     <div class="alert alert-danger alert-block" id="flassMessage">
                      <!-- <button type="button" class="close">×</button>  -->
                      <strong>{{ $message }}</strong>
                      </div>
                     @endif

                      @if ($message = Session::get('success'))
                     <div class="alert alert-success alert-block" id="flassMessage">
                      <!-- <button type="button" class="close">×</button>  -->
                      <strong>{{ $message }}</strong>
                      </div>
                     @endif

              <div class="col-md-12 col-sm-12 ">


                <div class="x_panel">
                  <div class="x_title">
                    <h2>Leads List</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                           <!--  <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a> -->
                          </div>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="card-box table-responsive">

                    <table id="example" class="table table-striped table-bordered bulk_action" style="width:100%">
                      <thead>
                        <tr>
                          <th>Lead Id</th>
                            <th style="display: none">File Doable</th>
                            <th style="display: none">File Login</th>
                            <th style="display: none">Type</th>
                          <th>Name</th>
                          <th>Mobile</th>
                          <th>City</th>
                          <th>Loan Type</th>
                          <th>Required Amount</th>
                          <th>Disbursed Amount</th>
                          <th>File Status</th>
                          <th>Actions</th>
                        </tr>
                      </thead>


                      <tbody>
                       @if(!empty($leads))
                       @php $p=1; @endphp
                        @foreach($leads as $key =>  $led)
                        <tr>
                        <td>{{ ($led->lead_id)?$led->lead_id:'--' }}</td>
                            <td style="display: none">{{ ($led->file_doable)?$led->file_doable:'--' }}</td>
                            <td style="display: none">{{ ($led->file_login)?$led->file_login:'--' }}</td>
                            <td style="display: none">{{ ($led->type)?$led->type:'--' }}</td>
                          <td>{{ ($led->full_name)?$led->full_name:'--' }}</td>
                          <td>{{ ($led->mobile_number)?$led->mobile_number:''}}</td>
                          <td>{{ ($led->city)?$led->city:'--' }}</td>
                          <td>{{ ($led->type)?$led->type:'--' }}</td>
                          <td>{{ ($led->req_loan_amt)?$led->req_loan_amt:'--' }}</td>
                          <td>{{ ($led->disbursed_amount)?$led->disbursed_amount:'--' }}</td>
                          <td>{{ ($led->file_status)?$led->file_status:'--' }}</td>

                          <td>  <a  href="{{ url('login_edit/'.$led->id) }}"><button class="btn btn-info"  title="Edit Lead" data-toggle="tooltip" ><i class="fa fa-pencil"></i></button></a>
                          {{-- <a onClick="return confirm('Are you sure you want to delete this record ?')" href="{{ url('/delete_lead_sales/'.$led->id) }}"><button class="btn btn-danger" title="Delete Lead" data-toggle="tooltip"><i class="fa fa-trash"></i></button></a> --}}

                           {{-- <a href="{{ url('/view_users/'.$led->id) }}"><button class="btn btn-warning" title="View Lead" data-toggle="tooltip"><i class="fa fa-eye"></i></button></a> --}}
                          </td>

                      </tr>
                      @php $p++; @endphp
                      @endforeach
                      @endif
                      </tbody>
                    </table>
                  </div>
                  </div>
              </div>
            </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
@include('backend.sales.layout.footer')

<script type="text/javascript">
setTimeout(function() {
    $('#flassMessage').fadeOut("slow");
}, 3000); //

$(document).ready(function() {
    $('#example').DataTable( {
        "ordering": true,
        "order": [[ 3, "desc" ]],
        "info":false,
        "dom": "<'row'<'col-sm-4'l><'col-sm-4 customDropDown'><'col-sm-4'f>>" +
            "<'row'<'col-sm-12't>>" +
            "<'row'<'col-sm-6'i><'col-sm-6'p>>",
        initComplete: function () {
            this.api().columns([1]).every( function () {
                var column = this;
                var select = $('<select class="form-control col-sm-6"><option value="">File Doable</option></select>')
                    .appendTo( '.customDropDown' )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );

                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
            this.api().columns([2]).every( function () {
                var column = this;
                var select = $('<select class="form-control col-sm-6"><option value="">File Login</option></select>')
                    .appendTo( '.customDropDown' )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );

                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
            this.api().columns([3]).every( function () {
                var column = this;
                var select = $('<select class="form-control col-sm-6"><option value="">Type</option></select>')
                    .appendTo( '.customDropDown' )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );

                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
            this.api().columns([10]).every( function () {
                var column = this;
                var select = $('<select class="form-control col-sm-6"><option value="">File Status</option></select>')
                    .appendTo( '.customDropDown' )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );

                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    } );
} );

</script>
