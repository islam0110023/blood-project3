<?php
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
$db = db::getInstance('localhost', 'root', '', 'blood_donation', 'reg');
if (isset($_POST['submit'])) {
  $signupEmail = trim($_POST['signupEmail'] ?? '');
  $userName = trim($_POST['userName'] ?? '');
  $phone = trim($_POST['phone'] ?? '');
  $firstName = trim($_POST['firstName'] ?? '');
  $lastName = trim($_POST['lastName'] ?? '');
  $location = trim($_POST['location'] ?? '');
  $bloodGroup = trim($_POST['bloodGroup'] ?? '');
  $signupPassword = trim($_POST['signupPassword'] ?? '');
  $confirmPassword = trim($_POST['confirmPassword'] ?? '');
  if (
    empty($signupEmail) || empty($userName) || empty($phone) || empty($firstName) ||
    empty($lastName) || empty($location) || empty($bloodGroup) ||
    empty($signupPassword) || empty($confirmPassword)
  ) {
    echo "<script>
        alert('Please fill in all fields. Spaces are not allowed.');
        window.location.href = 'login_signup.php';
    </script>";
    exit;
  }

  $result = $db->select()->where("emails", "=", $signupEmail)->get();
  $result1 = $db->select()->where("user_names", "=", $userName)->get();
  $db->setTable("users");
  $result3 = $db->select()->where("phone_Num", "=", $phone)->get();
  if (!empty($result)) {
    echo "<script>
        alert('This email is already registered');
        window.location.href = 'login_signup.php';
      </script>";
  } else if (!empty($result1)) {
    echo "<script>
        alert('This user name is already registered');
        window.location.href = 'login_signup.php';
      </script>";
  } else if ($signupPassword !== $confirmPassword) {

    echo "<script>
        alert('Password is not equal to confirm password');
        window.location.href = 'login_signup.php';
      </script>";
  } else if (!empty($result3)) {
    echo "<script>
        alert('This phone number is already registered');
        window.location.href = 'login_signup.php';
      </script>";
  } else if (!validateEgyptianPhoneNumber($_POST['phone'])) {
    echo "<script>
        alert('The phone number is incorrect or does not follow the Egyptian phone number format.');
        window.location.href = 'login_signup.php';
      </script>";
  } else {


    try {
      $db->beginTransaction();
      $db->setTable("reg");
      $db->insert([
        "user_names" => $userName,
        "emails" => $signupEmail,
        "password" => $signupPassword,
        "role" => "2"
      ])->excute();
      $reg_id = $db->getConnection()->insert_id;
      $db->setTable("users");
      $db->insert([
        "reg_id" => $reg_id,
        "first_name" => $firstName,
        "last_name" => $lastName,
        "phone_Num" => $phone,
        "location" => $location,
        "blood_type_id" => $bloodGroup

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