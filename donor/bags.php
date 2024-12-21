<?php
require_once('../database/database.php');

if (isset($_GET["Hid"])) {
    $db = db::getInstance('localhost', 'root', '', 'blood_donation', 'hospitals_blood_inventory HI');
    $Hid = $_GET["Hid"];
    $result = $db->select()->join('blood_types bt', 'bt.id', '=', 'HI.blood_type_id')->where('HI.hospitals_id', '=', $Hid)->show();
    // echo '<pre>';
    // print_r($result);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Bags Availability</title>
    <link rel="stylesheet" href="bags.css">
</head>

<body>
    <div class="container">
        <div class="content">
            <h1>Blood Bags Availability</h1>
            <table>
                <thead>
                    <tr>
                        <th>Blood Type</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- البيانات ستملأ هنا من الباك إند -->
                    <?php
                    foreach ($result as $rows => $val):

                        ?>
                        <tr>

                            <td>
                                <?=
                                    $val['Blood_Types'];
                                ?>
                            </td>
                            <td>
                                <?php
                                if ($val['Quantity'] > 0) {
                                    echo 'Available';
                                } else {
                                    echo 'Not Available';
                                }
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
</body>

</html>