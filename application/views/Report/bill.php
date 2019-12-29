<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> Bill</title>
  <!-- Tell the browser to be responsive to screen width -->

 <style type="text/css" media="print">
    @page
    {
        size:  auto;   /* auto is the initial value */
        margin: 7mm;  /* this affects the margin in the printer settings */
    }
    </style>
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
</div>
<body id="pdf">
<div class="wrapper">
  <!-- Main content -->
  <div class="row">
    <p style="text-align:center; font-size:17px;"> <b>Bill</b>  </p>
  </div>
  <table id="example" class="table table-bordered mb-0 invoice-table" Width="100%">
    <style media="print">
    table{
      border-collapse: collapse;
    }
      .invoice-table td{
          padding-left: 10px;
          border: 2px solid #555!important;
      }
      .invoice-table .small{
        Width:15% !important;
          border: 2px solid #555!important;
      }
      .invoice-table .large{
        Width:85% !important;
          border: 2px solid #555!important;
      }
      .invoice-table{
        margin-bottom:0px;
        border: 2px solid #555!important;
      }
      .invoice-table p{
        line-height: 15px;
      }
      .invoice-table .no-right-border{
      border-right: 0px!important;
      }
      .invoice-table .no-left-border{
      border-left: 0px!important;
      }
      .invoice-table .no-top-border{
      border-top: 0px!important;
      }
      .invoice-table .no-bottom-border{
      border-bottom: 0px!important;
      }
      .center{
        text-align: center;
      }
      p{
        margin-top: 5px;
        margin-bottom: 5px;
      }

      hr{
        margin-left: -10px;
      }


    </style>
    <style media="screen">
    table{
      border-collapse: collapse;
    }
    hr{
      margin-left: -10px;
    }
    .center{
      text-align: center;
    }
      .invoice-table td{
        padding-left: 10px;
          border: 2px solid #555!important;
      }
      .invoice-table .small{
        Width:15% !important;
          border: 2px solid #555!important;
      }
      .invoice-table .large{
        Width:85% !important;
          border: 2px solid #555!important;
      }
      .invoice-table{
        margin-bottom:0px;
        border: 2px solid #555!important;
      }
      .invoice-table p{
        line-height: 15px;
      }
      .invoice-table .no-right-border{
      border-right: 0px!important;
      }
      .invoice-table .no-left-border{
      border-left: 0px!important;
      }
      .invoice-table .no-top-border{
      border-top: 0px!important;
      }
      .invoice-table .no-bottom-border{
      border-bottom: 0px!important;
      }


    </style>
    <tr>
      <td   colspan="8" >
        <div class="" style="text-align:center;">
          <h3 style="font-family: 'Arial Black', 'Arial Bold', Gadget, sans-serif; font-size:26px; margin-top: 0px; margin-bottom: 5px;font-weight:bold; text-transform:uppercase;" ><?php echo $company_name; ?></h3>
          <p style="margin-bottom:5px; line-height:20px;  margin-top: 5px;  font-family: Calibri, Candara, Segoe, 'Segoe UI'; font-size: 16px;" > <b><?php echo $company_address; ?></b> </p>
          <p  style="margin-bottom:5px; margin-top: 5px; font-family: Calibri, Candara, Segoe, 'Segoe UI'; font-size: 16px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Mobile No: <?php echo $company_mob1; ?> &nbsp; | &nbsp; Email : <?php echo $company_email; ?> </p>
                        <!-- <p  style="margin-bottom:5px; font-family: Calibri, Candara, Segoe, 'Segoe UI'; font-size: 16px;"> GST No: <?php echo $GetCmpInfo['gst_no']; ?> &nbsp; | &nbsp; Website : <?php echo $GetCmpInfo['website']; ?> </p> -->
    <!-- <p style="margin-bottom:5px; text-align: right; padding-top: 10px;font-family: Calibri, Candara, Segoe, 'Segoe UI';" > Mo.: <?php echo $GetCmpInfo['mobile_no_1']; ?>   &nbsp; | &nbsp; Mo.: <?php echo $GetCmpInfo['mobile_no_2']; ?>   </p> -->
        </div>
      </td>
    </tr>

    <tr>
      <td colspan="4"  >  <p> <b>To</b> </p>
          <p> <b>Customer Name : <?php echo $customer_name; ?></b> </p>
          <p> <b>Address : <?php echo $customer_address; ?></b> </p>
          <p> <b>Mobile No. : <?php echo $mobile; ?></b> </p>

        </td>
        <td colspan="4"  >  <p> <b>Delivery Line</b>  : <?php echo $delivery_line_name; ?></p>
          <hr>
            <p> <b>Bill No.</b>  : <?php echo $bill_no; ?></p>
            <hr>
            <p> <b>Bill Date.</b>  : <?php echo $bill_date; ?></p>
            <hr>
            <p> <b>Previous  Due</b>  : &#8377; <?php echo $out_amount; ?></p>
          </td>
    </tr>
    <tr>
      <td colspan="2" Width="10%" class=" no-right-border">  <p class="center"> Sr. No. </p>
      </td>
      <td colspan="2"  Width="40%" class=" no-right-border">  <p class="center"> Newspaper / Scheme Name </p>
      </td>
      <td colspan="2"  Width="25" class=" no-right-border">  <p class="center"> Quantity</p>
      </td>
      <td colspan="2"  Width="25" class=" no-right-border">  <p class="center"> Bill Amount </p>
      </td>
    </tr>
    <?php $i = 0;
    foreach ($paper_list as $p_list) {
    $i++;  ?>
    <tr>
      <td colspan="2"> <p class="center"><?php echo $i; ?></p> </td>
      <td colspan="2"> <p class="center"><?php echo $p_list->newspaper_info_name; ?></p></td>
      <td colspan="2"> <p class="center"><?php echo $p_list->newspaper_qty; ?></p></td>
      <td colspan="2"> <p class="center">&#8377; <?php echo $p_list->amount; ?></p></td>
    </tr>
    <?php } ?>
    <?php
    foreach ($scheme_list as $s_list) {
    $i++;  ?>
    <tr>
      <td colspan="2"> <p class="center"><?php echo $i; ?></p> </td>
      <td colspan="2"> <p class="center"><?php echo $s_list->scheme_info_name; ?></p></td>
      <td colspan="2"> <p class="center"><?php echo $s_list->qty; ?></p></td>
      <td colspan="2"> <p class="center">&#8377; <?php echo $s_list->amount; ?></p></td>
    </tr>
    <?php } ?>


    <tr>
      <td colspan="4" valign="top"> <p> <b>Bill Amount in Word </b> : Rupees <?php echo $this->numbertowords->convert_number($tot_net_amt); ?> Only</p> </td>
      <td colspan="4"> <p> <b> Gross Total</b> : &#8377; <?php echo $tot_gros_amt; ?> </p>
          <p> <b>Delivery Charges</b> : &#8377; <?php echo $tot_del_charges; ?> </p>
          <p> <b> Add / Less </b> : &#8377; <?php echo $tot_add_amt; ?> / &#8377; <?php echo $tot_less_amt; ?> </p>
          <p> <b> Net Total</b> : &#8377; <?php echo $tot_net_amt; ?> </p>
      </td>
    </tr>

    <tr>
      <td colspan="3"  class=" no-right-border">  <p class="center"> <br> Customer Signatory </p>
      </td>
      <td colspan="2"   class=" no-right-border">  <p class="center"><br> Seal </p>
      </td>
      <td colspan="3"   class=" no-right-border">  <p class="center"><br> Authorised Signatory</p>

    </tr>


  </table>



  <!-- /.content -->
</div>
<!-- ./wrapper -->
<!-- <script src="<?php echo base_url('files/bower_components/jquery/dist/jquery.min.js'); ?>"></script> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.0.10/jspdf.plugin.autotable.min.js"></script>

<!-- <script src="<?php echo base_url('files/dist/tableHTMLExport.js'); ?>"></script> -->

<script type="text/javascript">
  <?php if(isset($pdf)) { ?>


  var doc = new jsPDF();

  $('#cmd').click(function () {
      doc.fromHTML($('#content').html(), 15, 15, {
          'width': 170,
              'elementHandlers': specialElementHandlers
      });
      doc.save('sample-file.pdf');
  });


  <?php } else { ?>
   window.print();
 <?php } ?>

</script>
</body>
</html>
