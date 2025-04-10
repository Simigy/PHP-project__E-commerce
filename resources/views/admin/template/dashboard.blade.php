<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Corona Admin</title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('Admin/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Admin/assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('Admin/assets/vendors/jvectormap/jquery-jvectormap.css') }}">
    <link rel="stylesheet" href="{{ asset('Admin/assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Admin/assets/vendors/owl-carousel-2/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Admin/assets/vendors/owl-carousel-2/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Admin/assets/css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('Admin/assets/images/favicon.png') }}" />
</head>
<body>
    <div class="container-scroller">
        <!-- Sidebar -->
        @include('admin.layouts.sidebar')
        
        <div class="container-fluid page-body-wrapper">
            <!-- Navbar -->
            @include('admin.layouts.navbar')
            
            <!-- Main Content -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card corona-gradient-card">
                                <div class="card-body py-0 px-0 px-sm-3">
                                    <div class="row align-items-center">
                                        <div class="col-4 col-sm-3 col-xl-2">
                                            <img src="{{ asset('Admin/assets/images/dashboard/Group126@2x.png') }}" class="gradient-corona-img img-fluid" alt="">
                                        </div>
                                        <div class="col-5 col-sm-7 col-xl-8 p-0">
                                            <h4 class="mb-1 mb-sm-0">Want even more features?</h4>
                                            <p class="mb-0 font-weight-normal d-none d-sm-block">Check out our Pro version with 5 unique layouts!</p>
                                        </div>
                                        <div class="col-3 col-sm-2 col-xl-2 pl-0 text-center">
                                            <span>
                                                <a href="#" target="_blank" class="btn btn-outline-light btn-rounded get-started-btn">Upgrade to PRO</a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-9">
                                            <div class="d-flex align-items-center align-self-start">
                                                <h3 class="mb-0">$12.34</h3>
                                                <p class="text-success ml-2 mb-0 font-weight-medium">+3.5%</p>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="icon icon-box-success ">
                                                <span class="mdi mdi-arrow-top-right icon-item"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <h6 class="text-muted font-weight-normal">Potential growth</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-9">
                                            <div class="d-flex align-items-center align-self-start">
                                                <h3 class="mb-0">$17.34</h3>
                                                <p class="text-success ml-2 mb-0 font-weight-medium">+11%</p>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="icon icon-box-success">
                                                <span class="mdi mdi-arrow-top-right icon-item"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <h6 class="text-muted font-weight-normal">Revenue current</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-9">
                                            <div class="d-flex align-items-center align-self-start">
                                                <h3 class="mb-0">$12.34</h3>
                                                <p class="text-danger ml-2 mb-0 font-weight-medium">-2.4%</p>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="icon icon-box-danger">
                                                <span class="mdi mdi-arrow-bottom-left icon-item"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <h6 class="text-muted font-weight-normal">Daily Income</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-9">
                                            <div class="d-flex align-items-center align-self-start">
                                                <h3 class="mb-0">$31.53</h3>
                                                <p class="text-success ml-2 mb-0 font-weight-medium">+3.5%</p>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="icon icon-box-success ">
                                                <span class="mdi mdi-arrow-top-right icon-item"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <h6 class="text-muted font-weight-normal">Expense current</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Transaction History</h4>
                                    <canvas id="transaction-history" class="transaction-chart"></canvas>
                                    <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                                        <div class="text-md-center text-xl-left">
                                            <h6 class="mb-1">Transfer to Paypal</h6>
                                            <p class="text-muted mb-0">07 Jan 2019, 09:12AM</p>
                                        </div>
                                        <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                                            <h6 class="font-weight-bold mb-0">$236</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Open Projects</h4>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="d-flex align-items-start mt-3">
                                                <div class="p-2 bg-primary rounded">
                                                    <i class="mdi mdi-file-document text-white icon-sm"></i>
                                                </div>
                                                <div class="ml-3">
                                                    <h6>Admin dashboard design</h6>
                                                    <p class="text-muted">Broadcast web app mockup</p>
                                                </div>
                                                <div class="ml-auto">
                                                    <div class="d-flex align-items-center">
                                                        <p class="text-muted mb-0">15 minutes ago</p>
                                                    </div>
                                                    <p class="text-muted mb-0">30 tasks, 5 issues</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-start mt-3">
                                                <div class="p-2 bg-success rounded">
                                                    <i class="mdi mdi-cloud-upload text-white icon-sm"></i>
                                                </div>
                                                <div class="ml-3">
                                                    <h6>Wordpress Development</h6>
                                                    <p class="text-muted">Upload new design</p>
                                                </div>
                                                <div class="ml-auto">
                                                    <div class="d-flex align-items-center">
                                                        <p class="text-muted mb-0">1 hour ago</p>
                                                    </div>
                                                    <p class="text-muted mb-0">23 tasks, 5 issues</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-start mt-3">
                                                <div class="p-2 bg-info rounded">
                                                    <i class="mdi mdi-clock text-white icon-sm"></i>
                                                </div>
                                                <div class="ml-3">
                                                    <h6>Project meeting</h6>
                                                    <p class="text-muted">New project discussion</p>
                                                </div>
                                                <div class="ml-auto">
                                                    <div class="d-flex align-items-center">
                                                        <p class="text-muted mb-0">35 minutes ago</p>
                                                    </div>
                                                    <p class="text-muted mb-0">15 tasks, 2 issues</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-start mt-3">
                                                <div class="p-2 bg-danger rounded">
                                                    <i class="mdi mdi-email text-white icon-sm"></i>
                                                </div>
                                                <div class="ml-3">
                                                    <h6>Broadcast Mail</h6>
                                                    <p class="text-muted">Sent release details to team</p>
                                                </div>
                                                <div class="ml-auto">
                                                    <div class="d-flex align-items-center">
                                                        <p class="text-muted mb-0">55 minutes ago</p>
                                                    </div>
                                                    <p class="text-muted mb-0">35 tasks, 7 issues</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Footer -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2025</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Laravel E-commerce</span>
                    </div>
                </footer>
            </div>
        </div>
    </div>
    
    <!-- Scripts -->
    <script src="{{ asset('Admin/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('Admin/assets/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('Admin/assets/vendors/progressbar.js/progressbar.min.js') }}"></script>
    <script src="{{ asset('Admin/assets/vendors/jvectormap/jquery-jvectormap.min.js') }}"></script>
    <script src="{{ asset('Admin/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('Admin/assets/vendors/owl-carousel-2/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('Admin/assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('Admin/assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('Admin/assets/js/misc.js') }}"></script>
    <script src="{{ asset('Admin/assets/js/settings.js') }}"></script>
    <script src="{{ asset('Admin/assets/js/todolist.js') }}"></script>
    <script src="{{ asset('Admin/assets/js/dashboard.js') }}"></script>
    
    <!-- Transaction history chart -->
    <script>
        $(function() {
            if ($("#transaction-history").length) {
                var areaData = {
                    labels: ["Paypal", "Stripe","Cash"],
                    datasets: [{
                        data: [55, 25, 20],
                        backgroundColor: [
                            "#ffab00", "#00d25b","#0090e7"
                        ]
                    }]
                };
                var areaOptions = {
                    responsive: true,
                    maintainAspectRatio: true,
                    segmentShowStroke: false,
                    cutoutPercentage: 70,
                    elements: {
                        arc: {
                            borderWidth: 0
                        }
                    },
                    legend: {
                        display: false
                    },
                    tooltips: {
                        enabled: true
                    }
                }
                var transactionhistoryChartPlugins = {
                    beforeDraw: function(chart) {
                        var width = chart.chart.width,
                            height = chart.chart.height,
                            ctx = chart.chart.ctx;

                        ctx.restore();
                        var fontSize = 1;
                        ctx.font = fontSize + "rem sans-serif";
                        ctx.textAlign = 'left';
                        ctx.textBaseline = "middle";
                        ctx.fillStyle = "#ffffff";

                        var text = "$1200",
                            textX = Math.round((width - ctx.measureText(text).width) / 2),
                            textY = height / 2.4;

                        ctx.fillText(text, textX, textY);

                        ctx.restore();
                        var fontSize = 0.75;
                        ctx.font = fontSize + "rem sans-serif";
                        ctx.textAlign = 'left';
                        ctx.textBaseline = "middle";
                        ctx.fillStyle = "#6c7293";

                        var texts = "Total",
                            textsX = Math.round((width - ctx.measureText(text).width) / 1.93),
                            textsY = height / 1.7;

                        ctx.fillText(texts, textsX, textsY);
                        ctx.save();
                    }
                }
                var transactionhistoryChartCanvas = $("#transaction-history").get(0).getContext("2d");
                var transactionhistoryChart = new Chart(transactionhistoryChartCanvas, {
                    type: 'doughnut',
                    data: areaData,
                    options: areaOptions,
                    plugins: transactionhistoryChartPlugins
                });
            }
        });
    </script>
    
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Initialize Bootstrap components
        document.addEventListener('DOMContentLoaded', function() {
            var dropdownElementList = [].slice.call(document.querySelectorAll('[data-bs-toggle="dropdown"]'));
            dropdownElementList.forEach(function(dropdownToggleEl) {
                new bootstrap.Dropdown(dropdownToggleEl);
            });
            
            var collapseElementList = [].slice.call(document.querySelectorAll('[data-bs-toggle="collapse"]'));
            collapseElementList.forEach(function(collapseToggleEl) {
                new bootstrap.Collapse(collapseToggleEl.nextElementSibling, {
                    toggle: false
                });
            });
        });
    </script>
</body>
</html> 