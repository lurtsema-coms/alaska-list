<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<div>
    <div class="bg-white p-10 rounded-3xl border border-gray-200 shadow overflow-x-auto">
        <div class="min-w-[40rem]">
            <div id="chart"></div>
        </div>
    </div>

    <script data-navigate-once>
        let chart;

        document.addEventListener('livewire:navigated', () => {
            let options = {
                chart: {
                    type: 'bar',
                    height: '390px'
                },
                series: [{
                    name: 'sales',
                    data: [30, 40, 35, 50, 49, 60, 70, 91, 125]
                }],
                xaxis: {
                    categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998, 1999]
                }
            };

            if (chart) {
                chart.destroy();
                chart = undefined;
            }

            // Render the chart
            if (document.querySelector("#chart")) {
                chart = new ApexCharts(document.querySelector("#chart"), options);
                chart.render();
            }
        });

        document.addEventListener('livewire:navigating', () => {
            if (chart) {
                chart.destroy();
                chart = undefined;
            }
        });
    </script>
</div>
