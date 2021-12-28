<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?php echo str_replace('/var/www/html','',__DIR__) ?>/../index.php">Covitesse</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
       <li class="nav-item">
          <a class="nav-link <?php if($page=="home"){echo "active"; ?> " <?php echo "aria-current=\"page\"";}else{?> " <?php }?> href="<?php echo str_replace('/var/www/html','',__DIR__) ?>/../index.php">Home</a>
        </li>
        <li class="nav-item">
        <a class="nav-link <?php if($page=="shop"){echo "active"; ?> " <?php echo "aria-current=\"page\"";}else{?> " <?php }?> href="<?php echo str_replace('/var/www/html','',__DIR__) ?>/../shop.php">Shop</a>
        </li>
        <?php
        
          if(isset($_SESSION["admin"]) && $_SESSION["admin"] == 1){
              ?>
              <li class="nav-item">
                <a class="nav-link <?php if($page=="admin"){ echo "active"; ?>" <?php echo "aria-current=\"page\"";} else{?> " <?php } ?> href="<?php echo str_replace('/var/www/html','',__DIR__) ?>/../admin.php" ?>Admin</a>
              </li>
          <?php
          }
        ?>


      </ul>
      <?php

      if(!isset($_SESSION["email"])){
      ?>
      <ul class="navbar-nav ms-auto">
        <li class="nav-item register_login">
          <button class="btn btn-secondary nav-link" onclick="location='<?php echo str_replace('/var/www/html','',__DIR__) ?>/../register.php'">Register</button>
        </li>
        <li class="nav-item register_login">
          <button class="btn btn-primary nav-link" onclick="location='<?php echo str_replace('/var/www/html','',__DIR__) ?>/../login.php'">Login</button>
        </li>
      </ul>
      <?php
      }
      else {
        ?>
        
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="shoppingcart.php"><image src="<?php echo str_replace("/var/www/html","",__DIR__) ?>/../../assets/cart.svg" alt="shopping cart"/></a>
          </li>

          <li class="nav-item">
            <button class="btn btn-secondary nav-link" onclick="location='<?php echo str_replace('/var/www/html','',__DIR__) ?>/../logout.php'">Logout</button>
          </li>
        </ul>
        <?php
      }
      ?>
    </div>
  </div>
</nav>