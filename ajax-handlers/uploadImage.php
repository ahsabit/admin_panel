<?php
    //require essential files
    require_once('../db_login.inc.php');
    $usrnm = $_SESSION['ADMIN_USERNAME'];
    $admn_log = $_SESSION['ADMIN_LOGIN'];
    if ($admn_log != "yes" || $usrnm == "") {
        header('location:login.php?from=analytics.php');
        die();
    }

    // Check if file was uploaded without errors
    if(isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $img_name = $_FILES['image']['name'];
        $temp_name = $_FILES['image']['tmp_name'];
        $img_type = $_FILES['image']['type'];
        $allowed_types = array("image/webp", "image/avif");
        $id = null;
        $name = null;
        
        // Check if the uploaded file type is allowed
        if (in_array($img_type, $allowed_types)) {
            // Generate a unique filename
            $img_up_name = rand(111111111, 999999999)."_".time()."_".$img_name;
            // Upload the image location on the server to the database
            $img_server_location = "images/product-image/".$img_up_name;
            $sql_produc = "SELECT * FROM products ORDER BY id DESC LIMIT 1;";
            $sql_products_res = mysqli_query($connection, $sql_produc);
            while ($rows_produc = mysqli_fetch_assoc($sql_products_res)) {
                $id = $rows_produc['id'];
                $name = $rows_produc['product_name'];
                $image_1 = $rows_produc['image_1'];
                $image_2 = $rows_produc['image_2'];
                $image_3 = $rows_produc['image_3'];
                $image_4 = $rows_produc['image_4'];
                $image_5 = $rows_produc['image_5'];
                $image_6 = $rows_produc['image_6'];
            }

            if ($name != null || $id == null) {
                $sql_up = "INSERT INTO products(image_1) VALUES('".$img_server_location."')";
            }else {
                if ($image_1 == null) {
                    $sql_up = "UPDATE products SET image_1 ='".$img_server_location."' WHERE id=".$id.";";
                }elseif ($image_2 == null) {
                    $sql_up = "UPDATE products SET image_2 ='".$img_server_location."' WHERE id=".$id.";";
                }elseif ($image_3 == null) {
                    $sql_up = "UPDATE products SET image_3 ='".$img_server_location."' WHERE id=".$id.";";
                }elseif ($image_4 == null) {
                    $sql_up = "UPDATE products SET image_4 ='".$img_server_location."' WHERE id=".$id.";";
                }elseif ($image_5 == null) {
                    $sql_up = "UPDATE products SET image_5 ='".$img_server_location."' WHERE id=".$id.";";
                }elseif ($image_6 == null) {
                    $sql_up = "UPDATE products SET image_6 ='".$img_server_location."' WHERE id=".$id.";";
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
            }else{
                echo "An error occured.";
            }
        } else {
            echo "Invalid file type.";
        }
    } else {
        echo "Error uploading file.";
    }