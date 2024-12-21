<?php
session_start();
require_once('../database/database.php');

if (isset($_SESSION['hospital'])) {
    if (isset($_POST['submit']) && $_POST['cpassword'] != null) {


        $db = db::getInstance('localhost', 'root', '', 'blood_donation', 'hospitals');
        $db->setTable('reg');

        $resultReg = $db->select()->where("id", "=", $_SESSION['hospital']['id'])->get();
        if ($_POST['cpassword'] == $resultReg['Password']) {

            try {
                if ($_POST['password'] == null) {
                    $password = $resultReg['Password'];
                } else {
                    $password = $_POST['password'];
                }
                $nameH = $_POST['hospital-name'];
                $emailH = $_POST['email'];
                $phoneH = $_POST['phone'];
                $addressH = $_POST['address'];

                $db->beginTransaction();
                $db->setTable("hospitals");
                $db->update([
                    "name" => $nameH,
                    "location" => $addressH,
                    "phone_Num" => $phoneH
                ])->where("reg_id", "=", $_SESSION['hospital']['id'])->excute();
                $db->setTable("reg");
                $db->update([
                    "emails" => $emailH,
                    "Password" => $password
                ])->where("id", "=", $_SESSION['hospital']['id'])->excute();

                $db->commit();
                header("location:setting.php");
                echo "<script>alert('Update successfuly');</script>";
            } catch (Exception $e) {
                $db->rollback();
                header("location:setting.php");
                echo "<script>alert('Error');</script>";
            }
        } else {
            echo "<script>
        alert('Password not valid');
        window.location.href = 'setting.php';
    </script>";
        }

    } else {
        echo "<script>
        alert('enter password');
        window.location.href = 'setting.php';
    </script>";
    }
} else {
    echo "<script>alert('Login');</script>";
    header("location:../home/login_signup.php");
}
?>