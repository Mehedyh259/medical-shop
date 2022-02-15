<div class="sidebar">
    <a href="<?php  echo $base_url; ?>">
        <h3>MEDIQAS</h3>
    </a>
    
    <small class="text-muted pl-3"><i class="fa fa-tachometer-alt"></i> DASHBOARD</small>
    <ul>
        <li><a href="<?php  echo $base_url; ?>"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="<?php  echo $base_url.'inventories'; ?>"><i class="fa fa-cart-plus"></i> Inventories </a></li>
        <li><a href="<?php  echo $base_url.'add-item'; ?>"><i class="fa fa-plus-square"></i> Add New Item</a></li>
        <li><a href="<?php  echo $base_url.'manage-inventories'; ?>"><i class="fa fa-cart-plus"></i> Manage Inventory</a></li>
        <li><a href="<?php  echo $base_url.'sells-report'; ?>"><i class="fa fa-file-invoice"></i> Sells Report</a></li>

    </ul>
    <small class="text-muted px-3">OTHERS TOOLS</small>
    <ul>
        <li><a href="<?php echo $base_url.'profile'; ?>"><i class="fa fa-user"></i> Profile Setting</a></li>

        <li><a href="logout.php"><i class="fa fa-sign-out-alt" aria-hidden="true"></i>Sign Out</a></li>
    </ul>

</div>