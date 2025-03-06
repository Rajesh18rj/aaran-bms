{{-- <div>
    <canvas id="myChart" style=""></canvas>
    <script>
        var xValues = ["Apl", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec", "Jan", "Feb", "Mar"];

        var yValues = [700900, 1060070, 560000, 903400, 709400, 132400, 803390, 347000, 403400, 801500, 609900, 303400]

        var barColors = ["#23B7E5", "#23B7E5", "#23B7E5", "#23B7E5", "#23B7E5", "#23B7E5", "#23B7E5", "#23B7E5", "#23B7E5", "#23B7E5", "#23B7E5", "#23B7E5"];

        new Chart("myChart", {
            type: "bar"

            , data: {
                labels: xValues
                , datasets: [{
                    data: yValues
                    , backgroundColor: barColors,

                }]
            }
            , options: {
                legend: {
                    display: false
                }
                , scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                , }
            }
        });

    </script>
</div> --}}
<div>
    <h2>Monthly Sales Totals</h2>

    @if($monthlyTotals->isEmpty())
    <p>No sales data available for this company.</p>
    @else
    <canvas id="myChart" style="width:100%; max-width:600px;"></canvas>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var xValues = @json($monthlyTotals->pluck('month')); // Get months dynamically
            var yValues = @json($monthlyTotals->pluck('total')); // Get totals dynamically

            var barColors = Array(xValues.length).fill("#23B7E5"); // Set color for each bar

            new Chart("myChart", {
                type: "bar"
                , data: {
                    labels: xValues.map(month => monthNames[month - 1]), // Convert month numbers to names
                    datasets: [{
                        data: yValues
                        , backgroundColor: barColors
                    , }]
                }
                , options: {
                    legend: {
                        display: false
                    }
                    , scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        });

        // Month names for better readability
        const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

    </script>
    @endif
</div>
