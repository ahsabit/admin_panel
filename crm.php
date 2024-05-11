<?php 
    require_once('db_login.inc.php');
    require_once('function.inc.php');

    $usrnm = $_SESSION['ADMIN_USERNAME'];
    $admn_log = $_SESSION['ADMIN_LOGIN'];
    
    if ($admn_log != "yes" || $usrnm == "") {
        header('location:login.php?from=crm.php');
        die();
    }

    $err_msg = '';
    if (isset($_POST['submit']) && $_POST['campaign-number'] != "") {
        $sql_camp = "select * from campaigns;";
        $result_camps = mysqli_query($connection,$sql_camp);
        while ($row_camps = mysqli_fetch_assoc($result_camps)) {
            $camp = $row_camps["total"];
        }
        if ($_POST['campaign-number'] >= $camp*(-1) || $_POST['campaign-number'] >= 0) {
            $campnum = get_safe_value($connection, $_POST['campaign-number']);
            $sql_add_camp = "update campaigns set total=total+".$campnum." where id=1;";
            mysqli_query($connection, $sql_add_camp);
        }else {
            $err_msg = "Please enter a valid campaign number";
        }
    }

    $i = 0;
    $totalExpenses = 0;
    $totalRevenue = 0;
    $sql_balance = "select * from balance_overview;";
    $result_balance = mysqli_query($connection,$sql_balance);

    while ($balance_rows = mysqli_fetch_assoc($result_balance)) {
        $month[] = $balance_rows['month'];
        $revenue[] = $balance_rows['revenue'];
        $totalRevenue += $revenue[$i];
        $expenses[] = $balance_rows['expenses'];
        $totalExpenses += $expenses[$i];
        $i++;
    }
    $profit = $totalRevenue - $totalExpenses;
    $monthly_revenue = this_month_data($month, $revenue);
    $monthly_expeses = this_month_data($month, $expenses);
    $daily_profit = floor(($monthly_revenue - $monthly_expeses)/30);

    $this_month = this_month($month);
    $sql_visits = "select * from analytics where month='".$this_month."';";
    $result_visits = mysqli_query($connection,$sql_visits);
    while ($row_visits = mysqli_fetch_assoc($result_visits)) {
        $visits = $row_visits["visits"];
        $vis = $visits;
        if ($visits == 0) {
            $vis = 1;
        }
        $users = $row_visits["user_num"];
    }
    $convertion = floor(($users/$vis)*100);

    $sql_camp = "select * from campaigns;";
    $result_camps = mysqli_query($connection,$sql_camp);
    while ($row_camps = mysqli_fetch_assoc($result_camps)) {
        $camp = $row_camps["total"];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/fontawesome-pro-5.15.3-web/css/all.css">
    <link rel="stylesheet" href="css/crm-style.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Admin Panel | Zelab</title>
</head>
<body>
    <?php require_once("slider.inc.php"); ?>
    <section class="main">
        <div class="main-wrapper">
            <?php require_once("header.inc.php"); ?>
            <div class="content-wrapper">
                <div class="main-numbers">
                    <div class="c-card">
                        <h5 class="c-head">
                            <span>campaigns sent</span>
                            <button class="campaign">Add</button>
                        </h5>
                        <div class="c-bottom">
                            <div class="c-left-side">
                                <i class="fas fa-rocket"></i>
                            </div>
                            <div class="c-right-middle">
                                <h2><?php echo $camp; ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="c-card">
                        <h5 class="c-head">
                            <span>anual profit</span>
                        </h5>
                        <div class="c-bottom">
                            <div class="c-left-side">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                            <div class="c-right-middle">
                                <h2>$<?php echo $profit; ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="c-card">
                        <h5 class="c-head">
                            <span>conversation rate</span>
                        </h5>
                        <div class="c-bottom">
                            <div class="c-left-side">
                                <i class="fas fa-heart-rate"></i>
                            </div>
                            <div class="c-right-middle">
                                <h2><?php echo $convertion; ?>%</h2>
                            </div>
                        </div>
                    </div>
                    <div class="c-card">
                        <h5 class="c-head">
                            <span>daily average income</span>
                        </h5>
                        <div class="c-bottom">
                            <div class="c-left-side">
                                <i class="fas fa-trophy"></i>
                            </div>
                            <div class="c-right-middle">
                                <h2>$<?php echo $daily_profit; ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="add-campaign">
                    <div class="add-campaign-wrapper">
                        <form action="crm.php" method="post">
                            <label for="campaign-number">Add Campaigns</label>
                            <input type="number" name="campaign-number" id="camp-num" required>
                            <input type="submit" name="submit" value="Add">
                        </form>
                    </div>
                    <img src="css/fontawesome-pro-5.15.3-web/svgs/solid/xmark.svg" class="cross">
                </div>
                <div class="graphs">
                    <div class="graph">
                        <div id="balance-overview" style="width: 1068px; height: 450px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php require_once("footer.inc.php");?>
    <span id="identity">crm</span>
    <script type="text/javascript">
        <?php 
            if ($err_msg != "") {
                echo "alert('".$err_msg."');";
            } 
        ?>
    </script>
    <script src="js/main.js"></script>
    <script src="js/crm.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <?php require_once("js/crm-graphs.js.php"); ?>
</body>
</html>
<?php mysqli_close($connection); ?>