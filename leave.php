<?php
require('top.inc.php');

$employee_id=$_SESSION['USER_ID'];
//For Sick Leaves
$cmp="select sick_count from employee where id='$employee_id'";
$cmp_sick=mysqli_query($con,$cmp);
$ans=mysqli_fetch_assoc($cmp_sick);
$scount=$ans['sick_count'];


//For Casual Leaves
$cmp_cas="select casual_count from employee where id='$employee_id'";
$cmp_casual=mysqli_query($con,$cmp_cas);
$ans=mysqli_fetch_assoc($cmp_casual);
$ccount=$ans['casual_count'];


//For Earned Leaves
$cmp_earn="select earned_count from employee where id='$employee_id'";
$cmp_earned=mysqli_query($con,$cmp_earn);
$ans=mysqli_fetch_assoc($cmp_earned);
$ercount=$ans['earned_count'];




if(isset($_GET['type']) && $_GET['type']=='delete' && isset($_GET['id'])){
	$id=mysqli_real_escape_string($con,$_GET['id']);
	mysqli_query($con,"delete from `leave` where id='$id'");
}
if(isset($_GET['type']) && $_GET['type']=='update' && isset($_GET['id'])){
	$id=mysqli_real_escape_string($con,$_GET['id']);
	$status=mysqli_real_escape_string($con,$_GET['status']);
	mysqli_query($con,"update `leave` set leave_status='$status' where id='$id'");
}
if($_SESSION['ROLE']==1){ 
	$sql="select `leave`.*, employee.name,employee.id as employee_id from `leave`,employee where `leave`.employee_id=employee.id order by `leave`.id desc";
}else{
	$sql="select `leave`.*, employee.name ,employee.id as employee_id from `leave`,employee where `leave`.employee_id='$employee_id' and `leave`.employee_id=employee.id order by `leave`.id desc";
}

$res=mysqli_query($con,$sql);
?>
<div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
						<div class="container" style="display:flex;" >	
				
						<div class="sep" >	
						<span class="box-title" style="font-size:1.5rem">Leave </span>
							<?php if($_SESSION['ROLE']==2){ ?>
								<h4 class="box_title_link" style="margin-top:5px;font-weight:550;padding:9px;background-color:green;border-radius:3px;width:103%"><a style="color:white;" href="add_leave.php">Apply Leave</a> </h4>
								<?php } ?>
								</div>

								<div class="table-stats order-table ov-h" style="margin-left:40px;width:50%;border:2px solid black;">
                              <table class="table"  >
                                 <thead>
                                    <tr style="border-bottom:2px solid black">
                                       <th width="11%" style="color:#0054D2;font-weight:600">Sick Leave Count:</th>
                                       <th width="12%" style="color:#0054D2;font-weight:600">Casual Leave Count:</th>
									   <th width="10%" style="color:#0054D2;font-weight:600">Earn Leave Count:</th>
									   </tr>
                                 </thead>
                                 <tbody>
								<td style="color:red"><?php if($scount>0){echo $scount;}else{echo "No More Sick Leaves Left!";} ?></td>
								<td style="color:red"><?php if($ccount>0){echo $ccount;}else{echo "No More Casual Leaves Left!";} ?></td>
								<td style="color:red"><?php if($ercount>0){echo $ercount;}else{echo "No More Earned Leaves Left!";} ?></td>
							</tbody>
							</table>

								</div>
						   </div>


                        <div class="card-body">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th width="5%">S.No</th>
                                       <th width="5%">ID</th>
									   <th width="15%">Employee Name</th>
                                       <th width="14%">From</th>
									   <th width="14%">To</th>
									   <th width="15%">Description</th>
									   <th width="18%">Leave Status</th>
									   <th width="10%"></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
									$i=1;
									while($row=mysqli_fetch_assoc($res)){?>
									<tr>
                                       <td><?php echo $i?></td>
									   <td><?php echo $row['id']?></td>
									   <td><?php echo $row['name'].' ('.$row['employee_id'].')'?></td>
                                       <td><?php echo $row['leave_from']?></td>
									   <td><?php echo $row['leave_to']?></td>
									   <td><?php echo $row['leave_description']?></td>
									   <td>
										   <?php
											if($row['leave_status']==1){
												echo "Waiting ...";
											}if($row['leave_status']==2){
												echo "Approved";
											}if($row['leave_status']==3){
												echo "Rejected";
											}
										   ?>

										   <?php if($_SESSION['ROLE']==1){ ?>
										   <select class="form-control" onchange="update_leave_status('<?php echo $row['id']?>',this.options[this.selectedIndex].value)">
											<option value="">Update Status</option>
											<option value="2">Approved</option>
											<option value="3">Rejected</option>
										   </select>
										   <?php } ?>
									   </td>
									   <td>
									   <?php
									   if($row['leave_status']==1){ ?>
									   <a href="leave.php?id=<?php echo $row['id']?>&type=delete">Delete</a>
									   <?php } ?>
									   
									   
									   </td>
									   
                                    </tr>
									<?php 
									$i++;
									} ?>
                                 </tbody>
                              </table>
                           </div>
                        
                     </div>
                  </div>
               </div>
            </div>
		  </div>
         <script>
		 function update_leave_status(id,select_value){
			window.location.href='leave.php?id='+id+'&type=update&status='+select_value;
		 }
		 </script>
<?php
require('footer.inc.php');
?>