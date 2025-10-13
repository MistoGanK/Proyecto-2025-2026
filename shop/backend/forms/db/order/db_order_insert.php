<!-- Header -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/header.php'); ?>

<!-- HTML -->
<h1>db_order_insert</h1>
<p>You Inserted: </p>

<?php
// Test
//print_r($_POST); // Debug 

// Variables
$order_id_order = $_POST['order_id_order'];
$order_id_customer = $_POST['order_id_customer'];
$order_id_product = $_POST['order_id_product'];
$order_id_payment_method = $_POST['order_id_payment_method'];
$order_qty = $_POST['order_qty'];
$order_unit_price;
$order_total;
$order_discount_rate = $_POST['order_discount_rate']/100;

// Save the key on an associative array

$product_variables = [
    'order_id_order' => $order_id_order,
    'order_id_customer' => $order_id_customer,
    'order_id_product' => $order_id_product,
    'order_id_payment_method' => $order_id_payment_method,
    'order_qty' => $order_qty,
    'order_discount_rate' => $order_discount_rate,
];
// Query the unit price
$order_unit_price_query = "
    SELECT price 
    FROM products 
    WHERE id_product = $order_id_product;
    ";
// Connection
include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/config/connection.php'); 

$order_unit_price_query_result = mysqli_query($conn,$order_unit_price_query);
if($order_unit_price_query_result){
    if (mysqli_num_rows($order_unit_price_query_result)>0){
        $row = mysqli_fetch_assoc($order_unit_price_query_result);
        $order_unit_price = $row['price'];

        $order_total = ($order_qty * $order_unit_price)*(1-$order_discount_rate);
    }else{
        $order_unit_price = 0;
        echo "Error: Product with ID $order_id_product not found.";
    }
   
}else{
   echo "SQL Query Error: ".mysqli_error($conn);
}

// SQL INSERT INTO

// Usa VALUES directamente con las variables que ya calculaste
$sql = "
INSERT INTO orders (id_order,id_customer, id_product, id_payment_method, qty, unit_price, total, discount)
VALUES (
    '$order_id_order',
    '$order_id_customer',
    '$order_id_product',
    '$order_id_payment_method',
    '$order_qty',
    '$order_unit_price',
    '$order_total',
    '$order_discount_rate'
);";

// Connection 
include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/config/connection.php');
if($sql){
    
}else{
    echo "SQL query Error".mysqli_error($conn);
}

//mysqli_query
if (mysqli_query($conn, $sql)) {
    echo "<p>Order incerted succesfully:</p>";
    echo
    "<ul>
    <li>Order ID: $order_id_order</li>
    <li>Order customer ID: $order_id_customer</li>
    <li>Product ID: $order_id_product</li>
    <li>Payment Method ID: $order_id_payment_method</li>
    <li>Order qty: $order_qty</li> 
    <li>Order unit price: $order_unit_price</li> 
    <li>Discount: $order_discount_rate</li> 
    <li>Order total: $order_total</li> 
</ul>";
} else {
    echo "<p>Error al insertar el producto: " . mysqli_error($conn) . "</p>";
}

// Close connection
mysqli_close($conn);
// Send confirmation
?>

<!-- Footer -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/footer.php'); ?>