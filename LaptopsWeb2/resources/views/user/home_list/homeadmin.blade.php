@extends('app')

@section('content')
<div class="container mx-auto p-3">
    <!-- Hàng đầu tiên -->
    <div class="grid grid-cols-1 md:grid-cols-4 pb-3 gap-5">
        <div class="p-4 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-lg shadow-lg">
            <h4 class="text-lg font-bold">Total Revenue</h4>
            <p class="text-2xl">$350,897</p>
            <p class="text-sm text-green-200">+3.48% Since last month</p>
        </div>
        <div class="p-4 bg-gradient-to-r from-red-500 to-pink-600 text-white rounded-lg shadow-lg">
            <h4 class="text-lg font-bold">Total Users</h4>
            <p class="text-2xl">2,356</p>
            <p class="text-sm text-red-200">-3.48% Since last week</p>
        </div>
        <div class="p-4 bg-gradient-to-r from-yellow-400 to-orange-500 text-white rounded-lg shadow-lg">
            <h4 class="text-lg font-bold">Total Products</h4>
            <p class="text-2xl">924</p>
            <p class="text-sm text-yellow-200">-1.10% Since yesterday</p>
        </div>
        <div class="p-4 bg-gradient-to-r from-teal-500 to-green-600 text-white rounded-lg shadow-lg">
            <h4 class="text-lg font-bold">Total Sales</h4>
            <p class="text-2xl">49.65%</p>
            <p class="text-sm text-green-200">+10% Since last month</p>
        </div>
    </div>

    <!-- Hàng thứ hai -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        <div class="md:col-span-2 bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-lg font-bold mb-4">Sales value</h3>
            <canvas id="salesValueChart"></canvas>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-lg font-bold mb-4">Total orders</h3>
            <canvas id="totalOrdersChart"></canvas>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Chart.js - Biểu đồ doanh số
        var salesValueCtx = document.getElementById('salesValueChart').getContext('2d');
        new Chart(salesValueCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Sales Value',
                    data: [10000, 12000, 9000, 15000, 17000, 14000, 19000, 22000, 24000, 23000, 25000, 28000],
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 2,
                    tension: 0.4,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    pointBackgroundColor: 'rgba(75, 192, 192, 1)'
                }]
            },
            options: {
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Chart.js - Biểu đồ đơn hàng
        var totalOrdersCtx = document.getElementById('totalOrdersChart').getContext('2d');
        new Chart(totalOrdersCtx, {
            type: 'bar',
            data: {
                labels: ['Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Total Orders',
                    data: [10, 20, 15, 25, 22, 30],
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
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
    });
</script>
@endsection