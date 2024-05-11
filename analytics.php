<?php
    require_once('db_login.inc.php');
    require_once('function.inc.php');
    $usrnm = $_SESSION['ADMIN_USERNAME'];
    $admn_log = $_SESSION['ADMIN_LOGIN'];
    if ($admn_log != "yes" || $usrnm == "") {
        header('location:login.php?from=analytics.php');
        die();
    }
    
    $sql_analytics = 'select * from analytics;';
    $ana_result = mysqli_query($connection, $sql_analytics);
    $i = 0;
    while ($ana_rows = mysqli_fetch_assoc($ana_result)) {
        $month[] = nullFinder($ana_rows['month']);
        $user_number[] = nullFinder($ana_rows['user_num']);
        $visits[] = nullFinder($ana_rows['visits']);
        $visits_dur[] = nullFinder($ana_rows['visits_dur']);
        $bounces[] = nullFinder($ana_rows['bounces']);
        $i++;
    }
    $sql_ana_device = "select * from devices where month='".this_month($month)."';";
    $ana_device_result = mysqli_query($connection, $sql_ana_device);
    $sql_ana_visits_per_hour = "select * from visits_per_hour;";
    $ana_visits_per_hour_result = mysqli_query($connection, $sql_ana_visits_per_hour);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/fontawesome-pro-5.15.3-web/css/all.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/analytics-style.css">
    <title>Admin Panel | Zelab</title>
</head>
<body>
    <?php require_once("slider.inc.php"); ?>
    <section class="main">
        <div class="main-wrapper">
            <?php require_once("header.inc.php"); ?>
            <div class="content-wrapper">
                <div class="row">
                    <div class="col">
                        <div class="rowler">
                            <a href="#usr_metr">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-info">
                                            <p class="up">users</p>
                                            <h2><?php echo this_month_data($month, $user_number); ?></h2>
                                            <p class="bottom">
                                                <?php 
                                                    $unno = pv_vs_this_month_data($month, $user_number);
                                                    if ($unno < 0) {
                                                        $unno = $unno*(-1);
                                                        $icon = "fa-arrow-down";
                                                        $ind = "red-ind";
                                                    }else {
                                                        $icon = "fa-arrow-up";
                                                        $ind = "green-ind";
                                                    }
                                                ?>
                                                <span class="<?php echo $ind; ?>"><i class="fas <?php echo $icon; ?>"></i> <?php echo $unno; ?>%</span> vs. previous month
                                            </p>
                                        </div>
                                        <div class="icons">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="iconing">
                                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                                <circle cx="9" cy="7" r="4"></circle>
                                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="#web_perf">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-info">
                                            <p class="up">visit</p>
                                            <h2><?php echo this_month_data($month, $visits); ?></h2>
                                            <p class="bottom">
                                                <?php
                                                    $unno = pv_vs_this_month_data($month, $visits);
                                                    if ($unno < 0) {
                                                        $unno = $unno*(-1);
                                                        $icon = "fa-arrow-down";
                                                        $ind = "red-ind";
                                                    }else {
                                                        $icon = "fa-arrow-up";
                                                        $ind = "green-ind";
                                                    }
                                                ?>
                                                <span class="<?php echo $ind; ?>"><i class="fas <?php echo $icon; ?>"></i> <?php echo $unno; ?>%</span> vs. previous month
                                            </p>
                                        </div>
                                        <div class="icons">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="iconing">
                                                <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="rowler">
                            <a href="#visit_dur">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-info">
                                            <p class="up">avg. visit duration</p>
                                            <h2><?php echo this_month_data($month, $visits_dur); ?>m</h2>
                                            <p class="bottom">
                                                <?php 
                                                    $unno = pv_vs_this_month_data($month, $visits_dur);
                                                    if ($unno < 0) {
                                                        $unno = $unno*(-1);
                                                        $icon = "fa-arrow-down";
                                                        $ind = "red-ind";
                                                    }else {
                                                        $icon = "fa-arrow-up";
                                                        $ind = "green-ind";
                                                    }
                                                ?>
                                                <span class="<?php echo $ind; ?>"><i class="fas <?php echo $icon; ?>"></i> <?php echo $unno; ?>%</span> vs. previous month
                                            </p>
                                        </div>
                                        <div class="icons">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="iconing">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <polyline points="12 6 12 12 16 14"></polyline>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="#web_perf">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-info">
                                            <p class="up">bounce</p>
                                            <h2><?php echo this_month_data($month, $bounces); ?></h2>
                                            <p class="bottom">
                                                <?php
                                                    $unno = pv_vs_this_month_data($month, $bounces);
                                                    if ($unno < 0) {
                                                        $unno = $unno*(-1);
                                                        $icon = "fa-arrow-down";
                                                        $ind = "red-ind";
                                                    }else {
                                                        $icon = "fa-arrow-up";
                                                        $ind = "green-ind";
                                                    }
                                                ?>
                                                <span class="<?php echo $ind; ?>"><i class="fas <?php echo $icon; ?>"></i> <?php echo $unno; ?>%</span> vs. previous month
                                            </p>
                                        </div>
                                        <div class="icons">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="iconing">
                                                <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                                                <polyline points="15 3 21 3 21 9"></polyline>
                                                <line x1="10" y1="14" x2="21" y2="3"></line>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col">
                        <div class="rowler">
                            <div class="cold">
                                <div id="web_perf" style="width: 29.08rem; height: 14.76rem"></div>
                            </div>
                            <div class="cold">
                                <div id="visit_dur" style="width: 29.08rem; height: 14.76rem"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="rowler">
                        <div class="cold">
                            <div id="device_metr" style="width: 29.08rem; height: 27.22rem"></div>
                        </div>
                        <div class="cold">
                            <div id="visit_by_hour" style="width: 29.08rem; height: 27.22rem"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="cold">
                        <div id="usr_metr" style="width: 59.33rem; height: 27.22rem"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php require_once("footer.inc.php");?>
    <span id="identity">analytics</span>
    <script src="js/main.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <?php require_once('js/analytics-graphs.js.php'); ?>
</body>
</html>
<?php mysqli_close($connection); ?>
