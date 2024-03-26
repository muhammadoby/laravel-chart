<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    {{-- bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="p-3">
    <div class="text-center mb-4">
        <h1>Chart - Dataset</h1>
        <div class="row">
            <b>Total: RP. {{ number_format($dataset->sum('amount')) }}</b>
            <b>Profit: RP. {{ number_format($profit->sum('amount')) }}</b>
            <b>Loss: RP. {{ number_format($loss->sum('amount')) }}</b>
        </div>
        <div class="chart-container">
            <span class="text-success fw-bold me-2">Profit: </span> <span class="px-3 py-0" style="background: rgba(60, 216, 55, 0.61)"></span>
        </div>
        <div>
            <span class="text-danger fw-bold me-2">Loss: </span> <span class="px-3 py-0" style="background: rgba(216, 55, 55, 0.61)"></span>
        </div>
    </div>
    <div class="mb-4">
        <canvas id="chart"></canvas>
    </div>
    {{ $data_daily->links() }}
    <script>
        const ctx = document.getElementById('chart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    @foreach ($data_daily as $data)
                        '{{ $data->date }}',
                    @endforeach
                ],
                datasets: [{
                    label: '# Chart',
                    data: [
                        @foreach ($data_daily as $data)
                            {{ $data->amount }},
                        @endforeach
                    ],
                    backgroundColor: [
                        @foreach ($data_daily as $data)
                            @if ($data->is_profit == true)
                                'rgba(60, 216, 55, 0.61)',
                            @else
                                'rgba(216, 55, 55, 0.61)',
                            @endif
                        @endforeach
                    ],
                    borderColor: [
                        @foreach ($data_daily as $data)
                            @if ($data->is_profit == true)
                                'rgba(60, 216, 55, 0.61)',
                            @else
                                'rgba(216, 55, 55, 0.61)',
                            @endif
                        @endforeach
                    ],
                    borderWidth: 1
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
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>

</html>
