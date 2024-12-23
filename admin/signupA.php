<?php
session_start();
require_once('../database/database.php');
session_start();
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
if (isset($_SESSION['admin'])) {
    if (isset($_POST['submit'])) {
        $HospitalName = trim($_POST['HospitalName'] ?? '');
        $userName = trim($_POST['userName'] ?? '');
        $HospitalEmail = trim($_POST['HospitalEmail'] ?? '');
        $HospitalPassword = trim($_POST['HospitalPassword'] ?? '');
        $confirmPassword = trim($_POST['confirmPassword'] ?? '');
        $HospitalNumber = trim($_POST['HospitalNumber'] ?? '');
        $Hospitallocation = trim($_POST['Hospitallocation'] ?? '');
        $Hospitallicense = trim($_POST['Hospitallicense'] ?? '');
        if (
            empty($HospitalName) || empty($userName) || empty($HospitalEmail) ||
            empty($HospitalPassword) || empty($confirmPassword) || empty($HospitalNumber) ||
            empty($Hospitallocation) || empty($Hospitallicense)
        ) {
            echo "<script>
            alert('Please fill in all fields. Spaces are not allowed.');
            window.location.href = 'register_hospital.php';
        </script>";
            exit;
        }


        $result = $db->select()->where("emails", "=", $HospitalEmail)->get();
        $result1 = $db->select()->where("user_names", "=", $userName)->get();
        $db->setTable("hospitals");
        $result3 = $db->select()->where("phone_Num", "=", $HospitalNumber)->get();
        $result4 = $db->select()->where("licenses_number", "=", $Hospitallicense)->get();

        if (!empty($result)) {
            echo "<script>
            alert('This email is already registered');
            window.location.href = 'register_hospital.php';
        </script>";
        } else if (!empty($result1)) {
            echo "<script>
            alert('This user name is already registered');
            window.location.href = 'register_hospital.php';
        </script>";
        } else if ($HospitalPassword !== $confirmPassword) {
            echo "<script>
            alert('Password is not equal to confirm password');
            window.location.href = 'register_hospital.php';
        </script>";
        } else if (!empty($result3)) {
            echo "<script>
            alert('This phone number is already registered');
            window.location.href = 'register_hospital.php';
        </script>";
        } else if (!validateEgyptianPhoneNumber($_POST['HospitalNumber'])) {
            echo "<script>
            alert('The phone number is incorrect or does not follow the Egyptian phone number format.');
            window.location.href = 'register_hospital.php';
        </script>";
        } else if (!empty($result4)) {
            echo "<script>
            alert('This license number is already registered');
            window.location.href = 'register_hospital.php';
        </script>";
        } else {

            try {

                $db->beginTransaction();

                $db->setTable("reg");
                $db->insert([
                    "user_names" => $userName,
                    "emails" => $HospitalEmail,
                    "password" => $HospitalPassword,
                    "role" => "3"
                ])->excute();

                $reg_id = $db->getConnection()->insert_id;

                $db->setTable("hospitals");
                $db->insert([
                    "reg_id" => $reg_id,
                    "name" => $HospitalName,
                    "location" => $Hospitallocation,
                    "phone_Num" => $HospitalNumber,
                    "licenses_number" => $Hospitallicense
                ])->excute();

                $db->commit();
                echo "<script>
            alert('Hospital registered successfully');
            window.location.href = 'register_hospital.php';
        </script>";
            } catch (Exception $e) {
                $db->rollback();
                echo "<script>
            alert('Registration failed');
            window.location.href = 'register_hospital.php';
        </script>";
            }

        }

    }
} else {
    echo "<script>
    alert('Login');
    window.location.href = '../home/login_signup.php';
</script>";
}
?>