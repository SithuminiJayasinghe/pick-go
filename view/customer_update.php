<?php
include '../model/db_connect.php';
$qry = $conn->query("SELECT * FROM goods where good_id = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
	$$k = $v;
}
if (isset ($_GET['update_status'])){
  echo 'hello';
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
					</dl>
				</div>
				<div class="callout callout-info">
					<b class="border-bottom border-primary">Recipient Information</b>
					<dl>
						<dt>Name:</dt>
						<dd><?php echo ucwords($recipient_name) ?></dd>
					</dl>
				</div>
			</div>
			<div class="col-md-6">
				<div class="callout callout-info">
					<b class="border-bottom border-primary">Package Status</b>
					<dl>
						<dd>
                        <div class="form-group" style="padding: 10px">
                            <label for="dtype">Delivered to Customer &nbsp; &nbsp;</label>
                            <input type="checkbox" style="-ms-transform: scale(1.5); -moz-transform: scale(1.5);  padding: 10px;" name="type" id="dtype" value="0" data-bootstrap-switch data-toggle="toggle" data-on="Deliver" data-off="Pickup" class="switch-toggle status_chk" data-size="xs" data-offstyle="info" data-width="5rem">
                            <div id="tbi-field">
                              <form action=""  id="update_status" >
                                <label>Image: </label>
                                <input type="file" name="pic" accept="image/*" value="Browse Image"/>
                                <input type="text" value="../courier/../assets/uploads/" name="path1" hidden="true"><span style="color: red; text-align: center;"></span><br>
                                <div id="btn-holder">
                                  <input type="text" hidden="true" name="idno" value="<?php echo $reference_number ?>"/>
                                <button class="btn btn-primary" form="update_status" id="btn_update">Update</button>
                                </div>
                              </form>
                            </div>
                        </div>
                        
						</dd>

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
  #btn-holder{
    height: 50px;
    position: relative;
  }
  #btn-update{
    margin: 0;
    width: 200;
  position: absolute;
  top: 50%;
  left: 50%;
  -ms-transform: translateY(-50%);
  transform: translateY(-50%);
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
    window.onload = $('#tbi-field').hide();
    // $('#btn_update').click(function(){
    //   $.ajax({
    //     url:'../controller/ajax.php?action=update_status',
    //     method:'POST',
    //     data: jQuery.param({ field1: "hello", field2 : "hello2"}),
    //     error:(err)=>{
    //       console.log(err)
    //       alert_toast('An error occured.',"error")
    //       end_load()
    //     },
    //     success:function(resp){
    //       if(resp==1){
    //         alert_toast("Parcel's Status successfully updated",'success');
    //         setTimeout(function(){
    //           location.reload()
    //         },750)
    //       }
    //     }
    //   })
    // })
    $('#update_status').submit(function(e){
      e.preventDefault()
      start_load()
      $.ajax({
        url:'../controller/ajax.php?action=update_status',
        method:'POST',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        error:(err)=>{
          console.log(err)
          alert_toast('An error occured.',"error")
          end_load()
        },
        success:function(resp){
          if(resp==1){
            alert_toast("Order Status successfully updated",'success');
            setTimeout(function(){
              location.reload()
            },2750)
          }
          if(resp==2){
            alert_toast("File you are trying upload already exists!",'error');
            setTimeout(function(){
              end_load()
            },2750)
          }
          if(resp==3){
            alert_toast("Only JPG, JPEG, PNG & GIF are allowed!",'error');
            setTimeout(function(){
              end_load()
            },2750)
          }
          if(resp==4){
            alert_toast("Image uploading failed!",'error');
            setTimeout(function(){
              end_load()
            },2750)
          }
        }
      })
    })
    $('#dtype').change(function(){
      if($(this).prop('checked') == false){
        $('#tbi-field').hide()
      }else{
        $('#tbi-field').show()
      }
  })
</script>
