document.addEventListener('DOMContentLoaded', function () {
    // Function to handle selecting a dropdown option
    function handleSelection(dropdownId, labelId) {
        const selectedOption = document.querySelector(`#${dropdownId} input:checked`);
        if (selectedOption) {
            const labelText = selectedOption.id;
            document.getElementById(labelId).textContent = labelText;
        }
    }

    // Add event listeners to each radio input inside the dropdowns
    document.querySelectorAll('#Departure-Dropdown input').forEach(input => {
        input.addEventListener('change', function () {
            handleSelection('Departure-Dropdown', 'Departure-Label');
            document.getElementById('Departure-Dropdown').classList.add('hidden');
        });
    });

    document.querySelectorAll('#Arrival-Dropdown input').forEach(input => {
        input.addEventListener('change', function () {
            handleSelection('Arrival-Dropdown', 'Arrival-Label');
            document.getElementById('Arrival-Dropdown').classList.add('hidden');
        });
    });
});


document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.dropdown');
    const dropdownContents = document.querySelectorAll('.dropdown-content');
    let activeDropdown = null;

    // Toggle dropdowns when clicking on the button
    buttons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.stopPropagation();
            const target = document.querySelector(this.getAttribute('data-dropdown-target'));

            if (activeDropdown && activeDropdown !== target) {
                activeDropdown.classList.add('hidden');
            }

            target.classList.toggle('hidden');
            activeDropdown = target.classList.contains('hidden') ? null : target;
        });
    });

    // Prevent dropdown from closing when clicking inside the dropdown content
    dropdownContents.forEach(content => {
        content.addEventListener('click', function (event) {
            event.stopPropagation();
        });
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function () {
        if (activeDropdown) {
            activeDropdown.classList.add('hidden');
            activeDropdown = null;
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const dateInput = document.getElementById('date');
    const dateLabel = document.getElementById('Date-Label');
    const today = new Date();
    const options = { year: 'numeric', month: 'short', day: 'numeric' };

    // Set the input date value to today's date
    dateInput.valueAsDate = today;

    // Update the Date-Label to today's date
    dateLabel.textContent = today.toLocaleDateString('id-ID', options);
});

document.getElementById('Date-Button').addEventListener('click', function () {
    document.getElementById('date').showPicker();
});

document.getElementById('date').addEventListener('change', function () {
    const dateInput = document.getElementById('date');
    const dateLabel = document.getElementById('Date-Label');
    const selectedDate = new Date(dateInput.value);
    const options = { year: 'numeric', month: 'short', day: 'numeric' };
    dateLabel.textContent = selectedDate.toLocaleDateString('id-ID', options);
});
document.addEventListener('DOMContentLoaded', function () {
    const quantityInput = document.getElementById('quantity');
    const numberDisplays = document.querySelectorAll('.number');
    const minusButton = document.getElementById('minus');
    const plusButton = document.getElementById('plus');

    function updateNumberDisplay(value) {
        numberDisplays.forEach(el => el.textContent = value);
    }

    // Initial update for the number displays
    updateNumberDisplay(quantityInput.value);

    plusButton.addEventListener('click', function () {
        let currentValue = parseInt(quantityInput.value);
        quantityInput.value = currentValue + 1;
        updateNumberDisplay(quantityInput.value);
    });

    minusButton.addEventListener('click', function () {
        let currentValue = parseInt(quantityInput.value);
        if (currentValue > 1) {
            quantityInput.value = currentValue - 1;
            updateNumberDisplay(quantityInput.value);
        }
    });

    // Update on manual input change
    quantityInput.addEventListener('input', function () {
        let value = parseInt(this.value) || 1;
        if (value < 1) value = 1;
        this.value = value;
        updateNumberDisplay(value);
    });
});

const swiper = new Swiper('.swiper', {
    // Optional parameters
    spaceBetween: 24,
    slidesPerView: 'auto',
    slidesOffsetAfter: 24,
    slidesOffsetBefore: 24,
});
