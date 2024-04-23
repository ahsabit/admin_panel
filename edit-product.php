<?php
    require_once('db_login.inc.php');
    require_once('function.inc.php');
    $usrnm = $_SESSION['ADMIN_USERNAME'];
    $admn_log = $_SESSION['ADMIN_LOGIN'];
    if ($admn_log != "yes" || $usrnm == "") {
        header('location:login.php?from=products.php');
        die();
    }

    if ($_GET['edit'] == 'true' && $_GET['product-id'] != null) {
        $pro_id = get_safe_value($connection, $_GET['product-id']);
        $_SESSION['CAHNGE_ID'] = $pro_id;
        $_SESSION['CHANGE_NUM'] = 1;
        $sql_product = "SELECT * FROM products WHERE id=".$pro_id.";";
        $result = mysqli_query($connection, $sql_product);
        if(isset($_POST['delete'])){
            $sql_delete = "DELETE FROM products WHERE id=".$pro_id.";";
            mysqli_query( $connection, $sql_delete );
            header("location: products.php");
            die();
        }
        while($rows_product = mysqli_fetch_assoc($result)) {
            $product_name = $rows_product["product_name"];
            $product_cte_id = $rows_product["category_id"];
            $product_price = $rows_product["price"];
            $product_qty = $rows_product["quantity"];
            $product_gender = $rows_product["gender"];
            $product_brand = $rows_product["brand"];
            $product_meta_keys = $rows_product["meta_keys"];
            $product_meta_desc = $rows_product["meta_desc"];
            $product_desc = $rows_product["description"];
        }
        if (isset($_POST['submit']) && $pro_id != null) {
            $name = get_safe_value($connection, $_POST['product-name']);
            $category = get_safe_value($connection, $_POST['category']);
            $price = get_safe_value($connection, $_POST['price']);
            $qty = get_safe_value($connection, $_POST['qty']);
            $gender = get_safe_value( $connection, $_POST['gender']);
            $brand = get_safe_value($connection, $_POST['brand']);
            $meta_key = get_safe_value($connection, $_POST['meta_key']);
            $meta_desc = get_safe_value($connection, $_POST['meta_desc']);
            $desc = get_safe_value($connection, $_POST['description']);

            $sql_up_product = "UPDATE products SET product_name='".$name."', category_id=".$category.", price=".$price.", quantity=".$qty.", gender=".$gender.", brand='".$brand."', meta_keys='".$meta_key."', meta_desc='".$meta_desc."', description='".$desc."' WHERE id=".$pro_id." ;";
            mysqli_query( $connection, $sql_up_product );
            header("location:products.php");
            die();
        }
    }else{
        header("location:products.php");
        die();
    }

    $sql_category = "SELECT * FROM categories;";
    $result_category = mysqli_query($connection, $sql_category);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/fontawesome-pro-5.15.3-web/css/all.css">
    <link rel="stylesheet" href="css/edit-products.css">
    <title>Admin Panel | Zelab</title>
</head>
<body>
    <header class="head">
        <h1>Edit Product</h1>
        <div class="right-head">
            <a href="products.php">
                <span>Products</span>
            </a>
            <span>
                <i class="fas fa-greater-than"></i>
            </span>
            <span>Edit Product</span>
        </div>
    </header>
    <section class="main">
        <form method="post" enctype="multipart/form-data">
            <div class="left-side side">
                <div class="fields">
                    <label for="product-name" class="productname">Product Name<span>*</span></label>
                    <input type="text" name="product-name" id="product-name" placeholder="Enter product name" value="<?php echo $product_name; ?>" required>
                    <p>Do not exceed 156 characters when entering product name.</p>
                </div>
                <div class="fields">
                    <label for="price" class="price">Price<span>*</span></label>
                    <input type="number" min="0" name="price" id="price" placeholder="Enter price" value="<?php echo $product_price; ?>" required>
                </div>
                <div class="fields selection">
                    <div class="select-f">
                        <label for="category" class="categor">Category<span>*</span></label>
                        <select name="category" id="category" required>
                            <option value="">Choose a category</option>
                            <?php
                                while ($rows_category = mysqli_fetch_assoc($result_category)){
                            ?>
                            <option value="<?php echo $rows_category['id']; ?>" <?php if($rows_category['id'] == $product_cte_id) echo 'selected'; ?>><?php echo $rows_category['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="select-f">
                        <label for="gender" class="gendr">Gender<span>*</span></label>
                        <select name="gender" id="gender" required>
                            <option value="1" <?php if($product_gender == 1) echo 'selected'; ?>>All</option>
                            <option value="2" <?php if($product_gender == 2) echo 'selected'; ?>>Male</option>
                            <option value="3" <?php if($product_gender == 3) echo 'selected'; ?>>Female</option>
                        </select>
                    </div>
                </div>
                <div class="fields">
                    <label for="qty" class="qty">Quantity<span>*</span></label>
                    <input type="number" min="0" name="qty" id="qty" placeholder="Enter quantity" value="<?php echo $product_qty; ?>" required>
                </div>
                <div class="fields">
                    <label for="brand" class="brnd">Brand<span>*</span></label>
                    <input type="text" name="brand" id="brand" placeholder="Enter brand name" value="<?php echo $product_brand; ?>" required>
                    <p>Do not exceed 56 characters when entering brand.</p>
                </div>
                <div class="fields">
                    <label for="meta_key" class="meta_cow">Meta Keywords<span>*</span></label>
                    <input type="text" name="meta_key" id="meta_key" placeholder="Enter meta keywords" value="<?php echo $product_meta_keys; ?>" required>
                </div>
                <div class="fields">
                    <label for="meta_desc" class="meta_desc">Meta Description<span>*</span></label>
                    <textarea name="meta_desc" id="meta_desc" cols="30" rows="5" placeholder="Meta Description: <?php echo $product_meta_desc; ?>" required></textarea>
                </div>
            </div>
            <div class="right-side side">
                <div class="image-uploader">
                    <header>Upload Images</header>
                    <div class="form">
                        <input type="file" name="image" id="image" hidden required>
                        <i class="fas fa-cloud-upload-alt"></i>
                        <p>Browse Images to Upload</p>
                    </div>
                    <div class="hidden"></div>
                    <div class="progress-area">
                        <li class="row">
                            <i class="fas fa-file-alt"></i>
                            <div class="content">
                                <div class="details">
                                    <span class="name"></span>
                                    <span class="percent"></span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress"></div>
                                </div>
                            </div>
                        </li>
                    </div>
                    <div class="uploaded-area"></div>
                </div>
                <p>You need to upload exactly 6 images. Pay attention to the quality of the pictures you add, comply with the background color standards. Pictures must be in certain dimensions. Notice that the product shows all the details.</p>
                <div class="fields">
                    <label for="description" class="desc">Description<span>*</span></label>
                    <textarea name="description" id="description" cols="30" rows="5" placeholder="Description: <?php echo $product_desc; ?>" required></textarea>
                </div>
                <input type="submit" name="submit" value="Save" class="submit-btn">
            </div>
        </form>
        <form method="post" class="delete-wrapper">
            <input type="submit" name="delete" value="Delete" class="delete-btn">
        </form>
    </section>
    <?php require_once("footer.inc.php");?>
    <script src="js/edit-product.js"></script>
</body>
</html>