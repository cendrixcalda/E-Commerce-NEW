<div class="dashboard-top">
    <div class="dashboard-box-sm">
        <div class="icon-container">
            <i class="fas fa-dollar-sign"></i>
        </div>
        <div class="details">
            <p>Total Revenue</p>
            <p>&#8369;9000</p>
        </div>
    </div>
    <div class="dashboard-box-sm">
        <div class="icon-container">
            <i class="fas fa-shopping-cart"></i>
        </div>
        <div class="details">
            <p>Total Orders</p>
            <p>4000</p>
        </div>
    </div>
    <div class="dashboard-box-sm">
        <div class="icon-container">
            <i class="fas fa-truck"></i>
        </div>
        <div class="details">
            <p>Total Items Sold</p>
            <p>2000</p>
        </div>
    </div>
    <div class="dashboard-box-sm">
        <div class="icon-container">
            <i class="fas fa-user-tag"></i>
        </div>
        <div class="details">
            <p>Total Customers</p>
            <p>200</p>
        </div>
    </div>
</div>

<div class="dashboard-main">
    <div class="dashboard-box-md">
        <div class="title-container">
            <p>Revenue</p>
            <select>
                <option value="Day">Day</option>
                <option value="Week">Week</option>
                <option value="Month" selected>Month</option>
                <option value="Year">Year</option>
            </select>
        </div>
        <div class="chart-container">
            <canvas id="revenueChart"></canvas>
        </div>
    </div>
    <div class="dashboard-box-md">
        <div class="title-container">
            <p>Orders</p>
            <select>
                <option value="Day">Day</option>
                <option value="Week">Week</option>
                <option value="Month" selected>Month</option>
                <option value="Year">Year</option>
            </select>
        </div>
        <div class="chart-container">
            <canvas id="ordersChart"></canvas>
        </div>
    </div>
</div>

<!-- <div class="chart-container" style="position: relative; height:20vh; width:30vw">
    <canvas id="myChart"></canvas>
</div> -->

<script>
    $(document).ready(function(){
        var ctx = document.getElementById('revenueChart');
        var ctx1 = document.getElementById('ordersChart');

        Chart.defaults.global.defaultFontColor = 'rgb(41, 41, 41)';

        var revenueChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    data: [12, 19, 3, 5, 2, 3],
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
                            // drawBorder: false,
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            display: false,
                            // drawBorder: false,
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
                        radius: 2
                    }
                }
            }
        });

        var ordersChart = new Chart(ctx1, {
            type: 'line',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    data: [12, 19, 3, 5, 2, 3],
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
                            // drawBorder: false,
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            display: false,
                            // drawBorder: false,
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
                        radius: 2
                    }
                }
            }
        });
    });
</script>