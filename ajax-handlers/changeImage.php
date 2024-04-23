<?php
    //require essential files
    require_once('../db_login.inc.php');
    $usrnm = $_SESSION['ADMIN_USERNAME'];
    $admn_log = $_SESSION['ADMIN_LOGIN'];
    if ($admn_log != "yes" || $usrnm == "") {
        header('location:login.php?from=products.php');
        die();
    }

    // Check if file was uploaded without errors
    if(isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $img_name = $_FILES['image']['name'];
        $temp_name = $_FILES['image']['tmp_name'];
        $img_type = $_FILES['image']['type'];
        $allowed_types = array("image/webp", "image/avif");
        $id = $_SESSION['CAHNGE_ID'];
        $name = null;
        
        // Check if the uploaded file type is allowed
        if (in_array($img_type, $allowed_types)) {
            // Generate a unique filename
            $img_up_name = rand(111111111, 999999999)."_".time()."_".$img_name;
            // Upload the image location on the server to the database
            $img_server_location = "images/product-image/".$img_up_name;
            if ($id != null) {
                if ($_SESSION['CHANGE_NUM'] == 1) {
                    $sql_up = "UPDATE products SET image_1 ='".$img_server_location."' WHERE id=".$id.";";
                }elseif ($_SESSION['CHANGE_NUM'] == 2) {
                    $sql_up = "UPDATE products SET image_2 ='".$img_server_location."' WHERE id=".$id.";";
                }elseif ($_SESSION['CHANGE_NUM'] == 3) {
                    $sql_up = "UPDATE products SET image_3 ='".$img_server_location."' WHERE id=".$id.";";
                }elseif ($_SESSION['CHANGE_NUM'] == 4) {
                    $sql_up = "UPDATE products SET image_4 ='".$img_server_location."' WHERE id=".$id.";";
                }elseif ($_SESSION['CHANGE_NUM'] == 5) {
                    $sql_up = "UPDATE products SET image_5 ='".$img_server_location."' WHERE id=".$id.";";
                }elseif ($_SESSION['CHANGE_NUM'] == 6) {
                    $sql_up = "UPDATE products SET image_6 ='".$img_server_location."' WHERE id=".$id.";";
                    $_SESSION['CHANGE_NUM'] = 1;
                }else{
                    $sql_up = "";
                }
            }

            if($sql_up != ""){
                mysqli_query($connection, $sql_up);
                // Generate destination directory
                $img_up_location = "../images/product-image/".$img_up_name;
                // Move the uploaded file to the destination directory
                move_uploaded_file($temp_name, $img_up_location);
                $_SESSION['CHANGE_NUM']++ ;
            }else{
                echo "An error occured.";
            }
        } else {
            echo "Invalid file type.";
        }
    } else {
        echo "Error uploading file.";
    }