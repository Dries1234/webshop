  <div data-product="<?php echo($id) ?>"  class="card article col-md-3">
    <img src="<?php echo($picture); ?>" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title"><?php echo($title); ?></h5>
      <p class="card-text">Price: €<?php echo($price)?></p>
      <?php
      if($page=="shop")
      {
      ?>
      <p class="card-text"><?php echo($description); ?></p>
      <button class="btn btn-primary add-cart">Add to cart</button>
      <?php
      }
      else if($page=="shoppingcart"){
        ?>
        <p class="card-text">Amount: <?php echo($amount)?></p>
        <button class="btn btn-danger remove-cart">Remove from cart</button>
      <?php
      }
      ?>
    </div>
  </div>