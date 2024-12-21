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
                            <th>Info</th> <!-- العمود الجديد -->
                        </tr>
                    </thead>
                    <tbody id="hospitalTableBody">
                        <!-- بيانات المستشفيات ستملأ هنا بواسطة الباك إند -->
                        <tr>
                            <td><input type="text" name="hospital_name_1" id="hospital_name_1" placeholder="Hospital Name" readonly></td>
                            <td><input type="text" name="hospital_location_1" id="hospital_location_1" placeholder="Location" readonly></td>
                            <td><input type="text" name="hospital_contact_1" id="hospital_contact_1" placeholder="Contact" readonly></td>
                            <td><a href="bags.php" target="_blank">View Info</a></td> <!-- رابط جديد -->
                        </tr>
                        <tr>
                            <td><input type="text" name="hospital_name_2" id="hospital_name_2" placeholder="Hospital Name" readonly></td>
                            <td><input type="text" name="hospital_location_2" id="hospital_location_2" placeholder="Location" readonly></td>
                            <td><input type="text" name="hospital_contact_2" id="hospital_contact_2" placeholder="Contact" readonly></td>
                            <td><a href="bags.php" target="_blank">View Info</a></td> <!-- رابط جديد -->
                        </tr>
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
                        <tr>
                            <td><input type="text" name="donor_name_1" id="donor_name_1" placeholder="Donor Name" readonly></td>
                            <td><input type="text" name="donor_phone_1" id="donor_phone_1" placeholder="Phone" readonly></td>
                            <td><input type="text" name="donor_governorate_1" id="donor_governorate_1" placeholder="Governorate" readonly></td>
                            <td><input type="text" name="donor_blood_type_1" id="donor_blood_type_1" placeholder="Blood Type" readonly></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="donor_name_2" id="donor_name_2" placeholder="Donor Name" readonly></td>
                            <td><input type="text" name="donor_phone_2" id="donor_phone_2" placeholder="Phone" readonly></td>
                            <td><input type="text" name="donor_governorate_2" id="donor_governorate_2" placeholder="Governorate" readonly></td>
                            <td><input type="text" name="donor_blood_type_2" id="donor_blood_type_2" placeholder="Blood Type" readonly></td>
                        </tr>
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
        hospitalBtn.addEventListener('click', function() {
            // إخفاء قسم المتبرعين وعرض قسم المستشفيات
            hospitalSection.style.display = 'block';
            donorSection.style.display = 'none';
        });

        // عند الضغط على زر المتبرعين
        donorBtn.addEventListener('click', function() {
            // إخفاء قسم المستشفيات وعرض قسم المتبرعين
            donorSection.style.display = 'block';
            hospitalSection.style.display = 'none';
        });
    </script>
</body>
</html>
