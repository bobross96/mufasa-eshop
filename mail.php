<?php 

include 'dbconnect.php';
include 'sessionPolice.php';

//trasnfer items from cart to order
$user_idINT = (int)$_SESSION['user_id'];




if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['order'] == "Confirm Payment"){
    
    //first check if exists address
    $address = $_POST['address'];
    $postalCode = $_POST['postalCode'];
    
    $checkAddressExist = "SELECT address,postal_code FROM users WHERE id = $user_idINT";
    $result = $db -> query($checkAddressExist);
    if ($result->num_rows == 0){
        //add new address into db
        $add_address = "INSERT INTO users (address,postal_code) VALUES ('$address','$postalCode') WHERE id = $user_idINT";
        $db ->query($add_address);
    } 

    else {
        // auto update user address
        $update_address = "UPDATE users SET address = '$address', postal_code = '$postalCode' WHERE id = $user_idINT";
        $db -> query($update_address);
    }

    $totalPrice = 0;
    foreach ($_SESSION['cart'] as $product_id => $quantity) {
        $productQuery = "SELECT * FROM products WHERE id = $product_id";
        $output = $db -> query($productQuery);
        $productInfo = $output -> fetch_assoc();
        $totalPrice += $quantity*$productInfo['price'];
    }
    
    //create new order in mufasa orders
    $insert_order = "INSERT INTO mufasa_orders VALUES (NULL,$user_idINT,CURRENT_TIMESTAMP,$totalPrice,'Created') ";
    $db->query($insert_order);
    //returns id of recently inserted row
    $order_id = $db->insert_id;

    
    

    $message = "Greetings from Mufasa Electronics ".$_SESSION['valid_user'].".\n";
    $message .= "We have received your order and will ship it as soon as possible.\n";
	$message .= "Below are your order details:\n";

    foreach ($_SESSION['cart'] as $product_id => $quantity) {
        $productQuery = "SELECT * FROM products WHERE id = $product_id";
        $output = $db -> query($productQuery);
        $productInfo = $output -> fetch_assoc();
        $message .= "\nProduct name: ".$productInfo['product_name']."\nQuantity: ".$quantity."\nSubtotal: $".$quantity*$productInfo['price']."\n";
        
        //insert into product orders table once order confirmed
        $insert_product_order = "INSERT INTO product_orders VALUES (NULL,$order_id,$product_id,$quantity)";
        $db->query($insert_product_order);
        //reduce stock for the item lol
        $updateStock = "UPDATE products SET stock = stock - $quantity WHERE id = $product_id ";
        $db -> query($updateStock);
    }
    $message .= "\nTotal Price: $".$totalPrice."\n\n";

    //unset cart session
    unset($_SESSION['cart']);

    //send mail 

    $message .= "Expected delivery date is: Whenever Cyberpunk 2077 launches\n";
    $message .= "Items will be sent to: ".$address.", Singapore ".$postalCode;
    $message .= "\nThanks for shopping with Mufasa, please order again before we go out of business.";
    
    $to = 'f37ee';
    $subject = 'Your order from Mufasa Electronics has been confirmed!';
    $headers = 'From: f32ee@localhost'."\r\n".'Reply-To: f32ee@localhost'."\r\n".'X-Mailer: PHP/'.phpversion();

    mail($to,$subject,$message,$headers);

    echo "<script>alert('Your order is successful, a confirmation email will be sent to you shortly.')</script>";
    echo "<script>location.href='order_history.php'</script>";

    

}



?>