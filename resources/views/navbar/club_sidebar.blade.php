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
                  @if(count(\Auth::user()->club->sports))
                    @foreach(\Auth::user()->club->sports as $sport)
                      <li class="nav-item"> <a class="nav-link" href="{{ url('/organization/sports/player/'.$sport->id) }}">{{ $sport->sport_name }} Players</a></li>
                    @endforeach
                  @endif
                </ul>
              </div>
            </li>
            <!-- <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#sidebar-layouts" aria-expanded="false" aria-controls="sidebar-layouts">
                <span class="menu-title">Sidebar Layouts</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-playlist-play menu-icon"></i>
              </a>
              <div class="collapse" id="sidebar-layouts">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="compact-menu.html">Compact menu</a></li>
                  <li class="nav-item"> <a class="nav-link" href="sidebar-collapsed.html">Icon menu</a></li>
                  <li class="nav-item"> <a class="nav-link" href="sidebar-hidden.html">Sidebar Hidden</a></li>
                  <li class="nav-item"> <a class="nav-link" href="sidebar-hidden-overlay.html">Sidebar Overlay</a></li>
                  <li class="nav-item"> <a class="nav-link" href="sidebar-fixed.html">Sidebar Fixed</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Basic UI Elements</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-crosshairs-gps menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="accordions.html">Accordions</a></li>
                  <li class="nav-item"> <a class="nav-link" href="buttons.html">Buttons</a></li>
                  <li class="nav-item"> <a class="nav-link" href="badges.html">Badges</a></li>
                  <li class="nav-item"> <a class="nav-link" href="breadcrumbs.html">Breadcrumbs</a></li>
                  <li class="nav-item"> <a class="nav-link" href="dropdowns.html">Dropdowns</a></li>
                  <li class="nav-item"> <a class="nav-link" href="modals.html">Modals</a></li>
                  <li class="nav-item"> <a class="nav-link" href="progress.html">Progress bar</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pagination.html">Pagination</a></li>
                  <li class="nav-item"> <a class="nav-link" href="tabs.html">Tabs</a></li>
                  <li class="nav-item"> <a class="nav-link" href="typography.html">Typography</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-advanced" aria-expanded="false" aria-controls="ui-advanced">
                <span class="menu-title">Advanced UI</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-cards-variant menu-icon"></i>
              </a>
              <div class="collapse" id="ui-advanced">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="dragula.html">Dragula</a></li>
                  <li class="nav-item"> <a class="nav-link" href="clipboard.html">Clipboard</a></li>
                  <li class="nav-item"> <a class="nav-link" href="context-menu.html">Context menu</a></li>
                  <li class="nav-item"> <a class="nav-link" href="slider.html">Slider</a></li>
                  <li class="nav-item"> <a class="nav-link" href="colcade.html">Colcade</a></li>
                  <li class="nav-item"> <a class="nav-link" href="carousel.html">Carousel</a></li>
                  <li class="nav-item"> <a class="nav-link" href="loaders.html">Loaders</a></li>
                  <li class="nav-item"> <a class="nav-link" href="tooltips.html">Tooltip</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="popups.html">
                <span class="menu-title">Popups</span>
                <i class="mdi mdi-forum menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="notifications.html">
                <span class="menu-title">Notifications</span>
                <i class="mdi mdi-bell-ring menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="slider.html">
                <span class="menu-title">Sliders</span>
                <i class="mdi mdi-laptop menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
                <span class="menu-title">Icons</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-contacts menu-icon"></i>
              </a>
              <div class="collapse" id="icons">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="mdi.html">Material</a></li>
                  <li class="nav-item"> <a class="nav-link" href="flag-icons.html">Flag icons</a></li>
                  <li class="nav-item"> <a class="nav-link" href="font-awesome.html">Font Awesome</a></li>
                  <li class="nav-item"> <a class="nav-link" href="simple-line-icon.html">Simple line icons</a></li>
                  <li class="nav-item"> <a class="nav-link" href="themify.html">Themify icons</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#forms" aria-expanded="false" aria-controls="forms">
                <span class="menu-title">Forms</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
              </a>
              <div class="collapse" id="forms">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="basic_elements.html">Form Elements</a></li>
                  <li class="nav-item"> <a class="nav-link" href="advanced_elements.html">Advanced Forms</a></li>
                  <li class="nav-item"> <a class="nav-link" href="validation.html">Validation</a></li>
                  <li class="nav-item"> <a class="nav-link" href="wizard.html">Wizard</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="text_editor.html">
                <span class="menu-title">Text editors</span>
                <i class="mdi mdi-file-document menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="code_editor.html">
                <span class="menu-title">Code editors</span>
                <i class="mdi mdi-code-not-equal-variant menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
                <span class="menu-title">Charts</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-chart-bar menu-icon"></i>
              </a>
              <div class="collapse" id="charts">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="chartjs.html">ChartJs</a></li>
                  <li class="nav-item"> <a class="nav-link" href="morris.html">Morris</a></li>
                  <li class="nav-item"> <a class="nav-link" href="flot-chart.html">Flot</a></li>
                  <li class="nav-item"> <a class="nav-link" href="google-charts.html">Google charts</a></li>
                  <li class="nav-item"> <a class="nav-link" href="sparkline.html">Sparkline js</a></li>
                  <li class="nav-item"> <a class="nav-link" href="c3.html">C3 charts</a></li>
                  <li class="nav-item"> <a class="nav-link" href="chartist.html">Chartist</a></li>
                  <li class="nav-item"> <a class="nav-link" href="justgage.html">JustGage</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
                <span class="menu-title">Tables</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-table-large menu-icon"></i>
              </a>
              <div class="collapse" id="tables">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="basic-table.html">Basic table</a></li>
                  <li class="nav-item"> <a class="nav-link" href="data-table.html">Data table</a></li>
                  <li class="nav-item"> <a class="nav-link" href="js-grid.html">Js-grid</a></li>
                  <li class="nav-item"> <a class="nav-link" href="sortable-table.html">Sortable table</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#maps" aria-expanded="false" aria-controls="maps">
                <span class="menu-title">Maps</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-map-marker-radius menu-icon"></i>
              </a>
              <div class="collapse" id="maps">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="google-maps.html">Google Maps</a></li>
                  <li class="nav-item"> <a class="nav-link" href="mapeal.html">Mapeal</a></li>
                  <li class="nav-item"> <a class="nav-link" href="vector-map.html">Vector map</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <span class="menu-title">User Pages</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-lock menu-icon"></i>
              </a>
              <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="login.html"> Login </a></li>
                  <li class="nav-item"> <a class="nav-link" href="login-2.html"> Login 2 </a></li>
                  <li class="nav-item"> <a class="nav-link" href="register.html"> Register </a></li>
                  <li class="nav-item"> <a class="nav-link" href="register-2.html"> Register 2 </a></li>
                  <li class="nav-item"> <a class="nav-link" href="lock-screen.html"> Lockscreen </a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#error" aria-expanded="false" aria-controls="error">
                <span class="menu-title">Error pages</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-security menu-icon"></i>
              </a>
              <div class="collapse" id="error">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="error-404.html"> 404 </a></li>
                  <li class="nav-item"> <a class="nav-link" href="error-500.html"> 500 </a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#general-pages" aria-expanded="false" aria-controls="general-pages">
                <span class="menu-title">General Pages</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-medical-bag menu-icon"></i>
              </a>
              <div class="collapse" id="general-pages">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="blank-page.html"> Blank Page </a></li>
                  <li class="nav-item"> <a class="nav-link" href="profile.html"> Profile </a></li>
                  <li class="nav-item"> <a class="nav-link" href="faq.html"> FAQ </a></li>
                  <li class="nav-item"> <a class="nav-link" href="faq-2.html"> FAQ 2 </a></li>
                  <li class="nav-item"> <a class="nav-link" href="news-grid.html"> News grid </a></li>
                  <li class="nav-item"> <a class="nav-link" href="timeline.html"> Timeline </a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#e-commerce" aria-expanded="false" aria-controls="e-commerce">
                <span class="menu-title">E-commerce</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-shopping menu-icon"></i>
              </a>
              <div class="collapse" id="e-commerce">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="invoice.html"> Invoice </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pricing-table.html"> Pricing Table </a></li>
                  <li class="nav-item"> <a class="nav-link" href="orders.html"> Orders </a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="email.html">
                <span class="menu-title">E-mail</span>
                <i class="mdi mdi-email menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="calendar.html">
                <span class="menu-title">Calendar</span>
                <i class="mdi mdi-calendar-today menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="gallery.html">
                <span class="menu-title">Gallery</span>
                <i class="mdi mdi-image-filter-frames menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="documentation.html">
                <span class="menu-title">Documentation</span>
                <i class="mdi mdi-file-document-box menu-icon"></i>
              </a>
            </li> -->
            <li class="nav-item sidebar-actions">
              <span class="nav-link">
                <!-- <div class="border-bottom">
                  <h6 class="font-weight-normal mb-3">Projects</h6>
                </div> -->
                <a href="{{ route('users.create') }}" class="btn btn-block btn-lg btn-gradient-primary mt-4">+ Add Users</a>
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