<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>BloomWithUs</title>
  <link rel="icon" href="http://bloomwithus.co.in/logo.png" type="image/x-icon">
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: #f8f9fa;
      margin: 0;
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
      align-items: center;
    }
    .login-form {
      width: 100%;
      max-width: 400px;
      padding: 20px;
      border: 1px solid #ddd;
      border-radius: 5px;
      background: #fff;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }
    footer {
      flex-shrink: 0;
      background: #f8f9fa;
    }
  </style>

</head>

<body class="index-page">
  <div class="container-wrapper">
    <header id="header" class="header d-flex align-items-center fixed-top">
      <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="index.html" class="logo d-flex align-items-center me-auto">
          <img src="http://bloomwithus.co.in/logo.png" alt="">
          <h1 class="sitename">BloomWithUs</h1>
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="index.php#about">About</a></li>
            <li><a href="index.php#features">Expert</a></li>
            <li><a href="index.php#services">Sessions</a></li>
            <li><a href="index.php#contact">Contact</a></li>
            <li><a href="login.php" class="active">Admin</a></li>
          </ul>
          
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
        <a class="btn-getstarted" href="ab.php">Appointment</a>
      </div>
    </header>

    <main class="main">
      <div class="login-form">
        <h3 class="text-center" style="color: #388da8;">Admin Login</h3>
        <form action="login_process.php" method="POST">
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
          <button type="submit" class="btn btn-primary w-100" style="background-color: #388da8;">Login</button>
        </form>
      </div>
    </main>

    <footer id="footer" class="footer position-relative light-background">
      <div class="container copyright text-center mt-4">
        <p style="display: flex; justify-content: center;">©<span>Copyright</span> <strong class="px-1 sitename">BloomWithUs</strong><span>All Rights Reserved</span></p>
        <div class="credits">
          Designed From <a href="https://rudraksha.org.in/" target="_blank"> Rudraksha</a>
        </div>
      </div>
    </footer>
  </div>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <!-- Preloader -->
  <div id="preloader"></div>
  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
