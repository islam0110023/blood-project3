<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital and Donor Details</title>
    <link rel="stylesheet" href="donor.css">
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <button id="hospitalBtn">Hospitals</button>
            <button id="donorBtn">Donors</button>
        </aside>

        <div class="content">
            <div id="hospitalSection">
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
                        </tr>
                    </thead>
                    <tbody>
                        <tr onclick="showBloodBags('City Hospital')">
                            <td>City Hospital</td>
                            <td>Cairo</td>
                            <td>+201234567890</td>
                        </tr>
                        <tr onclick="showBloodBags('Alexandria Medical Center')">
                            <td>Alexandria Medical Center</td>
                            <td>Alexandria</td>
                            <td>+201987654321</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div id="donorSection" style="display: none;">
                <h1>Donors</h1>
                <div class="search-bar">
                    <input type="text" id="donorSearch" placeholder="Search donors by 	Blood Type...">
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
                    <tbody>
                        <tr>
                            <td>Ali Ahmed</td>
                            <td>+201234567890</td>
                            <td>Cairo</td>
                            <td>O+</td>
                        </tr>
                        <tr>
                            <td>Sara Mohamed</td>
                            <td>+201987654321</td>
                            <td>Alexandria</td>
                            <td>A+</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div id="bloodBagsSection" style="display: none;">
                <button id="backBtn">Back</button>
                <h1>Blood Bags Availability</h1>
                <table>
                    <thead>
                        <tr>
                            <th>Blood Type</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="bloodBagsTableBody">
                        <!-- Dynamic content -->
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>

    <script src="donor.js"></script>
</body>
</html>
