<?php
include 'connection.php'; // Include the connection file

// Get the article ID from the URL
$id_artikel = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Query to get the article
$query = "SELECT artikel.*, kategori.nama_kategori 
          FROM artikel 
          JOIN kategori ON artikel.id_kategori = kategori.id_kategori 
          WHERE artikel.id_artikel = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_artikel);
$stmt->execute();
$result = $stmt->get_result();
$article = $result->fetch_assoc();
$stmt->close();

if (!$article) {
    die("Artikel tidak ditemukan.");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>
        <?= htmlspecialchars($article['judul']) ?> - Detail Page
    </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@100;600;800&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

    <!-- Spinner Start -->
    <div id="spinner"
        class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar start -->
    <div class="container-fluid sticky-top px-0">
        <!--<div class="container-fluid topbar bg-dark d-none d-lg-block">
            <div class="container px-0">
                <div class="topbar-top d-flex justify-content-between flex-lg-wrap">
                    <div class="top-info flex-grow-0">
                        <span class="rounded-circle btn-sm-square bg-primary me-2">
                            <i class="fas fa-bolt text-white"></i>
                        </span>
                        <div class="pe-2 me-3 border-end border-white d-flex align-items-center">
                            <p class="mb-0 text-white fs-6 fw-normal">Trending</p>
                        </div>
                        <div class="overflow-hidden" style="width: 735px;">
                            <div id="note" class="ps-2">
                                <img src="img/features-fashion.jpg"
                                    class="img-fluid rounded-circle border border-3 border-primary me-2"
                                    style="width: 30px; height: 30px;" alt="">
                                <a href="#">
                                    <p class="text-white mb-0 link-hover">Newsan unknown printer took a galley of type
                                        andscrambled Newsan.</p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="top-link flex-lg-wrap">
                        <i class="fas fa-calendar-alt text-white border-end border-secondary pe-2 me-2"> <span
                                class="text-body">Tuesday, Sep 12, 2024</span></i>
                        <div class="d-flex icon">
                            <p class="mb-0 text-white me-2">Follow Us:</p>
                            <a href="" class="me-2"><i class="fab fa-facebook-f text-body link-hover"></i></a>
                            <a href="" class="me-2"><i class="fab fa-twitter text-body link-hover"></i></a>
                            <a href="" class="me-2"><i class="fab fa-instagram text-body link-hover"></i></a>
                            <a href="" class="me-2"><i class="fab fa-youtube text-body link-hover"></i></a>
                            <a href="" class="me-2"><i class="fab fa-linkedin-in text-body link-hover"></i></a>
                            <a href="" class="me-2"><i class="fab fa-skype text-body link-hover"></i></a>
                            <a href="" class=""><i class="fab fa-pinterest-p text-body link-hover"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->
        <div class="container-fluid bg-light">
            <div class="container px-0">
                <nav class="navbar navbar-light navbar-expand-xl">
                    <a href="index.php" class="navbar-brand mt-3">
                        <p class="text-primary display-6 mb-2" style="line-height: 0;">Write-Rerz</p>
                        <small class="text-body fw-normal" style="letter-spacing: 12px;">Article Blog</small>
                    </a>
                    <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars text-primary"></span>
                    </button>
                    <div class="collapse navbar-collapse bg-light py-3" id="navbarCollapse">
                        <div class="navbar-nav mx-auto border-top">
                            <a href="index.php" class="nav-item nav-link ">Home</a>
                            <a href="detail-page.php" class="nav-item nav-link active">Detail Page</a>
                            <!--<a href="404.html" class="nav-item nav-link">404 Page</a>-->
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Post</a>
                                <div class="dropdown-menu m-0 bg-secondary rounded-0">
                                    <a href="article.php" class="dropdown-item">Article</a>
                                    <a href="categories.php" class="dropdown-item">Categories</a>
                                </div>
                            </div>
                            <!--<a href="contact.html" class="nav-item nav-link">Contact Us</a>-->
                        </div>
                        <!--<div class="d-flex flex-nowrap border-top pt-3 pt-xl-0">
                            <div class="d-flex">
                                <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                                    <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-user fa-fw"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                                <li><a class="dropdown-item" href="#" id="authLink">Login</a></li>
                                            </ul>
                                        </li>
                                </ul>
                            </div>
                            <button
                                class="btn-search btn border border-primary btn-md-square rounded-circle bg-white my-auto"
                                data-bs-toggle="modal" data-bs-target="#searchModal"><i
                                    class="fas fa-search text-primary"></i></button>
                        </div>-->
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Modal Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center">
                    <div class="input-group w-75 mx-auto d-flex">
                        <input type="search" class="form-control p-3" placeholder="keywords"
                            aria-describedby="search-icon-1">
                        <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Search End -->


    <!-- Single Product Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <ol class="breadcrumb justify-content-start mb-4">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active text-dark">Single Page</li>
            </ol>
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="mb-4">
                        <a href="#" class="h1 display-5">
                            <?= htmlspecialchars($article['judul']) ?>
                        </a>
                    </div>
                    <div class="position-relative rounded overflow-hidden mb-3">
                        <img src="data:image/jpeg;base64,<?= base64_encode($article['gambar']) ?>"
                            class="img-zoomin img-fluid rounded w-100" alt="">
                        <div class="position-absolute text-white px-4 py-2 bg-primary rounded"
                            style="top: 20px; right: 20px;">
                            <?= htmlspecialchars($article['nama_kategori']) ?>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="#" class="text-dark link-hover me-3"><i class="fa fa-calendar"></i>
                            <?= nl2br(htmlspecialchars($article['tanggal'])) ?></a>
                    </div>
                    <p class="my-4">
                        <?= nl2br(htmlspecialchars($article['isi'])) ?>
                    </p>
                    <!--<div class="bg-light p-4 mb-4 rounded border-start border-3 border-primary">
                        <h1 class="mb-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</h1>
                    </div>
                    <div class="row g-4">
                        <div class="col-6">
                            <div class="rounded overflow-hidden">
                                <img src="img/news-6.jpg" class="img-zoomin img-fluid rounded w-100" alt="">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="rounded overflow-hidden">
                                <img src="img/news-5.jpg" class="img-zoomin img-fluid rounded w-100" alt="">
                            </div>
                        </div>
                    </div>
                    <p class="my-4">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                        Ipsum has been the industry's standard dummy Lorem Ipsum has been the industry's standard dummy
                        type and scrambled it to make a type specimen book. It has survived not only five centuries, but
                        also the leap into electronic
                        Lorem Ipsum is simply dummy
                    </p>
                    <p class="my-4">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                        Ipsum has been the industry's standard dummy Lorem Ipsum has been the industry's standard dummy
                        type and scrambled it to make a type specimen book. It has survived not only five centuries, but
                        also the leap into electronic
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                        ther took It has survived not only five centuries, but also the leap into electronic
                    </p>
                    <div class="d-flex">
                        <div class="me-2">
                            <span class="fas fa-check-circle mb-3 fs-5"> Lorem Ipsum is simply dummy text of</span>
                            <span class="fas fa-check-circle mb-3 fs-5"> Lorem Ipsum is simply dummy text of</span>
                            <span class="fas fa-check-circle mb-3 fs-5"> Lorem Ipsum is simply dummy text of</span>
                        </div>
                        <div class="ms-2">
                            <span class="fas fa-check-circle mb-3 fs-5"> Lorem Ipsum is simply dummy text of</span>
                            <span class="fas fa-check-circle mb-3 fs-5"> Lorem Ipsum is simply dummy text of</span>
                            <span class="fas fa-check-circle mb-3 fs-5"> Lorem Ipsum is simply dummy text of</span>
                        </div>
                    </div>
                    <p class="my-4">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                        Ipsum has been the industry's standard dummy Lorem Ipsum has been the industry's standard dummy
                        type and scrambled it to make a type specimen book. It has survived not only five centuries, but
                        also the leap into electronic
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                        ther took It has survived not only five centuries, but also the leap into electronic
                    </p>-->
                    <div class="tab-class">
                        <div class="d-flex justify-content-between border-bottom mb-4">
                            <ul class="nav nav-pills d-inline-flex text-center">
                                <li class="nav-item mb-3">
                                    <h5 class="mt-2 me-3 mb-0">Tags:</h5>
                                </li>
                                <li class="nav-item mb-3">
                                    <a class="d-flex py-2 bg-light rounded-pill active me-2" data-bs-toggle="pill"
                                        href="#">
                                        <span class="text-dark" style="width: 100px;">
                                            <?= htmlspecialchars($article['nama_kategori']) ?>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                            <div class="d-flex align-items-center">
                                <h5 class="mb-0 me-3">Share:</h5>
                                <i
                                    class="fab fa-facebook-f link-hover btn btn-square rounded-circle border-primary text-dark me-2"></i>
                                <i
                                    class="btn fab bi-twitter link-hover btn btn-square rounded-circle border-primary text-dark me-2"></i>
                                <i
                                    class="btn fab fa-instagram link-hover btn btn-square rounded-circle border-primary text-dark me-2"></i>
                                <i
                                    class="btn fab fa-linkedin-in link-hover btn btn-square rounded-circle border-primary text-dark"></i>
                            </div>
                        </div>
                    </div>
                    <!--<div class="bg-light rounded my-4 p-4">
                        <h4 class="mb-4">You Might Also Like</h4>
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="d-flex align-items-center p-3 bg-white rounded">
                                    <img src="img/chatGPT.jpg" class="img-fluid rounded" alt="">
                                    <div class="ms-3">
                                        <a href="#" class="h5 mb-2">Lorem Ipsum is simply dummy text of the printing</a>
                                        <p class="text-dark mt-3 mb-0 me-3"><i class="fa fa-clock"></i> 06 minute read
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="d-flex align-items-center p-3 bg-white rounded">
                                    <img src="img/chatGPT-1.jpg" class="img-fluid rounded" alt="">
                                    <div class="ms-3">
                                        <a href="#" class="h5 mb-2">Lorem Ipsum is simply dummy text of the printing</a>
                                        <p class="text-dark mt-3 mb-0 me-3"><i class="fa fa-clock"></i> 06 minute read
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>-->

                </div>
                <div class="col-lg-4">
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="p-3 rounded border">
                                <h4 class="mb-4">Popular Categories</h4>
                                <div class="row g-2">
                                <?php
                                    include 'connection.php';

                                    $query = "SELECT * FROM kategori";
                                    $result = mysqli_query($conn, $query);

                                    if ($result) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<div class="col-12">';
                                            echo '<a href="kategori_home.php?id_kategori=' . $row['id_kategori'] . '"';
                                            echo 'class="link-hover btn btn-light w-100 rounded text-uppercase text-dark py-3">';
                                            echo '' . $row['nama_kategori'] . '</a>';
                                            echo '</div>';
                                        }
                                    } else {
                                        echo '<p>Failed to load categories.</p>';
                                    }
                                    ?>
                                    <!--<div class="col-12">
                                        <a href="kategori_home.php?id=' . $row['id_artikel'] . '"
                                            class="link-hover btn btn-light w-100 rounded text-uppercase text-dark py-3">
                                            ' . $row['nama_kategori'] . '</a>
                                    </div>
                                    <div class="col-12">
                                        <a href="#"
                                            class="link-hover btn btn-light w-100 rounded text-uppercase text-dark py-3">
                                            Bisnis
                                        </a>
                                    </div>
                                    <div class="col-12">
                                        <a href="#"
                                            class="link-hover btn btn-light w-100 rounded text-uppercase text-dark py-3">
                                            Politik
                                        </a>
                                    </div>
                                    <div class="col-12">
                                        <a href="#"
                                            class="link-hover btn btn-light w-100 rounded text-uppercase text-dark py-3">
                                            Olahraga
                                        </a>
                                    </div>
                                    <div class="col-12">
                                        <a href="#"
                                            class="link-hover btn btn-light w-100 rounded text-uppercase text-dark py-3">
                                            Kesehatan
                                        </a>
                                    </div>-->
                                </div>
                                <h4 class="my-4">Popular News</h4>
                                <div class="row g-4">
                                    <?php
                                    include 'connection.php';

                                    $query = "SELECT artikel.*, kategori.nama_kategori 
                                        FROM artikel 
                                        JOIN kategori ON artikel.id_kategori = kategori.id_kategori 
                                        ORDER BY artikel.tanggal DESC";
                                    $result = mysqli_query($conn, $query);

                                    if ($result) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<div class="col-12">';
                                            echo '<div class="row g-4 align-items-center features-item">';
                                            echo '<div class="col-4">';
                                            echo '<div class="rounded-circle position-relative">';
                                            echo '<div class="overflow-hidden rounded-circle">';
                                            echo '<img src="data:image/jpeg;base64,' . base64_encode($row['gambar']) . '"';
                                            echo 'class="img-zoomin img-fluid rounded-circle w-100" alt="">';
                                            echo '</div>';
                                            echo '</div>';
                                            echo '</div>';
                                            echo '<div class="col-8">';
                                            echo '<div class="features-content d-flex flex-column">';
                                            echo '<p class="text-uppercase mb-2">' . $row["nama_kategori"] . '</p>';
                                            echo '<a href="detail-page.php?id="' . $row["id_artikel"] . '&referer=index.php" class="h6">';
                                            echo '' . $row["judul"] . '</a>';
                                            echo '<small class="text-body d-block"><i class="fas fa-calendar-alt me-1"></i>' . ($row["tanggal"]) . '</small>';
                                            echo '</div>';
                                            echo '</div>';
                                            echo '</div>';
                                            echo '</div>';
                                        }
                                    } else {
                                        echo '<p>Failed to load categories.</p>';
                                    }
                                    ?>

                                    <!--<div class="col-12">
                                        <div class="row g-4 align-items-center features-item">
                                            <div class="col-4">
                                                <div class="rounded-circle position-relative">
                                                    <div class="overflow-hidden rounded-circle">
                                                        <img src="img/features-technology.jpg"
                                                            class="img-zoomin img-fluid rounded-circle w-100" alt="">
                                                    </div>
                                                    <span
                                                        class="rounded-circle border border-2 border-white bg-primary btn-sm-square text-white position-absolute"
                                                        style="top: 10%; right: -10px;">3</span>
                                                </div>
                                            </div>
                                            <div class="col-8">
                                                <div class="features-content d-flex flex-column">
                                                    <p class="text-uppercase mb-2">Technology</p>
                                                    <a href="#" class="h6">
                                                        Get the best speak market, news.
                                                    </a>
                                                    <small class="text-body d-block"><i
                                                            class="fas fa-calendar-alt me-1"></i> December 9,
                                                        2024</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row g-4 align-items-center features-item">
                                            <div class="col-4">
                                                <div class="rounded-circle position-relative">
                                                    <div class="overflow-hidden rounded-circle">
                                                        <img src="img/features-fashion.jpg"
                                                            class="img-zoomin img-fluid rounded-circle w-100" alt="">
                                                    </div>
                                                    <span
                                                        class="rounded-circle border border-2 border-white bg-primary btn-sm-square text-white position-absolute"
                                                        style="top: 10%; right: -10px;">3</span>
                                                </div>
                                            </div>
                                            <div class="col-8">
                                                <div class="features-content d-flex flex-column">
                                                    <p class="text-uppercase mb-2">Fashion</p>
                                                    <a href="#" class="h6">
                                                        Get the best speak market, news.
                                                    </a>
                                                    <small class="text-body d-block"><i
                                                            class="fas fa-calendar-alt me-1"></i> December 9,
                                                        2024</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row g-4 align-items-center features-item">
                                            <div class="col-4">
                                                <div class="rounded-circle position-relative">
                                                    <div class="overflow-hidden rounded-circle">
                                                        <img src="img/features-life-style.jpg"
                                                            class="img-zoomin img-fluid rounded-circle w-100" alt="">
                                                    </div>
                                                    <span
                                                        class="rounded-circle border border-2 border-white bg-primary btn-sm-square text-white position-absolute"
                                                        style="top: 10%; right: -10px;">3</span>
                                                </div>
                                            </div>
                                            <div class="col-8">
                                                <div class="features-content d-flex flex-column">
                                                    <p class="text-uppercase mb-2">Life Style</p>
                                                    <a href="#" class="h6">
                                                        Get the best speak market, news.
                                                    </a>
                                                    <small class="text-body d-block"><i
                                                            class="fas fa-calendar-alt me-1"></i> December 9,
                                                        2024</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>-->
                                    <div class="col-lg-12">
                                        <a href="index.php"
                                            class="link-hover btn border border-primary rounded-pill text-dark w-100 py-3 mb-4">View
                                            More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Single Product End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-dark footer py-5">
        <div class="container py-5">
            <div class="pb-4 mb-4" style="border-bottom: 1px solid rgba(255, 255, 255, 0.2);">
                <div class="row g-4">
                    <div class="col-lg-3">
                        <a href="#" class="d-flex flex-column flex-wrap">
                            <p class="text-white mb-0 display-6">Write-Rerz</p>
                            <small class="text-light" style="letter-spacing: 11px; line-height: 0;">Article Blog</small>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row g-5">
                <div class="col-lg-6 col-xl-3">
                    <div class="footer-item-1">
                        <h4 class="mb-4 text-white">Get In Touch</h4>
                        <p class="text-secondary line-h">Address: <span class="text-white">Malang</span>
                        </p>
                        <p class="text-secondary line-h">Email: <span class="text-white">andrean1329@gmail.com</span>
                        </p>
                        <p class="text-secondary line-h">Phone: <span class="text-white">+62838 0456 8210</span></p>
                        <div class="d-flex line-h">
                            <a class="btn btn-light me-2 btn-md-square rounded-circle" href=""><i
                                    class="fab fa-twitter text-dark"></i></a>
                            <a class="btn btn-light me-2 btn-md-square rounded-circle" href=""><i
                                    class="fab fa-facebook-f text-dark"></i></a>
                            <a class="btn btn-light me-2 btn-md-square rounded-circle" href=""><i
                                    class="fab fa-instagram text-dark"></i></a>
                            <a class="btn btn-light btn-md-square rounded-circle" href=""><i
                                    class="fab fa-linkedin-in text-dark"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Copyright Start -->
    <div class="container-fluid copyright bg-dark py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <span class="text-light"><a href="index.php"><i
                                class="fas fa-copyright text-light me-2"></i>Write-Rerz.com
                        </a>, All right reserved.</span>
                </div>
                <div class="col-md-6 my-auto text-center text-md-end text-white">
                    <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                    <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                    <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-2 border-white rounded-circle back-to-top"><i
            class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>