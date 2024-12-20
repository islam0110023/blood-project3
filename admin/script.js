const donors = [
    { name: "John Doe", bloodType: "A+" },
    { name: "Jane Smith", bloodType: "O-" }
];

const hospitals = [
    { name: "Hospital A", location: "City A", bloodTypes: ["A+", "O-"] },
    { name: "Hospital B", location: "City B", bloodTypes: ["B+", "AB+"] }
];

const bloodTypes = ["A+", "A-", "B+", "B-", "O+", "O-", "AB+", "AB-"];

// Function to update the dashboard with the total counts
function updateDashboard() {
    document.getElementById('donors-count').innerText = donors.length;
    document.getElementById('hospitals-count').innerText = hospitals.length;
    document.getElementById('blood-types-count').innerText = bloodTypes.length;
}

// Display the data when the page loads
window.onload = function () {
    updateDashboard();
};