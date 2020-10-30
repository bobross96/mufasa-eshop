if(isset($_GET['type'])){
    $category = $_GET['type'];
    //no sorting, will query as per normal
    $query = "SELECT * FROM products WHERE category = '$category'";
    $result = $db->query($query);

    //got sorting, will override the result from above
    if (isset($_POST['sortType'])){
        switch ($_POST['sortType']) {
            case 'highToLow':
                $sortBy = 'highToLow';
                $query = "SELECT * FROM products WHERE category IN ('$category') AND brand IN ('$brand') ORDER BY price DESC  ";
                $result = $db->query($query);
                break;
            case 'lowToHigh':
                $sortBy = 'lowToHigh';
                $query = "SELECT * FROM products WHERE category = '$category' ORDER BY price ASC ";
                $result = $db->query($query);
                break;
            default:

                break;
        }
    }
}

else if (isset($_GET['brand'])) {
    $brand = $_GET['brand'];
    $brandChecked = $_GET['brand'];
    //no sorting, will query as per normal
    $query = "SELECT * FROM products WHERE brand = '$brand'";
    $result = $db->query($query);

    //got sorting, will override the result from above
    if (isset($_POST['sortType'])){
        switch ($_POST['sortType']) {
            case 'highToLow':
                $sortBy = 'highToLow';
                
                $query = "SELECT * FROM products WHERE brand = '$brand' ORDER BY price DESC  ";
                $result = $db->query($query);
                break;
            case 'lowToHigh':
                $sortBy = 'lowToHigh';
                $query = "SELECT * FROM products WHERE brand = '$brand' ORDER BY price ASC ";
                $result = $db->query($query);
                break;
            default:

                break;
        }
    }
}