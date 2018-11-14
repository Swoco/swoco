<?php
error_reporting(E_ALL);
include('inc/dbase.php');

mysqli_query($con, "SET SQL_BIG_SELECTS=1");


if(isset($_GET['action']) && $_GET['action'] !='' && ($_GET['action'] == 'user_purchasehistory'))
{
     $arr_user_field_name = array('Order Id','Coin Qty','Unit Price (in $)','Purchase Amount ($)','Phase Mode','Status','Add Date','Payment Date');
     $uiddd = mysqli_real_escape_string($con, trim($_GET['uiddd']));
     $sql = "SELECT `ord_id`,`qnty`,`unit_price`,`total_price`,`phase_mode`,`status`,`added_date`,`pay_datetime`,remarks FROM milkway_userpay_list WHERE 1=1";

      if(isset($_GET['order_id']) && $_GET['order_id'] != '')
    {
        $order_id = mysqli_real_escape_string($con, trim($_GET['order_id']));
        $sql .= " AND `ord_id` = '".$order_id."'";
    }

     if(isset($_GET['phase_mode']) && $_GET['phase_mode'] != '')
    {
        $phase_mode = mysqli_real_escape_string($con, trim($_GET['phase_mode']));
        $sql .= " AND `phase_mode` = '".$phase_mode."'";
    }
     if(isset($_GET['remarks']) && $_GET['remarks'] != '')
    {
        $remark = mysqli_real_escape_string($con, trim($_GET['remarks']));
        $sql .= " AND `remarks` = '".$remark."'";
    }
    if(isset($_GET['status']) && $_GET['status'] != '')
    {
        $status = mysqli_real_escape_string($con, trim($_GET['status']));
         $sql .= " AND `status` = '".$status."'";
    }

}



 $rec = mysqli_query($con, $sql) or die (mysqli_error($con));
 $num_fields = mysqli_num_fields($rec);


 for($i = 0; $i < count($arr_user_field_name); $i++ )
    {
        $header .= $arr_user_field_name[$i]."\t";
    }
   
    while($row = mysqli_fetch_row($rec))
    {
        $line = '';
        foreach($row as $value)
        {                                           
            if((!isset($value)) || ($value == ""))
            {
                $value = "\t";
            }
            else
            {
                $value = str_replace( '"' , '""' , $value );
                $value = '"' . $value . '"' . "\t";
            }
            $line .= $value;
        }
        $data .= trim( $line ) . "\n";
    }
   
    $data = str_replace("\r" , "" , $data);
   
    if ($data == "")
    {
        $data = "\\n No Record Found!\n";                       
    }

    $rand_fn = rand();
   
    header("Content-type: application/octet-stream");
    header("Content-Disposition: attachment; filename=$rand_fn.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
    print "$header\n$data";
?>