<?php
    require_once('db_login.inc.php');
    require_once('function.inc.php');
    $usrnm = $_SESSION['ADMIN_USERNAME'];
    $admn_log = $_SESSION['ADMIN_LOGIN'];
    if ($admn_log != "yes" || $usrnm == "") {
        header('location:login.php?from=category.php');
        die();
    }

    if (isset($_GET['c-status']) && isset($_GET['category-id']) && isset($_GET['cr-status'])) {
        if ($_GET['c-status'] == "true" && $_GET['cr-status'] != "" && $_GET['category-id'] != "") {
            $cate_id = get_safe_value($connection ,$_GET['category-id']);
            $cate_stat = $_GET['cr-status'];
            if ($cate_stat == 0) {
                $sql_ch_status = "UPDATE categories SET status=1 WHERE id=".$cate_id." ;";
            } else {
                $sql_ch_status = "UPDATE categories SET status=0 WHERE id=".$cate_id." ;";
            }
            mysqli_query($connection, $sql_ch_status);
        }
    }
    
    if(isset($_POST['search'])){
        $search = get_safe_value($connection, $_POST['search']);
        if ($search != "") {
            $sql_category = "SELECT * FROM categories WHERE id=".$search.";";
        }else {
            $sql_category = "SELECT * FROM categories ORDER BY id DESC;";
        }
    }else {
        $sql_category = "SELECT * FROM categories ORDER BY id DESC;";
    }
    $result_category = mysqli_query($connection, $sql_category);
    $cata_qty = mysqli_num_rows($result_category);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/fontawesome-pro-5.15.3-web/css/all.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/category-style.css">
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
                        <form class="search-product" action="category.php" method="post">
                            <input type="number" min="0" name="search" placeholder="Search by Category ID">
                            <button class="fas fa-search"></button>
                        </form>
                        <a href="add-category.php" class="add-product">
                            <i class="fas fa-plus"></i>
                            <span>Add New</span>
                        </a>
                    </div>
                    <div class="product-field-body">
                        <table class="products">
                            <thead>
                                <tr>
                                    <th>Category ID</th>
                                    <th>Category</th>
                                    <th>Sale</th>
                                    <th>Status</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    while ($rows_category = mysqli_fetch_assoc($result_category)) {
                                ?>
                                <tr>
                                    <td><?php echo $rows_category['id']; ?></td>
                                    <td><?php echo $rows_category['name']; ?></td>
                                    <td><?php echo $rows_category['sale']; ?></td>
                                    <?php 
                                        if ($rows_category['status'] == 1) {
                                            $status_text = "Active";
                                            $status_class = "green";
                                        }else {
                                            $status_text = "Inactive";
                                            $status_class = "red";
                                        }
                                    ?>
                                    <td><a href="category.php?c-status=true&category-id=<?php echo $rows_category['id']; ?>&cr-status=<?php echo $rows_category['status']; ?>" class="status <?php echo $status_class; ?>"><?php echo $status_text; ?></a></td>
                                    <td>
                                        <a href="edit-category.php?edit=true&category-id=<?php echo $rows_category['id']; ?>" class="edit">Edit</a>
                                    </td>
                                </tr>
                                <?php } ?>
                                <?php 
                                    if ($cata_qty == 0) {
                                ?>
                                <tr>
                                    <td>There is no listed category.</td>
                                </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php require_once("footer.inc.php");?>
    <span id="identity">category</span>
    <script src="js/main.js"></script>
    <script src="js/category.js"></script>
</body>
</html>