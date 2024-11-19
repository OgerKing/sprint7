<div class="dropdown menu-options form-floating date-range-picker-container">
    <label for="dateRangeInput" class="input-label">Date Range</label>
    <div class="input-group">
        <input
            id="dateRangePicker"
            class="date-range-input form-styles"
            type="text"
            name="daterange"
            wire:ignore
            x-data
            x-init="
                            $('#dateRangePicker').daterangepicker(
                                {
                                    ranges: {
                                        'Today': [moment(), moment()],
                                        'Yesterday': [
                                            moment().subtract(1, 'days'),
                                            moment().subtract(1, 'days'),
                                        ],
                                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                                        'Last Month': [
                                            moment().subtract(1, 'month').startOf('month'),
                                            moment().subtract(1, 'month').endOf('month'),
                                        ],
                                    },
                                    'alwaysShowCalendars': true,
                                    autoUpdateInput: false,  
                                  
                                },
                                function (start, end, label) {
                                    console.log(
                                        'New date range selected: ' +
                                            start.format('YYYY-MM-DD') +
                                            ' to ' +
                                            end.format('YYYY-MM-DD') +
                                            ' (predefined range: ' +
                                            label +
                                            ')',
                                    )
                                    $('#dateRangePicker').val(start.format('MM/DD/YYYY') + ' - ' + end.format('MM/DD/YYYY'));
                    @this.set('dateRange', start.format('MM/DD/YYYY') + ' - ' + end.format('MM/DD/YYYY'));
                                },
                            )
                            $('#dateRangePicker').val('All');
                        "
        />
        <span class="input-group-text calendar-icon">
            <i class="bi bi-calendar"></i>
        </span>
    </div>
</div>
