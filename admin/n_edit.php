<?php
//db connection
include('../lib/connection.php');

// update news
if(isset($_GET['u_submit'])) {    
    $nid = $_GET['n_id'];
    $title = htmlspecialchars($_GET['n_title']); 
    $icon = $_GET['n_icon'];
    $desc = htmlspecialchars($_GET['n_desc']);
    $cid = $_GET['c_id'];

    $edit_sql = "UPDATE news SET Title = '$title', Icon = '$icon', Description = '$desc', C_ID = $cid WHERE ID = $nid";

    $edit_result = $conn->query($edit_sql);
    if($edit_result) {
        header('location:news.php');
    } else {
        die($conn->error);
    }
}

//edit news
if(isset($_GET['ID'])) {

    $e_id = $_GET['ID'];

    $s_sql = "SELECT * FROM news WHERE ID = $e_id";
    $r_sql = $conn->query($s_sql);
    if($r_sql->num_rows > 0) {
        while($final = $r_sql->fetch_assoc()) {

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Tables - news-Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="admin.php">News-641</a>
            <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
        </form>
            <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="#">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="#">Logout</a></li>
                    </ul>
                </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="admin.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link" href="../index.php" target="_blank">
                                <div class="sb-nav-link-icon"><i class="fa-brands fa-chrome"></i></div>
                                Visit Website
                            </a>
                            <div class="sb-sidenav-menu-heading">pages</div>
                            <a class="nav-link  active" href="category.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-layer-group"></i></div>
                                Category
                            </a>
                            <a class="nav-link" href="news.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-newspaper"></i></div>
                                News
                            </a>
                            <a class="nav-link" href="#">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-newspaper"></i></div>
                                Demo
                            </a>
                            <a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Charts
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Admin
                    </div>
                </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">News</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="admin.php">Dashboard</a></li>
                        <li class="breadcrumb-item">News</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-body">
                            <h2 class="mb-4">Edit News</h2>
                            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
                                <input value="<?php echo $final['ID'];?>" type="hidden" name="n_id" required>
                            <div class="mb-3">
                                <label for="n_title" class="form-label">News Title</label>
                                <input value="<?php echo $final['Title'];?>" type="text" class="form-control n_title" id="n_title" name="n_title" required>
                            </div>
                            <div class="mb-3">
                                <label for="n_icon" class="form-label">News Icon</label>
                                <input value="<?php echo $final['Icon'];?>" type="text" class="form-control n_icon" id="n_icon" name="n_icon" required>
                            </div>
                            <div class="mb-3">
                                <label for="n_description" class="form-label">News Description</label>
                                <textarea class="form-control n_desc" id="n_desc" name="n_desc" rows="4" required><?php echo $final['Description'];?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="c_id" class="form-label">Category ID</label>
                                <input value="<?php echo $final['C_ID'];?>" type="text" class="form-control c_id" id="c_id" name="c_id" required>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-success mb-4" name="u_submit">Update</button>
                                <button type="Reset" class="btn btn-danger mb-4">Reset</button>
                            </div>
                            </form>
                            <div class="result">
                            </div>
                        </div>
                        </div>
                    </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; News 2025</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                                &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
<?php
    }
}else{
    header('location:news.php');
}
}else{
    header('location:news.php');
}
?>