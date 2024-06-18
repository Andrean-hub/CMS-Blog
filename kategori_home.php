<?php
include 'connection.php';

$id_kategori = $_GET['id_kategori'] ?? null;
$referer = $_GET['referer'] ?? 'index.php'; // Default ke all_categories.php jika referer tidak ada

if (!$id_kategori) {
    header('Location: index.php');
    exit();
}

// Fetch category name
$category_query = "SELECT nama_kategori FROM kategori WHERE id_kategori = $id_kategori";
$category_result = mysqli_query($conn, $category_query);
$category = mysqli_fetch_assoc($category_result);

if (!$category) {
    echo "Kategori tidak ditemukan.";
    exit();
}

// Fetch articles in the category
$articles_query = "SELECT * FROM artikel WHERE id_kategori = $id_kategori";
$articles_result = mysqli_query($conn, $articles_query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Articles in
        <?php echo htmlspecialchars($category['nama_kategori']); ?> - Write-Rerz.com
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
                            <a href="index.php" class="nav-item nav-link active">Home</a>
                            <a href="detail-page.php" class="nav-item nav-link">Detail Page</a>
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


    <!-- Modal Search Start
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
     Modal Search End -->


    <!-- Most Populer News Start -->
    <div class="container-fluid populer-news py-5">
        <div class="container py-5">
            <div class="tab-class mb-4">
                <div class="row g-4">
                    <div class="col-lg-8 col-xl-9">
                        <div class="d-flex flex-column flex-md-row justify-content-md-between border-bottom mb-4">
                            <h1 class="mb-4">Articles in
                                <?php echo htmlspecialchars($category['nama_kategori']); ?>
                            </h1>
                            <!--<ul class="nav nav-pills d-inline-flex text-center">
                                <li class="nav-item mb-3">
                                    <a class="d-flex py-2 bg-light rounded-pill me-2" data-bs-toggle="pill"
                                        href="#tab-1">
                                        <span class="text-dark" style="width: 100px;">Pendidikan</span>
                                    </a>
                                </li>
                                <li class="nav-item mb-3">
                                    <a class="d-flex py-2 bg-light rounded-pill me-2" data-bs-toggle="pill"
                                        href="#tab-2">
                                        <span class="text-dark" style="width: 100px;">Bisnis</span>
                                    </a>
                                </li>
                                <li class="nav-item mb-3">
                                    <a class="d-flex py-2 bg-light rounded-pill me-2" data-bs-toggle="pill"
                                        href="#tab-3">
                                        <span class="text-dark" style="width: 100px;">Politik</span>
                                    </a>
                                </li>
                                <li class="nav-item mb-3">
                                    <a class="d-flex py-2 bg-light rounded-pill me-2" data-bs-toggle="pill"
                                        href="#tab-4">
                                        <span class="text-dark" style="width: 100px;">Kesehatan</span>
                                    </a>
                                </li>
                                <li class="nav-item mb-3">
                                    <a class="d-flex py-2 bg-light rounded-pill me-2" data-bs-toggle="pill"
                                        href="#tab-5">
                                        <span class="text-dark" style="width: 100px;">Olahraga</span>
                                    </a>
                                </li>
                            </ul>-->

                        </div>
                        <div class="tab-content mb-4">
                            <div id="tab-1" class="tab-pane fade show p-0 active">
                                <div class="row g-4">
                                    <?php
                                    if (mysqli_num_rows($articles_result) > 0) {
                                        while ($row = mysqli_fetch_assoc($articles_result)) {
                                            echo '<div class="col-lg-8">';
                                            echo '<div class="position-relative rounded overflow-hidden">';
                                            echo '<img src="data:image/jpeg;base64,' . base64_encode($row['gambar']) . '"';
                                            echo 'class="img-zoomin img-fluid rounded w-100" alt="...">';
                                            echo '</div>';
                                            echo '<div class="my-4">
                                            <a href="detail-page.php?id=' . $row['id_artikel'] . '" class="h4">
                                                ' . $row['judul'] . '
                                            </a>
                                        </div>';
                                            echo '<p>' . substr($row['isi'], 0, 150) . '...</p>';
                                            echo '<div class="d-flex justify-content-between">
                                        <a href="#" class="text-dark link-hover me-3"><i
                                                class="fas fa-calendar-alt me-1"></i>' . ($row['tanggal']) . '</a>
                                    </div>';
                                            echo '</div>';
                                        }
                                    } else {
                                        echo '<p>Tidak ada artikel dalam kategori ini.</p>';
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>
                        <div class="border-bottom mb-4">
                            <h2 class="my-4"> </h2>
                        </div>
                        <div class="whats-carousel owl-carousel">

                        </div>
                    </div>
                    <div class="col-lg-4 col-xl-3">
                        <div class="row g-4">
                            <div class="col-12">
                                <div class="p-3 rounded border">
                                    <div class="col-lg-12">
                                        <div class="border-bottom my-3 pb-3">
                                            <h4 class="mb-0">Trending Tags</h4>
                                        </div>
                                        <ul class="nav nav-pills d-inline-flex text-center mb-4">
                                            <?php
                                            include 'connection.php';

                                            $query = "SELECT * FROM kategori";
                                            $result = mysqli_query($conn, $query);

                                            if ($result) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo '<li class="nav-item mb-3">';
                                                    echo '<a class="d-flex py-2 bg-light rounded-pill me-2" href="kategori_home.php?id_kategori=' . $row['id_kategori'] . '&referer=index.php">';
                                                    echo '<span class="text-dark link-hover"
                                                            style="width: 90px;">' . $row['nama_kategori'] . '</span>';
                                                    echo '</a>';
                                                    echo '</li>';
                                                }
                                            } else {
                                                echo '<p>Failed to load categories.</p>';
                                            }
                                            ?>
                                            <!--<li class="nav-item mb-3">
                                                        <a class="d-flex py-2 bg-light rounded-pill me-2" href="<a href="kategori_home.php?id=' . $row['id_kategori'] . '">
                                                            <span class="text-dark link-hover"
                                                                style="width: 90px;">Pendidikan</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item mb-3">
                                                        <a class="d-flex py-2 bg-light rounded-pill me-2" href="#">
                                                            <span class="text-dark link-hover"
                                                                style="width: 90px;">Bisnis</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item mb-3">
                                                        <a class="d-flex py-2 bg-light rounded-pill me-2" href="#">
                                                            <span class="text-dark link-hover"
                                                                style="width: 90px;">Olahraga</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item mb-3">
                                                        <a class="d-flex py-2 bg-light rounded-pill me-2" href="#">
                                                            <span class="text-dark link-hover"
                                                                style="width: 90px;">Politik</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item mb-3">
                                                        <a class="d-flex py-2 bg-light rounded-pill me-2" href="#">
                                                            <span class="text-dark link-hover"
                                                                style="width: 90px;">Kesehatan</span>
                                                        </a>
                                                    </li>-->
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Most Populer News End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-dark footer py-5">
        <div class="container py-5">
            <div class="pb-4 mb-4" style="border-bottom: 1px solid rgba(255, 255, 255, 0.2);">
                <div class="row g-4">
                    <div class="col-lg-3">
                        <a href="#" class="d-flex flex-column flex-wrap">
                            <p class="text-white mb-0 display-6">Write-Rerz</p>
                            <small class="text-light" style="letter-spacing: 11px; line-height: 0;">Article
                                Blog</small>
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