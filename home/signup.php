<?php
require_once('../database/database.php');
function validateEgyptianPhoneNumber($phoneNumber) {
    
    $pattern = "/^01[0-2,5]{1}[0-9]{8}$/";

    if (preg_match($pattern, $phoneNumber)) {
        return true; 
    } else {
        return false; 
    }
}
function validateEmail($email) {
    $pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";

    if (preg_match($pattern, $email)) {
        return true; 
    } else {
        return false; 
    }
}
$db = db::getInstance('localhost', 'root', '', 'blood_donation', 'reg');
if (isset($_POST['submit'])) {

    $result = $db->select()->where("emails", "=", $_POST['signupEmail'])->get();
    $result1 = $db->select()->where("user_names", "=", $_POST['userName'])->get();
    $db->setTable("users");
    $result3 = $db->select()->where("phone_Num", "=", $_POST['phone'])->get();
    if ($_POST['signupEmail'] === $result['emails']) {
        echo "<script>
        alert('This email is already registered');
        window.location.href = 'login_signup.php';
      </script>";
    } else if ($_POST['userName'] === $result1['user_names']) {
        echo "<script>
        alert('This user name is already registered');
        window.location.href = 'login_signup.php';
      </script>";
    } else if ($_POST['signupPassword'] !== $_POST['confirmPassword']) {

        echo "<script>
        alert('Password is not equal to confirm password');
        window.location.href = 'login_signup.php';
      </script>";
    } else if($_POST['phone'] === $result3['phone_Num']){
        echo "<script>
        alert('This phone number is already registered');
        window.location.href = 'login_signup.php';
      </script>";
    }
    else if (!validateEgyptianPhoneNumber($_POST['phone'])) {
        echo "<script>
        alert('The phone number is incorrect or does not follow the Egyptian phone number format.');
        window.location.href = 'login_signup.php';
      </script>";
    }
    else if (!validateEmail($email)) {
        echo "<script>
        alert('Invalid email.');
        window.location.href = 'login_signup.php';
      </script>";
    }
    
    else {


        try {
            $db->beginTransaction();
            $db->setTable("reg");
            $db->insert([
                "user_names" => $_POST['userName'],
                "emails" => $_POST['signupEmail'],
                "password" => $_POST['signupPassword'],
                "role" => "2"
            ])->excute();
            $reg_id = $db->getConnection()->insert_id;
            $db->setTable("users");
            $db->insert([
                "reg_id" => $reg_id,
                "first_name" => $_POST['firstName'],
                "last_name" => $_POST['lastName'],
                "phone_Num" => $_POST['phone'],
                "location" => $_POST['location'],
                "blood_type_id" => $_POST['bloodGroup']

            ])->excute();
            $db->commit();
            echo "<script>
        alert('Register successfuly');
        window.location.href = 'login_signup.php';
      </script>";
        } catch (Exception $e) {
            $db->rollback();
            // echo "<script> alert('";
            // echo "Transaction failed: " . $e->getMessage();
            // echo "');</script";
            //echo "<script> alert('Transaction failed: " . $e->getMessage() . "');  </script>";
            // echo "<script>
            // alert('Transaction failed: " . addslashes($e->getMessage()) . "');
            //         </script>";
            echo "<script>
                alert('Register Error');
                window.location.href = 'login_signup.php';
              </script>";

            // echo "<script>alert('Transaction failed: error');</script>";

        }
    }

}
?>