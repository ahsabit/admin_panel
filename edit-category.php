<?php 
    require_once('db_login.inc.php');
    require_once('function.inc.php');
    $usrnm = $_SESSION['ADMIN_USERNAME'];
    $admn_log = $_SESSION['ADMIN_LOGIN'];
    if ($admn_log != "yes" || $usrnm == "") {
        header('location:login.php?from=category.php');
        die();
    }

    if ($_GET['edit'] == 'true' && $_GET['category-id'] != "") {
        $cate_id = get_safe_value($connection, $_GET['category-id']);
        if (isset($_POST['category-name']) && isset($_POST['submit'])) {
            if ($_POST['category-name'] != null) {
                $name = get_safe_value($connection, $_POST['category-name']);
                $sql_up_category = "UPDATE categories SET name='".$name."' WHERE id=".$cate_id.";";
                mysqli_query( $connection, $sql_up_category );
                header("location: category.php");
                die();
            }
        }
        if (isset($_POST['delete'])) {
            $sql_delete = "DELETE FROM categories WHERE id=".$cate_id.";";
            mysqli_query( $connection, $sql_delete );
            header("location:category.php");
            die();
        }
        $sql_category = "SELECT * FROM categories WHERE id=".$cate_id.";";
        $result = mysqli_query( $connection, $sql_category );
        while ($rows_category = mysqli_fetch_assoc($result)) {
            $name = $rows_category['name'];
        }
    } else {
        header("location: category.php");
        die();
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/fontawesome-pro-5.15.3-web/css/all.css">
    <link rel="stylesheet" href="css/add-category.css">
    <title>Admin Panel | Zelab</title>
</head>
<body>
    <header class="head">
        <h1>Add Category</h1>
        <div class="right-head">
            <a href="category.php">
                <span>Category</span>
            </a>
            <span>
                <i class="fas fa-greater-than"></i>
            </span>
            <span>Add Category</span>
        </div>
    </header>
    <section class="main">
        <form method="post">
            <div class="left-side side on-cate">
                <div class="fields">
                    <label for="category-name" class="productname">Product Name<span>*</span></label>
                    <input type="text" name="category-name" id="product-name" placeholder="Enter category name" value="<?php echo $name; ?>" required>
                <p>Do not exceed 20 characters when entering product name.</p>
                </div>
            </div>
            <div class="right-side side">
                <input type="submit" name="submit" value="Save" class="submit-btn">
            </div>
        </form>
        <form method="post" class="delete-wrapper">
            <input type="submit" name="delete" value="Delete" class="delete-btn">
        </form>
    </section>
    <?php require_once("footer.inc.php");?>
    <script src="js/add-product.js"></script>
</body>
</html>