<link rel="icon" href="/student022/backend/assets/icons/faviconBlack.png" type="image/png">
<form action="/student022/backend/forms/customers/form_customer_delete.php" method="post">
     <input type="number" id="id_customer" name="id_customer" value="<?php echo $id_customer; ?>" hidden="true">
     <input class="w-full h-full cursor-pointer" width="100%" type="submit" id="send" name="send" value="Delete">
</form>