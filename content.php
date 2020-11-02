<?php
include "dbconnect.php";

if (isset($_GET['search'])){
    $string = $_GET['search'];
    $noSpaceString = str_replace(' ', '', $string);
    $stringToSearch = "%".substr($noSpaceString,0,3)."%";
    $searchQuery = "SELECT * FROM products WHERE product_name LIKE '$stringToSearch' OR brand LIKE '$stringToSearch' OR category LIKE '$stringToSearch' ";
    $searchResult = $db->query($searchQuery);
    $result = array();
        foreach ($searchResult as $key => $value) {
            $result[$value['id']] = $value['price']; 
        }
    if (isset($_POST['sortType'])){
        switch ($_POST['sortType']) {
            case 'highToLow':
                $sortBy = 'highToLow';
                arsort($result);
                break;
            case 'lowToHigh':
                $sortBy = 'lowToHigh';
                asort($result);
                break;
            default;
                break;
        }
    }


   
}
else if((isset($_GET['type'])) || (isset($_GET['brand']))){
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
                
                $catResult = $db->query($query);
                $result = array();
                foreach ($catResult as $key => $value) {
                    $result[$value['id']] = $value['price']; 
                }
                //got sorting, will override the result from above
                if (isset($_POST['sortType'])){
                    switch ($_POST['sortType']) {
                        case 'highToLow':
                            $sortBy = 'highToLow';
                            arsort($result);
                            break;
                        case 'lowToHigh':
                            $sortBy = 'lowToHigh';
                            asort($result);
                            break;
                        default;
                            break;
                    }
                }
            
    }



else {
    
    $query = "SELECT * FROM products ";
    $catResult = $db->query($query);

    
    if (isset($_POST['sortType'])){
        $result = array();
        foreach ($catResult as $key => $value) {
            $result[$value['id']] = $value['price']; 
        }
        switch ($_POST['sortType']) {
            case 'highToLow':
                $sortBy = 'highToLow';
                arsort($result);
                break;
            case 'lowToHigh':
                $sortBy = 'lowToHigh';
                asort($result);
                break;
            default;
                break;
        }
    }

    else {
        $result = array();
        foreach ($catResult as $key => $value) {
            $result[$value['id']] = $value['price']; 
        }
    }
    
    #var_dump($result);

}
?>

<div class="listrightColumn">
    <!--  sorting bar above products   -->
    <div class="sorting-header" >
        <div>
            <!-- request url retains the query parameter -->
            <form action="<?php echo $_SERVER['REQUEST_URI']?>" method="POST">
            <label for="sortOption">Sort By:</label>
            <select name="sortType" id="sortOption" onchange="this.form.submit()">
            <option value="">Default</option>
                <option  value="lowToHigh" <?php if ($sortBy == 'lowToHigh') {echo 'selected';} ?>>Price low to high</option>
                <option  value="highToLow" <?php if ($sortBy == 'highToLow') {echo 'selected';} ?>>Price high to low</option>
            </select>
            </form>
            <br>
			<div class="searchValue">
            <?php
            foreach ($_GET as $key => $value) {
            ?>
                <span style="border:1px dimgray solid; padding : 10px;border-radius: 10px;"><?php echo $value; ?></span>
            <?php
            }
            ?>
			</div>

        </div>
    

    </div>
    <?php

    

    foreach ($result as $key => $value) {
        
        $productQuery = "SELECT * FROM products WHERE id = $key ";
        $productAll = $db->query($productQuery);
        $productInfo = $productAll -> fetch_assoc();
        

        echo "<div class='product'>";
        echo "<a href='product.php?id=".$productInfo['id']."'>";
        echo "<img class='product-image' src='images/productid".$productInfo['id'].".jpg' alt=''>";
        echo "<span class='product-desc' style='color: black; font-weight: bold'>".$productInfo['product_name']."</span><br>";
        echo "$","<class='product-price'>".$productInfo['price']."<br>";
        echo "</div>";
    }

    echo "</div>";
    
    ?>
</div>