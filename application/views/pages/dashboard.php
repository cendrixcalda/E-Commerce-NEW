<div class="dashboard-top">
    <div class="dashboard-box-sm">
        <div class="icon-container">
            <i class="fas fa-dollar-sign"></i>
        </div>
        <div class="details">
            <p>Total Revenue</p>
            <p id="revenue-alltime"></p>
        </div>
    </div>
    <div class="dashboard-box-sm">
        <div class="icon-container">
            <i class="fas fa-shopping-cart"></i>
        </div>
        <div class="details">
            <p>Total Orders</p>
            <p id="oders-alltime"></p>
        </div>
    </div>
    <div class="dashboard-box-sm">
        <div class="icon-container">
            <i class="fas fa-truck"></i>
        </div>
        <div class="details">
            <p>Total Items Sold</p>
            <p id="oder-details-alltime"></p>
        </div>
    </div>
    <div class="dashboard-box-sm">
        <div class="icon-container">
            <i class="fas fa-user-tag"></i>
        </div>
        <div class="details">
            <p>Total Customers</p>
            <p id="customers-alltime"></p>
        </div>
    </div>
</div>

<div class="dashboard-main">
    <div class="dashboard-box-md">
        <div class="title-container">
            <p>Revenue Chart</p>
            <p>Data shown is from this year's activity (<?php echo date('Y') ?>).</p>
        </div>
        <div class="chart-container">
            <canvas id="revenueChart"></canvas>
        </div>
    </div>
    <div class="dashboard-box-md">
        <div class="title-container">
            <p>Orders Chart</p>
            <p>Data shown is from this year's activity (<?php echo date('Y') ?>).</p>
        </div>
        <div class="chart-container">
            <canvas id="ordersChart"></canvas>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        var ctx = document.getElementById('revenueChart');
        var ctx1 = document.getElementById('ordersChart');

        Chart.defaults.global.defaultFontColor = 'rgb(41, 41, 41)';
        // Chart.defaults.global.defaultFillStyle = "transparent";

        var revenueChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                    data: [],
                    fill: true,
                    pointBackgroundColor: 'rgb(41, 41, 41)',
                    borderColor: 'rgb(41, 41, 41)',
                    borderWidth: 1
                }]
            },
            options:{
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false,
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            display: false,
                        },
                        ticks: {
                            beginAtZero: true,
                            maxTicksLimit: 5
                        }
                    }]
                },
                legend:{
                    display:false
                },
                elements: {
                    point:{
                        radius: 0
                    }
                }
            }
        });
        
        var ordersChart = new Chart(ctx1, {
            type: 'line',
            data: {
                labels: [],
                datasets: [
                    {
                        label: "Total",
                        fill: false,
                        backgroundColor: "rgb(41, 41, 41)",
                        borderColor: "rgb(41, 41, 41)",
                        borderWidth: 1,
                        data: []
                    },
                    {
                        label: "Incomplete",
                        fill: false,
                        backgroundColor: "rgb(61, 27, 216)",
                        borderColor: "rgb(61, 27, 216)",
                        borderWidth: 1,
                        data: []
                    },
                    {
                        label: "Completed",
                        fill: false,
                        backgroundColor: "rgb(33, 208, 231)",
                        borderColor: "rgb(33, 208, 231)",
                        borderWidth: 1,
                        data: []
                    },
                    {
                        label: "Cancelled",
                        fill: false,
                        backgroundColor: "rgb(250, 3, 77)",
                        borderColor: "rgb(250, 3, 77)",
                        borderWidth: 1,
                        data: [],
                        hidden: true,
                    },
                    {
                        label: "Refunded",
                        fill: false,
                        backgroundColor: "rgb(176, 22, 196)",
                        borderColor: "rgb(176, 22, 196)",
                        borderWidth: 1,
                        data: [],
                        hidden: true,
                    },
                    ],
            },
            options:{
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false,
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            display: false,
                        },
                        ticks: {
                            beginAtZero: true,
                            maxTicksLimit: 5
                        }
                    }]
                },
                legend:{
                    display:true,
                    lineWidth: 2,
                    labels:{
                        boxWidth: 4,
                    }
                },
                elements: {
                    point:{
                        radius: 0
                    }
                }
            }
        });

        function formatNumber(num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
        }

        function allTimeRevenue(){
            $.ajax({
                url: '<?php echo base_url(); ?>orderDetails/getRevenueAllTime',
                success: function(revenue){
                    $('#revenue-alltime').html('&#8369;'+formatNumber(revenue));
                }
            });
        };

        function allTimeOrders(){
            $.ajax({
                url: '<?php echo base_url(); ?>orders/getOrdersAllTime',
                success: function(orders){
                    $('#oders-alltime').html(formatNumber(orders));
                }
            });
        };

        function allTimeItemsSold(){
            $.ajax({
                url: '<?php echo base_url(); ?>orderDetails/getItemsSoldAllTime',
                success: function(itemsSold){
                    $('#oder-details-alltime').html(formatNumber(itemsSold));
                }
            });
        };

        function allTimeCustomers(){
            $.ajax({
                url: '<?php echo base_url(); ?>customers/getCustomersAllTime',
                success: function(customers){
                    $('#customers-alltime').html(formatNumber(customers));
                }
            });
        };

        function monthlyOrders(){
            $.ajax({
                url: '<?php echo base_url(); ?>orders/getMonthlyOrders',
                success: function(orders){
                    var orders = JSON.parse(orders);
                    ordersChart.data.labels.push("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");

                    for (var i in orders.total) {
                        ordersChart.data.datasets[0].data.push(orders.total[i]);
                    }

                    for (var i in orders.incomplete) {
                        ordersChart.data.datasets[1].data.push(orders.incomplete[i]);
                    }

                    for (var i in orders.completed) {
                        ordersChart.data.datasets[2].data.push(orders.completed[i]);
                    }

                    for (var i in orders.cancelled) {
                        ordersChart.data.datasets[3].data.push(orders.cancelled[i]);
                    }

                    for (var i in orders.refunded) {
                        ordersChart.data.datasets[4].data.push(orders.refunded[i]);
                    }
                    
                    // ordersChart.data.datasets[1].data.push(3, 6, 8, 2, 5, 1, 3, 4, 6);
                    ordersChart.update();
                }
            });
        };

        function monthlyRevenue(){
            $.ajax({
                url: '<?php echo base_url(); ?>orderDetails/getMonthlyRevenue',
                success: function(revenue){
                    var revenue = JSON.parse(revenue);
                    revenueChart.data.labels.push("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");

                    for (var i in revenue.data) {
                        revenueChart.data.datasets[0].data.push(revenue.data[i]);
                    }
                    revenueChart.update();
                }
            });
        };

        allTimeRevenue();
        allTimeOrders();
        allTimeItemsSold();
        allTimeCustomers();
        monthlyOrders();
        monthlyRevenue();
    });
</script>