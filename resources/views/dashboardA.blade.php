@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Chart</h1>
    </div>
    <div class="section-body">
        <h2 class="section-title" data-id="titleInput1Management">Menu Management</h2>
        <div class="row mb-0">
            <div class="col-12">
                @include('layouts.alert')
            </div>
        </div>
        <div class="row row-sm">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4 data-id="input1ListData">Menu Report All
                            <br>
                            <span style="font-size: 13px;">Tanggal: {{ \Carbon\Carbon::now()->startOfMonth()->format('d M Y') }} - {{ \Carbon\Carbon::now()->startOfMonth()->addDays(14)->format('d M Y') }}</span>
                        </h4>
                        <div class="card-header-action">
                            <div class="dropdown">
                                <button class="btn btn-info btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-chart-bar" aria-hidden="true"></i>
                                    Grafik
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{ url('/dashboard-A') }}">Grafik A</a>
                                    <a class="dropdown-item" href="{{ url('/dashboard-B') }}">Grafik B</a>
                                    <!-- Tambahkan opsi lain sesuai kebutuhan Anda -->
                                </div>
                            </div>
                            <a class="btn btn-info btn-primary active search search-date">
                                <i class="fa fa-search" aria-hidden="true"></i>
                                Search Tanggal
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="show-search search-date mb-0" style="display: none">
                            <form id="search-date" method="GET" action="{{ route('home') }}">
                                <div class="form-group">
                                    <label for="selected_date">Pilih Tanggal:</label>
                                    <input type="date" class="form-control" id="selected_date" name="selected_date" value="{{ $selectedDate ?? now()->format('Y-m-d') }}">
                                </div>
                                <div class="text-right">
                                    <button class="btn btn-primary mr-1" type="submit">Submit</button>
                                    <a class="btn btn-secondary" href="{{ route('home') }}">Reset</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- batas -->
    <div class="section-header d-flex">
        <div class="flex-fill">
            <figure class="highcharts-figure ml-5">
                <div id="barChart"></div>
            </figure>
            <script src="https://code.highcharts.com/highcharts.js"></script>
            <script>
                // Data retrieved https://en.wikipedia.org/wiki/List_of_cities_by_average_temperature
                var batas = <?php echo json_encode($dates) ?>;
                var tempWaterIn = <?php echo json_encode($tempWaterIn) ?>;
                var tempWaterOut = <?php echo json_encode($tempWaterOut) ?>;
                var tempOilIn = <?php echo json_encode($tempOilIn) ?>;
                var tempOilOut = <?php echo json_encode($tempOilOut) ?>;
                Highcharts.chart('barChart', {
                    chart: {
                        type: 'line'
                    },
                    title: {
                        text: 'Daily Temperature'
                    },
                    subtitle: {
                        text: 'Source: ' +
                            '<a href="https://en.wikipedia.org/wiki/List_of_cities_by_average_temperature" ' +
                            'target="_blank">Wikipedia.com</a>'
                    },
                    xAxis: {
                        categories: batas
                    },
                    yAxis: {
                        title: {
                            text: 'Temperature (°C)'
                        }
                    },
                    plotOptions: {
                        line: {
                            dataLabels: {
                                enabled: true
                            },
                            enableMouseTracking: false
                        }
                    },
                    series: [{
                        name: 'Temp Water In',
                        data: tempWaterIn
                    }, {
                        name: 'Temp Water Out',
                        data: tempWaterOut
                    }, {
                        name: 'Temp Oil In',
                        data: tempOilIn
                    }, {
                        name: 'Temp Oil Out',
                        data: tempOilOut
                    }]
                });
            </script>
        </div>
    </div>
</section>
@endsection
@push('customScript')
<script>
    document.querySelector(".search-date").addEventListener("click", function() {
        document.querySelector(".show-search.search-date").style.display = "block";
        document.querySelector(".show-search.search-range").style.display = "none";
    });

    document.querySelector(".search-range").addEventListener("click", function() {
        document.querySelector(".show-search.search-range").style.display = "block";
        document.querySelector(".show-search.search-date").style.display = "none";
    });
</script>
@endpush