<!-- resources/views/branch-chart.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Branch Count Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            /* Distribute space between buttons */
            align-items: center;
            /* Align buttons vertically */
            margin-bottom: 10px;
        }

        .add-btn,
        .download-btn {
            display: inline-block;
            padding: 10px 20px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            border: none;
        }

        .add-btn {
            background-color: #4CAF50;
        }

        .download-btn {
            background-color: #007bff;
        }

        .chart-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 10px;
            margin-left: 2%
        }

        .chart-area {
            width: 45%;
            /* Two charts per row */
            height: 400px;
        }
    </style>
</head>

<body>
    <center>
        <h1>Student Information Management System</h1>
    </center>
    <div class="header">
        <a href="{{ route('index') }}"><button class="add-btn" id="">Back</button></a>
    </div>
    <div class="chart-container">

        {{-- branch wise first chart --}}

        <div class="chart-area">
            <h3>
                <center>Branch Wise Data</center>
            </h3>
            <canvas id="branchChart"></canvas>
        </div>

        {{-- course wise second chart --}}
        <div class="chart-area">
            <h3>
                <center>Course Wise Data</center>
            </h3>
            <canvas id="branchChart1"></canvas>
        </div>

        {{-- category wise third chart --}}
        <div class="chart-area" style="margin-top: 5%">
            <h3>
                <center>Category Wise Data</center>
            </h3>
            <canvas id="branchChart2"></canvas>
        </div>

        {{-- department wise fourth chart --}}
        <div class="chart-area" style="margin-top: 5%">
            <h3>
                <center>Department Wise Data</center>
            </h3>
            <canvas id="branchChart3"></canvas>
        </div>
    </div>

    <script>
        var ctx = document.getElementById('branchChart').getContext('2d');
        var branchChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($branchCounts->pluck('branch')), // Branch names
                datasets: [{
                    label: 'Branch Count',
                    data: @json($branchCounts->pluck('total')), // Branch count
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
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

        var ctx = document.getElementById('branchChart1').getContext('2d');
        var branchChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($courseCounts->pluck('course')), // Branch names
                datasets: [{
                    label: 'Course Count',
                    data: @json($courseCounts->pluck('total')), // Branch count
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
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

        var ctx = document.getElementById('branchChart2').getContext('2d');
        var branchChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($categoryCounts->pluck('category')), // Branch names
                datasets: [{
                    label: 'Category Count',
                    data: @json($categoryCounts->pluck('total')), // Branch count
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
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

        var ctx = document.getElementById('branchChart3').getContext('2d');
        var branchChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($departmentCounts->pluck('department')),  
                datasets: [{
                    label: 'Department Count',
                    data: @json($departmentCounts->pluck('total')), 
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
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
</body>

</html>
