  <?php
  include_once("handler.php");
  ?>
  <div data-product="<?php echo($id) ?>"  class="card article col-md-3">
    <img src="<?php echo($picture); ?>" class="card-img-top img-fluid" alt="...">
    <div class="card-body">
      <h5 class="card-title"><?php echo($title); ?></h5>
      <p class="card-text">Price: €<?php echo($price)?></p>
      <p class="card-text"><?php echo($description); ?></p>
      <button class="btn btn-primary add-cart">Add to cart</button>
    </div>
  </div>