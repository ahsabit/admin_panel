<?php
    require_once('db_login.inc.php');
    require_once('function.inc.php');
    $usrnm = $_SESSION['ADMIN_USERNAME'];
    $admn_log = $_SESSION['ADMIN_LOGIN'];
    if ($admn_log != "yes" || $usrnm == "") {
        header('location:login.php?from=add-product.php');
        die();
    }

    if (isset($_POST['submit']) && $_POST['product-name'] != null) {
        $sql_product = "SELECT * FROM products ORDER BY id DESC LIMIT 1;";
        $result = mysqli_query($connection, $sql_product);
        while ($rows_product = mysqli_fetch_assoc($result)) {
            $pro_name = $rows_product['product_name'];
            $pro_img = $rows_product['image_6'];
            $pro_id = $rows_product['id'];
        }
        if ($pro_name == null && $pro_img != null) {
            $name = get_safe_value($connection, $_POST['product-name']);
            $category = get_safe_value($connection, $_POST['category']);
            $price = get_safe_value($connection, $_POST['price']);
            $qty = get_safe_value($connection, $_POST['qty']);
            $gender = get_safe_value( $connection, $_POST['gender']);
            $brand = get_safe_value($connection, $_POST['brand']);
            $meta_key = get_safe_value($connection, $_POST['meta_key']);
            $meta_desc = get_safe_value($connection, $_POST['meta_desc']);
            $desc = get_safe_value($connection, $_POST['description']);

            $sql_up_product = "UPDATE products SET product_name='".$name."', category_id=".$category.", price=".$price.", quantity=".$qty.", sale=0, status=1, gender=".$gender.", brand='".$brand."', meta_keys='".$meta_key."', meta_desc='".$meta_desc."', description='".$desc."' WHERE id=".$pro_id." ;";
            mysqli_query( $connection, $sql_up_product );
            header("location:products.php");
            die();
        }
    }

    $sql_category = "SELECT * FROM categories where status=1;";
    $result_category = mysqli_query($connection, $sql_category);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/fontawesome-pro-5.15.3-web/css/all.css">
    <link rel="stylesheet" href="css/add-products.css">
    <title>Admin Panel | Zelab</title>
</head>
<body>
    <header class="head">
        <h1>Add Product</h1>
        <div class="right-head">
            <a href="products.php">
                <span>Products</span>
            </a>
            <span>
                <i class="fas fa-greater-than"></i>
            </span>
            <span>Add Product</span>
        </div>
    </header>
    <section class="main">
        <form method="post" enctype="multipart/form-data">
            <div class="left-side side">
                <div class="fields">
                    <label for="product-name" class="productname">Product Name<span>*</span></label>
                    <input type="text" name="product-name" id="product-name" placeholder="Enter product name" required>
                    <p>Do not exceed 156 characters when entering product name.</p>
                </div>
                <div class="fields">
                    <label for="price" class="price">Price<span>*</span></label>
                    <input type="number" min="0" name="price" id="price" placeholder="Enter price" required>
                </div>
                <div class="fields selection">
                    <div class="select-f">
                        <label for="category" class="categor">Category<span>*</span></label>
                        <select name="category" id="category" required>
                            <option value="">Choose a category</option>
                            <?php
                                while ($rows_category = mysqli_fetch_assoc($result_category)){
                            ?>
                            <option value="<?php echo $rows_category['id']; ?>"><?php echo $rows_category['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="select-f">
                        <label for="gender" class="gendr">Gender<span>*</span></label>
                        <select name="gender" id="gender" required>
                            <option value="1">All</option>
                            <option value="2">Male</option>
                            <option value="3">Female</option>
                        </select>
                    </div>
                </div>
                <div class="fields">
                    <label for="qty" class="qty">Quantity<span>*</span></label>
                    <input type="number" min="0" name="qty" id="qty" placeholder="Enter quantity" required>
                </div>
                <div class="fields">
                    <label for="brand" class="brnd">Brand<span>*</span></label>
                    <input type="text" name="brand" id="brand" placeholder="Enter brand name" required>
                    <p>Do not exceed 56 characters when entering brand.</p>
                </div>
                <div class="fields">
                    <label for="meta_key" class="meta_cow">Meta Keywords<span>*</span></label>
                    <input type="text" name="meta_key" id="meta_key" placeholder="Enter meta keywords" required>
                </div>
                <div class="fields">
                    <label for="meta_desc" class="meta_desc">Meta Description<span>*</span></label>
                    <textarea name="meta_desc" id="meta_desc" cols="30" rows="5" placeholder="Meta Description" required></textarea>
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
                    <textarea name="description" id="description" cols="30" rows="5" placeholder="Description" required></textarea>
                </div>
                <input type="submit" name="submit" value="Save" class="submit-btn">
            </div>
        </form>
    </section>
    <?php require_once("footer.inc.php");?>
    <script src="js/add-product.js"></script>
</body>
</html>