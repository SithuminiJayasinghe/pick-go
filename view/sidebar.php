  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="dropdown">
   	<a href="./" class="brand-link">
        <?php if($_SESSION['login_type'] == 1): ?>
        <h3 class="text-center p-0 m-0"><b>ADMIN</b></h3>
        <?php elseif ($_SESSION['login_type'] == 2): ?>
          <h3 class="text-center p-0 m-0"><b>STAFF</b></h3>
        <?php elseif ($_SESSION['login_type'] == 3): ?>
          <h3 class="text-center p-0 m-0"><b>CUSTOMER</b></h3>
        <?php else: ?>
        <h3 class="text-center p-0 m-0"><b>GUEST</b></h3>
        <?php endif; ?>

    </a>
      
    </div>
    <div class="sidebar pb-4 mb-4">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item dropdown">
            <a href="./" class="nav-link nav-home">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>     
          <?php if($_SESSION['login_type'] == 1): ?>
          
         
        <?php endif; ?>

        <?php if($_SESSION['login_type'] == 3): ?>
          <li class="nav-item">
            <a href="#" class="nav-link nav-edit_parcel">
              <i class="nav-icon fas fa-boxes"></i>
              <p>
                Customer
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.php?page=customer_pickup_request" class="nav-link nav-new tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Pickup Request</p>
                </a>
              </li>
            
            </ul>
          </li>
          <?php endif; ?>

          <?php if($_SESSION['login_type'] == 1): ?>
          <li class="nav-item">
            <a href="#" class="nav-link nav-edit_parcel">
              <i class="nav-icon fas fa-boxes"></i>
              <p>
                Admin
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.php?page=customer_pickup_request" class="nav-link nav-new tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p> Pickup Request </p>
                </a>
              </li>
            
            </ul>
          </li>
          <?php endif; ?>


          <?php if($_SESSION['login_type'] == 2): ?>
          <li class="nav-item">
            <a href="#" class="nav-link nav-edit_parcel">
              <i class="nav-icon fas fa-boxes"></i>
              <p>
                Staff
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.php?page=assign_to_officer" class="nav-link nav-new tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p> View Assigned Requests</p>
                </a>
              </li>
            
            </ul>
          </li>
          <?php endif; ?>



            
        </ul>
      </nav>
    </div>
  </aside>
  <script>
  	$(document).ready(function(){
      var page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
  		var s = '<?php echo isset($_GET['s']) ? $_GET['s'] : '' ?>';
      if(s!='')
        page = page+'_'+s;
  		if($('.nav-link.nav-'+page).length > 0){
             $('.nav-link.nav-'+page).addClass('active')
  			if($('.nav-link.nav-'+page).hasClass('tree-item') == true){
            $('.nav-link.nav-'+page).closest('.nav-treeview').siblings('a').addClass('active')
  				$('.nav-link.nav-'+page).closest('.nav-treeview').parent().addClass('menu-open')
  			}
        if($('.nav-link.nav-'+page).hasClass('nav-is-tree') == true){
          $('.nav-link.nav-'+page).parent().addClass('menu-open')
        }

  		}
     
  	})
  </script>