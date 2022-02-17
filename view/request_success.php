<?php
if(!isset($conn)){ include '../model/db_connect.php'; }
$ref_id = (int)$_GET['ref_id'];
$officer = $conn->query("SELECT * FROM goods where reference_number = $ref_id");
$good_name= "";
while($row = $officer->fetch_assoc()):
    $good_name =  $row['good_name'];
    $sender_address =  $row['sender_address'];
endwhile;
?>


</div>
<div class="row">
          <div class="col-md-6">
              <div class="form-group">
                <label for="" class="control-label">Item Name</label>
                <div class="col-5 pull-right"> <span id="heading"></span><span id="details"><?php echo $good_name ?></span> </div>  
             </div>
              <div class="form-group">
                <label for="" class="control-label">Sender's address</label>
                <div class="col-5 pull-right"> <span id="heading"></span><span id="details"><?php echo $sender_address ?></span> </div>  
            </div>
              <div class="form-group">
                <label for="" class="control-label">Tracking ID</label>
                 <div class="col-5 pull-right"> <span id="heading"></span><span id="details"><?php echo $_GET['ref_id'] ?></span> </div>

              </div>
             


              
          </div>
         
        </div>