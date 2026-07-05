/**
 * Appointment Booking JavaScript
 * Handles appointment booking form and functionality
 */

class AppointmentBooking {
    constructor() {
        this.form = document.getElementById('appointmentForm');
        if (!this.form) return;

        this.serviceSelect = this.form.querySelector('[name="service_id"]');
        this.barberSelect = this.form.querySelector('[name="barber_id"]');
        this.dateInput = this.form.querySelector('[name="appointment_date"]');
        this.timeSelect = this.form.querySelector('[name="appointment_time"]');

        this.init();
    }

    init() {
        this.form.addEventListener('submit', (e) => this.handleSubmit(e));
        if (this.dateInput) this.dateInput.addEventListener('change', () => this.updateTimeSlots());
        if (this.barberSelect) this.barberSelect.addEventListener('change', () => this.updateTimeSlots());

        this.setMinDate();
    }

    setMinDate() {
        if (this.dateInput) {
            const today = new Date();
            const yyyy = today.getFullYear();
            const mm = String(today.getMonth() + 1).padStart(2, '0');
            const dd = String(today.getDate() + 1).padStart(2, '0');
            this.dateInput.min = `${yyyy}-${mm}-${dd}`;
            this.dateInput.value = `${yyyy}-${mm}-${dd}`;
        }
    }

    updateTimeSlots() {
        if (!this.dateInput || !this.barberSelect || !this.timeSelect) return;

        const date = this.dateInput.value;
        const barberId = this.barberSelect.value;

        if (!date || !barberId) return;

        fetch(`php/appointment.php?action=get_slots&barber_id=${barberId}&date=${date}`)
            .then(response => response.json())
            .then(data => {
                this.timeSelect.innerHTML = '<option value="">Select Time</option>';
                if (data.slots) {
                    data.slots.forEach(slot => {
                        const option = document.createElement('option');
                        option.value = slot;
                        option.textContent = formatTime(slot);
                        this.timeSelect.appendChild(option);
                    });
                }
            })
            .catch(error => console.error('Error:', error));
    }

    handleSubmit(e) {
        e.preventDefault();

        if (!validateForm(this.form)) return;

        const formData = new FormData(this.form);
        formData.append('action', 'book');

        fetch('php/appointment.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showMessage('Appointment booked successfully!', 'success');
                this.form.reset();
                setTimeout(() => {
                    window.location.href = 'appointments.php';
                }, 2000);
            } else {
                showMessage(data.message, 'error');
            }
        })
        .catch(error => {
            showMessage('An error occurred', 'error');
            console.error('Error:', error);
        });
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    new AppointmentBooking();
});
