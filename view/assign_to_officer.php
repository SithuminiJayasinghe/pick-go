<?php include'../model/db_connect.php' ?>
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-header">
			<div class="card-tools">
			</div>
		</div>
		<div class="card-body">
			<table class="table tabe-hover table-bordered" id="list">
				<!-- <colgroup>
					<col width="5%">
					<col width="15%">
					<col width="25%">
					<col width="25%">
					<col width="15%">
				</colgroup> -->
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th>Good_ID</th>
						<th>Sender</th>
						<th>Sender's address</th>
						<th>Order date and time</th>
						<th>Sender Available From</th>
						<th>Sender Available To</th>
						<th>Sender remarks</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$where = "";
					// if(isset($_GET['s'])){
					// 	$where = " where status = {$_GET['s']} ";
					// }
					if($_SESSION['login_type'] != 1 ){
						if(empty($where))
							$where = " where ";
						else
							$where .= " and ";
						$where .= "sender_nearest_center = {$_SESSION['login_center_id'] } ";
					}

					$qry = $conn->query("SELECT * from goods where status_id is NULL order by date_created DESC");
					while($row= $qry->fetch_assoc()):
					?>
					<tr>
						<td class="text-center"><?php echo $i++ ?></td>
						<td><b><?php echo ($row['good_id']) ?></b></td>
						<td><b><?php echo ucwords($row['sender_name']) ?></b></td>
						<td><b><?php echo ucwords($row['sender_address']) ?></b></td>
						<td><b><?php echo ucwords($row['date_created']) ?></b></td>
						<td><b><?php echo ucwords($row['sender_available_time_from']) ?></b></td>
						<td><b><?php echo ucwords($row['sender_available_time_to']) ?></b></td>
						<td><b><?php echo ucwords($row['sender_remarks']) ?></b></td>

						
						<td class="text-center">
		                    <div class="btn-group">
		                    	<!-- <button type="button" class="btn btn-info btn-flat view_parcel" data-id="<?php echo $row['good_id'] ?>">
		                          <i class="fas fa-eye"></i>
		                        </button> -->
		                        <a href="index.php?page=assign_to_officer_2&id=<?php echo $row['good_id'] ?>" class="btn btn-primary btn-flat ">
		                          <i class="fas fa-edit"></i>
		                        </a>
		                        <!-- <button type="button" class="btn btn-danger btn-flat delete_parcel" data-id="<?php echo $row['good_id'] ?>">
		                          <i class="fas fa-trash"></i>
		                        </button> -->
	                      </div>
						</td>
					</tr>	



					</tr>	
				<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<style>
	table td{
		vertical-align: middle !important;
	}
</style>
<script>
	$(document).ready(function(){
		$('#list').dataTable()
		$('.view_parcel').click(function(){
			uni_modal("Parcel's Details","view_parcel.php?id="+$(this).attr('data-id'),"large")
		})
	$('.delete_parcel').click(function(){
	_conf("Are you sure to delete this parcel?","delete_parcel",[$(this).attr('data-id')])
	})
	})
	function delete_parcel($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_parcel',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>