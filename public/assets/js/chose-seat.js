document.addEventListener('DOMContentLoaded', function () {
    const selectedSeats = [];
    const formSeat = document.getElementById('form-seat');
    const seatCheckboxes = document.querySelectorAll('.seat-checkbox');
    const selectedSeatsElement = document.getElementById('selectedSeats');
    const quantityElement = document.getElementById('quantity');
    const priceElement = document.getElementById('price');
    const subTotalElement = document.getElementById('subTotal');
    const totalTaxElement = document.getElementById('totalTax');
    const grandTotalElement = document.getElementById('grandTotal');

    const basePrice = 50000;
    const taxRate = 0.11;

    // Function to update the seat display information
    function updateSeatInfo() {
        quantityElement.textContent = `${selectedSeats.length} People`;
        selectedSeatsElement.textContent = selectedSeats.join(', ');

        const subTotal = basePrice * selectedSeats.length;
        const totalTax = subTotal * taxRate;
        const grandTotal = subTotal + totalTax;

        priceElement.textContent = `Rp ${basePrice.toLocaleString()}`;
        subTotalElement.textContent = `Rp ${subTotal.toLocaleString()}`;
        totalTaxElement.textContent = `Rp ${totalTax.toLocaleString()}`;
        grandTotalElement.textContent = `Rp ${grandTotal.toLocaleString()}`;
    }

    // Add event listener to each seat checkbox
    seatCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            const seatLabel = this.closest('label');
            const seatName = seatLabel.getAttribute('data-seat');
            const seatId = seatLabel.getAttribute('data-seat-id');

            if (this.checked) {
                selectedSeats.push(seatName);
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'selected_seats[]';
                input.value = seatId;
                formSeat.appendChild(input);
                seatLabel.classList.add('selected');
            } else {
                const index = selectedSeats.indexOf(seatName);
                if (index > -1) {
                    selectedSeats.splice(index, 1);
                    document.querySelector(`input[name="selected_seats[]"][value="${seatId}"]`).remove();
                }
                seatLabel.classList.remove('selected');
            }
            updateSeatInfo();
        });
    });
});
