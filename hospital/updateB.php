<?php
session_start();
require_once('../database/database.php');

if (isset($_SESSION['hospital'])) {
    if (isset($_POST['update'])) {

        $db = db::getInstance('localhost', 'root', '', 'blood_donation', 'hospitals');

        $result = $db->select()->where("reg_id", '=', $_SESSION['hospital']['id'])->get();
        $db->setTable("hospitals_blood_inventory");

        $result2 = $db->select()->where("hospitals_id", "=", $result['hospitals_id'])->andwhere("blood_type_id", "=", $_POST['update'])->get();
        $quantity = intval($_POST['updateB']);
        if ($quantity != null) {
            try {




                $quantity += $result2['Quantity'];
                if ($quantity < 0) {
                    echo "<script>
            alert('Quantity does not allow');
            window.location.href = 'edit_dash_hos.php';
          </script>";
                } else {
                    $db->beginTransaction();
                    $db->setTable("hospitals_blood_inventory");
                    $db->update([
                        "Quantity" => $quantity
                    ])->where("hospitals_id", "=", $result['hospitals_id'])->andwhere("blood_type_id", "=", $_POST['update'])->excute();

                    $db->commit();
                    header("location:edit_dash_hos.php");
                    echo "<script>alert('Update successfuly');</script>";
                }



            } catch (Exception $e) {
                $db->rollback();
                // echo "<script>alert('Error');</script>";
                // header("location:edit_dash_hos.php");
                echo "<script>
            alert('error');
            window.location.href = 'edit_dash_hos.php';
          </script>";
            }
        } else {
            // header("location:edit_dash_hos.php");

            // echo "<script>alert('enter valid number');</script>";

            echo "<script>
        alert('Enter valid number');
        window.location.href = 'edit_dash_hos.php';
      </script>";
        }

    }
} else {
    echo "<script>alert('Login');</script>";
    header("location:../home/login_signup.php");
}
?>