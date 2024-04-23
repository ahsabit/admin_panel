<?php
    require_once('db_login.inc.php');
    require_once('function.inc.php');

    $usrnm = $_SESSION['ADMIN_USERNAME'];
    $admn_log = $_SESSION['ADMIN_LOGIN'];
    
    if ($admn_log != "yes" || $usrnm == "") {
        header('location:login.php?from=products.php');
        die();
    }

    if (isset($_GET['c-status']) && isset($_GET['product-id']) && isset($_GET['cr-status'])) {
        if ($_GET['c-status'] == "true" && $_GET['cr-status'] != "" && $_GET['product-id'] != "") {
            $prod_id = get_safe_value($connection ,$_GET['product-id']);
            $prod_stat = $_GET['cr-status'];
            if ($prod_stat == 0) {
                $sql_ch_status = "UPDATE products SET status=1 WHERE id=".$prod_id." ;";
            } else {
                $sql_ch_status = "UPDATE products SET status=0 WHERE id=".$prod_id." ;";
            }
            mysqli_query($connection, $sql_ch_status);
        }
    }
    
    if(isset($_POST['search'])){
        $search = get_safe_value($connection, $_POST['search']);
        if ($search != "") {
            $sql_products = "SELECT * FROM products WHERE id=".$search.";";
        }else {
            $sql_products = "SELECT * FROM products ORDER BY id DESC;";
        }
    }else {
        $sql_products = "SELECT * FROM products ORDER BY id DESC;";
    }
    $result_products = mysqli_query($connection, $sql_products);
    $products_qty = mysqli_num_rows($result_products);

    $sql_category = "SELECT * FROM categories;";
    $result_category = mysqli_query($connection, $sql_category);
    $j = 0;
    while ($rows_category = mysqli_fetch_assoc($result_category)) {
        $categories_id[] = $rows_category['id'];
        $categories[] = $rows_category['name'];
        $j++;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/fontawesome-pro-5.15.3-web/css/all.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/products-style.css">
    <title>Admin Panel | Zelab</title>
</head>
<body>
    <?php require_once("slider.inc.php"); ?>
    <section class="main">
        <div class="main-wrapper">
            <?php require_once("header.inc.php"); ?>
            <div class="content-wrapper">
                <div class="product-field">
                    <div class="product-field-head">
                        <form class="search-product" action="products.php" method="post">
                            <input type="number" min="0" name="search" placeholder="Search by Product ID">
                            <button class="fas fa-search"></button>
                        </form>
                        <a href="add-product.php" class="add-product">
                            <i class="fas fa-plus"></i>
                            <span>Add New</span>
                        </a>
                    </div>
                    <div class="product-field-body">
                        <table class="products">
                            <thead>
                                <tr>
                                    <th>Product ID</th>
                                    <th>Product</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Sale</th>
                                    <th>Status</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    while ($rows_products = mysqli_fetch_assoc($result_products)) {
                                        $i = 0;
                                        while ($j>0) {
                                            if ($categories_id[$i] == $rows_products["category_id"]) {
                                                break;
                                            }
                                            $i++;
                                            $j--;
                                        }
                                ?>
                                <tr>
                                    <td><?php echo $rows_products['id']; ?></td>
                                    <td><?php echo $rows_products['product_name']; ?></td>
                                    <td><?php echo $categories[$i]; ?></td>
                                    <td>$<?php echo $rows_products['price']; ?></td>
                                    <td><?php echo $rows_products['quantity']; ?></td>
                                    <td><?php echo $rows_products['sale']; ?></td>
                                    <?php
                                        if ($rows_products['status'] == 1) {
                                            $status_class = "green";
                                            $status_text = "Active";
                                        }else{
                                            $status_class = "red";
                                            $status_text = "Inactive";
                                        }
                                    ?>
                                    <td><a class="status <?php echo $status_class; ?>" href="products.php?c-status=true&product-id=<?php echo $rows_products['id']; ?>&cr-status=<?php echo $rows_products['status']; ?>"><?php echo $status_text; ?></a></td>
                                    <td>
                                        <a href="edit-product.php?edit=true&product-id=<?php echo $rows_products['id']; ?>" class="edit">Edit</a>
                                    </td>
                                </tr>
                                <?php } ?>
                                <?php 
                                    if($products_qty == 0){
                                ?>
                                <tr>
                                    <td>There is no listed product</td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php require_once("footer.inc.php");?>
    <span id="identity">products</span>
    <script src="js/main.js"></script>
    <script src="js/products.js"></script>
</body>
</html>
<?php mysqli_close($connection); ?>