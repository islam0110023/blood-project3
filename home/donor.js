const hospitalBtn = document.getElementById('hospitalBtn');
const donorBtn = document.getElementById('donorBtn');
const hospitalSection = document.getElementById('hospitalSection');
const donorSection = document.getElementById('donorSection');
const bloodBagsSection = document.getElementById('bloodBagsSection');
const hospitalSearch = document.getElementById('hospitalSearch');
const donorSearch = document.getElementById('donorSearch');

hospitalBtn.addEventListener('click', () => {
    hospitalSection.style.display = 'block';
    donorSection.style.display = 'none';
    bloodBagsSection.style.display = 'none';
});

donorBtn.addEventListener('click', () => {
    donorSection.style.display = 'block';
    hospitalSection.style.display = 'none';
    bloodBagsSection.style.display = 'none';
});

// Search functionality for hospitals (by location)
hospitalSearch.addEventListener('input', () => {
    const filter = hospitalSearch.value.toLowerCase(); // النص المدخل في البحث
    const rows = hospitalSection.querySelectorAll('tbody tr'); // الصفوف في الجدول

    rows.forEach(row => {
        const location = row.cells[1].textContent.toLowerCase(); // عمود المحافظة
        row.style.display = location.includes(filter) ? '' : 'none'; // إظهار أو إخفاء الصف
    });
});

// Search functionality for donors (by blood type)
donorSearch.addEventListener('input', () => {
    const filter = donorSearch.value.toLowerCase(); // النص المدخل في البحث
    const rows = donorSection.querySelectorAll('tbody tr'); // الصفوف في الجدول

    rows.forEach(row => {
        const bloodType = row.cells[3].textContent.toLowerCase(); // عمود فصيلة الدم
        row.style.display = bloodType.includes(filter) ? '' : 'none'; // إظهار أو إخفاء الصف
    });
});


// Show blood bags functionality
function showBloodBags(hospitalName) {
    hospitalSection.style.display = 'none';
    donorSection.style.display = 'none';
    bloodBagsSection.style.display = 'block';

    const bloodBagsTableBody = document.getElementById('bloodBagsTableBody');
    bloodBagsTableBody.innerHTML = ''; // Clear previous data

    // Example blood bags data
    const bloodData = {
        'City Hospital': [
            { type: 'A+', status: 'Available' },
            { type: 'B+', status: 'Unavailable' },
        ],
        'Alexandria Medical Center': [
            { type: 'O+', status: 'Available' },
            { type: 'AB-', status: 'Unavailable' },
        ],
    };

    const bloodBags = bloodData[hospitalName] || [];
    bloodBags.forEach(blood => {
        const row = document.createElement('tr');
        row.innerHTML = `<td>${blood.type}</td><td>${blood.status}</td>`;
        bloodBagsTableBody.appendChild(row);
        const backBtn = document.getElementById('backBtn');

backBtn.addEventListener('click', () => {
    hospitalSection.style.display = 'none';
    donorSection.style.display = 'none';
    bloodBagsSection.style.display = 'none';

    // Show the main menu
    hospitalSection.style.display = 'block'; // Or choose the section to display initially
});

    });
}
