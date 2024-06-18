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
    <title>Post Categories</title>
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
                                    <a href="article.php" class="dropdown-item ">Article</a>
                                    <a href="categories.php" class="dropdown-item active">Categories</a>
                                </div>
                            </div>
                            <!--<a href="contact.html" class="nav-item nav-link">Contact Us</a>-->
                        </div>
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
    
    <!-- Modal Search End -->

    <!-- Most Populer News Start -->
    <div class="container-fluid populer-news py-5">
        <div class="container py-5">
            <div class="tab-class mb-4">
                <div class="row g-4">
                    <div class="col-lg-8 col-xl-9">
                        <div class="d-flex flex-column flex-md-row justify-content-md-between border-bottom mb-4">
                            <h1 class="mb-4">Categories</h1>
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
                                Category List:
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple" class="table table-striped table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th>Id Kategori</th>
                                            <th>Kategori</th>
                                            <th>Keterangan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    include "connection.php";
                                    $query = mysqli_query($conn, "SELECT * FROM kategori ORDER BY id_kategori ASC");
                                    $no = 1; // Initialize row counter
                                    while ($row = mysqli_fetch_array($query)):
                                        ?>
                                        <tr>
                                            <td><?= $row['id_kategori'] ?></td>
                                            <td><?= $row['nama_kategori'] ?></td>
                                            <td><?= $row['keterangan'] ?></td>
                                            <td>
                                                <a href="#" class="btn btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#catedit<?= $no ?>">Edit</a>
                                                <a href="#" class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#cathapus<?= $no ?>">Delete</a>
                                            </td>   
                                        </tr>

                                        <!-- Edit Category Modal -->
                                        <div class="modal fade" id="catedit<?= $no ?>" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                                                    </div>
                                                    <form action="act_category.php" method="POST" enctype="multipart/form-data">
                                                        <input type="hidden" name="tid" value="<?= $row['id_kategori'] ?>">
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label class="control-label" for="nama_kategori">Category
                                                                    Name</label>
                                                                <input type="text" class="form-control" name="tkategori"
                                                                    value="<?= $row['nama_kategori'] ?>" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label" for="ket">Category
                                                                    Description</label>
                                                                <input type="text" class="form-control" name="keterangan"
                                                                    value="<?= $row['keterangan'] ?>" required>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button class="btn btn-primary" type="submit"
                                                                    name="catedit">Save</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Delete Category Modal -->
                                        <div class="modal fade" id="cathapus<?= $no ?>" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Delete Category</h5>
                                                    </div>
                                                    <form action="act_category.php" method="POST">
                                                        <input type="hidden" name="id_kategori"
                                                            value="<?= $row['id_kategori'] ?>">
                                                        <div class="modal-body">
                                                            <div class="modal-footer">
                                                                <h5 class="text-center">Are you sure you want to delete this
                                                                    category? <br><span
                                                                        class="text-danger"><?= $row['nama_kategori'] ?></span>
                                                                </h5>
                                                                <button type="button" class="btn btn-primary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button class="btn btn-primary" type="submit"
                                                                    name="catdelete">Delete Category</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        <?php
                                        $no++; // Increment row counter
                                    endwhile;
                                    ?>
                                </table>
                            </div>
                        </div>
                        <!-- Add Category Modal -->
                        <div class="modal fade" id="tambah" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">New Category</h5>
                                    </div>
                                    <form action="act_category.php" method="POST" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label class="control-label" for="nama_kategori">Category Name</label>
                                                <input type="text" class="form-control" placeholder="Enter your Category"
                                                    name="tkategori" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label" for="keterangan">Category Description</label>
                                                <input type="text" class="form-control" placeholder="Enter your Description"
                                                    name="ket" required>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button class="btn btn-primary" type="submit" name="catsave">Add
                                                    Category</button>
                                            </div>
                                        </div>
                                    </form>
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