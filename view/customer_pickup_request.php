<?php if(!isset($conn)){ include '../model/db_connect.php'; } ?>
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
              <h4>Sender's Information</h4>
              <div class="form-group">
                <label for="" class="control-label">Name</label>
                <input type="text" name="sender_name" id="" class="form-control form-control-sm" value="<?php echo isset($sender_name) ? $sender_name : '' ?>" required>
              </div>
              <div class="form-group">
                <label for="" class="control-label">Address</label>
                <input type="text" name="sender_address" id="" class="form-control form-control-sm" value="<?php echo isset($sender_address) ? $sender_address : '' ?>" required>
              </div>


              <div class="form-group">
                <div class="form-group" id="fbi-field">
                  <label for="" class="control-label">Sender's Nearest City</label>
                    <select name="sender_nearest_city" id="sender_nearest_city" class="form-control select2" required="">
                      <option value=""></option>
                        <?php 
                          $branches = $conn->query("SELECT *,concat(city_id,city_name) as address FROM cities");
                          while($row = $branches->fetch_assoc()):
                        ?>
                      <option value="<?php echo $row['city_id'] ?>" <?php echo isset($sender_nearest_city) && $sender_nearest_city == $row['city_id'] ? "selected":'' ?>><?php echo $row['city_id']. ' | '.(ucwords($row['address'])) ?></option>
                    <?php endwhile; ?>
                    </select>
                </div>
              </div>
              
              <div class="form-group">
                <label for="" class="control-label">Email</label>
                <input type="text" name="sender_email" id="" class="form-control form-control-sm" value="<?php echo isset($sender_email) ? $sender_email : '' ?>" required>
              </div>
              <div class="form-group">
                <label for="" class="control-label">Contact No:</label>
                <input type="text" name="sender_contact_no" id="" class="form-control form-control-sm" value="<?php echo isset($sender_contact_no) ? $sender_contact_no : '' ?>" required>
              </div>

              <div class="form-group">
                <div class="form-group" id="fbi-field">
                  <label for="" class="control-label">Sender's Nearest Operational Center</label>
                    <select name="sender_nearest_center" id="sender_nearest_center" class="form-control select2" required="">
                      <option value=""></option>
                        <?php 
                          $branches = $conn->query("SELECT *,concat(center_code,', ',city) as address FROM center");
                          while($row = $branches->fetch_assoc()):
                        ?>
                      <option value="<?php echo $row['center_id'] ?>" <?php echo isset($sender_nearest_center) && $sender_nearest_center == $row['center_id'] ? "selected":'' ?>><?php echo $row['center_code']. ' | '.(ucwords($row['address'])) ?></option>
                    <?php endwhile; ?>
                    </select>
                </div>
              </div>

              <div class="form-group">
                <label for="" class="control-label">Available date for pickup</label>
                <input type="date" name="sender_available_date" id="" class="form-control form-control-sm" value="<?php echo isset($sender_available_date) ? $sender_available_date : '' ?>" required>
              </div>
              <div class="form-group">
                <label for="" class="control-label">Available time for pickup</label>
                <input type="time" placeholder="From" name="sender_available_time_from" id="" class="form-control form-control-sm" value="<?php echo isset($sender_available_time_from) ? $sender_available_time_from : '' ?>" required>
                <br>
                <input type="time" placeholder="To" name="sender_available_time_to" id="" class="form-control form-control-sm" value="<?php echo isset($sender_available_time_to) ? $sender_available_time_to : '' ?>" required>
              </div>
              <div class="form-group">
                <label for="" class="control-label">Remarks</label>
                <input type="text" name="sender_remarks" id="" class="form-control form-control-sm" value="<?php echo isset($sender_remarks) ? $sender_remarks : '' ?>" required>
              </div>
          </div>
          <div class="col-md-6">
              <h4>Receiver's Informration</h4>
              <div class="form-group">
                <label for="" class="control-label">Name</label>
                <input type="text" name="recipient_name" id="" class="form-control form-control-sm" value="<?php echo isset($recipient_name) ? $recipient_name : '' ?>" required>
              </div>
              <div class="form-group">
                <label for="" class="control-label">Address</label>
                <input type="text" name="recipient_address" id="" class="form-control form-control-sm" value="<?php echo isset($recipient_address) ? $recipient_address : '' ?>" required>
                          </div>

              <div class="form-group">
                <div class="form-group" id="fbi-field">
                  <label for="" class="control-label">Recipient's Nearest City</label>
                    <select name="recipient_nearest_city" id="recipient_nearest_city" class="form-control select2" required="">
                      <option value=""></option>
                        <?php 
                          $branches = $conn->query("SELECT *,concat(city_id,city_name) as address FROM cities");
                          while($row = $branches->fetch_assoc()):
                        ?>
                      <option value="<?php echo $row['city_id'] ?>" <?php echo isset($recipient_nearest_city) && $recipient_nearest_city == $row['city_id'] ? "selected":'' ?>><?php echo $row['city_id']. ' | '.(ucwords($row['address'])) ?></option>
                    <?php endwhile; ?>
                    </select>
                </div>
              </div>

              <div class="form-group">
                <label for="" class="control-label">Email</label>
                <input type="text" name="recipient_email" id="" class="form-control form-control-sm" value="<?php echo isset($recipient_email) ? $recipient_email : '' ?>" required>
              </div>
              <div class="form-group">
                <label for="" class="control-label">Contact No:</label>
                <input type="text" name="recipient_contact_no" id="" class="form-control form-control-sm" value="<?php echo isset($recipient_contact_no) ? $recipient_contact_no : '' ?>" required>
              </div>

              <div class="form-group">
                <div class="form-group" id="tbi-field">
                  <label for="" class="control-label">Recipient's Nearest Operational Center</label>
                    <select name="recipient_nearest_center" id="recipient_nearest_center" class="form-control select2">
                      <option value=""></option>
                        <?php 
                          $branches = $conn->query("SELECT *,concat(center_code,', ',city) as address FROM center");
                          while($row = $branches->fetch_assoc()):
                        ?>
                        <option value="<?php echo $row['center_id'] ?>" <?php echo isset($recipient_nearest_center) && $recipient_nearest_center == $row['center_id'] ? "selected":'' ?>><?php echo $row['center_code']. ' | '.(ucwords($row['address'])) ?></option>
                      <?php endwhile; ?>
                    </select>
                </div>
              </div>

              <div class="form-group">
                <label for="" class="control-label">Available date for pickup</label>
                <input type="date" name="recipient_available_date" id="" class="form-control form-control-sm" value="<?php echo isset($recipient_available_date) ? $recipient_available_date : '' ?>" required>
              </div>
              <div class="form-group">
                <label for="" class="control-label">Available time for pickup</label>
                <input type="time" placeholder="From" name="recipient_available_time_from" id="" class="form-control form-control-sm" value="<?php echo isset($recipient_available_time_from) ? $recipient_available_time_from : '' ?>" required>
                <br>
                <input type="time" placeholder="To" name="recipient_available_time_to" id="" class="form-control form-control-sm" value="<?php echo isset($recipient_available_time_to) ? $recipient_available_time_to : '' ?>" required>
              </div>
              <div class="form-group">
                <label for="" class="control-label">Remarks</label>
                <input type="text" name="recipient_remarks" id="recipient_remarks" class="form-control form-control-sm" value="<?php echo isset($recipient_remarks) ? $recipient_remarks : '' ?>" required>
                
              </div>

          </div>
        </div>
        <hr>
     
        <h4>Item Information</h4>
        <table class="table table-bordered" id="parcel-items">
          <thead>
            <tr>            
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
              <td><input type="text" name='weight[]' value="<?php echo isset($weight) ? $weight :'' ?>" required></td>
              <td><input type="text" name='height[]' value="<?php echo isset($height) ? $height :'' ?>" required></td>
              <td><input type="text" name='length[]' value="<?php echo isset($length) ? $length :'' ?>" required></td>
              <td><input type="text" name='width[]' onkeypress="getDistance()" value="<?php echo isset($width) ? $width :'' ?>" required></td>
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
              <?php endif; ?>
      </form>
  	</div>
  	<div class="card-footer border-top border-info">
  		<div class="d-flex w-100 justify-content-center align-items-center">
  			<button class="btn btn-flat  bg-gradient-primary mx-2" form="manage-parcel">Save</button>
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
        <td><input type="text" class="text-right number" name='price[]'  required></td>
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
			url:'../controller/ajax.php?action=save_parcel',
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
      // alert(resp)
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
  function getDistance(){
    var city_a = $('#sender_nearest_city').val();
    var city_b = $('#recipient_nearest_city').val();
    var total = 0.00;
    $.ajax({
			url:'../controller/ajax.php?action=get_distance',
		    // cache: false,
		    // contentType: false,
		    // processData: false,
		    method: 'POST',
        data:{city_a:city_a,city_b:city_b},
		    type: 'POST',
			success:function(resp){
        resp = JSON.parse(resp)
						if(Object.keys(resp).length > 0){

              // alert(resp[0].distance);
              total = resp[0].distance * 5;
              $('#tAmount').text(parseFloat(total).toLocaleString('en-US',{style:'decimal',maximumFractionDigits:2,minimumFractionDigits:2}))
		
						}
			}
		})

  }

  function calc(){

        var total = 0 ;
         $('#parcel-items [name="price[]"]').each(function(){
          var p = $(this).val();
              p =  p.replace(/,/g,'')
              p = p > 0 ? p : 0;
            total = parseFloat(p) + parseFloat(total)
         })

         $.ajax({
			url:'../controller/ajax.php?action=get_distance',
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
      alert(resp)
        if(resp == 1){
            alert_toast('Data successfully saved',"success");
            setTimeout(function(){
              location.href = 'index.php?page=parcel_list';
            },2000)

        }
			}
		})

         if($('#tAmount').length > 0)
         $('#tAmount').text(parseFloat(total).toLocaleString('en-US',{style:'decimal',maximumFractionDigits:2,minimumFractionDigits:2}))
  }
</script>