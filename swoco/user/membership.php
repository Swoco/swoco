<?php
//ini_set('max_execution_time', 0);
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
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       <?php include('../inc/header.php');?>
        <title>Cryptobulls</title>
        <style>
            .loader {
                border: 2px solid #f3f3f3; /* Light grey */
                border-top: 2px solid #3498db; /* Blue */
                border-radius: 50%;
                width: 30px;
                height: 30px;
                animation: spin 2s linear infinite;
            }

            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
            .loader-center{
                margin-left:auto;
                margin-right:auto;
                margin-top:5px;
            }

        </style>
    </head>
    <body>

        <!--topbar start-->

        <!--topbar end-->

        <!-- Menu-Start -->
      
        <!-- Menu-End -->

        <div class="content">

         
            <!--dashboard start-->
            <section class="container-fluid main-dash">
               
                    <div class="row">
                        <div class="col-sm-12 col-xs-12">
                            <div class="main-dash-right">
                                <div class="dash-title">Share Your Referral link</div>
                                
                              
                                <div class="table-type">
                                    <div class="tb-head">
                                        <div class="row">
                                            <div class="col-sm-10 col-xs-12">Members Info</div>
                                            <div class="col-sm-2 col-xs-12">Partners</div>
                                        </div>
                                    </div>
                                    <div class="panel-group" id="accordion1">
                                        <div class="panel panel-default">
                                            <ul class="panel-list" style="background-color:#525252;color:#fff">
                                                <li>

                                                    <span class="span-first" style="width:300px">Name</span>
                                                    <span class="span-last" style="width:170px">Email</span>
                                                    <span class="span-last" style="width:170px">Total Purchase Amount</span>
                                                       <span class="span-last" style="width:170px">Total token qunatity</span>
                                                    <span class="span-last" style="width:71px">date</span>
                                                </li>
                                            </ul>
                                            <ul class="panel-list">
                                                <?php
                                                category_tree($_SESSION['ref_idsignup']);

//Recursive php function
                                                function category_tree($catid) {
                                                    $alluser_array = get_directuser($catid);
                                                   
                                                    $result = mysqli_query($con,"select * from milkyway_usersignup  where `link_reference_id` ='". $catid . "'") or die(mysqli_error());
                                                    $select_detail =mysqli_query($con,"select * from milkyway_usersignup  where `reference_id` ='". $catid . "'");
                                                    $display_detail = mysqli_fetch_array($select_detail);
                                                  $query_ref_qry = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$display_detail['reference_id']."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result = mysqli_fetch_array($query_ref_qry);

$query_ref_qry1 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$display_detail['id']."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result1 = mysqli_fetch_array($query_ref_qry1);

$query_ref_qry2 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$display_detail['id']."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result2 = mysqli_fetch_array($query_ref_qry2);

$reinvest=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$display_detail['id']."'");
$reinvest_income=mysqli_fetch_array($reinvest);

$buy=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$display_detail['id']."'");
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
                                               echo '
                                                <li>
                                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#level' . $display_detail['reference_id'] . '"  onclick="downline(this,' . $display_detail['reference_id'] . ')"></a>
                                                    <span class="span-first" style="font-size: 12px;">' . $display_detail['name'] . ' (' . $display_detail['link_reference_id'] . ')' . '</span>
                                                        <span class="span-last" style="width:170px;font-size: 12px;">' . $display_detail['email'] . ' <b></b></span>
                                                    <span class="span-last" style="width:170px;font-size: 12px;">' . floor($total_amount) . ' <b></b></span>
                                                      <span class="span-last" style="width:170px;font-size: 12px;">' . floor($query_ref_amt_result1['token']) . ' <b>BULL</b></span>
                                                     <span class="span-last" style="width:71px;font-size: 12px;">Date<b>' . date('F d Y h:i:s', strtotime($display_detail['date'])) . '</b></span>
                                                </li> ';

                                                    echo '<div id="level' . $display_detail['reference_id'] . '" class="panel-collapse collapse">';


                                                    echo '</div>';
                                                }

//close the connection
                                                ?>
                                            </ul>


                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        </section>
                        <!--dashboard end-->
                        <!--footer start-->
                        <?php
                        include('../inc/footer.php');
                        ?>
                        <!--footer end-->
                    </div>

                   
                    <script>
                        function downline(obj, id) {
                            var par_li = $(obj).parent('li');
                            $(obj).attr('onclick', '');
                            $.ajax({
                                url: "ajax_member.php",
                                method: "POST",
                                data: {user_id: id},
                                beforeSend: function () {
                                    par_li.after("<div class='loader loader-center'></div>");
                                },
                                success: function (data)
                                {
                                    par_li.siblings(".loader").remove();
                                    $('#level' + id).html(data);
                                }
                            });

                        }
                    </script>
                    </body>
                    </html>
