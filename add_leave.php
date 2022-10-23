<?php
require('top.inc.php');

$employee_id=$_SESSION['USER_ID'];

//For Sick Leaves
$cmp="select sick_count from employee where id='$employee_id'";
$cmp_sick=mysqli_query($con,$cmp);
$ans=mysqli_fetch_assoc($cmp_sick);
$scount=$ans['sick_count'];
$sickcnt=$scount;


//For Casual Leaves
$cmp_cas="select casual_count from employee where id='$employee_id'";
$cmp_casual=mysqli_query($con,$cmp_cas);
$ans=mysqli_fetch_assoc($cmp_casual);
$ccount=$ans['casual_count'];
$cascnt=$ccount;


//For Earned Leaves
$cmp_earn="select earned_count from employee where id='$employee_id'";
$cmp_earned=mysqli_query($con,$cmp_earn);
$ans=mysqli_fetch_assoc($cmp_earned);
$ercount=$ans['earned_count'];
$earncnt=$ercount;


if(isset($_POST['submit'])){
	$empleave=mysqli_real_escape_string($con,$_POST['emptype']);
	$leave_from=mysqli_real_escape_string($con,$_POST['leave_from']);
	$leave_to=mysqli_real_escape_string($con,$_POST['leave_to']);
	$leave_description=mysqli_real_escape_string($con,$_POST['leave_description']);
	
	if($empleave=='Sick'){
		if($sickcnt>1){
		$sickcnt--;
		$ssql="update `employee` set sick_count='$sickcnt' where id='$employee_id' ";
		mysqli_query($con,$ssql);
		$sql="insert into `leave`(leave_type,leave_from,leave_to,employee_id,leave_description,leave_status) values('$empleave','$leave_from','$leave_to','$employee_id','$leave_description',1)";
		mysqli_query($con,$sql);
	}
	header('location:leave.php');
}
else{
	echo "No More Sick Leaves!!";
}


if($empleave=='Casual'){
	if($cascnt>1){
		$cascnt--;
		$csql="update `employee` set casual_count='$cascnt' where id='$employee_id' ";
		mysqli_query($con,$csql);
		$sql="insert into `leave`(leave_type,leave_from,leave_to,employee_id,leave_description,leave_status) values('$empleave','$leave_from','$leave_to','$employee_id','$leave_description',1)";
		mysqli_query($con,$sql);
	}
	header('location:leave.php');
}
else{
	echo "No More Sick Leaves!!";
}


if($empleave=='Earned'){
	if($earncnt>1){
		$earncnt--;
		$esql="update `employee` set earned_count='$earncnt' where id='$employee_id'";
		mysqli_query($con,$esql);
		$sql="insert into `leave`(leave_type,leave_from,leave_to,employee_id,leave_description,leave_status) values('$empleave','$leave_from','$leave_to','$employee_id','$leave_description',1)";
		mysqli_query($con,$sql);
	}
	header('location:leave.php');
}
else{
	echo "No More Sick Leaves!!";
}



}
?>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Leave Type</strong><small> Form</small></div>
						
                        <div class="card-body card-block">
                           <form method="post">
						   
								<div class="form-group">
									<label class=" form-control-label">Leave Type</label>
									<select name="emptype"  required class="form-control">
										<option  value="">Select Leave</option>
										<?php
										$res=mysqli_query($con,"select * from leave_type order by leave_type desc");
										while($row=mysqli_fetch_assoc($res)){
									echo "<option value=".$row['leave_type'].">".$row['leave_type']."</option>";
										}
										?>
									</select>
								</div>
							   <div class="form-group">
									<label class=" form-control-label">From Date</label>
									<input type="date" name="leave_from"  class="form-control" required>
								</div>
								<div class="form-group">
									<label class=" form-control-label">To Date</label>
									<input type="date" name="leave_to" class="form-control" required>
								</div>
								<div class="form-group">
									<label class=" form-control-label">Leave Description</label>
									<input type="text" name="leave_description" class="form-control" >
								</div>
								
								 <button  type="submit" name="submit" class="btn btn-lg btn-info btn-block">
							   <span id="payment-button-amount">Submit</span>
							   </button>
							  </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
                  

<?php
require('footer.inc.php');
?>


