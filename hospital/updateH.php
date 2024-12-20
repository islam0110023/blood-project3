<?php
session_start();
require_once('../database/database.php');

if (isset($_SESSION['hospital'])) {
    if (isset($_POST['submit'])) {   
        
        $db = db::getInstance('localhost', 'root', '', 'blood_donation', 'hospitals');
        try {
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
                "emails" => $emailH
            ])->where("id", "=", $_SESSION['hospital']['id'])->excute();

            $db->commit();
            echo "<script>alert('Update successfuly');</script>";
            header("location:setting.php");
        } catch (Exception $e) {
            $db->rollback();
            echo "<script>alert('Error');</script>";
            header("location:setting.php");
        }

    }
} else {
    echo "<script>alert('Login');</script>";
    header("location:../home/login_signup.php");
}
?>