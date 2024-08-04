<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>BloomWithUs</title>
    <link rel="icon" href="assets/img/logo.png" type="image/x-icon">
    <meta content="" name="description">
    <meta content="" name="keywords">

     <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <!-- Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <style>
          body {
            background-color: #f8f9fa;
        }
        .container-wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            width: 100%;
        }
        main {
            flex: 1;
            display: flex;
            justify-content: center;
            width: 100vw !important;
        }
        .disease-state{
            z-index: 1;
            position: relative;
            top:120px;
            left: 10px;
        }
        .chart-container {
    width: 100%;
    max-width: 500px; /* Adjust as needed */
    height: 400px;    /* Adjust as needed */
}

.chart-container1 {
    width: 100%;
    max-width: 1000px; /* Adjust as needed */
    height: 700px;    /* Adjust as needed */
    
}

canvas {
    width: 100% ;
    height: 100%;
}

.card1{
    max-height: 650px !important;
    display: flex;
    justify-content: center;
}

        ::-webkit-scrollbar { width: 0 !important }

    </style>
</head>

<body class="index-page">
         <!-- Custom Alert Modal -->
                <div class="modal fade" id="customAlertModal" tabindex="-1" aria-labelledby="customAlertLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="customAlertLabel">BloomWithUs</h5>
                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="customAlertMessage">
                                <!-- Dynamic alert message will be injected here -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
<div class="container-wrapper">
            <header id="header" class="header d-flex align-items-center fixed-top">
                <div class="container-fluid container-xl position-relative d-flex align-items-center">
                    <a href="index.html" class="logo d-flex align-items-center me-auto">
                    <img src="assets/img/logo.png" alt="Logo">
                        <h1 class="sitename">BloomWithUs</h1>
                    </a>
                    <nav id="navmenu" class="navmenu">
                        <ul>
                        <li><a href="admin_dashboard.php">Home</a></li>
                        <li><a href="admin_dashboard.php#AddPost">Add Post</a></li>
                        <li><a href="prescription.php">Prescription</a></li>
                        <li><a href="stats.php" class="active">Statistics</a></li>
                        <li><a href="logout.php" style="color: red;">Logout</a></li>
                        </ul>
                        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
                    </nav>
                    <a class="btn-getstarted" href="appointment.php">Appointments</a>
                </div>
            </header>

    <main class="main" style="margin-top: 11vh;">
    <div class="container mt-3">
    <div class="card card1 mt-5">
     <h3 class="m-4 mt-5">Appointments Stats</h3>
    <canvas id="appointmentsChart" class="mx-4 mb-4" width="400" height="200"></canvas>
    </div>
    
    <div class="card card1 mt-5">
    <h3 class="disease-state m-4">Diseases Analytics</h3>
    <div class="row mt-3"> 
        <div class="col-2"></div>
        <div >

        </div>
       

    </div>

    <div class="container">
    <div class="row text-center">
        <div class="col-md-12 d-flex justify-content-center align-items-center ">
            <div class="chart-container1">
                <canvas id="diseasesChart" ></canvas>
            </div>
        </div>
    </div>
</div>
</div>

<div class="card card1 mt-5">
    <div class="container mt-4">
    <div class="row text-center">
        <div class="col-md-7 d-flex justify-content-center align-items-center my-3">
            <div class="chart-container">
                <h3>Therapies Offered</h3>
                <canvas id="therapiesChart"></canvas>
            </div>
        </div>
        <div class="col-md-5 d-flex justify-content-center align-items-center my-3">
            <div class="chart-container">
                <h3 class="mr-5"><span class="mr-5">Medicine's Prescribed</span></h3>
                <canvas id="medicinesChart"></canvas>
            </div>
        </div>
    </div>
</div>
</div>


    </div>

    </main>
    <footer id="footer" class="footer position-relative light-background">
    <div class="container copyright text-center mt-4">
      <p style="display: flex; justify-content: center;">©<span>Copyright</span> <strong class="px-1 sitename">BloomWithUs</strong><span>All Rights Reserved</span></p>
      <div class="credits">
        Designed From <a href="https://rudraksha.org.in/" target="_blank"> Rudraksha Welfare Foundation <a href="https://www.linkedin.com/in/chokkalingam2005/" target="_blank"><i class="bi bi-person-workspace"></i></a></a>
      </div>
    </div>
  </footer>
    </div>
    
    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <!-- Preloader -->
    <div id="preloader"></div>
    <!-- Vendor JS Files -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/customAlert.js"></script>
    
    <!-- script -->

       <!-- jQuery -->
       <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
       <!-- Bootstrap JS -->
       <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
       <!-- select2 JS -->
       <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


       <script>
        // Fetch and display appointments data
        fetch('get_appointments_data.php')
    .then(response => response.json())
    .then(data => {
        console.log('Data fetched successfully:', data);

        // Define a list of bright colors
        const brightColors = [
            '#7DDA58',
            '#FFD401', //  Yellow
            '#5DE2E7', //  Blue
            '#BFD641', // oil green
            '#8D6F64',  // Brown
            '#5DE2E7',  // turqoise blue
            '#FFDE59' // Light yellow
        ];

        // Generate colors dynamically based on the number of datasets or data points
        const backgroundColors = data.datasets.map((dataset, index) => {
            // Use modulo to cycle through colors if there are more datasets than colors
            return brightColors[index % brightColors.length];
        });

        const ctx = document.getElementById('appointmentsChart').getContext('2d');
        const appointmentsChart = new Chart(ctx, {
            type: 'bar',
            data: {
                ...data, // Spread the original data
                datasets: data.datasets.map((dataset, index) => ({
                    ...dataset,
                    backgroundColor: backgroundColors[index] // Apply the colors
                }))
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            font: {
                                size: 14, // Increase the font size for y-axis
                                weight: 'bold' // Increase the font weight for y-axis
                            }
                        }
                    },
                    x: {
                        ticks: {
                            font: {
                                size: 14, // Increase the font size for x-axis
                                weight: 'bold' // Increase the font weight for x-axis
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            font: {
                                size: 16, // Increase the font size for legend
                                weight: 'bold' // Increase the font weight for legend
                            }
                        }
                    }
                }
            }
        });
    })
    .catch(error => {
        console.error('Error fetching appointments data:', error);
    });



            // Fetch and display diseases data
            const brightColors = [
    '#FFD401', // Yellow
    '#FE6D6F', // Red
    '#E7DDFF', // li8 purple
    '#8885DF', // Light 
    '#7DDA58', // Green
    '#FF3E5C', // Pink
    '#1BADE6', 
    '#CECECE',
    '#C49662',
    '#8D6F64',
    '#108F8A',
    '#7B9731',
    '#D9FE12',
    '#DFC57B',
    '#FEA5D3'
];

fetch('get_diseases_data.php')
    .then(response => response.json())
    .then(data => {
        const ctx = document.getElementById('diseasesChart').getContext('2d');
        
        // Apply the colors to the dataset
        const datasets = data.datasets.map((dataset, index) => ({
            ...dataset,
            backgroundColor: brightColors // Apply the colors to the pie chart
        }));

        const diseasesChart = new Chart(ctx, {
            type: 'pie',
            data: {
                ...data,
                datasets: datasets // Include the customized datasets
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'left',
                        labels: {
                            font: {
                                size: 16, // Font size for legend labels
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw;
                            }
                        }
                    }
                }
            }
        });
    })
    .catch(error => {
        console.error('Error fetching diseases data:', error);
    });


            // Fetch and display therapies data
            fetch('get_therapies_data.php')
                .then(response => response.json())
                .then(data => {
                    const ctx = document.getElementById('therapiesChart').getContext('2d');
                    const datasets = data.datasets.map((dataset, index) => ({
            ...dataset,
            backgroundColor: brightColors // Apply the colors to the pie chart
        }));
                    const therapiesChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                ...data,
                datasets: datasets // Include the customized datasets
            },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'left',
                                    labels: {
                    // This more specific font property overrides the global property
                    font: {
                        size: 15,
                    }
                }
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(tooltipItem) {
                                            return tooltipItem.label + ': ' + tooltipItem.raw;
                                        }
                                    }
                                }
                            }
                        }
                    });
                })
                .catch(error => {
                    console.error('Error fetching therapies data:', error);
                });
                
            // Fetch and display top 5 medicines data
            fetch('get_top_medicines.php')
                .then(response => response.json())
                .then(data => {
                    const ctx = document.getElementById('medicinesChart').getContext('2d');
                    const datasets = data.datasets.map((dataset, index) => ({
            ...dataset,
            backgroundColor: brightColors // Apply the colors to the pie chart
        }));
                    new Chart(ctx, {
                        type: 'pie', data: {
                ...data,
                datasets: datasets // Include the customized datasets
            },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'right',
                                    labels: {
                    // This more specific font property overrides the global property
                    font: {
                        size: 15,
                    }
                }
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(tooltipItem) {
                                            return tooltipItem.label + ': ' + tooltipItem.raw;
                                        }
                                    }
                                }
                            }
                        }
                    });
                })
                .catch(error => {
                    console.error('Error fetching medicines data:', error);
                });
        </script>


</body>
</html>
