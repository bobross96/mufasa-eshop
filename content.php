<?php
include "dbconnect.php";

if((isset($_GET['type'])) || (isset($_GET['brand']))){
    $category = $_GET['type'];
    $brand = $_GET['brand'];
    //no sorting, will query as per normal
    $query = "SELECT * FROM products WHERE ";
                
                if (isset($_GET['type'])){
                   
                    $query .= "category IN ('$category') ";
                   
                }
                if ((isset($_GET['type'])) && (isset($_GET['brand']))){
                    $query .= "AND ";
                }
                if (isset($_GET['brand'])){
                    $query .= "brand IN ('$brand') ";
                }
                $query .= "ORDER BY price ASC";
                
                $result = $db->query($query);
    $result = $db->query($query);

    //got sorting, will override the result from above
    if (isset($_POST['sortType'])){

        switch ($_POST['sortType']) {
            case 'highToLow':
                $sortBy = 'highToLow';
                $query = "SELECT * FROM products WHERE ";
                
                if (isset($_GET['type'])){
                   
                    $query .= "category IN ('$category') ";
                   
                }
                if ((isset($_GET['type'])) && (isset($_GET['brand']))){
                    $query .= "AND ";
                }
                if (isset($_GET['brand'])){
                    $query .= "brand IN ('$brand') ";
                }
                $query .= "ORDER BY price DESC";

                $result = $db->query($query);
                break;
            case 'lowToHigh':
                $sortBy = 'lowToHigh';
                $query = "SELECT * FROM products WHERE ";
                
                if (isset($_GET['type'])){
                   
                    $query .= "category IN ('$category') ";
                   
                }
                if ((isset($_GET['type'])) && (isset($_GET['brand']))){
                    $query .= "AND ";
                }
                if (isset($_GET['brand'])){
                    $query .= "brand IN ('$brand') ";
                }
                $query .= "ORDER BY price ASC";
                $result = $db->query($query);
                break;
            default:

                break;
        }
    }
}



else {
    
    $query = "SELECT * FROM products ";
    $result = $db->query($query);

    
    if (isset($_POST['sortType'])){
        switch ($_POST['sortType']) {
            case 'highToLow':
                $sortBy = 'highToLow';
                $query = "SELECT * FROM products ORDER BY price DESC";
                $result = $db->query($query);
                break;
            case 'lowToHigh':
                $sortBy = 'lowToHigh';
                $query = "SELECT * FROM products ORDER BY price ASC";
                $result = $db->query($query);
                break;
            default:

                break;
        }
    }
    
    #var_dump($result);

}
?>

<div class="listrightColumn">
    <!--  sorting bar above products   -->
    <div class="sorting-header" >
        <div>
            <!-- request uri retains the query parameter -->
            <form action="<?php echo $_SERVER['REQUEST_URI']?>" method="POST">
            <label for="sortOption">Sort By:</label>
            <select name="sortType" id="sortOption" onchange="this.form.submit()">
            <option value="">Default</option>
                <option  value="lowToHigh" <?php if ($sortBy == 'lowToHigh') {echo 'selected';} ?>>Price low to high</option>
                <option  value="highToLow" <?php if ($sortBy == 'highToLow') {echo 'selected';} ?>>Price high to low</option>
            </select>
            </form>
        </div>
    

    </div>
    <?php
    
    foreach ($result as $value) {

        echo "<div class='product'>";
        echo "<a href='product.php?id=".$value['id']."'>";
        echo "<img class='product-image' src='images/productid".$value['id'].".jpg' alt=''>";
        echo "<span class='product-desc' style='color: black; font-weight: bold'>".$value['product_name']."</span><br>";
        echo "$","<class='product-price'>".$value['price']."<br>";
        echo "</div>";
    }

    echo "</div>";
    
    ?>
</div>