<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- base:css -->
    <link rel="stylesheet" href="vendors/typicons.font/font/typicons.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- inject:css -->
    <link rel="stylesheet" href="css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="images/favicon.png" />
    
</head>
<body>
<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo" href="{{ route('mainpage') }}"><img src="images/blurayarchive.png" alt="logo"/></a>
            <button class="navbar-toggler navbar-toggler align-self-center d-none d-lg-flex" type="button" data-toggle="minimize">
                <span class="typcn typcn-th-menu"></span>
            </button>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item nav-profile dropdown">
                    <a class="nav-link dropdown-toggle pl-0 pr-0" href="#" data-toggle="dropdown" id="profileDropdown">
                        <i class="typcn typcn-user-outline mr-0"></i>
                        <span class="nav-profile-name">{{ Auth::user()->name }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                            <i class="typcn typcn-cog text-primary"></i>
                            Settings
                        </a>
                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="typcn typcn-power text-primary"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>

<!-- partial -->
<div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_settings-panel.html -->
    <div class="theme-setting-wrapper">
        <div id="settings-trigger"><i class="typcn typcn-cog-outline"></i></div>
        <div id="theme-settings" class="settings-panel">
            <i class="settings-close typcn typcn-delete-outline"></i>
            <p class="settings-heading">SIDEBAR SKINS</p>
            <div class="sidebar-bg-options" id="sidebar-light-theme">
                <div class="img-ss rounded-circle bg-light border mr-3"></div>
                Light
            </div>
            <div class="sidebar-bg-options selected" id="sidebar-dark-theme">
                <div class="img-ss rounded-circle bg-dark border mr-3"></div>
                Dark
            </div>
            <p class="settings-heading mt-2">HEADER SKINS</p>
            <div class="color-tiles mx-0 px-4">
                <div class="tiles success"></div>
                <div class="tiles warning"></div>
                <div class="tiles danger"></div>
                <div class="tiles primary"></div>
                <div class="tiles info"></div>
                <div class="tiles dark"></div>
                <div class="tiles default border"></div>
            </div>
        </div>
    </div>
    
    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <li class="nav-item">
                <div class="d-flex sidebar-profile">
                    <div class="sidebar-profile-image">
                        <img src="images/faces/face29.png" alt="image">
                        <span class="sidebar-status-indicator"></span>
                    </div>
                    <div class="sidebar-profile-name">
                        <p class="sidebar-name">
                            {{ Auth::user()->name }}
                        </p>
                        <p class="sidebar-designation">
                            Welcome
                        </p>
                    </div>
                </div>
                <p class="sidebar-menu-title">Menu</p>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('mainpage') }}">
                    <i class="typcn typcn-device-desktop menu-icon"></i>
                    <span class="menu-title">Homepage</span>
                </a>
            </li>
        </ul>
    </nav>

    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 d-flex grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-wrap justify-content-between">
                                <h4 class="card-title mb-3">Your Rent Status</h4>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Blu-ray Title</th>
                                            <th>Due Date</th>
                                            <th>Status</th>
                                            <th>fine</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($rentals as $rental)
                                        <tr>
                                            <td>{{ $rental->id }}</td>
                                            <td>{{ $rental->bluray->title }}</td>
                                            <td>{{ $rental->due_date }}</td>
                                            <td>{{ $rental->status }}</td>
                                            <td>{{ $rental->fine }}</td>
                                            <td>
                                                @if($rental->status === 'Returned Requested')
                                                    <!-- Show Approve Return button when status is 'Returned Requested' -->
                                                    <form action="{{ route('rental.approveReturn', $rental->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success">Approve Return</button>
                                                    </form>
                                                @elseif($rental->status === 'Rented')
                                                    <!-- Show Request Return button when status is 'Rented' -->
                                                    <form action="{{ route('rental.requestReturn', $rental->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-primary">Request Return</button>
                                                    </form>
                                                @else
                                                    <!-- Show disabled button when the status is anything else (e.g., Returned) -->
                                                    <button class="btn btn-secondary disabled">Returned</button>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-center text-sm-left d-block d-sm-inline-block">Copyright © <a href="#" target="_blank">Blu-ray Archive</a> 2024</span>
            </div>
        </footer>
        <!-- partial -->
    </div>
    <!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- base:js -->
<script src="vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page-->
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="js/off-canvas.js"></script>
<script src="js/hoverable-collapse.js"></script>
<script src="js/template.js"></script>
<script src="js/settings.js"></script>
<script src="js/todolist.js"></script>
<!-- endinject -->
<!-- plugin js for this page -->
<script src="vendors/progressbar.js/progressbar.min.js"></script>
<script src="vendors/chart.js/Chart.min.js"></script>
<!-- End plugin js for this page -->
<!-- Custom js for this page-->
<script src="js/dashboard.js"></script>
<!-- End custom js for this page-->
</body>
</html>
