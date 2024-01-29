<x-bkash::layout>
    <div class="mx-auto max-w-screen-xl space-y-6 py-12">

        <div class="flex items-center space-x-6">
            <div class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <a href="#">
                    <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">
                        Total Amount: ৳ {{ $total }}
                    </h5>
                </a>
                <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">
                    Total amount of {{ $period }} days
                </p>
            </div>
            <div class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <a href="#">
                    <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">
                        Total Transactions: {{ $totalTransactions }}
                    </h5>
                </a>
                <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">
                    Total transactions of {{ $period }} days
                </p>
            </div>
            <div class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <a href="#">
                    <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">
                        Total Refunds: 100
                    </h5>
                </a>
                <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">
                    Total refunds of {{ $period }} days
                </p>
            </div>
        </div>

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

        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Mobile
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Payment ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Tax ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Amount
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Actions
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($transactions as $transaction)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $transaction->created_at->format('d M Y') }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $transaction->customerMsisdn }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $transaction->paymentID }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $transaction->trxID }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $transaction->transactionStatus }}
                        </td>
                        <td class="px-6 py-4">
                            ৳ {{ $transaction->amount }}
                        </td>
                        <td class="px-6 py-4 space-x-3">
                            <a href="{{ route('bkash.show', $transaction->id) }}"
                               class="text-blue-600 hover:text-blue-700 dark:hover:text-blue-500 hover:underline dark:hover:text-blue-400">
                                View
                            </a>
                            <a href="/bkash/refund/{{ $transaction->id }}"
                               class="text-blue-600 hover:text-blue-700 dark:hover:text-blue-500 hover:underline dark:hover:text-blue-400">
                                Refund
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div>
            {{ $transactions->links() }}
        </div>
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
</x-bkash::layout>
