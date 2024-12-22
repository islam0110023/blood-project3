<?php

session_start();
require_once('../database/database.php');

if (isset($_SESSION['admin'])) {
    if (isset($_POST['delete'])) {
        $db = db::getInstance('localhost', 'root', '', 'blood_donation', 'reg');

        $db->update([
            "IS_active" => 1
        ])->where("id", "=", $_POST['delete'])->excute();

        echo "<script>
                alert('Delete successful');
                window.location.href = 'manage_donors.php';
            </script>";
    }

} else {
    echo "<script>
    alert('Login');
    window.location.href = '../home/login_signup.php';
</script>";
}
?>