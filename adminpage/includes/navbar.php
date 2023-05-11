<nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
    <a href="#" class="sidebar-toggler flex-shrink-0">
        <i class="fa fa-bars"></i>
    </a>
    <form class="d-none d-md-flex ms-4">
        <input class="form-control border-0" type="search" placeholder="Search">
    </form>
    <div class="navbar-nav align-items-center ms-auto">
        <a href="../../mrf/home.php" class="nav-link">Home</a>
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <i class="bi bi-person-circle" style="width: 40px; height:40px;"></i>
                <span class="d-none d-lg-inline-flex"><?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname']; ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                <a href="#" class="dropdown-item" id="settings">Account Settings</a>
                <a href="#" id="logout" class="dropdown-item">Log Out</a>
            </div>
        </div>
    </div>
</nav>