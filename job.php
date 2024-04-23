<?php
    require_once('db_login.inc.php');
    require_once('function.inc.php');
    $usrnm = $_SESSION['ADMIN_USERNAME'];
    $admn_log = $_SESSION['ADMIN_LOGIN'];
    if ($admn_log != "yes" || $usrnm == "") {
        header('location:login.php?from=job.php');
        die();
    }

    if (isset($_GET['c-status']) && isset($_GET['job-id']) && isset($_GET['cr-status'])) {
        if ($_GET['c-status'] == "true" && $_GET['cr-status'] != "" && $_GET['job-id'] != "") {
            $job_id = get_safe_value($connection ,$_GET['job-id']);
            $job_stat = get_safe_value($connection, $_GET['cr-status']);
            if ($job_stat == 0) {
                $sql_ch_status = "UPDATE jobs SET status=1 WHERE id=".$job_id." ;";
            } else {
                $sql_ch_status = "UPDATE jobs SET status=0 WHERE id=".$job_id." ;";
            }
            mysqli_query($connection, $sql_ch_status);
        }
    }

    if(isset($_POST['search'])){
        $search = get_safe_value($connection, $_POST['search']);
        if ($search != "") {
            $sql_jobs = "SELECT * FROM jobs WHERE id=".$search.";";
        }else {
            $sql_jobs = "SELECT * FROM jobs ORDER BY id DESC;";
        }
    }else {
        $sql_jobs = "SELECT * FROM jobs ORDER BY id DESC;";
    }
    $result_jobs = mysqli_query($connection, $sql_jobs);
    $jobs_qty = mysqli_num_rows($result_jobs);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/fontawesome-pro-5.15.3-web/css/all.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/job-style.css">
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
                        <form class="search-product" action="job.php" method="post">
                            <input type="number" name="search" min="0" placeholder="Search by Job ID">
                            <button class="fas fa-search"></button>
                        </form>
                        <a href="add-job.php" class="add-product">
                            <i class="fas fa-plus"></i>
                            <span>Add New</span>
                        </a>
                    </div>
                    <div class="product-field-body">
                        <table class="products">
                            <thead>
                                <tr>
                                    <th>Job ID</th>
                                    <th>Job Title</th>
                                    <th>Job Type</th>
                                    <th>Pay</th>
                                    <th>Experience Level</th>
                                    <th>Location</th>
                                    <th>Status</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    while($rows_job = mysqli_fetch_assoc($result_jobs)) {
                                ?>
                                <tr>
                                    <td><?php echo $rows_job['id']; ?></td>
                                    <td><?php echo $rows_job['title']; ?></td>
                                    <td><?php echo $rows_job['type']; ?></td>
                                    <td>$<?php echo $rows_job['pay']; ?> a month</td>
                                    <td><?php echo $rows_job['experience']; ?> years</td>
                                    <td><?php echo $rows_job['location']; ?></td>
                                    <?php
                                        if ($rows_job['status'] == 1) {
                                            $status_text = 'Active';
                                            $status_class = 'green';
                                        }else{
                                            $status_text = 'Inactive';
                                            $status_class = 'red';
                                        }
                                    ?>
                                    <td><a href="job.php?c-status=true&job-id=<?php echo $rows_job['id']; ?>&cr-status=<?php echo $rows_job['status']; ?>" class="status <?php echo $status_class; ?>"><?php echo $status_text; ?></span></td>
                                    <td>
                                        <a href="edit-job.php?edit=true&job-id=<?php echo $rows_job['id']; ?>" class="edit">Edit</a>
                                    </td>
                                </tr>
                                <?php } ?>
                                <?php
                                    if($jobs_qty == 0) {
                                ?>
                                <tr>
                                    <td>There is no listed job</td>
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
    <span id="identity">job</span>
    <script src="js/main.js"></script>
    <script src="js/job.js"></script>
</body>
</html>