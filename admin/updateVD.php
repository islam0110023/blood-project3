<?php

session_start();
require_once('../database/database.php');

if (isset($_SESSION['admin'])) {
    if (isset($_POST['available'])) {
        $db = db::getInstance('localhost', 'root', '', 'blood_donation', 'users');
        $resultReg = $db->select()->where("reg_id", "=", $_POST['available'])->get();
       
      
        if ($resultReg['is_doner'] == true) {
            $is_doner = false;
            $db->update([
                "is_doner" => $is_doner
            ])->where("reg_id", "=", $_POST['available'])->excute();
            $_SESSION['is_doner']=$is_doner;
            echo "<script>
                    alert('Updated successful');
                    window.location.href = 'manage_donors.php';
                </script>";
            
        } else {
            // $is_doner = false;
                echo "<script>
                alert('Already Hide');
                window.location.href = 'manage_donors.php';
            </script>";
        }
        // $db->update([
        //     "is_doner" => $is_doner
        // ])->where("reg_id", "=", $_POST['available'])->excute();
        // $_SESSION['is_doner']=$is_doner;
        // echo "<script>
        //         alert('Updated successful');
        //         window.location.href = 'manage_donors.php';
        //     </script>";
    }

}
?>