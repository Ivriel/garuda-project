// Generate options for day, month, and year once
function populateDateOptions() {
    const daySelects = document.querySelectorAll('.day-select');
    const monthSelects = document.querySelectorAll('.month-select');
    const yearSelects = document.querySelectorAll('.year-select');
    
    // Populate days (1-31)
    for (let i = 1; i <= 31; i++) {
        daySelects.forEach(select => {
            select.innerHTML += `<option value="${i}">${i}</option>`;
        });
    }

    // Populate months (01-12)
    const months = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
    months.forEach((month, index) => {
        monthSelects.forEach(select => {
            select.innerHTML += `<option value="${index + 1}">${month}</option>`;
        });
    });

    // Populate years (current year to 100 years back)
    const currentYear = new Date().getFullYear();
    for (let i = currentYear; i >= currentYear - 100; i--) {
        yearSelects.forEach(select => {
            select.innerHTML += `<option value="${i}">${i}</option>`;
        });
    }
}

populateDateOptions();