<nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="nav-profile-image">
                  <img src="{{ asset('admin/jpg/face1.jpg') }}" alt="profile">
                  <span class="login-status online"></span>
                  <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2">Mr. Paurush</span>
                  <span class="text-secondary text-small">Super Admin</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('adminDashboard') }}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('clubs.index') }}">
                <span class="menu-title">Clubs</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#page-layouts" aria-expanded="false" aria-controls="page-layouts">
                <span class="menu-title">Games</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-apps menu-icon"></i>
              </a>
              <div class="collapse" id="page-layouts">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="#">Table Tennis</a></li>
                  <li class="nav-item"> <a class="nav-link" href="#">Roller Skating</a></li>
                  <li class="nav-item"> <a class="nav-link" href="#">Football</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#sidebar-tournament" aria-expanded="false" aria-controls="page-layouts">
                <span class="menu-title">Tournament </span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-apps menu-icon"></i>
              </a>
              <div class="collapse" id="sidebar-tournament">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="#">League</a></li>
                  <li class="nav-item"> <a class="nav-link" href="#">Knock-Out</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#sidebar-player" aria-expanded="false" aria-controls="page-layouts">
                <span class="menu-title">Players </span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-apps menu-icon"></i>
              </a>
              <div class="collapse" id="sidebar-player">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="#">Table Tennis Player</a></li>
                  <li class="nav-item"> <a class="nav-link" href="#">Football Player</a></li>
                  <li class="nav-item"> <a class="nav-link" href="#">Roller Skating Player</a></li>
                </ul>
              </div>
            </li>
            
            <li class="nav-item sidebar-actions">
              <span class="nav-link">
                <!-- <div class="border-bottom">
                  <h6 class="font-weight-normal mb-3">Projects</h6>
                </div> -->
                <a href="{{ route('clubs.create') }}" class="btn btn-block btn-lg btn-gradient-primary mt-4">+ Add Club</a>
                <!-- <div class="mt-4">
                  <div class="border-bottom">
                    <p class="text-secondary">Categories</p>
                  </div>
                  <ul class="gradient-bullet-list mt-4">
                    <li>Free</li>
                    <li>Pro</li>
                  </ul>
                </div> -->
              </span>
            </li>
          </ul>
        </nav>