<?php

use App\Models\Product;
use Carbon\Carbon;
use Livewire\Volt\Component;

new class extends Component {

    public function with(): array
    {
        return [
            'active_post' => $this->loadActivePost(),
            'deleted_post' => $this->loadDeletedPost(),
            'transaction_closed' => $this->loadTransactionClosedPost(),
            'total_post' => $this->loadTotalPost(),
            'chart' => $this->loadMonthlyPost(),
        ];
    }

    public function loadActivePost(){
        return Product::where('status', 'APPROVED')->count();
    }

    public function loadDeletedPost(){
        return Product::where('status', 'DELETED')->count();
    }

    public function loadTransactionClosedPost(){
        return Product::where('qty', 0)->count();
    }

    public function loadTotalPost(){
        return Product::count();
    }

    public function loadMonthlyPost(){
        return Product::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get()
            ->map(function ($item) {
                $item->month_name = Carbon::createFromDate($item->year, $item->month)->format('F Y');
                return $item;
            });
    }
}; ?>

<div>
    <div class="px-4 py-8 mx-auto space-y-8 sm:container sm:rounded-lg sm:px-6 lg:px-8">
        <div class="gap-2 w-full max-w-[56.25rem] space-y-8">
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
                <div class="flex items-center justify-between px-6 py-4 bg-white border border-gray-200 rounded-lg shadow-md">
                    <div>
                        <p class="font-bold text-gray-600 text-md">Active Posts</p>
                        <p class="text-gray-400 text-md">{{ $active_post }}</p>
                    </div>
                    <div class="p-3 text-blue-500 bg-blue-100 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                        </svg>
                    </div>
                </div>
                {{-- <div class="flex items-center justify-between px-6 py-4 bg-white border border-gray-200 rounded-lg shadow-md">
                    <div>
                        <p class="font-bold text-gray-600 text-md">Transaction Closed</p>
                        <p class="text-gray-400 text-md">{{ $transaction_closed }}</p>
                    </div>
                    <div class="p-3 text-green-500 bg-green-100 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                        </svg>
                    </div>
                </div> --}}
                <div class="flex items-center justify-between px-6 py-4 bg-white border border-gray-200 rounded-lg shadow-md">
                    <div>
                        <p class="font-bold text-gray-600 text-md">Deleted Post</p>
                        <p class="text-gray-400 text-md">{{ $deleted_post }}</p>
                    </div>
                    <div class="p-3 text-red-500 bg-red-100 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                        </svg>
                    </div>
                </div>
                <div class="flex items-center justify-between px-6 py-4 bg-white border border-gray-200 rounded-lg shadow-md">
                    <div>
                        <p class="font-bold text-gray-600 text-md">Total Posts</p>
                        <p class="text-gray-400 text-md">{{ $total_post }}</p>
                    </div>
                    <div class="p-3 text-gray-500 bg-gray-100 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <div class="px-6 py-4 overflow-x-auto bg-white border border-gray-200 rounded-lg shadow-md">
            <div class="min-w-[40rem]">
                <div id="chart"></div>
            </div>
        </div>
</div>

<script data-navigate-once>
    let chart;

    const chartData = @json($chart);

    // Format the chart data
    const labels = chartData.map(item => item.month_name);
    const data = chartData.map(item => item.count);

    document.addEventListener('livewire:navigated', () => {
        let options = {
            chart: {
                type: 'bar',
                height: '390px'
            },
            series: [{
                name: 'Upload Per Month',
                data: data
            }],
            xaxis: {
                categories: labels
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
