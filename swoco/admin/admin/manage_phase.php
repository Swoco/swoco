<?php include('inc/header.php');?>
<?php

error_reporting(0);

include('inc/dbase.php');

include('inc/checker.php');

session_start();
if(isset($_SESSION['adm_email']) == '') {

        header("location:index.php");

    }  
  $query = mysqli_query($con, "SELECT * FROM `milkyway_icocoin` order by id");



?>
    <script>
      function funComp(ids, idsst)
      {
         var xr2 = confirm('Are You Sure You Want to Change Complete Status ?');



            if(xr2)

            {

                window.location.href='loader_comp.php?page_nm=manage-complete&id='+ids+'&compst='+idsst;

            }

            else

            {

                 return false;

            }
      }
    </script>



      <script>

        function changicoStatus(ir)

        {

            var xr = confirm('Are You Sure You Want to Change Phase ?');



            if(xr)

            {

                window.location.href='loader.php?page_nm=manage-phase&ic_status='+ir;

            }

            else

            {

                 return false;

            }



        }

    </script>
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12  breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">Manage Phase</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a>
                </li>
                
                <li class="breadcrumb-item active">Manage Phase
                </li>
              </ol>
            </div>
          </div>
        </div>
       
      </div>
      <div class="content-body">
         <!-- File export table -->
        <section id="file-export-admin-plus">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">File export</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                  <div class="heading-elements">
                    <ul class="list-inline mb-0">
                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                      <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                      <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                      <li><a data-action="close"><i class="ft-x"></i></a></li>
                    </ul>
                  </div>
                </div>
                <div class="card-content collapse show">
                  <div class="card-body card-dashboard">
                  
                    <table class="table table-striped table-bordered file-export">
                      <thead>
                        <tr>
                                  <th>S.N.</th>                               
                                  <th>Phase Name</th>
                                  <th>Swoco Price in ($)</th>
                                  <th>Duration</th>
                                  <th>Status</th>  
                                  <th>Completed</th>
                                  <th>Action</th>
                                  <th>Action</th>
                        </tr>
                     </thead>
                     <?php

                        $cnt =1; 

                        while($row = mysqli_fetch_array($query))

                         {

                            if($row['status'] == '1')

                            {

                                $curr_status = 'Active';

                            }

                            else

                            {

                                $curr_status = 'Deactive';

                            }

                          ?>

                      <tbody>
                       
                          <tr id="row<?php echo $row['id'];?>">

                            <td tabindex="0" class="sorting_1"><?php echo $cnt; ?></td>


                            <td><?php echo ucfirst($row['phase']); ?></td>

                         <!--    <td id="p_phase_dur<?php echo $row['id'];?>"><?php echo $row['phase_duration']; ?></td> -->

                            <td id="p_unit_prc<?php echo $row['id'];?>"><?php echo $row['unit_coin_prc']; ?></td>

                           <!--  <td id="p_total_coin<?php echo $row['id'];?>"><?php echo $row['total_coin']; ?></td> -->
                          
                          <td id="p_date_duration<?php echo $row['id'];?>"><?php echo $row['date_duration']; ?></td>

                           <!--   <td><?php echo $row['start']; ?></td>

                            <td><?php echo $row['end']; ?></td> -->

                            <td><?php echo $curr_status; ?></td>

                            <td><?php if($row['complete'] == '0') { ?>
                              <a href="javascript:void(0)" onclick="funComp(<?php echo $row['id']; ?>,<?php echo $row['complete']; ?>)">No<a>
                            <?php } else { ?>
                               <a href="javascript:void(0)" onclick="funComp(<?php echo $row['id']; ?>,<?php echo $row['complete']; ?>)">Yes<a>
                            <?php } ?>
                           </td>
                             <td><input type="radio" name="icocoin_sts" <?php if($row['status'] =='1') { echo "checked";} ?>  onclick="return changicoStatus(<?php echo $row['id']; ?>)"></td>

                              <td> 

                                <input type='button' class="btn btn-success mr-10" id="edit_button<?php echo $row['id'];?>" value="edit" onclick="edit_row('<?php echo $row['id'];?>');">

                                <input type='button' class="btn btn-success mr-10" id="save_button<?php echo $row['id'];?>" value="save" onclick="save_row('<?php echo $row['id'];?>');" style="display:none;">

                            </td>

                          

                          </tr>
                          <?php  $cnt++; } ?>
                      </tbody>
                     
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- File export table -->
        
       
        
        
        <!--/ Language - Comma decimal place table -->
      </div>
    </div>
  </div>
 <?php include('inc/footer.php');?>
  <script>
   function edit_row(id)
    {
     
     var p1_unit_prc=document.getElementById("p_unit_prc"+id).innerHTML;
      var p1_date_duration=document.getElementById("p_date_duration"+id).innerHTML;

      document.getElementById("p_unit_prc"+id).innerHTML="<input class='form-control' type='text' id='unit_prc_text"+id+"' value='"+p1_unit_prc+"' onkeyup = 'numericFilter(this);'>";
       document.getElementById("p_date_duration"+id).innerHTML="<input class='form-control' type='text' id='date_duration_text"+id+"' value='"+p1_date_duration+"'>";
      
     document.getElementById("edit_button"+id).style.display="none";
     document.getElementById("save_button"+id).style.display="inline";
    }


function save_row(id)
{
 var p2unit_prc = document.getElementById("unit_prc_text"+id).value;

 var p2date_duration = document.getElementById("date_duration_text"+id).value;
  
 $.ajax
 ({
  type:'post',
  url:'modify_records.php',
  data:{
   edit_row_phase:'edit_row_phase',
   row_id:id,
   p1unit_prc:p2unit_prc,
   p1date_duration:p2date_duration
  },
  success:function(response) {
   if(response=="success")
   {
    document.getElementById("p_unit_prc"+id).innerHTML=p2unit_prc;
     document.getElementById("p_date_duration"+id).innerHTML=p2date_duration;
    document.getElementById("edit_button"+id).style.display="inline";
    document.getElementById("save_button"+id).style.display="none";
   }
  }
 });
}

  </script>
