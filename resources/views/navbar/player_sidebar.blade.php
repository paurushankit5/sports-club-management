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
              <a class="nav-link" href="{{ route('myprofile') }}">
                <span class="menu-title">My Profile</span>
                <i class="mdi mdi-apps menu-icon"></i>
              </a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link" href="{{ route('playerInvoices', \Auth::user()->id  ) }}">
                <span class="menu-title">Invoice</span>
                <i class="mdi mdi-currency-inr menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('player.receivedPayments', \Auth::user()->id ) }}">
                <span class="menu-title">Payments</span>
                <i class="mdi mdi-currency-inr menu-icon"></i>
              </a>
            </li>

           
           
            
            
            
          </ul>
        </nav>