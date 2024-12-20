<?php
session_start();
require_once('../database/database.php');

if (isset($_SESSION['hospital'])) {
    if (isset($_POST['update'])) {

        $db = db::getInstance('localhost', 'root', '', 'blood_donation', 'hospitals');

        $result = $db->select()->where("reg_id", '=', $_SESSION['hospital']['id'])->get();
        $db->setTable("hospitals_blood_inventory");

        $result2 = $db->select()->where("hospitals_id", "=", $result['hospitals_id'])->andwhere("blood_type_id", "=", $_POST['update'])->get();


        try {
            $quantity = $_POST['updateB'];
            $quantity+=$result2['Quantity'];


            $db->beginTransaction();
            $db->setTable("hospitals_blood_inventory");
            $db->update([
                "Quantity" => $quantity
            ])->where("hospitals_id", "=", $result['hospitals_id'])->andwhere("blood_type_id", "=", $_POST['update'])->excute();

            $db->commit();
            header("location:edit_dash_hos.php");
            echo "<script>alert('Update successfuly');</script>";
        } catch (Exception $e) {
            $db->rollback();
            echo "<script>alert('Error');</script>";
            header("location:edit_dash_hos.php");
        }

    }
} else {
    echo "<script>alert('Login');</script>";
    header("location:../home/login_signup.php");
}
?>