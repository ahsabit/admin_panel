<?php
    function this_month_data($mon, $data){
        $u = 0;
        while ($u < 11) {
            if ($mon[$u] == date("M")) {
                if ($data[$u] == "null") {
                    return 0;
                }else {
                    return $data[$u];
                }
            }elseif($mon[$u] == date("M")."."){
                if ($data[$u] == "null") {
                    return 0;
                }else {
                    return $data[$u];
                }
            }
            $u++;
        }
    }

    function this_month($mon) {
        $currentMonth = date("M");
    
        // Append a period to the current month abbreviation
        $currentMonthWithPeriod = $currentMonth . ".";
    
        for ($u = 0; $u < 11; $u++) {
            // Check if the month abbreviation matches either with or without a period
            if ($mon[$u] == $currentMonth || $mon[$u] == $currentMonthWithPeriod) {
                return $mon[$u]; // Return matching month abbreviation
            }
        }
    
        return null; // Return null if current month abbreviation is not found in the array
    }
    

    function pv_vs_this_month_data($mon, $data){
        $u = 0;
        while ($u < 11) {
            if ($mon[$u] == date("M")) {
                if ($data[$u] == "null") {
                    return floor(((0-$data[$u-1])/$data[$u-1])*100);
                }else {
                    return floor((($data[$u]-$data[$u-1])/$data[$u-1])*100);
                }
            }elseif($mon[$u] == date("M")."."){
                if($mon[$u] == "Jan."){
                    if ($data[$u] == "null") {
                        return floor(((0-$data[11])/$data[11])*100);
                    }else {
                        return floor((($data[$u]-$data[11])/$data[11])*100);
                    }
                }else {
                    if ($data[$u] == "null") {
                        return floor(((0-$data[$u-1])/$data[$u-1])*100);
                    }else {
                        return floor((($data[$u]-$data[$u-1])/$data[$u-1])*100);
                    }
                }
            }
            $u++;
        }
    }

    function get_safe_value($conn ,$str){
        $str = mysqli_real_escape_string($conn, trim($str));
        return $str;
    }

    function encrypt($string) {
        $key = "#9osdk3*]{+.;;i)";
        $iv = "^#@k90k;[]sc,&(0";
        return openssl_encrypt($string, "aes-256-cbc", $key, 0, $iv);
    }

    function nullFinder($value){
        if ($value == 0) {
            $value = 'null';
        }
        return $value;
    }