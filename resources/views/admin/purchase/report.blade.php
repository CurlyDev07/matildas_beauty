@extends('admin.purchase.layouts')


@section('page')
    <div class="tbg-white tp-5 trounded-lg tshadow-lg ttext-black-100 ">
        <div class="tborder-b tflex titems-center tjustify-between tpx-5 tpy-3">
            <span class="ttext-base ttext-title tfont-medium">Purchase Report</span>
        </div>

        
        <div id="daily_chart" class="tmt-5"></div>
        <div id="monthly_chart" class="tmt-5"></div>
            
        <div id="suppliers"></div>

    </div>
@endsection


@section('js')





{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.slim.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js" ></script>

<script>

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }// numberWithCommas

    function dayChart() {
        $.ajax({
            url: '/admin/purchase/report-data',
            type: 'POST',
            data: {filter: 'day'},
            success: (data)=>{

                let total_prices = [];
                let dates = [];

                $.each(data, function (index, value) { 
                    total_prices.push(value.total_price);
                    dates.push(moment(value.created_at).format('DD'));
                });// arrange data 

                var dailychart = {
                    series: [{
                            name: "Purchase",
                            data: total_prices
                    }],
                    chart: {
                        height: 350,
                        type: 'line',
                        zoom: {
                            enabled: false
                        }
                    },
                        dataLabels: {
                        enabled: true,
                        formatter: function(val, index) {
                            return numberWithCommas(val)
                        }
                    },
                        stroke: {
                        curve: 'straight'
                    },
                        title: {
                        text: 'Purchase Trend by Day',
                        align: 'left'
                    },
                    grid: {
                        row: {
                            colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                            opacity: 0.5
                        },
                    },
                        xaxis: {
                        categories: dates,
                    }
                };

                var chart = new ApexCharts(document.querySelector("#daily_chart"), dailychart);
                chart.render();
            }
        });
    }

    function monthChart() {
        $.ajax({
            url: '/admin/purchase/report-data',
            type: 'POST',
            data: {filter: 'month'},
            success: (data)=>{

                let total_prices = [];
                let dates = [];

                $.each(data, function (index, value) { 
                    total_prices.push(value.total);
                    dates.push(value.month);
                });// arrange data 
                
                var dailychart = {
                    series: [{
                            name: "Purchase",
                            data: total_prices
                    }],
                    chart: {
                        height: 350,
                        type: 'line',
                        zoom: {
                            enabled: false
                        }
                    },
                        dataLabels: {
                        enabled: true,
                        
                    },
                        stroke: {
                        curve: 'straight'
                    },
                        title: {
                        text: 'Purchase Trend by Month',
                        align: 'left'
                    },
                    grid: {
                        row: {
                            colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                            opacity: 0.5
                        },
                    },
                        xaxis: {
                        categories: dates,
                    }
                };

                var chart = new ApexCharts(document.querySelector("#monthly_chart"), dailychart);
                chart.render();
            }
        }); 
    }
    dayChart();
    monthChart();


</script>
@endsection