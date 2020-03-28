<!DOCTYPE html>
<html>
<head>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">

  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
  <style type="text/css">
      body{
        font-size: 10px;
      }
      .table th, .table td {
    padding: 5px;
    vertical-align: top;
    border-top: 1px solid #dee2e6;
}
  </style>
</head>
<body>

<div class="container">
  <div class="col-md-12 col-lg-12 col-sm-12">
    <br><br><br><br>
  <center><h2>Birthday Mail Sending Application</h2></center>
  <hr>
  <p></p>                                                                                      
  <div class="table-responsive">          
  <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Sl</th>
                <th>Employee Name</th>
                <th>Email</th>
                <th>Emp-Code</th>
                <th>Mobile No</th>
                <th>Birth Day</th>
                <th>Status</th>
                <th>Mail Sent Timestamp</th>
            </tr>
        </thead>
        <tbody><?php $sl=0; ?>
            @foreach($emps as $emp)
            <tr>
                <td><?php echo $sl=$sl+1; ?></td>
                <td>{{$emp->emp_name}}</td>
                <td>{{$emp->emp_email}}</td>
                <td>{{$emp->emp_code}}</td>
                <td>{{$emp->emp_mobile}}</td>
                <td>{{$emp->birthday}}</td>
                <td>
                    @if($emp->status ==0)
                        {{'Queued'}}
                    @elseif($emp->status ==1)
                        {{'Mail Sent'}}
                    @elseif($emp->status ==2)
                        {{'Reject'}}
                    @endif
                </td>
                <td>{{$emp->mail_sent_at}}</td>
                
            </tr>
            @endforeach
            
        </tbody>
        <tfoot>
            <tr>
                <th>Sl</th>
                <th>Employee Name</th>
                <th>Email</th>
                <th>Emp-Code</th>
                <th>Mobile No</th>
                <th>Birth day</th>
                <th>Status</th>
                <th>Mail Sent Timestamp</th>
            </tr>
        </tfoot>
    </table>
  </div>
  <br>
  <div class="pull-right">
  <form action="{{url('postpdf')}}" method="post">
    {!! csrf_field() !!}
    <div class="row">
      <div class="col-sm-10 col-lg-10 col-md-10">&nbsp;</div>
      <div class="col-sm-2 col-lg-2 col-md-2">
      <button type="submit" class="form-control btn btn-sm btn-success pull-right" >Sent Mail</button>
      </div>
    </div>
  </form>
  </div>
  </div>
  
</div>

</body>
<script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable();
} );
</script>
</html>
