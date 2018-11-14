<?php
ini_set('max_execution_time', 0);
error_reporting(0);
include('../inc/dbase.php');


function get_directuser($id) {
    $i = 0;
    $id_array = array();
    $select_tree = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$id."'");
while($row_tree = mysqli_fetch_array($select_tree)){
        $id_array[$i] = $row_treer['reference_id'];
        $i++;
    }
    return $id_array;
}
?>
<div class="panel-body">
    <ul>
        <?php
        $select_user = mysqli_query($con, "select * from milkyway_usersignup where reference_id='" . $_POST['user_id'] . "'");
        $display_user = mysqli_fetch_array($select_user);
        $select_downline_user = mysqli_query($con,"select * from milkyway_usersignup  where `link_reference_id` ='" . $display_user['reference_id'] . "'") or die(mysqli_error());
        while ($display_downline_user = mysqli_fetch_array($select_downline_user)) {
            $alluser_array = get_directuser($display_downline_user['reference_id']);
           $query_ref_qry = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$display_user['reference_id']."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result = mysqli_fetch_array($query_ref_qry);

$query_ref_qry1 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$display_user['id']."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result1 = mysqli_fetch_array($query_ref_qry1);

$query_ref_qry2 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$display_user['id']."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result2 = mysqli_fetch_array($query_ref_qry2);

$reinvest=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$display_user['id']."'");
$reinvest_income=mysqli_fetch_array($reinvest);

$buy=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$display_user['id']."'");
$buy_amount=mysqli_fetch_array($buy);

$total_amount=$query_ref_amt_result1['amount']+$query_ref_amt_result2['amount1'];

$total_income_amnt1a = $query_ref_amt_result['ref_total_amt'];

if($total_income_amnt1a == '')
{
$total_income_amnt = 0;
}
else
{
$total_income_amnt = $total_income_amnt1a;
}

            ?>
            <li style="margin-left:10px;">
                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#level<?php echo $display_downline_user['reference_id'] ?>"  onclick="downline(this,<?php echo $display_downline_user['reference_id'] ?>)"></a>
                <span class="span-first" style="font-size: 12px;"><?php echo $display_downline_user['name'] . ' (' . $display_downline_user['reference_id'] . ')' ?></span>
                <span class="span-last" style="width:170px;font-size: 12px;"><?php echo $display_downline_user['email'] ?> <b>ALC</b></span>
                <span class="span-last" style="width:170px;font-size: 12px;"><?php echo floor($total_amount); ?> <b></b></span>
                 <span class="span-last" style="width:170px;font-size: 12px;"><?php echo floor($query_ref_amt_result1['token']); ?> <b></b></span>
                <span class="span-last" style="width:71px;font-size: 12px;">Date <b><?php echo date('F d Y h:i:s', strtotime($display_downline_user['date'])) ?></b></span>
               
            </li>
            <div id="level<?php echo $display_downline_user['reference_id'] ?>" class="panel-collapse collapse" style ="margin-left:10px;"></div>
            <?php
        }
        ?>
    </ul>
</div>