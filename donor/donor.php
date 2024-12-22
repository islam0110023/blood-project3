<?php
// session_start();
require_once('../database/database.php');
$db = db::getInstance('localhost', 'root', '', 'blood_donation', 'users u');
//$result = $db->select()->join('blood_types bt', 'bt.id', '=', 'u.blood_type_id')->where('u.is_doner', '=', true)->show();
$result = $db->select()
    ->join("reg r", "r.id", "=", "u.reg_id")
    ->join("blood_types bt", "bt.id", "=", "u.blood_type_id")
    ->where('u.is_doner', '=', true)
    ->andwhere("r.IS_active", "=", 0)
    ->andwhere("r.Role", "=", 2)
    ->show();
// echo "<pre>";
// print_r($result);
$db->setTable('hospitals');
// $resultH = $db->select()->show();
$resultH = $db->select()
    ->join("reg r", "r.id", "=", "hospitals.reg_id")
    ->where("r.IS_active", "=", 0)
    ->andwhere("r.Role", "=", 3)
    ->show();
// echo '<pre>';
// print_r($resultH);

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
                    <input type="text" id="hospitalSearch" placeholder="Search hospitals by location...">
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
                    <input type="text" id="donorSearch" placeholder="Search donors by Blood Type...">
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

        // عند الضغط على زر المستشفيات
        hospitalBtn.addEventListener('click', function () {
            // إخفاء قسم المتبرعين وعرض قسم المستشفيات
            hospitalSection.style.display = 'block';
            donorSection.style.display = 'none';
        });

        // عند الضغط على زر المتبرعين
        donorBtn.addEventListener('click', function () {
            // إخفاء قسم المستشفيات وعرض قسم المتبرعين
            donorSection.style.display = 'block';
            hospitalSection.style.display = 'none';
        });
    </script>
</body>

</html>