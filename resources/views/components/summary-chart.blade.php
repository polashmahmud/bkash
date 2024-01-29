<div class="w-full bg-white rounded-lg shadow dark:bg-gray-800">
    <div class="flex justify-between p-4 md:p-6 pb-0 md:pb-0">
        <div>
            <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">৳ {{ array_sum($sums) }}</h5>
            <p class="text-base font-normal text-gray-500 dark:text-gray-400">
                {{ $period }} days total
            </p>
        </div>
    </div>
    <div id="labels-chart" class="px-2.5"></div>
</div>

<script>
    // ApexCharts options and config
    window.addEventListener("load", function() {
        let options = {
            // set the labels option to true to show the labels on the X and Y axis
            xaxis: {
                show: true,
                categories: {{ Js::from($dates) }},
                labels: {
                    show: true,
                    style: {
                        fontFamily: "Inter, sans-serif",
                        cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                    }
                },
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false,
                },
            },
            yaxis: {
                show: true,
                labels: {
                    show: true,
                    style: {
                        fontFamily: "Inter, sans-serif",
                        cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                    },
                    formatter: function (value) {
                        return '৳' + value;
                    }
                }
            },
            series: [
                {
                    name: "Amount",
                    data: {{ Js::from($sums) }},
                    color: "#7E3BF2",
                },
            ],
            chart: {
                sparkline: {
                    enabled: false
                },
                height: "100%",
                width: "100%",
                type: "area",
                fontFamily: "Inter, sans-serif",
                dropShadow: {
                    enabled: false,
                },
                toolbar: {
                    show: false,
                },
            },
            tooltip: {
                enabled: true,
                x: {
                    show: false,
                },
            },
            fill: {
                type: "gradient",
                gradient: {
                    opacityFrom: 0.55,
                    opacityTo: 0,
                    shade: "#1C64F2",
                    gradientToColors: ["#1C64F2"],
                },
            },
            dataLabels: {
                enabled: false,
            },
            stroke: {
                width: 6,
            },
            legend: {
                show: false
            },
            grid: {
                show: false,
            },
        }

        if (document.getElementById("labels-chart") && typeof ApexCharts !== 'undefined') {
            const chart = new ApexCharts(document.getElementById("labels-chart"), options);
            chart.render();
        }
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
