<?php
session_start();
require_once('../database/database.php');

if (isset($_SESSION['user'])) {
    // echo "<script>
    //     alert('session');
    //     window.location.href = 'settings.php';
    // </script>";

    if (isset($_POST['update']) && $_POST['cpassword'] != null) {


        $db = db::getInstance('localhost', 'root', '', 'blood_donation', 'hospitals');
        $db->setTable('reg');

        $resultReg = $db->select()->where("id", "=", $_SESSION['user']['id'])->get();
        if ($_POST['cpassword'] == $resultReg['Password']) {

            try {
                if ($_POST['password'] == null) {
                    $password = $resultReg['Password'];
                } else {

                    $password = $_POST['password'];
                }
                $namef = $_POST['first-name'];
                $namel = $_POST['last-name'];
                $emailH = $_POST['email'];
                $phoneH = $_POST['phone'];
                $addressH = $_POST['location'];
                $bloodtype = $_POST['blood-type'];

                $db->beginTransaction();
                $db->setTable("users");
                $db->update([
                    "first_name" => $namef,
                    "last_name" => $namel,
                    "location" => $addressH,
                    "phone_Num" => $phoneH,
                    "blood_type_id" => $bloodtype
                ])->where("reg_id", "=", $_SESSION['user']['id'])->excute();
                $db->setTable("reg");
                $db->update([
                    "emails" => $emailH,
                    "Password" => $password
                ])->where("id", "=", $_SESSION['user']['id'])->excute();

                $db->commit();
                header("location:settings.php");
                echo "<script>alert('Update successfuly');</script>";
            } catch (Exception $e) {
                $db->rollback();
                // header("location:settings.php");
                // echo "<script>alert('Error');</script>";
                echo "<script>
        alert('update error');
        window.location.href = 'settings.php';
    </script>";
            }
        } else {
            echo "<script>
        alert('Password not valid');
        window.location.href = 'settings.php';
    </script>";
        }

    } else {
        echo "<script>
        alert('enter password');
        window.location.href = 'settings.php';
    </script>";
    }
} else {
    echo "<script>alert('Login');</script>";
    header("location:../home/login_signup.php");
}
?>