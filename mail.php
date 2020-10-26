<?php 

include 'dbconnect.php';
include 'sessionPolice.php';

//trasnfer items from cart to order
$user_idINT = (int)$_SESSION['user_id'];

// query all the orders depending on user id 
$query = "SELECT * FROM cart_product c,products p WHERE c.user_id = $user_idINT AND c.product_id = p.id"; 

$result = $db->query($query);

$totalPrice = 0;
$message = "Greetings from Mufasa E Shop ".$_SESSION['valid_user']."\n";
$message .= "Your order is below:\n";

foreach ($result as $value) {
    $cart_id = $value['id'];
    $totalPrice += $value['quantity']*$value['price'];
    $message .= "Product name: ".$value['product_name']." Quantity: ".$value['quantity']." Price:$ ".$value['quantity']*$value['price']."\n";

}
$message .= "Total Price:$ ".$totalPrice."\n";
$message .= "Expected delivery date is: -fakedate-\n";
$message .= "\nThanks for shopping with Mufasa, please order again we have unlimited stock";

$orders_query = "SELECT * FROM mufasa_orders";
$orders_result = $db->query($orders_query);

if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['order'] == 'Submit'){
    //add cart items to order
    //update first? if not create
    $insert_order = "INSERT INTO mufasa_orders VALUES (NULL,$user_idINT,CURRENT_TIMESTAMP,$totalPrice) ";
    
    $db->query($insert_order);
    // add invididual products into the product_orders table
    $order_id = $db->insert_id;
    foreach ($result as $value) {
        $product_idINT = (int)$value['product_id'];
        $quantityINT =(int)$value['quantity'];
        $insert_product_order = "INSERT INTO product_orders VALUES (NULL,$order_id,$product_idINT,$quantityINT)";
        $db->query($insert_product_order);
    }

    $cart_idINT = (int)$cart_id;
    //delete items from cart
    
    $to = 'f37ee';
    $subject = 'Mufasa e shop order details';
    $headers = 'From: f32ee@localhost'."\r\n".'Reply-To: f32ee@localhost'."\r\n".'X-Mailer: PHP/'.phpversion();

    mail($to,$subject,$message,$headers);
    
    
    $delete = "DELETE FROM cart_product WHERE user_id=$user_idINT";
    $db->query($delete);

    echo "<script>alert('successfully ordered, an email as been sent to the user')</script>";
    echo "<script>location.href='order_history.php'</script>";

    



}




?>