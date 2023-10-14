@extends('layout')
@section('content')
    <div class="row mb-3">
        <div class="col-12 col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title d-inline-block">Total Revenue</h5>

                    <p class="card-text my-2 h3">£ {{ $allTransactions->sum }} </p>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title d-inline-block">Total Deals Won</h5>

                    <p class="card-text my-2 h3">{{ $dealsWonCount }}</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title d-inline-block">Total Deals Won worth</h5>

                    <p class="card-text my-2 h3">£ {{ $dealsWonWorth }}</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title d-inline-block">Total Clients</h5>

                    <p class="card-text my-2 h3">{{ $allClients->count }}</p>
                </div>
            </div>
        </div>

    </div>

    <div class="row mb-3">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title d-inline-block">Total Revenue for the year <span class="selectedYear"></span></h5>
                    <p class="card-text my-2 h3 totalAmount"></p>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title d-inline-block">Total Clients for the year <span class="selectedYear2"></span>
                    </h5>

                    <p class="card-text my-2 h3 totalClient"></p>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-6 p-2">
            <div>
                <select class="form-control my-2 transactionYear d-inline-block rounded-1" aria-label="select">
                    <option value="2023">2023</option>
                    <option value="2022">2022</option>
                    <option value="2021">2021</option>
                    <option value="2020">2020</option>
                </select>
            </div>
            <canvas class="border rounded-3" id="revenueChart"></canvas>

        </div>
        <div class="col-12 col-md-6 p-2">
            <div>
                <select class="form-control my-2 clientYear d-inline-block rounded-1" aria-label="select">
                    <option value="2023">2023</option>
                    <option value="2022">2022</option>
                    <option value="2021">2021</option>
                    <option value="2020">2020</option>
                </select>
            </div>
            <canvas class="border rounded-3" id="clientChart"></canvas>

        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-6 p-2">
            <div>
                <select class="form-control my-2 dealYear d-inline-block rounded-1" aria-label="select">
                    <option value="2023">2023</option>
                    <option value="2022">2022</option>
                    <option value="2021">2021</option>
                    <option value="2020">2020</option>
                </select>
            </div>
            <canvas class="border rounded-3" id="dealWonChart"></canvas>

        </div>
        <div class="col-12 col-md-6 p-2">
            <div>
                <select class="form-control my-2 allDealsYear d-inline-block rounded-1" aria-label="select">
                    <option value="2023">2023</option>
                    <option value="2022">2022</option>
                    <option value="2021">2021</option>
                    <option value="2020">2020</option>
                </select>
            </div>
            <canvas class="border rounded-3" id="allDealChart"></canvas>

        </div>
    </div>


    <script>
        let revenueBarChart;
        let dealWonBarChart;
        let allDealLineChart;
        let clientLineChart;

        let today = new Date();
        let currentYear = new Date().getFullYear();

        $('.selectedYear').text(currentYear);
        $('.selectedYear2').text(currentYear);

        loadRevenueData();
        changeRevenueYear();
        loadDealWonChartData();
        changeDealWon();
        loadAllDealChartData();
        changeAllDeal();
        loadClientChartData();
        changeClient();

        function loadClientChartData() {
            $.ajax({
                type: "GET",
                url: "/dashboard/showClients",
                dataType: "json",
                success: function(response) {

                    console.log(response);
                    clientChart(response[0])
                    $('.totalClient').text(response[1]);


                }
            });
        }

        function changeClient() {
            let selectElement = document.querySelector('.clientYear');
            selectElement.addEventListener('change', function() {
                let yearValue = this.value;

                $('.selectedYear2').text('');
                $('.selectedYear2').text(yearValue);


                console.log(yearValue);
                $.ajax({
                    type: "GET",
                    url: "/dashboard/showClients",
                    data: {
                        yearValue: yearValue
                    },
                    dataType: "json",
                    success: function(response) {

                        console.log(response);

                        clientChart(response[0]);
                        $('.totalClient').text(response[1]);

                    }
                });

            });
        }

        function loadAllDealChartData() {
            $.ajax({
                type: "GET",
                url: "/dashboard/showAllDeals",
                dataType: "json",
                success: function(response) {

                    console.log(response);

                    allDealChart(response);

                }
            });
        }

        function changeAllDeal() {
            //select option
            let selectElement = document.querySelector('.allDealsYear');
            selectElement.addEventListener('change', function() {
                let yearValue = this.value;

                $.ajax({
                    type: "GET",
                    url: "/dashboard/showAllDeals",
                    data: {
                        yearValue: yearValue
                    },
                    dataType: "json",
                    success: function(response) {

                        console.log(response);

                        allDealChart(response);
                    }
                });

            });
        }

        function loadRevenueData() {
            $.ajax({
                type: "GET",
                url: "/dashboard/showTransaction",
                dataType: "json",
                success: function(response) {

                    console.log(response);

                    transactionChart(response[0]);
                    $('.totalAmount').text('£ ' + response[1]);

                }
            });
        }

        function loadDealWonChartData() {
            $.ajax({
                type: "GET",
                url: "/dashboard/showDealWon",
                dataType: "json",
                success: function(response) {

                    dealWonChart(response);
                }
            });
        }

        function changeRevenueYear() {
            //select option
            let selectElement = document.querySelector('.transactionYear');
            selectElement.addEventListener('change', function() {
                let yearValue = this.value;

                $('.selectedYear').text('');
                $('.selectedYear').text(yearValue);

                console.log(yearValue);

                $.ajax({
                    type: "GET",
                    url: "/dashboard/showTransaction",
                    data: {
                        yearValue: yearValue
                    },
                    dataType: "json",
                    success: function(response) {

                        console.log(response);

                        transactionChart(response[0]);
                        $('.totalAmount').text('£ ' + response[1]);
                    }
                });

            });
        }

        function changeDealWon() {
            //select option
            let selectElement = document.querySelector('.dealYear');
            selectElement.addEventListener('change', function() {
                let yearValue = this.value;

                console.log(yearValue);

                $.ajax({
                    type: "GET",
                    url: "/dashboard/showDealWon",
                    data: {
                        yearValue: yearValue
                    },
                    dataType: "json",
                    success: function(response) {

                        console.log(response);
                        dealWonChart(response);

                    }
                });
            });
        }

        function transactionChart(response) {

            // Destroy any existing chart
            if (revenueBarChart) {
                revenueBarChart.destroy();
            }

            let totalTransactionsWithMonth = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
            let allData = response;

            let totalRevenue = 0;

            for (const [monthIndex, amountSum] of Object.entries(allData)) {
                totalTransactionsWithMonth[monthIndex - 1] = amountSum;
                totalRevenue += amountSum;
            }

            console.log(totalRevenue);

            const revenueChart = document.getElementById('revenueChart');

            revenueBarChart = new Chart(revenueChart, {
                type: 'bar',
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                        'October', 'November', 'December'
                    ],
                    datasets: [{
                        label: 'Monthly Revenue breakdown',
                        data: totalTransactionsWithMonth,
                        borderWidth: 1,
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                }
            });
        }

        function allDealChart(response) {

            if (allDealLineChart) {
                allDealLineChart.destroy();
            }
            //New
            let totalNew = 0;
            let dealsNew = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
            let allData1 = response[0];


            for (const [monthIndex, countDeal] of Object.entries(allData1)) {
                dealsNew[monthIndex - 1] = countDeal;
                totalNew += countDeal;
            }

            //Proposal
            let totalProposal = 0;
            let dealsProposal = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
            let allData2 = response[1];

            for (const [monthIndex, countDeal] of Object.entries(allData2)) {
                dealsProposal[monthIndex - 1] = countDeal;
                totalProposal += countDeal;
            }

            //Negotiation
            let totalNegotiation = 0;
            let dealsNegotiation = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
            let allData3 = response[2]

            for (const [monthIndex, countDeal] of Object.entries(allData3)) {
                dealsNegotiation[monthIndex - 1] = countDeal;
                totalNegotiation += countDeal;
            }

            //Won
            let totalWon = 0;
            let dealsWon = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
            let allData4 = response[3];


            for (const [monthIndex, countDeal] of Object.entries(allData4)) {
                dealsWon[monthIndex - 1] = countDeal;
                totalWon += countDeal;
            }

            //Lost
            let totalLost = 0
            let dealsLost = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
            let allData = response[4]

            for (const [monthIndex, countDeal] of Object.entries(allData)) {
                dealsLost[monthIndex - 1] = countDeal;
                totalLost += countDeal;
            }

            const allDealsChart = document.getElementById('allDealChart');

            allDealLineChart = new Chart(allDealsChart, {
                type: 'line',
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                        'October', 'November', 'December'
                    ],
                    datasets: [{
                            label: 'New ' + totalNew,
                            data: dealsNew,
                            borderWidth: 1,
                            tension: 0.4,
                            borderColor: '#00bfff'
                        },
                        {
                            label: 'Proposal ' + totalProposal,
                            data: dealsProposal,
                            borderWidth: 1,
                            tension: 0.4,
                            borderColor: '#00ffff'
                        },
                        {
                            label: 'Negotiation ' + totalNegotiation,
                            data: dealsNegotiation,
                            borderWidth: 1,
                            tension: 0.4,
                            borderColor: '#ffff00'
                        },
                        {
                            label: 'Won ' + totalWon,
                            data: dealsWon,
                            borderWidth: 2,
                            tension: 0.4,
                            borderColor: '#00ff00'
                        },
                        {
                            label: 'Lost ' + totalLost,
                            data: dealsLost,
                            borderWidth: 1,
                            tension: 0.4,
                            borderColor: '#ff0000',
                        }
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                        }
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: 'All Deals'
                        }
                    }
                }
            });
        }

        function dealWonChart(response) {

            if (dealWonBarChart) {
                dealWonBarChart.destroy();
            }

            let totalDealAmount = 0;
            let totalDealsWonWithMonth = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
            let allData = response;

            for (const [monthIndex, amountSum] of Object.entries(allData)) {
                totalDealsWonWithMonth[monthIndex - 1] = amountSum;
                totalDealAmount += amountSum;
            }

            const displayDealWonChart = document.getElementById('dealWonChart');

            dealWonBarChart = new Chart(displayDealWonChart, {
                type: 'bar',
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                        'October', 'November', 'December'
                    ],
                    datasets: [{
                        label: 'Total Deals Won' + ' worth £ ' +
                            totalDealAmount,
                        data: totalDealsWonWithMonth,
                        borderWidth: 1,
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                }
            });
        }


        function clientChart(response) {

            if (clientLineChart) {
                clientLineChart.destroy();
            }

            let totalClientsWithMonth = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

            let allData = response

            for (const [monthIndex, clientCount] of Object.entries(allData)) {
                totalClientsWithMonth[monthIndex - 1] = clientCount;
            }

            const clientChart = document.getElementById('clientChart');

            clientLineChart = new Chart(clientChart, {
                type: 'line',
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                        'October', 'November', 'December'
                    ],
                    datasets: [{
                        label: 'Total Monthly Client Enrollment',
                        data: totalClientsWithMonth,
                        borderWidth: 1,
                        tension: 0.4
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    </script>
@endsection
