<link rel="icon" href="/student022/shop/backend/assets/icons/faviconBlack.png" type="image/png">
<?php 
  if (isset($_SESSION['id_customer'])){
      $id_customer = $_SESSION['id_customer'];
  }
  
  if (isset($_SESSION['role']) && $_SESSION['role'] !== 'Guest') {
    echo '<form class="w-full h-full" action="/student022/shop/backend/forms/db/shopping_cart/db_shopping_cart_checkout.php" method="post">';
      echo '<input type="number" id="id_customer" name="id_customer" value="' . $id_customer . '" hidden="true">';
      echo '<input class="w-full h-full cursor-pointer" type="submit" id="send" name="send" value="Checkout">';
    echo '</form>';
  }else{
    echo "<a class='w-full h-full cursor-pointer' href='/student022/shop/backend/autentification/login.php'> Log in";
    echo '</a>';
    
  }
?>