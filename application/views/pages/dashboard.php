<div class="dashboard-top">
    <div class="dashboard-box-sm">
        <div class="icon-container">
            <i class="fas fa-dollar-sign"></i>
        </div>
        <div class="details detail-1">
            <p>Total Revenue</p>
        </div>
    </div>
    <div class="dashboard-box-sm">
        <div class="icon-container">
            <i class="fas fa-shopping-cart"></i>
        </div>
        <div class="details detail-2">
            <p>Total Orders</p>
        </div>
    </div>
    <div class="dashboard-box-sm">
        <div class="icon-container">
            <i class="fas fa-truck"></i>
        </div>
        <div class="details detail-3">
            <p>Total Items Sold</p>
        </div>
    </div>
    <div class="dashboard-box-sm">
        <div class="icon-container">
            <i class="fas fa-user-tag"></i>
        </div>
        <div class="details detail-4">
            <p>Total Customers</p>
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
                    fill: false,
                    pointBackgroundColor: 'rgb(41, 41, 41)',
                    borderColor: 'rgb(41, 41, 41)',
                    borderWidth: 3
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
                },
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
                        borderWidth: 3,
                        data: []
                    },
                    {
                        label: "Incomplete",
                        fill: false,
                        backgroundColor: "rgb(61, 27, 216)",
                        borderColor: "rgb(61, 27, 216)",
                        borderWidth: 3,
                        data: []
                    },
                    {
                        label: "Completed",
                        fill: false,
                        backgroundColor: "rgb(33, 208, 231)",
                        borderColor: "rgb(33, 208, 231)",
                        borderWidth: 3,
                        data: []
                    },
                    {
                        label: "Cancelled",
                        fill: false,
                        backgroundColor: "rgb(250, 3, 77)",
                        borderColor: "rgb(250, 3, 77)",
                        borderWidth: 3,
                        data: [],
                        hidden: true,
                    },
                    {
                        label: "Refunded",
                        fill: false,
                        backgroundColor: "rgb(176, 22, 196)",
                        borderColor: "rgb(176, 22, 196)",
                        borderWidth: 3,
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
                    $('.detail-1').append('<p class="counter1">'+formatNumber(revenue)+'</p>')
                    $('.counter1').counterUp({
                        time: 1000
                    });
                }
            });
        };

        function allTimeOrders(){
            $.ajax({
                url: '<?php echo base_url(); ?>orders/getOrdersAllTime',
                success: function(orders){
                    $('.detail-2').append('<p class="counter2">'+formatNumber(orders)+'</p>')
                    $('.counter2').counterUp({
                        time: 1000
                    });
                }
            });
        };

        function allTimeItemsSold(){
            $.ajax({
                url: '<?php echo base_url(); ?>orderDetails/getItemsSoldAllTime',
                success: function(itemsSold){
                    $('.detail-3').append('<p class="counter3">'+formatNumber(itemsSold)+'</p>')
                    $('.counter3').counterUp({
                        time: 1000
                    });
                }
            });
        };

        function allTimeCustomers(){
            $.ajax({
                url: '<?php echo base_url(); ?>customers/getCustomersAllTime',
                success: function(customers){
                    $('.detail-4').append('<p class="counter4">'+formatNumber(customers)+'</p>')
                    $('.counter4').counterUp({
                        time: 1000
                    });
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
                        ordersChart.update();
                    }

                    for (var i in orders.incomplete) {
                        ordersChart.data.datasets[1].data.push(orders.incomplete[i]);
                        ordersChart.update();
                    }

                    for (var i in orders.completed) {
                        ordersChart.data.datasets[2].data.push(orders.completed[i]);
                        ordersChart.update();
                    }

                    for (var i in orders.cancelled) {
                        ordersChart.data.datasets[3].data.push(orders.cancelled[i]);
                        ordersChart.update();
                    }

                    for (var i in orders.refunded) {
                        ordersChart.data.datasets[4].data.push(orders.refunded[i]);
                        ordersChart.update();
                    }
                    
                }
            });
        };

        function monthlyRevenue(){
            $.ajax({
                url: '<?php echo base_url(); ?>orderDetails/getMonthlyRevenue',
                success: function(revenue){
                    var revenue = JSON.parse(revenue);
                    var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                    // revenueChart.data.labels.push("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
                    
                    for (var i in revenue.data) {
                        revenueChart.data.labels.push(months[i]);
                        revenueChart.data.datasets[0].data.push(revenue.data[i]);
                        revenueChart.update();
                    }   
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