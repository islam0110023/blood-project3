<?php
// session_start();
require_once('../database/database.php');
$db = db::getInstance('localhost', 'root', '', 'blood_donation', 'users u');
//$result = $db->select()->join('blood_types bt', 'bt.id', '=', 'u.blood_type_id')->where('u.is_doner', '=', true)->show();
if (!empty( $_GET['search'])) {
    $search = strtolower($_GET['search']);

    $db->setTable('hospitals');
    // $resultH = $db->select()->show();
    $resultH = $db->select()
        ->join("reg r", "r.id", "=", "hospitals.reg_id")
        ->where("r.IS_active", "=", 0)
        ->andwhere("r.Role", "=", 3)
        ->andwhere("location", "like", "$search%")
        ->show();
} else {
    $db->setTable('hospitals');
    // $resultH = $db->select()->show();
    $resultH = $db->select()
        ->join("reg r", "r.id", "=", "hospitals.reg_id")
        ->where("r.IS_active", "=", 0)
        ->andwhere("r.Role", "=", 3)
        ->show();
    // echo '<pre>';
    // print_r($resultH);
}
if (!empty( $_GET['search1'])  && !empty( $_GET['search2'])) {
    $search1 = $_GET['search1'];
    $search2 = strtolower($_GET['search2']);
    $db->setTable('users u');
    $result = $db->select()
        ->join("reg r", "r.id", "=", "u.reg_id")
        ->join("blood_types bt", "bt.id", "=", "u.blood_type_id")
        ->where('u.is_doner', '=', true)
        ->andwhere("r.IS_active", "=", 0)
        ->andwhere("r.Role", "=", 2)
        ->andwhere("bt.Blood_Types", "like", "%$search1%")
        ->andwhere("u.location", "like", "%$search2%")
        ->show();

} else if (!empty( $_GET['search1'])) {
    $search1 = $_GET['search1'];
    $db->setTable('users u');
    $result = $db->select()
        ->join("reg r", "r.id", "=", "u.reg_id")
        ->join("blood_types bt", "bt.id", "=", "u.blood_type_id")
        ->where('u.is_doner', '=', true)
        ->andwhere("r.IS_active", "=", 0)
        ->andwhere("r.Role", "=", 2)
        ->andwhere("bt.Blood_Types", "like", "%$search1%")
        ->show();
} else if (!empty( $_GET['search2'])) {
    $search2 = strtolower($_GET['search2']);
    $db->setTable('users u');
    $result = $db->select()
        ->join("reg r", "r.id", "=", "u.reg_id")
        ->join("blood_types bt", "bt.id", "=", "u.blood_type_id")
        ->where('u.is_doner', '=', true)
        ->andwhere("r.IS_active", "=", 0)
        ->andwhere("r.Role", "=", 2)
        ->andwhere("u.location", "like", "%$search2%")
        ->show();
} else {
    $db->setTable('users u');
    $result = $db->select()
        ->join("reg r", "r.id", "=", "u.reg_id")
        ->join("blood_types bt", "bt.id", "=", "u.blood_type_id")
        ->where('u.is_doner', '=', true)
        ->andwhere("r.IS_active", "=", 0)
        ->andwhere("r.Role", "=", 2)
        ->show();
    // echo "<pre>";
// print_r($result);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital and Donor Details</title>
    <link rel="stylesheet" href="donor.css">
    <style>
        /* إضافة بعض التنسيقات البسيطة هنا إذا لزم الأمر */
    </style>
   <script>
        function clearInput() {
            document.getElementById('hospitalSearch').value = '';
            document.getElementById('donorSearch1').value = '';
            document.getElementById('donorSearch2').value = '';
        }
        window.onload = function () {
        document.getElementById('donorSearch1').value = '';
        document.getElementById('donorSearch2').value = '';
        document.getElementById('hospitalSearch').value = '';
    }
    </script>
</head>

<body>
    <div class="container">
        <aside class="sidebar">
            <button id="hospitalBtn">Hospitals</button>
            <button id="donorBtn">Donors</button>
        </aside>

        <div class="content">
            <!-- Hospital Section -->
            <div id="hospitalSection" style="display: block;">
                <h1>Hospitals</h1>
                <div class="search-bar">
                    <form action="donor.php" method="get" onreset="clearInput()">
                        <input type="text" id="hospitalSearch" name="search" 
                            value="<?= isset($_GET['search']) ? $_GET['search'] : ''; ?>"
                            placeholder="Search hospitals by location...">
                    </form>

                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Hospital Name</th>
                            <th>Location</th>
                            <th>Contact</th>
                            <th>Info</th>
                        </tr>
                    </thead>
                    <tbody id="hospitalTableBody">
                        <?php
                        foreach ($resultH as $row => $val):

                            ?>
                            <tr>

                                <td>
                                    <?=
                                        $val['name'];
                                    ?>
                                </td>
                                <td>
                                    <?=
                                        $val['location'];
                                    ?>
                                </td>
                                <td>
                                    <?=
                                        $val['phone_Num'];
                                    ?>
                                </td>
                                <td><a href="bags.php?Hid=<?= $val['hospitals_id']; ?>" target="_blank">View Info</a></td>
                                <!-- رابط جديد -->
                            </tr>
                            <?php
                        endforeach;
                        ?>

                    </tbody>
                </table>
            </div>

            <!-- Donor Section -->
            <div id="donorSection" style="display: none;">
                <h1>Donors</h1>
                <div class="search-bar">
                    <!-- <input type="text" id="donorSearch" placeholder="Search donors by Blood Type...">
                    <input type="text" id="donorSearch" placeholder="Search donors by Location..."> -->

                    <!-- <form action="" method="get" style="display: flex; gap: 10px;">
                        <input style="margin: 0 10;  width: 400px;" type="text" id="donorSearch" name="search1"
                            value="<//?= isset($_GET['search1']) ? $_GET['search1'] : ''; ?>"
                            placeholder="Search donors by Blood Type...">
                        </form>
                        <form action="" method="get">
                        <input style="margin: 0 150px; width: 400px;" type="text" id="donorSearch" name="search2"
                            value="<//?= isset($_GET['search2']) ? $_GET['search2'] : ''; ?>"
                            placeholder="Search donors by Location...">
                    </form> -->
                    <form action="donor.php" method="get" style="display: flex; gap: 10px;"  onreset="clearInput()">
                        <input type="text" name="search1" id="donorSearch1"
                            value="<?= isset($_GET['search1']) ? $_GET['search1'] : ''; ?>"
                            placeholder="Search donors by Blood Type...">
                        <input type="text" name="search2" id="donorSearch2" 
                            value="<?= isset($_GET['search2']) ? $_GET['search2'] : ''; ?>"
                            placeholder="Search donors by Location...">
                        <button type="submit" style="display:none;" >Search</button>
                    </form>


                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Governorate</th>
                            <th>Blood Type</th>
                        </tr>
                    </thead>
                    <tbody id="donorTableBody">
                        <!-- بيانات المتبرعين ستملأ هنا بواسطة الباك إند -->
                        <?php
                        foreach ($result as $row => $val):

                            ?>
                            <tr>

                                <td><?php
                                echo $val['first_name'] . " " . $val['last_name'];
                                ?></td>
                                <td>
                                    <?=
                                        $val['phone_Num'];
                                    ?>
                                </td>
                                <td>
                                    <?=
                                        $val['location'];
                                    ?>
                                </td>
                                <td>
                                    <?=
                                        $val['Blood_Types'];
                                    ?>
                                </td>
                            </tr>
                            <?php
                        endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
    // الحصول على الأزرار والأقسام
    const hospitalBtn = document.getElementById('hospitalBtn');
    const donorBtn = document.getElementById('donorBtn');
    const hospitalSection = document.getElementById('hospitalSection');
    const donorSection = document.getElementById('donorSection');

    // دالة لعرض القسم المطلوب وتخزينه في localStorage
    function showSection(section) {
        if (section === 'hospital') {
            hospitalSection.style.display = 'block';
            donorSection.style.display = 'none';
            localStorage.setItem('activeSection', 'hospital'); // تخزين القسم
        } else if (section === 'donor') {
            donorSection.style.display = 'block';
            hospitalSection.style.display = 'none';
            localStorage.setItem('activeSection', 'donor'); // تخزين القسم
        }
    }

    // عند الضغط على زر المستشفيات
    hospitalBtn.addEventListener('click', function () {
        showSection('hospital');
    });

    // عند الضغط على زر المتبرعين
    donorBtn.addEventListener('click', function () {
        showSection('donor');
    });

    // عند تحميل الصفحة، استرجع القسم النشط من localStorage
    document.addEventListener('DOMContentLoaded', function () {
        const activeSection = localStorage.getItem('activeSection') || 'hospital'; // القسم الافتراضي هو المستشفيات
        showSection(activeSection);
    });
</script>

</body>

</html>