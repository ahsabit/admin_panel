<?php 
    require_once('db_login.inc.php');
    require_once('function.inc.php');

    $usrnm = $_SESSION['ADMIN_USERNAME'];
    $admn_log = $_SESSION['ADMIN_LOGIN'];
    
    if ($admn_log != "yes" || $usrnm == "") {
        header('location:login.php?from=orders.php');
        die();
    }

    if (isset($_GET['id']) && isset($_GET['status'])) {
        if ($_GET['id'] != "" && $_GET['status'] != "" && $_GET['change-status'] == "yes") {
            $cn_id = get_safe_value($connection, $_GET['id']);
            $cn_status = get_safe_value($connection, $_GET['status']);
            $cn_stat = get_safe_value($connection, $_GET['change-status']);
            switch ($cn_status) {
                case 1:
                    $sql_cn = "UPDATE orders SET status=2 WHERE id=".$cn_id.";";
                    break;

                case 2:
                    $sql_cn = "UPDATE orders SET status=3 WHERE id=".$cn_id.";";
                    break;
                
                default:
                    $sql_cn = "UPDATE orders SET status=1 WHERE id=".$cn_id.";";
                    break;
            }
            mysqli_query( $connection, $sql_cn );
        }
    }

    $err_msg = "";

    if(isset($_POST['submit'])){
        $pro_id = get_safe_value($connection, $_POST['order-id']);
        $pro_num = get_safe_value($connection, $_POST['new-percent']);
        if ($pro_id != '' && $pro_num != '') {
            $sql_pro = "UPDATE orders SET progress=".$pro_num." WHERE id=".$pro_id.";";
            mysqli_query( $connection, $sql_pro );
        }
    }

    if(isset($_POST['search'])){
        $search = get_safe_value($connection, $_POST['search']);
        if ($search != "") {
            $sql_orders = "SELECT * FROM orders WHERE id=".$search.";";
        }else {
            $sql_orders = "SELECT * FROM orders ORDER BY id DESC;";
        }
    }else {
        $sql_orders = "SELECT * FROM orders ORDER BY id DESC;";
    }
    $result_orders = mysqli_query($connection, $sql_orders);
    $orders_qty = mysqli_num_rows($result_orders);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/fontawesome-pro-5.15.3-web/css/all.css">
    <link rel="stylesheet" href="css/orders-style.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Admin Panel | Zelab</title>
</head>
<body>
    <?php require_once("slider.inc.php"); ?>
    <section class="main">
        <div class="main-wrapper">
            <?php require_once("header.inc.php"); ?>
            <div class="content-wrapper">
                <div class="product-field-head">
                    <form class="search-product" action="orders.php" method="post">
                        <input type="number" min="0" name="search" placeholder="Search by Order ID">
                        <button class="fas fa-search"></button>
                    </form>
                </div>
                <table class="deal-info">
                    <thead>
                        <tr>
                            <th>Order Id</th>
                            <th>Product ID</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Progress</th>
                            <th>Status</th>
                            <th>Deal Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            while ($rows_orders = mysqli_fetch_assoc($result_orders)) {
                        ?>
                        <tr>
                            <td><?php 
                                    $id = $rows_orders['id'];
                                    echo $id; 
                                ?></td>
                            <td><?php echo $rows_orders['product_id']; ?></td>
                            <td><?php echo $rows_orders['customer_name']; ?></td>
                            <td><?php echo $rows_orders['address']; ?></td>
                            <td class="pro-td">
                                <button class="progress-num" style="z-index: <?php echo $id; ?>"><?php echo $rows_orders['progress']; ?>%</button>
                                <div class="progress-bar">
                                    <div class="progress" style="width: <?php echo $rows_orders['progress']; ?>%;"></div>
                                </div>
                            </td>
                            <td style="padding:0;">
                                <?php 
                                    switch ($rows_orders['status']) {
                                        case 1:
                                            $span_class = "intro";
                                            $span_text = "Processing";
                                            break;

                                        case 2:
                                            $span_class = "won";
                                            $span_text = "Completed";
                                            break;
                                        
                                        default:
                                            $span_class = "stuck";
                                            $span_text = "Canceled";
                                            break;
                                    }
                                ?>
                                <a class="<?php echo $span_class; ?>" href="<?php echo "orders.php?id=".$id."&status=".$rows_orders['status']."&change-status=yes"; ?>" style="text-decoration:none;"><?php echo $span_text; ?></a>
                            </td>
                            <td>$<?php echo $rows_orders['price']; ?></td>
                        </tr>
                        <?php } ?>
                        <?php 
                            if($orders_qty == 0){
                        ?>
                        <tr>
                            <td>There is no listed order</td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="add-campaign">
                    <div class="add-campaign-wrapper">
                        <form action="orders.php" method="post">
                            <label for="camp-num">Change Progress</label>
                            <input type="number" min="0" max="100" name="new-percent" id="camp-num" required>
                            <input type="text" name="order-id" id="order-id" hidden required>
                            <input type="submit" name="submit" value="Change">
                        </form>
                    </div>
                    <img src="css/fontawesome-pro-5.15.3-web/svgs/solid/xmark.svg" class="cross">
                </div>
            </div>
        </div>
    </section>
    <?php require_once("footer.inc.php");?>
    <span id="identity">orders</span>
    <script src="js/main.js"></script>
    <script src="js/orders.js"></script>
    <script type="text/javascript">
        <?php 
            if ($err_msg != "") {
                echo "alert('".$err_msg."');";
            } 
        ?>
    </script>
</body>
</html>
<?php mysqli_close($connection); ?>