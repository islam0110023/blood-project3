<?php

session_start();
require_once('../database/database.php');

if (isset($_SESSION['user'])) {
    if (isset($_POST['available'])) {
        $db = db::getInstance('localhost', 'root', '', 'blood_donation', 'users');
        $resultReg = $db->select()->where("reg_id", "=", $_SESSION['user']['id'])->get();
        $is_doner = false;
        //     echo "<script>
        //     alert('not entered');
        //     window.location.href = 'settings.php';
        // </script>";
        if ($resultReg['is_doner'] == false) {
            $is_doner = true;
            //     echo "<script>
            //     alert('1');
            //     window.location.href = 'settings.php';
            // </script>";
        } else {
            $is_doner = false;
            //     echo "<script>
            //     alert('0');
            //     window.location.href = 'settings.php';
            // </script>";
        }
        $db->update([
            "is_doner" => $is_doner
        ])->where("reg_id", "=", $_SESSION['user']['id'])->excute();
        $_SESSION['is_doner']=$is_doner;
        echo "<script>
                alert('Updated successful');
                window.location.href = 'settings.php';
            </script>";
    }

}
?>