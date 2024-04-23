<?php
    require_once('db_login.inc.php');
    require_once('function.inc.php');
    $usrnm = $_SESSION['ADMIN_USERNAME'];
    $admn_log = $_SESSION['ADMIN_LOGIN'];
    if ($admn_log != "yes" || $usrnm == "") {
        header('location:login.php?from=edit-job.php');
        die();
    }

    if ($_GET['edit'] == "true" && $_GET['job-id'] != "") {
        $id = get_safe_value($connection, $_GET['job-id']);
        if (isset($_POST['submit'])) {
            $title = get_safe_value($connection, $_POST['job-title']);
            $type = get_safe_value($connection, $_POST['job-type']);
            $pay = get_safe_value($connection, $_POST['pay']);
            $exp = get_safe_value($connection, $_POST['experience']);
            $location = get_safe_value($connection, $_POST['location']);
            $desc = get_safe_value($connection, $_POST['description']);
            $ups = array($title, $type, $pay, $exp, $location, $desc);
            if (!in_array("", $ups)) {
                $sql_up = "UPDATE jobs SET title='".$title."', type='".$type."', pay=".$pay.", experience=".$exp.", location='".$location."', description='".$desc."' WHERE id=".$id.";";
                mysqli_query($connection, $sql_up);
                header("location:job.php");
                die();
            }
        }
        if (!isset($_POST['submit'])) {
            $sql_down = "SELECT * FROM jobs WHERE id=".$id.";";
            $result_down = mysqli_query($connection, $sql_down);
            while ($rows_job = mysqli_fetch_assoc($result_down)) {
                $tit = $rows_job["title"];
                $typ = $rows_job["type"];
                $py = $rows_job['pay'];
                $ex = $rows_job['experience'];
                $loca = $rows_job['location'];
                $des = $rows_job['description'];
            }
        }
    }else {
        header("location:job.php");
        die();
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
                    <input type="text" name="job-title" id="product-name" placeholder="Enter job title" value="<?php echo $tit; ?>" required>
                    <p>Do not exceed 20 characters when entering title.</p>
                </div>
                <div class="fields">
                    <label for="job-type">Job Type<span>*</span></label>
                    <select name="job-type" id="job-type" required>
                        <option value="Internship" <?php if($typ == 'Internship'){ echo 'selected';} ?>>Internship</option>
                        <option value="Full Time" <?php if($typ == 'Full Time'){ echo 'selected';} ?>>Full Time</option>
                        <option value="Part Time" <?php if($typ == 'Part Time'){ echo 'selected';} ?>>Part Time</option>
                        <option value="Contract" <?php if($typ == 'Contract'){ echo 'selected';} ?>>Contract</option>
                    </select>
                </div>
                <div class="fields">
                    <label for="pay" class="brnd">Pay<span>*</span></label>
                    <input type="number" min="0" name="pay" id="pay" placeholder="Enter pay" value="<?php echo $py; ?>" required>
                </div>
                <div class="fields">
                    <label for="experience" class="exp">Experience<span>*</span></label>
                    <input type="number" min="0" name="experience" id="experience" placeholder="Enter experience level in years" value="<?php echo $ex; ?>" required>
                </div>
                <div class="fields">
                    <label for="location" class="loc">location<span>*</span></label>
                    <input type="text" name="location" id="location" placeholder="Enter location" value="<?php echo $loca; ?>" required>
                </div>
                <div class="fields">
                    <label for="description" class="desc">Description<span>*</span></label>
                    <textarea name="description" id="description" cols="30" rows="8" placeholder="Write Description" required><?php echo $des; ?></textarea>
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