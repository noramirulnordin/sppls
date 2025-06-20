@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="container-fluid">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="row">


            <div class="col-xl-12">
                <div class="row">
                    <div class="col-12 mb-4 d-flex align-items-center justify-content-between">
                        <h4 class="header-title mb-0">Maklumat Data</h4>
                        <form id="dashboard-date-form" class="d-flex align-items-center">
                            <label for="dashboard-date" class="me-2 mb-0">Tarikh:</label>
                            <input type="date" id="dashboard-date" name="dashboard_date" class="form-control"
                                value="{{ request('dashboard_date', now()->format('Y-m-d')) }}">
                        </form>
                    </div>

                    @foreach ($card as $cardData)
                        <div class="col-12 col-md-2 mb-4">
                            <div class="card h-100 shadow border-0 custom-card">
                                <div
                                    class="card-body d-flex flex-column align-items-center justify-content-center position-relative p-4">
                                    <div class="icon-bg d-flex align-items-center justify-content-center mb-3">
                                        <i class="{{ $cardData['icon'] }}"></i>
                                    </div>
                                    <div class="fw-bold mb-1 card-number">
                                        {{ $cardData['value'] }}
                                    </div>
                                    <div class="card-label">

                                        {{ $cardData['name'] }}
                                    </div>
                                    <div class="position-absolute card-bg-icon">
                                        <i class="{{ $cardData['icon'] }}"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-4">Percent Balak Dijual</h4>
                        <div dir="ltr">
                            <div id="gradient-chart" class="apex-charts" data-colors="#8f75da,#727cf5"></div>
                        </div>
                    </div>
                </div>
            </div>




            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-4">Jumlah Balak Terjual</h4>
                        <div dir="ltr">
                            <div id="line-chart" class="apex-charts" data-colors="#ffbc00"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('styles')
    <link rel="stylesheet" href="/assets/css/vendor/apexcharts.css">
    <style>
        .custom-card {
            background: linear-gradient(135deg, rgba(49, 58, 70, 0.90) 0%, #0099f7 100%);
            border-radius: 1.5rem;
            box-shadow: 0 8px 32px 0 rgba(49, 58, 70, 0.18);
            backdrop-filter: blur(7px);
            border: 1px solid rgba(255, 255, 255, 0.10);
            overflow: hidden;
            transition: box-shadow 0.2s;
        }

        .custom-card:hover {
            box-shadow: 0 12px 36px 0 rgba(49, 58, 70, 0.26);
        }

        .icon-bg {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: linear-gradient(135deg, #313a46 40%, #00bcd4 100%);
            box-shadow: 0 6px 32px 0 rgba(0, 188, 212, 0.15);
        }

        .icon-bg i {
            font-size: 2rem;
            color: #fff;
            filter: drop-shadow(0 2px 8px #0099f7cc);
        }

        .card-number {
            font-size: 2.3rem;
            color: #fff;
            letter-spacing: 1px;
            text-shadow: 0 2px 8px rgba(49, 58, 70, 0.15);
        }

        .card-label {
            font-size: 1.1rem;
            color: #f8f9fa;
            opacity: 0.95;
            margin-bottom: 0.5rem;
            text-align: center;
        }

        .card-bg-icon {
            right: 10px;
            bottom: 10px;
            opacity: 0.10;
            font-size: 4rem;
            color: #fff;
            pointer-events: none;
            z-index: 0;
        }
    </style>

@endsection

@section('scripts')
    <script src="/assets/js/vendor/apexcharts.min.js"></script>
    <script>
        // Update the date input value when the form is submitted
        document.getElementById('dashboard-date').addEventListener('change', function() {
            const selectedDate = this.value;
            const url = new URL(window.location.href);
            url.searchParams.set('dashboard_date', selectedDate);
            window.location.href = url.toString();
        });
        $(document).ready(function() {
            var options = {
                chart: {
                    height: 350,
                    type: 'line',
                    zoom: {
                        enabled: false
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth'
                },
                series: [{
                    name: "Jumlah Balak Terjual",
                    data: [
                        @php
                            use App\Models\Transaksi;
                            $data = [];
                            for ($i = 6; $i >= 0; $i--) {
                                $date = \Carbon\Carbon::now()->subDays($i)->format('Y-m-d');
                                $count = Transaksi::whereDate('tarikh_dibeli', $date)->count();
                                $data[] = $count;
                            }
                            echo implode(',', $data);
                        @endphp
                    ]
                }],
                xaxis: {
                    categories: [
                        @php
                            $dates = [];
                            for ($i = 6; $i >= 0; $i--) {
                                $dates[] = \Carbon\Carbon::now()->subDays($i)->format('d M Y');
                            }
                            echo "'" . implode("','", $dates) . "'";
                        @endphp
                    ],
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + " unit";
                        }
                    }
                }
            }

            var chart = new ApexCharts(document.querySelector("#line-chart"), options);
            chart.render();

            @php
                use App\Models\Balak;
                $total = Balak::count();
                $rosak = Balak::where('status', 'Dijual')->count();
                $percent = $total > 0 ? round(($rosak / $total) * 100, 2) : 0;
            @endphp

            var dataColors = $("#gradient-chart").data("colors");
            var colors = dataColors ? dataColors.split(",") : [];

            var options = {
                chart: {
                    height: 330,
                    type: "radialBar",
                    toolbar: {
                        show: true
                    }
                },
                plotOptions: {
                    radialBar: {
                        startAngle: -135,
                        endAngle: 225,
                        hollow: {
                            margin: 0,
                            size: "70%",
                            background: "#fff",
                            image: undefined,
                            imageOffsetX: 0,
                            imageOffsetY: 0,
                            position: "front",
                            dropShadow: {
                                enabled: true,
                                top: 3,
                                left: 0,
                                blur: 4,
                                opacity: 0.24
                            },
                        },
                        track: {
                            background: "#fff",
                            strokeWidth: "67%",
                            margin: 0,
                            dropShadow: {
                                enabled: true,
                                top: -3,
                                left: 0,
                                blur: 4,
                                opacity: 0.35
                            },
                        },
                        dataLabels: {
                            showOn: "always",
                            name: {
                                offsetY: -10,
                                show: true,
                                color: "#888",
                                fontSize: "17px"
                            },
                            value: {
                                formatter: function(o) {
                                    return parseInt(o) + " %";
                                },
                                color: "#111",
                                fontSize: "36px",
                                show: true,
                            },
                        },
                    },
                },
                fill: {
                    type: "gradient",
                    gradient: {
                        shade: "dark",
                        type: "horizontal",
                        shadeIntensity: 0.5,
                        gradientToColors: colors,
                        inverseColors: true,
                        opacityFrom: 1,
                        opacityTo: 1,
                        stops: [0, 100],
                    },
                },
                series: [{{ $percent }}],
                stroke: {
                    lineCap: "round"
                },
                labels: ["Dijual"],
            };

            var gradientChart = new ApexCharts(
                document.querySelector("#gradient-chart"),
                options
            );
            gradientChart.render();
        });
    </script>
@endsection
