<?php if(!isset($conn)){ include 'db_connect.php'; } ?>
<style>
  textarea{
    resize: none;
  }
</style>
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-body">
			<form action="" id="manage-parcel">
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
        <div id="msg" class=""></div>
        <div class="row">
          <div class="col-md-6">
              <h4>Assign Pickup</h4>

              <br>
              <div class="col-sm-6 form-group ">
                <label for="" class="control-label">Assign to Officer</label>
                <select name="assign_officer" id="" class="form-control input-sm select2">
                  <option value=""></option>

                </select>
              </div>

              <div class="form-group">
                <label for="" class="control-label">Pickup date</label>
                <input type="text" name="assign_officer" id="" class="form-control form-control-sm" value="<?php echo isset($assign_officer) ? $assign_officer : '' ?>" required>
              </div>
              <div class="form-group">
                <label for="" class="control-label">Pickup time: From</label>
                <input type="datetime" name="assign_officer" id="" class="form-control form-control-sm" value="<?php echo isset($assign_officer) ? $assign_officer : '' ?>" required>
              </div>
              <div class="form-group">
                <label for="" class="control-label">Pickup time: To</label>
                <input type="text" name="assign_officer" id="" class="form-control form-control-sm" value="<?php echo isset($assign_officer) ? $assign_officer : '' ?>" required>
              </div>


              <!-- <div class="form-group">
                <label for="" class="control-label">Address</label>
                <input type="text" name="sender_address" id="" class="form-control form-control-sm" value="<?php echo isset($sender_address) ? $sender_address : '' ?>" required>
              </div>
              <div class="form-group">
                <label for="" class="control-label">Nearest City</label>
                <input type="text" name="sender_nearest_city" id="" class="form-control form-control-sm" value="<?php echo isset($sender_nearest_city) ? $sender_nearest_city : '' ?>" required>
              </div>
              <div class="form-group">
                <label for="" class="control-label">Email</label>
                <input type="text" name="sender_email" id="" class="form-control form-control-sm" value="<?php echo isset($sender_email) ? $sender_email : '' ?>" required>
              </div>
              <div class="form-group">
                <label for="" class="control-label">Contact No:</label>
                <input type="text" name="sender_contact" id="" class="form-control form-control-sm" value="<?php echo isset($sender_contact) ? $sender_contact : '' ?>" required>
              </div>
              <div class="form-group">
                <label for="" class="control-label">Nearest Operational Center</label>
                <input type="text" name="sender_nearest_operational_center" id="" class="form-control form-control-sm" value="<?php echo isset($sender_nearest_operational_center) ? $sender_nearest_operational_center : '' ?>" required>
              </div>
              <div class="form-group">
                <label for="" class="control-label">Available date for pickup</label>
                <input type="text" name="sender_available_date_for_pickup" id="" class="form-control form-control-sm" value="<?php echo isset($sender_available_date_for_pickup) ? $sender_available_date_for_pickup : '' ?>" required>
              </div>
              <div class="form-group">
                <label for="" class="control-label">Available time for pickup</label>
                <input type="text" name="sender_available_time_for_pickup_from" id="" class="form-control form-control-sm" value="<?php echo isset($sender_available_time_for_pickup_from) ? $sender_available_time_for_pickup_from : '' ?>" required>
                <input type="text" name="sender_available_time_for_pickup_to" id="" class="form-control form-control-sm" value="<?php echo isset($sender_available_time_for_pickup_to) ? $sender_available_time_for_pickup_to : '' ?>" required>
              </div>
              <div class="form-group">
                <label for="" class="control-label">Remarks</label>
                <input type="text" name="sender_remarks" id="" class="form-control form-control-sm" value="<?php echo isset($sender_remarks) ? $sender_remarks : '' ?>" required>
              </div>
               -->


          </div>
          <!-- <div class="col-md-6">
              <h4>Recipient's Information</h4>
              <div class="form-group">
                <label for="" class="control-label">Name</label>
                <input type="text" name="recipient_name" id="" class="form-control form-control-sm" value="<?php echo isset($recipient_name) ? $recipient_name : '' ?>" required>
              </div> -->
              <!-- <div class="form-group">
                <label for="" class="control-label">Address</label>
                <input type="text" name="recipient_address" id="" class="form-control form-control-sm" value="<?php echo isset($recipient_address) ? $recipient_address : '' ?>" required>
              </div>
              <div class="form-group">
                <label for="" class="control-label">Nearest City</label>
                <input type="text" name="sender_nearest_city" id="" class="form-control form-control-sm" value="<?php echo isset($sender_nearest_city) ? $sender_nearest_city : '' ?>" required>
              </div>
              <div class="form-group">
                <label for="" class="control-label">Email</label>
                <input type="text" name="sender_email" id="" class="form-control form-control-sm" value="<?php echo isset($sender_email) ? $sender_email : '' ?>" required>
              </div>
              <div class="form-group">
                <label for="" class="control-label">Contact No:</label>
                <input type="text" name="sender_contact" id="" class="form-control form-control-sm" value="<?php echo isset($sender_contact) ? $sender_contact : '' ?>" required>
              </div>
              <div class="form-group">
                <label for="" class="control-label">Nearest Operational Center</label>
                <input type="text" name="sender_nearest_operational_center" id="" class="form-control form-control-sm" value="<?php echo isset($sender_nearest_operational_center) ? $sender_nearest_operational_center : '' ?>" required>
              </div>
              <div class="form-group">
                <label for="" class="control-label">Available date for delivery</label>
                <input type="text" name="sender_available_date_for_pickup" id="" class="form-control form-control-sm" value="<?php echo isset($sender_available_date_for_pickup) ? $sender_available_date_for_pickup : '' ?>" required>
              </div>
              <div class="form-group">
                <label for="" class="control-label">Available time for delivery</label>
                <input type="text" name="sender_available_time_for_delivery_from" id="" class="form-control form-control-sm" value="<?php echo isset($sender_available_time_for_delivery_from) ? $sender_available_time_for_delivery_from : '' ?>" required>
                <input type="text" name="sender_available_time_for_delivery_to" id="" class="form-control form-control-sm" value="<?php echo isset($sender_available_time_for_delivery_to) ? $sender_available_time_for_delivery_to : '' ?>" required>
              </div> -->
              <!-- <div class="form-group">
                <label for="" class="control-label">Remarks</label>
                <input type="text" name="sender_remarks" id="" class="form-control form-control-sm" value="<?php echo isset($sender_remarks) ? $sender_remarks : '' ?>" required>
              </div>               -->
          <!-- </div> -->
        </div>
        <br>
        <br>
        <!-- <h4>Item Information</h4>
        <table class="table table-bordered" id="parcel-items">
          <thead>
            <tr>
              <th>Name</th>
              <th>Type</th>
              <th>Weight</th>
              <th>Height</th>
              <th>Length</th>
              <th>Width</th>
              <th>Price</th>
              <?php if(!isset($id)): ?>
              <th></th>
            <?php endif; ?>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><input type="text" name='name' value="<?php echo isset($name) ? $name :'' ?>" required></td>
              <td><input type="text" name='type' value="<?php echo isset($type) ? $type :'' ?>" required></td>
              <td><input type="text" name='weight[]' value="<?php echo isset($weight) ? $weight :'' ?>" required></td>
              <td><input type="text" name='height[]' value="<?php echo isset($height) ? $height :'' ?>" required></td>
              <td><input type="text" name='length[]' value="<?php echo isset($length) ? $length :'' ?>" required></td>
              <td><input type="text" name='width[]' value="<?php echo isset($width) ? $width :'' ?>" required></td>
              <td><input type="text" class="text-right number" name='price[]' value="<?php echo isset($price) ? $price :'' ?>" required></td>
              <?php if(!isset($id)): ?>
              <td><button class="btn btn-sm btn-danger" type="button" onclick="$(this).closest('tr').remove() && calc()"><i class="fa fa-times"></i></button></td>
              <?php endif; ?>
            </tr>
          </tbody>
              <?php if(!isset($id)): ?>
          <tfoot>
            <th colspan="4" class="text-right">Total</th>
            <th class="text-right" id="tAmount">0.00</th>
            <th></th>
          </tfoot>
              <?php endif; ?>
        </table>
              <?php if(!isset($id)): ?>
        <div class="row">
          <div class="col-md-12 d-flex justify-content-end">
            <button  class="btn btn-sm btn-primary bg-gradient-primary" type="button" id="new_parcel"><i class="fa fa-item"></i> Add Item</button>
          </div>
        </div>
              <?php endif; ?> -->
      </form>
  	</div>
  	<div class="card-footer border-top border-info">
  		<div class="d-flex w-100 justify-content-center align-items-center">
  			<button class="btn btn-flat  bg-gradient-primary mx-2" form="manage-parcel">Assign</button>
  			<a class="btn btn-flat bg-gradient-secondary mx-2" href="./index.php?page=parcel_list">Cancel</a>
  		</div>
  	</div>
	</div>
</div>
<div id="ptr_clone" class="d-none">
  <table>
    <tr>
        <td><input type="text" name='weight[]' required></td>
        <td><input type="text" name='height[]' required></td>
        <td><input type="text" name='length[]' required></td>
        <td><input type="text" name='width[]' required></td>
        <td><input type="text" class="text-right number" name='price[]' required></td>
        <td><button class="btn btn-sm btn-danger" type="button" onclick="$(this).closest('tr').remove() && calc()"><i class="fa fa-times"></i></button></td>
      </tr>
  </table>
</div>
<script>
  $('#dtype').change(function(){
      if($(this).prop('checked') == true){
        $('#tbi-field').hide()
      }else{
        $('#tbi-field').show()
      }
  })
    $('[name="price[]"]').keyup(function(){
      calc()
    })
  $('#new_parcel').click(function(){
    var tr = $('#ptr_clone tr').clone()
    $('#parcel-items tbody').append(tr)
    $('[name="price[]"]').keyup(function(){
      calc()
    })
    $('.number').on('input keyup keypress',function(){
        var val = $(this).val()
        val = val.replace(/[^0-9]/, '');
        val = val.replace(/,/g, '');
        val = val > 0 ? parseFloat(val).toLocaleString("en-US") : 0;
        $(this).val(val)
    })

  })
	$('#manage-parcel').submit(function(e){
		e.preventDefault()
		start_load()
    if($('#parcel-items tbody tr').length <= 0){
      alert_toast("Please add atleast 1 parcel information.","error")
      end_load()
      return false;
    }
		$.ajax({
			url:'controller/ajax.php?action=save_parcel',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
			// if(resp){
      //       resp = JSON.parse(resp)
      //       if(resp.status == 1){
      //         alert_toast('Data successfully saved',"success");
      //         end_load()
      //         var nw = window.open('print_pdets.php?ids='+resp.ids,"_blank","height=700,width=900")
      //       }
			// }
        if(resp == 1){
            alert_toast('Data successfully saved',"success");
            setTimeout(function(){
              location.href = 'index.php?page=parcel_list';
            },2000)

        }
			}
		})
	})
  function displayImgCover(input,_this) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
            $('#cover').attr('src', e.target.result);
          }

          reader.readAsDataURL(input.files[0]);
      }
  }
  function calc(){

        var total = 0 ;
         $('#parcel-items [name="price[]"]').each(function(){
          var p = $(this).val();
              p =  p.replace(/,/g,'')
              p = p > 0 ? p : 0;
            total = parseFloat(p) + parseFloat(total)
         })
         if($('#tAmount').length > 0)
         $('#tAmount').text(parseFloat(total).toLocaleString('en-US',{style:'decimal',maximumFractionDigits:2,minimumFractionDigits:2}))
  }
</script>