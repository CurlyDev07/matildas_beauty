@extends('admin.sms.layouts')

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection

@section('page')

<div class="tflex tjustify-between text-sm tfont-medium tpx-5 tpy-4 t ttext-title">
    <div class="">Follow Ups</div>
    <div class="tborder tflex titems-center tpx-2 tpy-1 trounded ttext-sm" >
        <img class="tpr-1" src="{{ asset('images/icons/calendar.png') }}" alt="">
        <input type="text" name="date" id="date" value="" class="browser-default tooltipped" data-position="top" data-tooltip="Filter by date"/>
    </div>
</div>

<div class="tmax-w-2xl tmx-auto">
    <div class="ttext-center tmb-4">
        <h2 id="tchart-label" class="ttext-xl tfont-bold">Loading chart data...</h2>
    </div>

    <div class="tbg-white tshadow-md trounded-lg tp-4">
        <canvas id="followupChart" width="400" height="400"></canvas>
    </div>
</div>
@endsection

@section('js')
    <!-- Required Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Date Picker -->
    <script>
        $(function () {
            $('#date').daterangepicker({
                maxDate: moment(),
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
            });

            $('#date').on('apply.daterangepicker', function (ev, picker) {
                const parser = new URL(window.location.href);
                const formatted = picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY');
                parser.searchParams.set("date", formatted);
                window.location.href = parser.href;
            });
        });
    </script>

    <!-- Chart Loader -->
    <script>
        function getUrlParameter(name) {
            name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
            const regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
            const results = regex.exec(location.search);
            return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
        }

        let dateRange = getUrlParameter('date');
        if (!dateRange) {
            const today = moment().format('MM/DD/YYYY');
            dateRange = `${today} - ${today}`;
        }

        $(document).ready(function () {
            $.ajax({
                url: "https://misstisa.com/api/followups/statistics?date=" + encodeURIComponent(dateRange),
                method: "GET",
                success: function (res) {
                    const pending = res.pending ?? 0;
                    const sent = res.sent ?? 0;
                    const failed = res.failed ?? 0;

                    $('#tchart-label').text(`Follow-Up Stats: ${dateRange}`);

                    const data = {
                        labels: ['Pending', 'Sent', 'Failed'],
                        datasets: [{
                            label: 'Follow-ups',
                            data: [pending, sent, failed],
                            backgroundColor: ['#facc15', '#22c55e', '#ef4444'],
                            borderWidth: 1
                        }]
                    };

                    const config = {
                        type: 'pie',
                        data: data,
                        options: {
                            responsive: true,
                            plugins: {
                                legend: { position: 'bottom' }
                            }
                        },
                    };

                    new Chart(document.getElementById('followupChart'), config);
                },
                error: function (err) {
                    console.error("❌ Error fetching chart data:", err);
                    $('#tchart-label').text('Error loading chart data.');
                }
            });
        });
    </script>
@endsection
