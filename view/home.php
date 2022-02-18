<?php include('../model/db_connect.php') ?>
<?php
$twhere ="";
if($_SESSION['login_type'] != 1)
  $twhere = "  ";
?>
<!-- Info boxes -->
<?php if($_SESSION['login_type'] == 1): ?>
        <div class="row">
          <div class="col-12 col-sm-12 col-md-12">
            <div class="small-box bg-light shadow-sm border">
              <div class="inner">
                <h3 style="text-align: center">Welcome Administrator!</h3>
              </div>
            </div>
          </div>
      </div> 

<?php else: ?>
	 <div class="col-12">
          <div class="card">
          	<div class="card-body">
          		Welcome <?php echo $_SESSION['login_name'] ?>!
          	</div>
          </div>

          <div class="col-lg-12">
            <div class="card card-outline card-primary">
              <div class="card-header">
              </div>
              <div class="card-body">
                <table class="table tabe-hover table-bordered" id="list">
                  <thead>
                    <tr>
                      <th>Reference Number</th>
                      <th>Sender Name</th>
                      <th>Recipient Name</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    
                    $qry = $conn->query("SELECT * from goods g, systemusers su WHERE g.recipient_email=su.email AND su.system_user_id='".$_SESSION['login_system_user_id']."'");
                    while($row= $qry->fetch_assoc()):
                    ?>
                    <tr>
                      <td><b><?php echo ($row['reference_number']) ?></b></td>
                      <td><b><?php echo ucwords($row['sender_name']) ?></b></td>
                      <td><b><?php echo ucwords($row['recipient_name']) ?></b></td>
                      <td class="text-center">
                          <div class="btn-group">
                            <?php 
                            if($row["status_id"] != 0) { ?>
                              <button type="button" class="btn btn-info btn-flat view_status" data-id="<?php echo $row['good_id'] ?>">
                                Update Status
                              </button>
                            <?php }
                            else { ?>
                              <i class="ico-rec fas fa-check-double"></i>Received
                            <?php
                            } ?>
                          </div>
                      </td>
                    </tr>	
                  <?php endwhile; ?>
                  </tbody>
                </table>
              </div>
            </div>
</div>

      </div>
          
<?php endif; ?>


<style>
	table td{
		vertical-align: middle !important;
	}

  .ico-rec{
    padding: 5px 5px 0 0;
    color: #0add1a;
  }
  .switch {
      position: relative;
      display: inline-block;
      width: 120px;
      height: 34px;
    }

    .switch input {display:none;}

    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ca2222;
      -webkit-transition: .4s;
      transition: .4s;
    }

    .slider:before {
      position: absolute;
      content: "";
      height: 26px;
      width: 26px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
    }

    input:checked + .slider {
      background-color: #2ab934;
    }

    input:focus + .slider {
      box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
      -webkit-transform: translateX(85px);
      -ms-transform: translateX(85px);
      transform: translateX(85px);
    }

    /*------ ADDED CSS ---------*/
    .on
    {
      display: none;
    }

    .on, .off
    {
      color: white;
      position: absolute;
      transform: translate(-50%,-50%);
      top: 50%;
      left: 50%;
      font-size: 10px;
      font-family: Verdana, sans-serif;
    }

    input:checked+ .slider .on
    {display: block;}

    input:checked + .slider .off
    {display: none;}

    /*--------- END --------*/

    /* Rounded sliders */
    .slider.round {
      border-radius: 34px;
    }

    .slider.round:before {
      border-radius: 50%;}
</style>
<script>
	$(document).ready(function(){
		$('#list').dataTable()
		$('.view_status').click(function(){
			uni_modal("Customer Update Status","customer_update.php?id="+$(this).attr('data-id'),"large")
		})
	$('.delete_parcel').click(function(){
	_conf("Are you sure to delete this parcel?","delete_parcel",[$(this).attr('data-id')])
	})
	})
	function delete_parcel($id){
		start_load()
		$.ajax({
			url:'../controller/ajax.php?action=delete_parcel',
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
