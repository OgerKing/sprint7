<div class="dropdown menu-options form-floating date-range-picker-container">
    <label for="dateRangeInput" class="input-label">Select Date</label>
    <div class="input-group">
        <input
            id="datePicker"
            class="date-range-input form-styles"
            type="text"
            name="date"
            wire:ignore
            x-data
            x-init="
                $('#datePicker').daterangepicker(
                    {
                        singleDatePicker: true,
                        showDropdowns: true,
                        autoUpdateInput: false,
                    },
                    function (chosen_date) {
                        console.log('New date selected: ' + chosen_date.format('YYYY-MM-DD'));
                        $('#datePicker').val(chosen_date.format('MM/DD/YYYY'));
                        @this.set('date', chosen_date.format('MM/DD/YYYY'));
                    }
                );
                $('#datePicker').val('Select a date');
            "
        />
        <span class="input-group-text calendar-icon">
            <i class="bi bi-calendar"></i>
        </span>
    </div>
</div>
