@extends('admin.layouts.corona')

@section('title', 'Chart.js - Admin Dashboard')

@section('content')
<div class="page-header">
    <h3 class="page-title">Chart.js</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Charts</a></li>
            <li class="breadcrumb-item active" aria-current="page">Chart.js</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Line chart</h4>
                <canvas id="lineChart" style="height:250px"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Bar chart</h4>
                <canvas id="barChart" style="height:230px"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Area chart</h4>
                <canvas id="areaChart" style="height:250px"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Doughnut chart</h4>
                <canvas id="doughnutChart" style="height:250px"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Pie chart</h4>
                <canvas id="pieChart" style="height:250px"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Scatter chart</h4>
                <canvas id="scatterChart" style="height:250px"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Get chart canvas elements
    var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
    var barChartCanvas = $("#barChart").get(0).getContext("2d");
    var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
    var doughnutChartCanvas = $("#doughnutChart").get(0).getContext("2d");
    var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
    var scatterChartCanvas = $("#scatterChart").get(0).getContext("2d");
    
    // Chart options
    var options = {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                    fontColor: "#9fa0a2"
                },
                gridLines: {
                    color: "rgba(204, 204, 204,0.1)"
                }
            }],
            xAxes: [{
                ticks: {
                    fontColor: "#9fa0a2"
                },
                gridLines: {
                    color: "rgba(204, 204, 204,0.1)"
                }
            }]
        },
        legend: {
            display: true,
            position: 'top',
            labels: {
                fontColor: "#9fa0a2"
            }
        },
        elements: {
            point: {
                radius: 0
            }
        }
    };
    
    // Line Chart Data
    var lineChartData = {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug"],
        datasets: [{
            label: 'Dataset 1',
            data: [10, 23, 5, 45, 20, 32, 15, 45],
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 2,
            fill: true
        },
        {
            label: 'Dataset 2',
            data: [30, 15, 25, 35, 10, 42, 25, 35],
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 2,
            fill: true
        }]
    };
    
    // Bar Chart Data
    var barChartData = {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug"],
        datasets: [{
            label: 'Dataset 1',
            data: [30, 35, 25, 45, 20, 32, 35, 25],
            backgroundColor: [
                'rgba(255, 99, 132, 0.8)',
                'rgba(54, 162, 235, 0.8)',
                'rgba(255, 206, 86, 0.8)',
                'rgba(75, 192, 192, 0.8)',
                'rgba(153, 102, 255, 0.8)',
                'rgba(255, 159, 64, 0.8)',
                'rgba(255, 99, 132, 0.8)',
                'rgba(54, 162, 235, 0.8)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)'
            ],
            borderWidth: 1
        }]
    };
    
    // Area Chart Data
    var areaChartData = {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug"],
        datasets: [{
            label: 'Dataset 1',
            data: [30, 35, 25, 45, 20, 32, 35, 25],
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 2,
            fill: true
        }]
    };
    
    // Doughnut Chart Data
    var doughnutChartData = {
        labels: ["Category 1", "Category 2", "Category 3", "Category 4"],
        datasets: [{
            data: [30, 40, 20, 10],
            backgroundColor: [
                'rgba(255, 99, 132, 0.8)',
                'rgba(54, 162, 235, 0.8)',
                'rgba(255, 206, 86, 0.8)',
                'rgba(75, 192, 192, 0.8)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)'
            ],
            borderWidth: 1
        }]
    };
    
    // Pie Chart Data
    var pieChartData = {
        labels: ["Category 1", "Category 2", "Category 3", "Category 4", "Category 5"],
        datasets: [{
            data: [30, 25, 15, 20, 10],
            backgroundColor: [
                'rgba(255, 99, 132, 0.8)',
                'rgba(54, 162, 235, 0.8)',
                'rgba(255, 206, 86, 0.8)',
                'rgba(75, 192, 192, 0.8)',
                'rgba(153, 102, 255, 0.8)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)'
            ],
            borderWidth: 1
        }]
    };
    
    // Scatter Chart Data
    var scatterChartData = {
        datasets: [{
            label: 'Dataset 1',
            data: [
                {x: 10, y: 20}, {x: 25, y: 15}, {x: 40, y: 30}, 
                {x: 55, y: 10}, {x: 70, y: 40}, {x: 85, y: 25}
            ],
            backgroundColor: 'rgba(75, 192, 192, 0.8)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        },
        {
            label: 'Dataset 2',
            data: [
                {x: 15, y: 45}, {x: 30, y: 25}, {x: 45, y: 50}, 
                {x: 60, y: 15}, {x: 75, y: 60}, {x: 90, y: 35}
            ],
            backgroundColor: 'rgba(54, 162, 235, 0.8)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    };
    
    // Initialize Charts
    new Chart(lineChartCanvas, {
        type: 'line',
        data: lineChartData,
        options: options
    });
    
    new Chart(barChartCanvas, {
        type: 'bar',
        data: barChartData,
        options: options
    });
    
    new Chart(areaChartCanvas, {
        type: 'line',
        data: areaChartData,
        options: options
    });
    
    new Chart(doughnutChartCanvas, {
        type: 'doughnut',
        data: doughnutChartData,
        options: {
            responsive: true,
            animation: {
                animateScale: true,
                animateRotate: true
            },
            legend: {
                position: 'top',
                labels: {
                    fontColor: "#9fa0a2"
                }
            }
        }
    });
    
    new Chart(pieChartCanvas, {
        type: 'pie',
        data: pieChartData,
        options: {
            responsive: true,
            animation: {
                animateScale: true,
                animateRotate: true
            },
            legend: {
                position: 'top',
                labels: {
                    fontColor: "#9fa0a2"
                }
            }
        }
    });
    
    new Chart(scatterChartCanvas, {
        type: 'scatter',
        data: scatterChartData,
        options: {
            scales: {
                xAxes: [{
                    ticks: {
                        fontColor: "#9fa0a2"
                    },
                    gridLines: {
                        color: "rgba(204, 204, 204,0.1)"
                    }
                }],
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        fontColor: "#9fa0a2"
                    },
                    gridLines: {
                        color: "rgba(204, 204, 204,0.1)"
                    }
                }]
            },
            legend: {
                position: 'top',
                labels: {
                    fontColor: "#9fa0a2"
                }
            }
        }
    });
});
</script>
@endpush 