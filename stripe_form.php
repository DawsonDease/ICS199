<?php require_once('./config.php'); ?>

<form action="charge.php" method="post">
  <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
          data-key="<?php echo $stripe['publishable_key']; ?>"
          data-description="Access for a year"
          data-amount="5000" // 5000 needs to be changed to cart total variable * 100 
          data-locale="auto"></script>
</form>