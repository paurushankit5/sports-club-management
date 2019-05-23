<nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="nav-profile-image">
                  <img @if( \Auth::user()->profile_pic != '' )
                           src="{{ asset('images/'.\Auth::user()->profile_pic) }}"   
                      @else
                           src="{{ asset('noprofilepic.png') }}"
                      @endif
                    alt="{{ \Auth::user()->fname." ".\Auth::user()->lname }}">
                  <span class="login-status online"></span>
                  <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2">{{ \Auth::user()->fname." ".\Auth::user()->lname }}</span>
                  <span class="text-secondary text-small">{{ \Auth::user()->role->role_name }}</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('coachDashboard') }}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('users.all') }}">
                <span class="menu-title">Users</span>
                <i class="mdi mdi-apps menu-icon"></i>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#sidebar-player" aria-expanded="false" aria-controls="page-layouts">
                <span class="menu-title">Players </span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-apps menu-icon"></i>
              </a>
              <div class="collapse" id="sidebar-player">
                <ul class="nav flex-column sub-menu">
                  @if(count(\Auth::user()->sports))
                    @foreach(\Auth::user()->sports as $sport)
                      <li class="nav-item"> <a class="nav-link" href="{{ route('myplayers', $sport->id) }}">{{ $sport->sport_name }}</a></li>
                    @endforeach
                  @endif
                </ul>
              </div>
            </li>
            
            
            <!-- <li class="nav-item sidebar-actions">
              <span class="nav-link">                
                <a href="{{ route('users.create') }}" class="btn btn-block btn-lg btn-gradient-primary mt-4">+ Add Users</a>                
              </span>
            </li> -->
          </ul>
        </nav>