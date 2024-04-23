<?php
    require_once('db_login.inc.php');
    require_once('function.inc.php');
    $usrnm = $_SESSION['ADMIN_USERNAME'];
    $admn_log = $_SESSION['ADMIN_LOGIN'];
    if ($admn_log != "yes" || $usrnm == "") {
        header('location:login.php?from=add-job.php');
        die();
    }

    if (isset($_POST['submit'])) {
        $title = get_safe_value($connection, $_POST['job-title']);
        $type = get_safe_value($connection, $_POST['job-type']);
        $pay = get_safe_value($connection, $_POST['pay']);
        $exp = get_safe_value($connection, $_POST['experience']);
        $location = get_safe_value($connection, $_POST['location']);
        $desc = get_safe_value($connection, $_POST['description']);
        $ups = array($title, $type, $pay, $exp, $location, $desc);
        if (!in_array("", $ups)) {
            $sql_up = "INSERT INTO jobs(title, type, pay, experience, location, status, description) VALUES('".$title."','".$type."',".$pay.",".$exp.",'".$location."', 1, '".$desc."')";
            mysqli_query($connection, $sql_up);
            header("location:job.php");
            die();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/fontawesome-pro-5.15.3-web/css/all.css">
    <link rel="stylesheet" href="css/add-job.css">
    <title>Admin Panel | Zelab</title>
</head>
<body>
    <header class="head">
        <h1>Add Job</h1>
        <div class="right-head">
            <a href="job.php">
                <span>Job</span>
            </a>
            <span>
                <i class="fas fa-greater-than"></i>
            </span>
            <span>Add Job</span>
        </div>
    </header>
    <section class="main">
        <form method="post">
            <div class="left-side side">
                <div class="fields">
                    <label for="product-name" class="productname">Job Title<span>*</span></label>
                    <input type="text" name="job-title" id="product-name" placeholder="Enter job title" required>
                    <p>Do not exceed 20 characters when entering title.</p>
                </div>
                <div class="fields">
                    <label for="job-type">Job Type<span>*</span></label>
                    <select name="job-type" id="job-type" required>
                        <option value="Internship">Internship</option>
                        <option value="Full Time">Full Time</option>
                        <option value="Part Time">Part Time</option>
                        <option value="Contract">Contract</option>
                    </select>
                </div>
                <div class="fields">
                    <label for="pay" class="brnd">Pay<span>*</span></label>
                    <input type="number" min="0" name="pay" id="pay" placeholder="Enter pay" required>
                </div>
                <div class="fields">
                    <label for="experience" class="exp">Experience<span>*</span></label>
                    <input type="number" min="0" name="experience" id="experience" placeholder="Enter experience level in years" required>
                </div>
                <div class="fields">
                    <label for="location" class="loc">location<span>*</span></label>
                    <input type="text" name="location" id="location" placeholder="Enter location" required>
                </div>
                <div class="fields">
                    <label for="description" class="desc">Description<span>*</span></label>
                    <textarea name="description" id="description" cols="30" rows="8" placeholder="description [Note: do not exceed 1000 characters]" required></textarea>
                </div>
            </div>
            <div class="right-side side">
                <input name="submit" type="submit" value="Save" class="submit-btn">
            </div>
        </form>
    </section>
    <?php require_once("footer.inc.php");?>
</body>
</html>