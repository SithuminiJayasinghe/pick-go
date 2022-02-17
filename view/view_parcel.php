<?php
include '../model/db_connect.php';
$qry = $conn->query("SELECT * FROM goods where good_id = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
	$$k = $v;
}
?>
<div class="container-fluid">
	<div class="col-lg-12">
		<div class="row">
			<div class="col-md-12">
				<div class="callout callout-info">
					<dl>
						<dt>Tracking Number:</dt>
						<dd> <h4><b><?php echo $reference_number ?></b></h4></dd>
					</dl>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="callout callout-info">
					<b class="border-bottom border-primary">Sender Information</b>
					<dl>
						<dt>Name:</dt>
						<dd><?php echo ucwords($sender_name) ?></dd>
						<dt>Address:</dt>
						<dd><?php echo ucwords($sender_address) ?></dd>
						<dt>Contact:</dt>
						<dd><?php echo ucwords($sender_contact_no) ?></dd>
					</dl>
				</div>
				<div class="callout callout-info">
					<b class="border-bottom border-primary">Recipient Information</b>
					<dl>
						<dt>Name:</dt>
						<dd><?php echo ucwords($recipient_name) ?></dd>
						<dt>Address:</dt>
						<dd><?php echo ucwords($recipient_address) ?></dd>
						<dt>Contact:</dt>
						<dd><?php echo ucwords($recipient_contact_no) ?></dd>
					</dl>
				</div>
			</div>
			<div class="col-md-6">
				<div class="callout callout-info">
					<b class="border-bottom border-primary">Parcel Details</b>
						<div class="row">
							<div class="col-sm-6">
								<dl>
									<dt>Wight:</dt>
									<dd><?php echo $weight ?></dd>
									<dt>Height:</dt>
									<dd><?php echo $height ?></dd>
									<dt>Price:</dt>
									<dd><?php echo number_format($price,2) ?></dd>
								</dl>	
							</div>
							<div class="col-sm-6">
								<dl>
									<dt>Width:</dt>
									<dd><?php echo $width ?></dd>
									<dt>length:</dt>
									<dd><?php echo $length ?></dd>
								</dl>	
							</div>
						</div>
					<dl>
						<dt>Branch Accepted the Parcel:</dt>
						<dt>Status:</dt>
						<dd>
							<?php 
							switch ($status_id) {
								case '0':
									echo "<span class='badge badge-pill badge-info'>Accepted</span>";
									break;
								case '1':
									echo "<span class='badge badge-pill badge-info'> Dispatched to Center</span>";
									break;
								case '2':
									echo "<span class='badge badge-pill badge-primary'> Dsipatched to Delivery</span>";
									break;
								
								default:
									echo "<span class='badge badge-pill badge-info'>Pending Status</span>";
									
									break;
							}
							?>
						</dd>
						<dd><span class="btn badge badge-primary bg-gradient-primary" id='update_status'><h6> Update Status</h6></span></dd>
					</dl>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal-footer display p-0 m-0">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
<style>
	#uni_modal .modal-footer{
		display: none
	}
	#uni_modal .modal-footer.display{
		display: flex
	}
	table.table{
		width:100%;
		border-collapse: collapse;
	}
	table.table tr,table.table th, table.table td{
		border:1px solid;
	}
	.text-cnter{
		text-align: center;
	}
</style>
<script>
	$('#update_status').click(function(){
		uni_modal("Update Status of: <?php echo $reference_number ?>","manage_parcel_status.php?id=<?php echo $good_id ?>&cs=<?php echo $status_id ?>","")
	})
</script>