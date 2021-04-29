<!DOCTYPE html>
<html>
 <head>
  <title>Date Range Fiter Data in Laravel using Ajax</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
 </head>
 <body>
  <br />
  <nav class="navbar navbar-light bg-light text-center">
      <div>
      <button type="button" name="filter" id="filter" class="btn btn-default btn-lg larger align-self-center" style="width:75%"><strong>+</strong> ADD FILTER</button>
       {{-- <button type="button" name="filter" id="filter" class="btn btn-info btn-sm">Filter</button> --}}
      </div>
      <div class="container">
      <div class="row">
        <div class="col col-lg-2">
          <p>Search For :</p>
        </div>
      <div class="col col-lg-2" style="margin-right:15px">
        <select class="form-control-md" id="atribute" >
            <option selected disabled>Select An Atribute</option>
          <option value="listing_id">Listing</option>
          <option value="abbreviation">Abbreviation</option>
          <option value="payment_period">Payment Period</option>
          <option value="item">Items</option>
          <option value="currency">Currency</option>
          <option value="name">Expense</option>
          <option value="created_at">Created At</option>
        </select>
      </div>
      <div class="col col-lg-2">
        <select class="form-control-md" id="operator">
          <option selected disabled>Select An Operator</option>
          <option value="=">is</option>
          <option value="!=">is not</option>

        </select>
      </div>
      <div class="col col-lg-2">
        <input type="text" id="date" name="date" style="display: none">
        <select class="form-control-md" name="currency" id="currency" style="display: none">
          <option selected disabled>Select An option</option>
          <option value="LPB">LPB</option>
          <option value="usd">usd</option>
          <option value="EUR">EUR</option>
          <option value="AUD">AUD</option>

        </select>
      </div>
      </div>
    </div>
     </nav>
    <div class="panel-body">
     <div class="table-responsive">
      <table class="table table-striped table-bordered">
       <thead>
        <tr>
         <th width="10%">listing_id</th>
         <th width="5%">abreviation</th>
         <th width="10%">name</th>
         <th width="10%">currency</th>
         <th width="20%">date</th>
         <th width="20%">item</th>
         <th width="35%">payment period</th>
         
        </tr>
       </thead>
       <tbody>
       
       </tbody>
      </table>
      {{ csrf_field() }}
     </div>
    </div>
   </div>
  </div>

</body>
</html>

<script>

  $('#atribute').on('change',function () {
    var atribute = $(this).val();

    if(atribute == "payment_period" || atribute == "created_at"){

      var greater_than ='>'
      if(($('#operator option[value=">"]').length == 0)) {
        $("#operator").append('<option value=">">greater than</option>');}
    }else{
    $("#operator option[value='>']").remove();}

  });
  </script>
  <script>
 $('#operator').on('change',function () {
  
    var atribute = $('#atribute').val();
    var selected_option = $(this).find("option:selected").length > 0;
    
    if((atribute == "created_at" || atribute == "payment_period") && selected_option){

      $('#currency').css('display','none');
      $('#date').css('display','block');
    }
    else if((atribute == "currency" || atribute == "abbreviation") && selected_option){
      $('#date').css('display','none');
    $('#currency').css('display','block');
    }
    else{
      $('#date').css('display','none');
    $('#currency').css('display','none');
    }
    });
    </script>

<script>
$(document).ready(function(){
//datepicker format

 $('#date').datepicker({
  todayBtn: 'linked',
  dateFormat: 'm/d/yy',
  autoclose: true
 });

 var _token = $('input[name="_token"]').val();

 fetch_data();
//fetch data display in table
 function fetch_data()
 {
  var operator = $('#operator option:selected').val();
  var atribute = $('#atribute option:selected').val();
  var datepicker = $('#date').val();
  var currency = $('#currency option:selected').val();

  $.ajax({
   url:"{{ route('daterange.fetch_data') }}",
   method:"POST",
   data:{atribute:atribute, operator:operator,datepicker:datepicker,currency:currency, _token:_token},
   dataType:"json",
   success:function(data)
   {

    var output = '';
    $('#total_records').text(data.length);
    for(var count = 0; count < data.length; count++)
    {
     output += '<tr>';
     output += '<td>' + data[count].listing_id + '</td>';
     output += '<td>' + data[count].abbreviation + '</td>';
     output += '<td>' + data[count].name + '</td>';
     output += '<td>' + data[count].currency + '</td>';
     output += '<td>' + data[count].created_at + '</td>';
     output += '<td>' + data[count].item + '</td>';
     output += '<td>' + data[count].payment_period + '</td></tr>';
    }
    $('tbody').html(output);
   }
  })
 }
//alert if fields are empty
 $('#filter').click(function(){
  var atr = $('#atribute').val();
  var ope = $('#operator').val();

  if(atr != null &&  ope != null)
  {
   fetch_data();
  }
  else
  {
   alert('Both fields are required');
  }
 });




});
</script>

<script>
//   $('.filter').click(function(){
//   var your_selected_value = $('#operator option:selected').val();

// $.ajax({
//   type: "POST",
//   url: "/list/fetch_data",
//   data: {selected: your_selected_value},
//   success: function(data) {
//     alert('sjdgu');
//   },
//   error: function(data) {
//     console.log(data);
//   }
// });});
  </script>