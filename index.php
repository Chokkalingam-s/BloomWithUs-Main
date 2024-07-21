<?php
include 'db_connection.php';

$conn = new mysqli($servername, $db_username, $db_password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM events ORDER BY id ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Developed By Chokkalingam S ( linkedin.com/in/chokkalingam2005 )-->
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>BloomWithUs</title>
  <link rel="icon" href="assets/img/logo.png" type="image/x-icon">
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

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
        .counter-section {
            background-color: #f0f8ff;
            padding: 50px 0;
            text-align: center;
            max-width: 100%;
        }
        .counter {
            font-size: 2.5em;
            color: #388da8;
        }
        .counter-description {
            font-size: 1.2em;
            color: #16a085;
        }
        .plus-sign {
            font-size: 1.2em;
            vertical-align: center;
            
        }
    </style>
</head>

<body class="index-page">
  <!-- Developed By Chokkalingam S ( linkedin.com/in/chokkalingam2005 )-->
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="index.html" class="logo d-flex align-items-center me-auto">
        <img src="assets/img/logo.png" alt="Logo">
        <h1 class="sitename">BloomWithUs</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#" class="active">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#features">Expert</a></li>
          <li><a href="#services">Sessions</a></li>
          <li><a href="#contact">Contact</a></li>
          <li><a href="login.php">Admin</a></li>
        </ul>
        
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
      <a class="btn-getstarted" href="ab.php">Appointment</a>
    </div>
  </header>

  <main class="main">
    <!-- Carousel -->    
    <div id="carouselExampleIndicators" id="hero" class="carousel slide" style="margin-top: 13vh;" data-bs-ride="carousel" data-bs-interval="4700">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="800" height="500" src="assets/img/MB2.jpg" role="img" aria-label="Placeholder: First slide" preserveAspectRatio="xMidYMid slice" focusable="false"></img>
        </div>
        <div class="carousel-item">
          <img class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="800" height="500" src="assets/img/MB3.jpg" role="img" aria-label="Placeholder: Second slide" preserveAspectRatio="xMidYMid slice" focusable="false"></img>
        </div>
        <div class="carousel-item">
          <img class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="800" height="500" src="assets/img/MB1.jpg" role="img" aria-label="Placeholder: Third slide" preserveAspectRatio="xMidYMid slice" focusable="false"></img>
        </div>
        <div class="carousel-item">
          <img class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="800" height="500" src="assets/img/MB4.jpg" role="img" aria-label="Placeholder: Fourth slide" preserveAspectRatio="xMidYMid slice" focusable="false"></img>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
     <!-- Carousel End-->  

    <!-- Featured Services Section -->
    <section id="featured-services" class="featured-services section light-background">
      <div class="container">
        <div class="row gy-4">
          <div class="col-xl-4 col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item d-flex">
              <div class="icon flex-shrink-0"><i class="bi bi-calendar-date"></i></div>
              <div>
                <h4 class="title"><a href="#" class="stretched-link">10 AM - 6 PM Services</a></h4>
                <p class="description">Dedicated service hours ensuring timely mental health support.</p>
              </div>
            </div>
          </div>
          <!-- End Service Item -->

          <div class="col-xl-4 col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item d-flex">
              <div class="icon flex-shrink-0"><i class="bi bi-person-fill-check"></i></div>
              <div>
                <h4 class="title"><a href="#" class="stretched-link">Professional Staff</a></h4>
                <p class="description">Qualified experts committed to your mental well-being and growth.</p>
              </div>
            </div>
          </div><!-- End Service Item -->

          <div class="col-xl-4 col-lg-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item d-flex">
              <div class="icon flex-shrink-0"><i class="bi bi-clipboard-heart-fill"></i></div>
              <div>
                <h4 class="title"><a href="#" class="stretched-link">Emergency Care</a></h4>
                <p class="description">Prompt, reliable care for urgent psychological needs and assistance.</p>
              </div>
            </div>
          </div><!-- End Service Item -->
        </div>
      </div>
    </section><!-- /Featured Services Section -->

    <!-- About Section -->
    <section id="about" class="about section">
      <div class="container">
          <div class="row gy-4" >
              <div class="col-lg-6 content d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="100">
                  <p class="who-we-are">Who We Are</p>
                  <h3 style="text-align:left">Psychology delves into Understanding Human Behaviors, Thoughts, & Emotions to Aid Adaptation</h3>
                  <p class="fst-italic">
                      It's distinct from psychiatry, pediatrics, or social work, focusing on mental processes, brain functions, and behavior. Psychologists address well-being, treating disorders like Personality Disorder or OCD. Despite misconceptions of granting "superpowers," psychology aims to alleviate stigma and provide accurate understanding.
                  </p>
                  <ul>
                      <li><i class="bi bi-check-circle"></i> <span>Mental health struggles often face societal misunderstanding, labeled as "weakness" or "drama."</span></li>
                      <li><i class="bi bi-check-circle"></i> <span>Seeking professional help remains paramount, though some misconstrue medication as the sole solution.</span></li>
                      <li><i class="bi bi-check-circle"></i> <span>In essence, while friends and family offer support, professional intervention is irreplaceable in fostering mental wellness.</span></li>
                  </ul>
                  <!-- <a href="#" class="read-more"><span>Book Session</span><i class="bi bi-arrow-right"></i></a> -->
              </div>
  
              <div class="col-lg-6 about-images d-flex align-items-center" data-aos="fade-up" data-aos-delay="200">
                  <img src="assets/img/logo.png" class="img-fluid w-100 h-99" alt="">
              </div>
          </div>
      </div>
  </section>
    <!-- End About Section -->

    <div class="container counter-section">
      <div class="row">
          <div class="col-md-4">
              <div class="counter"><strong><span id="peopleTreated">0</span><span class="plus-sign">+</span></strong></div>
              <div class="counter-description"><h4><strong>Lives Transformed</strong></h4></div>
          </div>
          <div class="col-md-4">
              <div class="counter"><strong><span id="lecturesSeminars">0</span><span class="plus-sign">+</span></strong></div>
              <div class="counter-description"><h4><strong>Seminars Conducted</strong></h4></div>
          </div>
          <div class="col-md-4">
              <div class="counter"><strong><span id="yearsExperience">0</span><span class="plus-sign">+</span></strong></div>
              <div class="counter-description"><h4><strong>Consultancy Experience</strong></h4></div>
          </div>
      </div>
  </div>
    <!-- Myths and Facts Section -->
    <section id="testimonials" class="testimonials section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Myths and Facts</h2>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="swiper init-swiper">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 7000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 1,
                  "spaceBetween": 40
                },
                "1200": {
                  "slidesPerView": 3,
                  "spaceBetween": 1
                }
              }
            }
          </script>
          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="stars">    
                <h6> <i>Myths-</i> If a person has a mental health condition, it
                  means the person has low intelligence.</h6>
                    <p><i>Fact-</i> Mental illness, like physical illness, can affect anyone
                  regardless of intelligence, social class, or income level.</p>
                </div>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="stars">
                <h6><i>Myth: </i>Nothing can be done to protect people from
                  developing mental health conditions.</h6>
                    <p><i>Fact-</i> Many factors can protect people from developing mental
                  health conditions, as strengthening social and emotional
                  skills, seeking support early on,
                  loving, warm relationships, having a positive school
                  environment & healthy sleep patterns.</p>
                  </div>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="stars">         
                <h6><i>Myth:</i> A mental health condition is a sign of weakness; if
                  the person were stronger, they would not have this
                  condition.</h6>
                    <p><i>Fact -</i>Anyone can develop a mental health condition. A mental
                  health condition has nothing to do with being weak or lacking
                  willpower.</p>
                </div>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="stars"> 
                <h6><i>Myth: </i>Therapy and self-help are a waste of time. Why bother when you can just take a pill?</h6>
                <p><i>Fact- </i> Treatment for mental health conditions vary depending on the individual and could include medication,
                   therapy, or both. Many individuals do best when they work with a support system during the healing and recovery process.</p>
              </div>
              </div>
            </div><!-- End testimonial item -->

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>

    </section><!-- /Myths Section End -->

    <!-- Expert Section -->
    <section id="features" class="features section">
      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
          <h2>Expert</h2>
      </div><!-- End Section Title -->
  
      <div class="container">
          <div class="row flex-lg-nowrap flex-wrap justify-content-between">

            <!-- Image Column -->
            <div class="col-lg-4 image-column d-flex align-items-start justify-content-center" data-aos="fade-up" data-aos-delay="200">
              <img src="assets/img/mam.jpg" alt="Mrs.Tamana Sharma" class="img-fluid">
          </div><!-- End Image Column -->
              <!-- Content Column -->
              <div class="col-lg-8 content d-flex flex-column" data-aos="fade-up" data-aos-delay="100">
                  <div class="expert-content">
                      <ul class="team-social">
                          <li>Ms. Tamana Sharma, with an MSc in Applied Psychology from Guru Jambheshwar University (2010), has cultivated a career dedicated to advancing mental health and personal development. Her professional journey began as a psychologist trainee at Arya Hospital, Chandigarh (2012-2013), where she gained essential clinical experience. This foundational period was followed by a significant tenure at Ishh Guidance and Counselling Centre in Panchkula (2013-2020), where she provided comprehensive psychological services, including individual counseling, psychological assessments, and therapeutic interventions.</li>
                          <li>The COVID-19 pandemic necessitated a shift to online counseling (2020-2022), during which she continued to support clients' mental health needs remotely, demonstrating adaptability and commitment to her practice. In 2022, she founded Bloom with Us Guidance and Counselling Centre, a private counseling center that offers personalized mental health services, career counseling, and personal development workshops.</li>
                          <li class="more-content">Throughout her career, Mrs. Tamana Sharma has been actively involved in conducting workshops on a variety of crucial topics such as aptitude and career counseling, parenting, sex education, and personality development. These workshops have been held at reputable institutions including Northern Railways, DAV School, and Hans Raj School, allowing her to reach and impact a wide audience. Additionally, she has organized psychological testing and behavioral therapy sessions across Chandigarh, Haryana, Ambala, and Shimla, further extending her influence in the field.</li>
                          <li class="more-content">Her commitment to social activism is evidenced by her organization of free education and health camps, and participation in environmental, Anti-AIDS, and Anti-Drugs campaigns. She has also been actively involved in the National Service Scheme (NSS) and holds an NCC ‘C’ certificate, reflecting her dedication to community service and leadership. In recent years, her work has focused on career counseling, mental health lectures, personality testing, and individual and matrimonial counseling sessions.</li>
                          <li class="more-content">Mrs. Tamana Sharma has embraced social media, particularly Instagram, to share insights and tips for mental growth and personal development, thereby fostering a supportive online community. Her comprehensive experience, community involvement, and innovative approach to online counseling underscore her dedication to enhancing mental health and personal development for individuals and communities alike.</li>
                      </ul>
                      <button class="read-more btn btn-primary" style="background-color: #388ea8cb; margin-left: 42%;">Read More</button>
                  </div>
              </div><!-- End Content Column -->
  
              
          </div>
      </div>
  </section><!-- /Expert Section -->

    <!-- Sessions Section -->
    <section id="services" class="services section light-background">
      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Sessions on Mental Health</h2>
         </div><!-- End Section Title -->
        <div class="container">
                <div class="row">

                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $title = htmlspecialchars($row['title']);
                            $description = nl2br(htmlspecialchars($row['description']));;
                            $images = json_decode($row['images'], true);
                    ?>

                            <div class="col-md-6">
                                <!-- Event Card Start -->
                                <div class="card event-card">
                                    <div class="card-header event-card-header">
                                        <h5 class="card-title event-card-title"><?php echo $title; ?></h5>
                                    </div>
                                    <div class="card-body event-card-body">
                                        <p class="card-text event-card-description"><?php echo $description; ?></p>
                                        <div class="row">
                                            <?php
                                            $imageCount = count($images);
                                            $limit = min($imageCount, 2); // Show maximum of 2 images
                                            for ($i = 0; $i < $limit; $i++) {
                                                echo '<div class="col-6">';
                                                echo '<img src="uploads/' . $images[$i] . '" alt="' . $title . ' Image ' . ($i + 1) . '" class="event-image" data-bs-toggle="modal" data-bs-target="#eventModal">';
                                                echo '</div>';
                                            }
                                            ?>
                                        </div>
                                        <div class="d-flex justify-content-center mt-3"> <!-- Center align button -->
                                       <?php
                                          if ($imageCount > 2) {
                                              echo '<button class="btn btn-primary view-more-btn" style="background-color: #388da8;" data-bs-toggle="modal" data-bs-target="#eventModal_' . $row['id'] . '">View More Images</button>';
                                          }
                                          ?>
                                      </div>
                                    </div>
                                </div>
                                <!-- Event Card End -->
                            </div>

                            <!-- Modal for Images -->
                            <div class="modal fade" id="eventModal_<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="eventModalLabel_<?php echo $row['id']; ?>" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="eventModalLabel_<?php echo $row['id']; ?>">Event Images - <?php echo $title; ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body" style="max-height: calc(100vh - 200px); overflow-y: auto;">
                                            <div id="carouselExampleControls_<?php echo $row['id']; ?>" class="carousel slide" data-bs-ride="carousel">
                                                <div class="carousel-inner">
                                                    <?php
                                                    foreach ($images as $index => $image) {
                                                        echo '<div class="carousel-item ' . ($index === 0 ? 'active' : '') . '">';
                                                        echo '<img src="uploads/' . $image . '" class="d-block w-100" style="object-fit:contain;height:auto; max-height:95vh;" alt="Event Image ' . ($index + 1) . '">';
                                                        echo '</div>';
                                                    }
                                                    ?>
                                                </div>
                                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls_<?php echo $row['id']; ?>" data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Previous</span>
                                                </button>
                                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls_<?php echo $row['id']; ?>" data-bs-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Next</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->
                    <?php
                        }
                    } else {
                        echo "No events found";
                    }
                    $conn->close();
                    ?>
                </div>
      </div>
    </section><!-- /Sessions Section -->

    <!-- Faq Section -->
    <section id="faq" class="faq section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Frequently Asked Questions</h2>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row justify-content-center">

          <div class="col-lg-10" data-aos="fade-up" data-aos-delay="100">

            <div class="faq-container">

              <div class="faq-item faq-active">
                <h3>What is the difference between a psychologist and a psychiatrist?</h3>
                <div class="faq-content">
                  <p>Psychologists primarily provide talk therapy and behavioral interventions, while psychiatrists are medical doctors who can prescribe medication for mental health conditions. Both professionals often collaborate to provide comprehensive care.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3>How do I know if I need to see a psychologist?</h3>
                <div class="faq-content">
                  <p>If you're experiencing persistent emotional distress, changes in mood, difficulties coping with daily activities, or overwhelming stress, consulting a psychologist can help you understand and manage these issues effectively.</p>
                  </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3>How confidential are my sessions with a psychologist?</h3>
                <div class="faq-content">
                  <p> Psychologists adhere to strict confidentiality guidelines. Information shared in therapy is protected and will only be disclosed with your consent or if required by law (e.g., in cases of imminent harm).</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3>How long does therapy typically last?</h3>
                <div class="faq-content">
                  <p> The duration of therapy varies depending on individual needs. Some people may find relief in a few sessions, while others might benefit from longer-term therapy. Your psychologist will work with you to determine the best approach.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3>What are the signs of depression?</h3>
                <div class="faq-content">
                  <p> Common signs of depression include persistent sadness, loss of interest in activities, changes in appetite or sleep patterns, fatigue, feelings of worthlessness, and difficulty concentrating. If you experience these symptoms, seeking professional help is recommended.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3>How do I book a session with a psychologist?</h3>
                <div class="faq-content">
                  <p>You can book a session through our website's booking system or contact us directly via phone or email. Our team will assist you in scheduling an appointment at a convenient time.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

            </div>

          </div><!-- End Faq Column-->

        </div>

      </div>

    </section><!-- /Faq Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Contact Us</h2>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-4">
            <div class="col-lg-6">
                <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="200">
                    <i class="bi bi-geo-alt"></i>
                    <h3>Address</h3>
                    <p>#132/6, Mansa Devi Complex, Sector 4,
                      Panchkula, Haryana, India, 134109</p>
                </div>
                <!-- End Info Item -->
    
                <div class="row gy-4 mt-3">
                    <div class="col-lg-6 col-md-6">
                      <a href="tel:+91 97799 81199" style="text-decoration: none;"> <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="300">
                            <i class="bi bi-telephone"></i>
                            <h3>Call Us</h3>
                            <p>+91 97799 81199</p>
                        </div>
                        </a>
                    </div>
                    <!-- End Info Item -->
    
                    <div class="col-lg-6 col-md-6">
                      <a href="mailto:Bloomwithuscounselling@gmail.com" style=" text-decoration: none;">
                        <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="400">
                            <i class="bi bi-envelope"></i>
                            <h3>Email Us</h3>
                            <p>Bloomwithuscounselling@gmail.com</p>
                        </div>
                        </a>
                    </div>
                    <!-- End Info Item -->
                </div>
            </div>
            <!-- End Contact Form -->
    
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3431.236945533628!2d76.87522361461943!3d30.676032481636574!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390fdf8495898ef1%3A0xf43a7fde6c916e21!2sMansa%20Devi%20Complex%2C%20Panchkula%2C%20Haryana%2C%20India%2C%20134109!5e0!3m2!1sen!2s!4v1620319184670!5m2!1sen!2s"  frameborder="0" style="border:0; width: 100%; height: 400px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <!-- End Google Maps -->
        </div>
    </div>
    

    </section><!-- /Contact Section -->


  </main>

  <footer id="footer" class="footer position-relative light-background">
    <div class="container copyright text-center mt-4">
      <p style="display: flex; justify-content: center;">©<span>Copyright</span> <strong class="px-1 sitename">BloomWithUs</strong><span>All Rights Reserved</span></p>
      <div class="credits">
        Designed From <a href="https://rudraksha.org.in/" target="_blank"> Rudraksha Welfare Foundation <a href="https://www.linkedin.com/in/chokkalingam2005/" target="_blank"><i class="bi bi-person-workspace"></i></a></a>
      </div>
    </div>
  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <!-- Preloader -->
  <div id="preloader"></div>
  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
        var readMoreBtn = document.querySelector(".read-more");
        var moreContent = document.querySelectorAll(".more-content");
        var isExpanded = false;
    
        readMoreBtn.addEventListener("click", function() {
            moreContent.forEach(function(item) {
                item.style.display = isExpanded ? "none" : "list-item";
            });
            isExpanded = !isExpanded;
            readMoreBtn.textContent = isExpanded ? "Read Less" : "Read More";
        });
    });
    </script>
  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>


  <script>
document.addEventListener('DOMContentLoaded', function() {
    const counters = document.querySelector('.counter-section');
    const observer = new IntersectionObserver((entries) => {
        if (entries[0].isIntersecting) {
            fetchAndAnimateCounters();
            observer.disconnect();
        }
    }, { threshold: 0.1 });

    observer.observe(counters);
});

async function fetchAndAnimateCounters() {
    try {
        const response = await fetch('get_achievements.php');
        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }
        const data = await response.json();
        if (data && typeof data === 'object') {
            animateCounter('peopleTreated', data.people_treated);
            animateCounter('lecturesSeminars', data.lectures_seminars);
            animateCounter('yearsExperience', data.years_experience);
        } else {
            console.error('Data is not an object:', data);
        }
    } catch (error) {
        console.error('Error fetching data:', error);
    }
}

function animateCounter(id, endValue) {
    let counter = document.getElementById(id);
    let count = 0;
    let increment = Math.ceil(endValue / 90);
    let interval = setInterval(() => {
        if (count >= endValue) {
            clearInterval(interval);
            count = endValue; 
        }
        counter.innerText = count;
        count += increment;
    }, 20); // Adjust the speed
}
</script>

</body>

</html>