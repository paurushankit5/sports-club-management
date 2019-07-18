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
              <a class="nav-link" href="{{ route('clubDashboard') }}">
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
              <a class="nav-link" href="{{ route('club_fees') }}">
                <span class="menu-title">Fees Structure</span>
                <i class="mdi mdi-currency-inr menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('payment_module', array(date('m'), date('Y') )) }}">
                <span class="menu-title">Payment</span>
                <i class="mdi mdi-currency-inr menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('revenue_module', array(date('m'), date('Y'), \Auth::user()->club_id )) }}">
                <span class="menu-title">Revenue</span>
                <i class="mdi mdi-currency-inr menu-icon"></i>
              </a>
            </li>

            <!-- <li class="nav-item">
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
            </li> -->
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#sidebar-player" aria-expanded="false" aria-controls="page-layouts">
                <span class="menu-title">Members </span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-apps menu-icon"></i>
              </a>
              <div class="collapse" id="sidebar-player">
                <ul class="nav flex-column sub-menu">
                  @if(count(\Auth::user()->club->sports))
                    @foreach(\Auth::user()->club->sports as $sport)
                      <li class="nav-item"> <a class="nav-link" href="{{ url('/organization/sports/player/'.$sport->id) }}">{{ $sport->sport_name }}</a></li>
                    @endforeach
                  @endif
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#sidebar-coach" aria-expanded="false" aria-controls="page-layouts">
                <span class="menu-title">Coach / Trainer </span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-apps menu-icon"></i>
              </a>
              <div class="collapse" id="sidebar-coach">
                <ul class="nav flex-column sub-menu">
                  @if(count(\Auth::user()->club->sports))
                    @foreach(\Auth::user()->club->sports as $sport)
                      <li class="nav-item"> <a class="nav-link" href="{{ url('/organization/sports/coach/'.$sport->id) }}">{{ $sport->sport_name }}</a></li>
                    @endforeach
                  @endif
                </ul>
              </div>
            </li>
            
            <li class="nav-item sidebar-actions">
              <span class="nav-link">
                
                <a href="{{ route('users.create') }}" class="btn btn-block btn-lg btn-gradient-primary mt-4">+ Add Users</a>
                
              </span>
            </li>
          </ul>
        </nav>