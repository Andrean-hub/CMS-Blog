<?php
session_start();

// Cek apakah pengguna sudah login atau belum
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    // Pengguna belum login, lakukan tindakan yang sesuai, seperti redirect ke halaman login
    header('Location: login.php');
    exit();
}

// Jika pengguna sudah login, maka dapatkan dan tampilkan email
$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Post Article</title>
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

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
                            <a href="index.php" class="nav-item nav-link">Home</a>
                            <a href="#" class="nav-item nav-link">Detail Page</a>
                            <!--<a href="404.html" class="nav-item nav-link">404 Page</a>-->
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-item nav-link active dropdown-toggle"
                                    data-bs-toggle="dropdown">Post</a>
                                <div class="dropdown-menu m-0 bg-secondary rounded-0">
                                    <a href="article.php" class="dropdown-item active">Article</a>
                                    <a href="categories.php" class="dropdown-item">Categories</a>
                                </div>
                            </div>
                        
                            <!--<a href="contact.html" class="nav-item nav-link">Contact Us</a>-->
                        </di>
                        <div class="d-flex flex-nowrap border-top pt-3 pt-xl-0">
                            <div class="d-flex">
                                <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-user fa-fw"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                            <li><a class="dropdown-item" href="#" id="authLink">Logout</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <!--<button
                                class="btn-search btn border border-primary btn-md-square rounded-circle bg-white my-auto"
                                data-bs-toggle="modal" data-bs-target="#searchModal"><i
                                    class="fas fa-search text-primary"></i></button>-->
                        </div>
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

    <!-- Most Populer News Start -->
    <div class="container-fluid populer-news py-5">
        <div class="container py-5">
            <div class="tab-class mb-4">
                <div class="row g-4">
                    <div class="col-lg-8 col-xl-9">
                        <div class="d-flex flex-column flex-md-row justify-content-md-between border-bottom mb-4">
                            <h1 class="mb-4">Articles</h1>
                            <ul class="nav nav-pills d-inline-flex text-center">
                                <li class="nav-item mb-3">
                                    <button type="button" class="d-flex py-2 bg-light rounded-pill active me-2"
                                        data-bs-toggle="modal" data-bs-target="#tambah"><span class="text-dark"
                                            style="width: 100px;">Add</span>
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Article List:
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple" class="table table-striped table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th>Id Artikel</th>
                                            <th>Tanggal</th>
                                            <th>Author</th>
                                            <th>Kategori</th>
                                            <th>Judul</th>
                                            <th>Isi</th>
                                            <th>Gambar</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    include "connection.php";
                                    $query = mysqli_query($conn, "SELECT artikel.*, kategori.nama_kategori 
                                    FROM artikel 
                                    JOIN kategori ON artikel.id_kategori = kategori.id_kategori 
                                        ORDER BY artikel.id_artikel ASC");
                                    $no = 1; // Initialize row counter
                                    while ($row = mysqli_fetch_array($query)):
                                        ?>
                                        <tr>
                                            <td>
                                                <?= $row['id_artikel'] ?>
                                            </td>
                                            <td>
                                                <?= $row['tanggal'] ?>
                                            </td>
                                            <td>
                                                <?= $row['penulis'] ?>
                                            </td>
                                            <td>
                                                <?= $row['nama_kategori'] ?>
                                            </td>
                                            <td>
                                                <?= $row['judul'] ?>
                                            </td>
                                            <td>
                                                <?= substr($row['isi'], 0, 30) ?><?php if (strlen($row['isi']) > 30) echo '...'; ?>
                                            </td>
                                            <td><img src="data:image/jpeg;base64,<?= base64_encode($row['gambar']) ?>"
                                                    width="100"></td>
                                            <td>
                                                <a href="#" class="btn btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#articleedit<?= $no ?>">Edit</a>
                                                <a href="#" class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#articlehapus<?= $no ?>">Delete</a>
                                            </td>
                                        </tr>

                                        <!-- Edit Article Modal -->
                                        <div class="modal fade" id="articleedit<?= $no ?>" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Article</h5>
                                                    </div>
                                                    <form action="act_article.php" method="POST"
                                                        enctype="multipart/form-data">
                                                        <input type="hidden" name="tid" value="<?= $row['id_artikel'] ?>">
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label class="control-label" for="penulis">Author</label>
                                                                <input type="text" class="form-control" name="penulis"
                                                                    value="<?= $row['penulis'] ?>" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label" for="kategori">Category</label>
                                                                <select class="form-control" name="kategori" required>
                                                                    <?php
                                                                    $catQuery = mysqli_query($conn, "SELECT * FROM kategori");
                                                                    while ($catRow = mysqli_fetch_array($catQuery)) {
                                                                        $selected = ($catRow['id_kategori'] == $row['id_kategori']) ? 'selected' : '';
                                                                        echo "<option value='{$catRow['id_kategori']}' $selected>{$catRow['nama_kategori']}</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label" for="judul">Title</label>
                                                                <input type="text" class="form-control" name="judul"
                                                                    value="<?= $row['judul'] ?>" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label" for="isi">Content</label>
                                                                <textarea class="form-control" name="isi" rows="5"
                                                                    required><?= $row['isi'] ?></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label" for="gambar">Image</label>
                                                                <input type="file" class="form-control" name="gambar">
                                                                <img src="data:image/jpeg;base64,<?= base64_encode($row['gambar']) ?>"
                                                                    width="100" class="mt-2">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button class="btn btn-primary" type="submit"
                                                                    name="articleedit">Save</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Delete Article Modal -->
                                        <div class="modal fade" id="articlehapus<?= $no ?>" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Delete Article</h5>
                                                    </div>
                                                    <form action="act_article.php" method="POST">
                                                        <input type="hidden" name="id_artikel"
                                                            value="<?= $row['id_artikel'] ?>">
                                                        <div class="modal-body">
                                                            <div class="modal-footer">
                                                                <h5 class="text-center">Are you sure you want to delete this
                                                                    article? <br><span class="text-danger">
                                                                        <?= $row['judul'] ?>
                                                                    </span></h5>
                                                                <button type="button" class="btn btn-primary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button class="btn btn-primary" type="submit"
                                                                    name="articledelete">Delete</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        $no++; // Increment row counter
                                    endwhile;
                                    ?>
                                </table>
                            </div>
                        </div>
                        <!-- Add Article Modal -->
                        <div class="modal fade" id="tambah" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">New Article</h5>
                                    </div>
                                    <form action="act_article.php" method="POST" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label class="control-label" for="penulis">Author</label>
                                                <input type="text" class="form-control" name="penulis"
                                                    placeholder="Enter author's name" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label" for="kategori">Category</label>
                                                <select class="form-control" name="kategori" required>
                                                    <?php
                                                    $catQuery = mysqli_query($conn, "SELECT * FROM kategori");
                                                    while ($catRow = mysqli_fetch_array($catQuery)) {
                                                        echo "<option value='{$catRow['id_kategori']}'>{$catRow['nama_kategori']}</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label" for="judul">Title</label>
                                                <input type="text" class="form-control" name="judul"
                                                    placeholder="Enter the title" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label" for="isi">Content</label>
                                                <textarea class="form-control" name="isi" rows="5"
                                                    placeholder="Enter the content" required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label" for="gambar">Image</label>
                                                <input type="file" class="form-control" name="gambar" required>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button class="btn btn-primary" type="submit" name="articlesave">Add
                                                    Article</button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!--<div class="tab-content mb-4">
                            <div id="tab-1" class="tab-pane fade show p-0 active">
                                <div class="row g-4">
                                    <div class="col-lg-8">
                                        <div class="position-relative rounded overflow-hidden">
                                            <img src="img/news-1.jpg" class="img-zoomin img-fluid rounded w-100" alt="">
                                            <div class="position-absolute text-white px-4 py-2 bg-primary rounded"
                                                style="top: 20px; right: 20px;">
                                                Sports
                                            </div>
                                        </div>
                                        <div class="my-4">
                                            <a href="#" class="h4">Lorem Ipsum is simply dummy text of the printing and
                                                typesetting industry.</a>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <a href="#" class="text-dark link-hover me-3"><i class="fa fa-clock"></i> 06
                                                minute read</a>
                                            <a href="#" class="text-dark link-hover me-3"><i class="fa fa-eye"></i> 3.5k
                                                Views</a>
                                            <a href="#" class="text-dark link-hover me-3"><i
                                                    class="fa fa-comment-dots"></i> 05 Comment</a>
                                            <a href="#" class="text-dark link-hover"><i class="fa fa-arrow-up"></i> 1.5k
                                                Share</a>
                                        </div>
                                        <p class="my-4">Lorem Ipsum is simply dummy text of the printing and typesetting
                                            industry. Lorem Ipsum has been the industry's standard dummy Lorem Ipsum has
                                            been the industry's standard dummy..
                                        </p>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="row g-4">
                                            <div class="col-12">
                                                <div class="row g-4 align-items-center">
                                                    <div class="col-5">
                                                        <div class="overflow-hidden rounded">
                                                            <img src="img/news-3.jpg"
                                                                class="img-zoomin img-fluid rounded w-100" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="col-7">
                                                        <div class="features-content d-flex flex-column">
                                                            <p class="text-uppercase mb-2">Sports</p>
                                                            <a href="#" class="h6">Get the best speak market, news.</a>
                                                            <small class="text-body d-block"><i
                                                                    class="fas fa-calendar-alt me-1"></i> Dec 9,
                                                                2024</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="row g-4 align-items-center">
                                                    <div class="col-5">
                                                        <div class="overflow-hidden rounded">
                                                            <img src="img/news-4.jpg"
                                                                class="img-zoomin img-fluid rounded w-100" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="col-7">
                                                        <div class="features-content d-flex flex-column">
                                                            <p class="text-uppercase mb-2">Sports</p>
                                                            <a href="#" class="h6">Get the best speak market, news.</a>
                                                            <small class="text-body d-block"><i
                                                                    class="fas fa-calendar-alt me-1"></i> Dec 9,
                                                                2024</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="row g-4 align-items-center">
                                                    <div class="col-5">
                                                        <div class="overflow-hidden rounded">
                                                            <img src="img/news-5.jpg"
                                                                class="img-zoomin img-fluid rounded w-100" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="col-7">
                                                        <div class="features-content d-flex flex-column">
                                                            <p class="text-uppercase mb-2">Sports</p>
                                                            <a href="#" class="h6">Get the best speak market, news.</a>
                                                            <small class="text-body d-block"><i
                                                                    class="fas fa-calendar-alt me-1"></i> Dec 9,
                                                                2024</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="row g-4 align-items-center">
                                                    <div class="col-5">
                                                        <div class="overflow-hidden rounded">
                                                            <img src="img/news-6.jpg"
                                                                class="img-zoomin img-fluid rounded w-100" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="col-7">
                                                        <div class="features-content d-flex flex-column">
                                                            <p class="text-uppercase mb-2">Sports</p>
                                                            <a href="#" class="h6">Get the best speak market, news.</a>
                                                            <small class="text-body d-block"><i
                                                                    class="fas fa-calendar-alt me-1"></i> Dec 9,
                                                                2024</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="row g-4 align-items-center">
                                                    <div class="col-5">
                                                        <div class="overflow-hidden rounded">
                                                            <img src="img/news-7.jpg"
                                                                class="img-zoomin img-fluid rounded w-100" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="col-7">
                                                        <div class="features-content d-flex flex-column">
                                                            <p class="text-uppercase mb-2">Magazine</p>
                                                            <a href="#" class="h6">Get the best speak market, news.</a>
                                                            <small class="text-body d-block"><i
                                                                    class="fas fa-calendar-alt me-1"></i> Dec 9,
                                                                2024</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>-->

                    </div>
                    <!--<div class="col-lg-4 col-xl-3">
                        <div class="row g-4">
                            <div class="col-12">
                                <div class="p-3 rounded border">
                                    <h4 class="my-4">Popular News</h4>
                                    <div class="row g-4">
                                        <div class="col-12">
                                            <div class="row g-4 align-items-center features-item">
                                                <div class="col-4">
                                                    <div class="rounded-circle position-relative">
                                                        <div class="overflow-hidden rounded-circle">
                                                            <img src="img/features-sports-1.jpg"
                                                                class="img-zoomin img-fluid rounded-circle w-100"
                                                                alt="">
                                                        </div>
                                                        <span
                                                            class="rounded-circle border border-2 border-white bg-primary btn-sm-square text-white position-absolute"
                                                            style="top: 10%; right: -10px;">3</span>
                                                    </div>
                                                </div>
                                                <div class="col-8">
                                                    <div class="features-content d-flex flex-column">
                                                        <p class="text-uppercase mb-2">Sports</p>
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
                                                            <img src="img/features-technology.jpg"
                                                                class="img-zoomin img-fluid rounded-circle w-100"
                                                                alt="">
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
                                                                class="img-zoomin img-fluid rounded-circle w-100"
                                                                alt="">
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
                                                                class="img-zoomin img-fluid rounded-circle w-100"
                                                                alt="">
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
                                        </div>
                                        <div class="col-lg-12">
                                            <a href="#"
                                                class="link-hover btn border border-primary rounded-pill text-dark w-100 py-3 mb-4">View
                                                More</a>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="border-bottom my-3 pb-3">
                                                <h4 class="mb-0">Trending Tags</h4>
                                            </div>
                                            <ul class="nav nav-pills d-inline-flex text-center mb-4">
                                                <li class="nav-item mb-3">
                                                    <a class="d-flex py-2 bg-light rounded-pill me-2" href="#">
                                                        <span class="text-dark link-hover"
                                                            style="width: 90px;">Lifestyle</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item mb-3">
                                                    <a class="d-flex py-2 bg-light rounded-pill me-2" href="#">
                                                        <span class="text-dark link-hover"
                                                            style="width: 90px;">Sports</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item mb-3">
                                                    <a class="d-flex py-2 bg-light rounded-pill me-2" href="#">
                                                        <span class="text-dark link-hover"
                                                            style="width: 90px;">Politics</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item mb-3">
                                                    <a class="d-flex py-2 bg-light rounded-pill me-2" href="#">
                                                        <span class="text-dark link-hover"
                                                            style="width: 90px;">Magazine</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item mb-3">
                                                    <a class="d-flex py-2 bg-light rounded-pill me-2" href="#">
                                                        <span class="text-dark link-hover"
                                                            style="width: 90px;">Game</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item mb-3">
                                                    <a class="d-flex py-2 bg-light rounded-pill me-2" href="#">
                                                        <span class="text-dark link-hover"
                                                            style="width: 90px;">Movie</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item mb-3">
                                                    <a class="d-flex py-2 bg-light rounded-pill me-2" href="#">
                                                        <span class="text-dark link-hover"
                                                            style="width: 90px;">Travel</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item mb-3">
                                                    <a class="d-flex py-2 bg-light rounded-pill me-2" href="#">
                                                        <span class="text-dark link-hover"
                                                            style="width: 90px;">World</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>-->
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
                        <p class="text-secondary line-h">Phone: <span class="text-white">+6283 8045 68210</span></p>
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
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/datatables-simple-demo.js"></script>
    <script src="js/datatables-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>