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
      <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
        <div id="msg" class=""></div>
        <div class="row">
          <div class="col-md-6">
              <h4>Assign Pickup</h4>
              <br>
              <div class="col-sm-6 form-group ">
                <label for="" class="control-label">Assign to Officer</label>
                <div class="form-group">
                  <div class="form-group" id="tbi-field">
                    <select name="assigned_officer" id="assigned_officer" class="form-control select2">
                      <option value=""></option>
                        <?php 
                          $branches = $conn->query("SELECT * FROM systemusers where type=2 ");
                          while($row = $branches->fetch_assoc()):
                        ?>
                        <option value="<?php echo $row['system_user_id'] ?>" <?php echo isset($system_user_id) && $system_user_id == $row['system_user_id'] ? "selected":'' ?>><?php echo $row['firstname'] ?></option>
                      <?php endwhile; ?>
                    </select>
                  </div> 
                </div>
              </div>

              <div class="form-group">
                <label for="" class="control-label">Pickup date</label>
                <input type="date" name="assigned_pickup_date" id="assigned_pickup_date" class="form-control form-control-sm" value="<?php echo isset($assigned_pickup_date) ? $assigned_pickup_date : '' ?>" required>
              </div>
              <div class="form-group">
                <label for="" class="control-label">Pickup time: From</label>
                <input type="time" name="assigned_pickup_time_from" id="assigned_pickup_time_from" class="form-control form-control-sm" value="<?php echo isset($assigned_pickup_time_from) ? $assigned_pickup_time_from : '' ?>" >
              </div>
              <div class="form-group">
                <label for="" class="control-label">Pickup time: To</label>
                <input type="time" name="assigned_pickup_time_to" id="assigned_pickup_time_to" class="form-control form-control-sm" value="<?php echo isset($assigned_pickup_time_to) ? $assigned_pickup_time_to : '' ?>" >
              </div>
              <input type="hidden" name="status_id" id="status_id" class="form-control form-control-sm" value="<?php echo isset($status_id) ? $status_id : 1 ?>" >
              <input type="hidden" name="reference_number" id="reference_number" class="form-control form-control-sm" value="<?php echo isset($reference_number) ? $reference_number : 1 ?>" >



           
          </div>
                  </div>
        <br>
        <br>
         
      </form>
  	</div>
  	<div class="card-footer border-top border-info">
  		<div class="d-flex w-100 justify-content-center align-items-center">
  			<button class="btn btn-flat  mx-2" form="manage-parcel" style="background-color: #F57600;">Assign</button>
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
		start_load();

   
		$.ajax({
			url:'../controller/ajax.php?action=update_parcel',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
        if(resp == 1){
            alert_toast('Data successfully updated.',"success");
            start_load();
            setTimeout(function(){
              var assigned_officer = $('#assigned_officer').val();
              var reference_number = $('#reference_number').val();
              location.href = 'assign_email.php?assigned_officer_id=' + assigned_officer + '&reference_number='+reference_number;
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