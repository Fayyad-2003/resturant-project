<!-- RESERVATION MODAL START -->
<div class="fp__reservation">
    <div class="modal fade" id="reservationModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="reservationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="reservationModalLabel">Book a Table</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="fp__reservation_form" id="reservation_form">
                        @csrf
                        <input class="reservation_input" type="text" name="name"
                            value="{{ auth()->check() ? auth()->user()->name : '' }}" placeholder="Your Name" required>

                        <input class="reservation_input" type="text" name="phone"
                            value="{{ auth()->check() ? auth()->user()->phone : '' }}" placeholder="Phone Number"
                            required>

                        <input class="reservation_input" type="date" name="date" min="{{ date('Y-m-d') }}" required>

                        <select class="reservation_input form-select" name="time" required>
                            <option value="">Select Time</option>
                            <option value="08:00 AM - 10:00 AM">08:00 AM - 10:00 AM</option>
                            <option value="10:00 AM - 12:00 PM">10:00 AM - 12:00 PM</option>
                            <option value="12:00 PM - 02:00 PM">12:00 PM - 02:00 PM</option>
                            <option value="02:00 PM - 04:00 PM">02:00 PM - 04:00 PM</option>
                            <option value="04:00 PM - 06:00 PM">04:00 PM - 06:00 PM</option>
                            <option value="06:00 PM - 08:00 PM">06:00 PM - 08:00 PM</option>
                            <option value="08:00 PM - 10:00 PM">08:00 PM - 10:00 PM</option>
                            <option value="10:00 PM - 12:00 AM">10:00 PM - 12:00 AM</option>
                        </select>

                        <select class="reservation_input form-select" name="persons" required>
                            <option value="">Select Persons</option>
                            <option value="1">1 Person</option>
                            <option value="2">2 Persons</option>
                            <option value="3">3 Persons</option>
                            <option value="4">4 Persons</option>
                            <option value="5">5 Persons</option>
                            <option value="6">6 Persons</option>
                            <option value="8">8 Persons</option>
                            <option value="10">10+ Persons</option>
                        </select>

                        <button type="submit" id="reservation_btn">Confirm Reservation</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- RESERVATION MODAL END -->