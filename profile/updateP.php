<?php
session_start();
require_once('../database/database.php');

function validateEgyptianPhoneNumber($phoneNumber)
{

    $pattern = "/^01[0-2,5]{1}[0-9]{8}$/";

    if (preg_match($pattern, $phoneNumber)) {
        return true;
    } else {
        return false;
    }
}

if (isset($_SESSION['user'])) {
   

    if (isset($_POST['update']) && $_POST['cpassword'] != null) {


        $db = db::getInstance('localhost', 'root', '', 'blood_donation', 'hospitals');
        $db->setTable('reg');
        $resultReg = $db->select()->where("id", "=", $_SESSION['user']['id'])->get();
        if ($_POST['cpassword'] == $resultReg['Password']) {
            $result = $db->select()->where("emails", "=", $_POST['email'])->andwhere("id", "<>", $_SESSION['user']['id'])->get();
            $db->setTable("users");
            $result3 = $db->select()->where("phone_Num", "=",  $_POST['phone'])->andwhere("reg_id", "<>", $_SESSION['user']['id'])->get();

            if (!empty($result)) {
                echo "<script>
                    alert('This email is already registered');
                    window.location.href = 'settings.php';
                  </script>";
            } else if (!empty($result3)) {
                echo "<script>
                    alert('This phone number is already registered');
                    window.location.href = 'settings.php';
                  </script>";
            } else if (!validateEgyptianPhoneNumber($_POST['phone'])) {
                echo "<script>
                    alert('The phone number is incorrect or does not follow the Egyptian phone number format.');
                    window.location.href = 'settings.php';
                  </script>";
            } else {

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
                    echo "<script>
                    alert('Update successfuly');
                    window.location.href = 'settings.php';
                </script>";
                } catch (Exception $e) {
                    $db->rollback();
                   
                    echo "<script>
        alert('update error');
        window.location.href = 'settings.php';
    </script>";
                }
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
    echo "<script>
    alert('Login');
    window.location.href = '../home/login_signup.php';
</script>";
}
?>