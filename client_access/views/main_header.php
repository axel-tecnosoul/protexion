<!-- page-wrapper Start-->
    <div class="page-wrapper">
      <!-- Page Header Start-->
      <div class="page-main-header open">
        <div class="main-header-right row">
          <div class="main-header-left d-lg-none">
            <div class="logo-wrapper"><a href="home_users.php"><!--<img src="assets/images/favicon.png" alt="">--></a></div>
          </div>
          <div class="mobile-sidebar d-none">
            <div class="media-body text-right switch-sm">
              <label class="switch"><a href="#"><i id="sidebar-toggle" data-feather="align-left"></i></a></label>
            </div>
          </div>
          <div class="nav-right col p-0">
            <ul class="nav-menus">
              <li class="text-left" style="margin: 0;width: 100%;">
                <img src="assets/images/logo.png" alt="ProteXion - Centro médico laboral" class="img-responsive" style="width: 140px;">
              </li>
              <li><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>
              <!--<li class="onhover-dropdown"><a class="txt-dark" href="#">
                  <h6>EN</h6></a>
                <ul class="language-dropdown onhover-show-div p-20">
                  <li><a href="#" data-lng="en"><i class="flag-icon flag-icon-is"></i> English</a></li>
                  <li><a href="#" data-lng="es"><i class="flag-icon flag-icon-um"></i> Spanish</a></li>
                  <li><a href="#" data-lng="pt"><i class="flag-icon flag-icon-uy"></i> Portuguese</a></li>
                  <li><a href="#" data-lng="fr"><i class="flag-icon flag-icon-nz"></i> French</a></li>
                </ul>
              </li>-->
              <!-- NOTIFICACIONES -->
              <!--<li class="onhover-dropdown"><i data-feather="bell"></i><span class="dot"></span>-->
                <!--<ul class="notification-dropdown onhover-show-div">
                  <li>Notification <span class="badge badge-pill badge-primary pull-right">3</span></li>
                  <li>
                    <div class="media">
                      <div class="media-body">
                        <h6 class="mt-0"><span><i class="shopping-color" data-feather="shopping-bag"></i></span>Your order ready for Ship..!<small class="pull-right">9:00 AM</small></h6>
                        <p class="mb-0">Lorem ipsum dolor sit amet, consectetuer.</p>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="media">
                      <div class="media-body">
                        <h6 class="mt-0 txt-success"><span><i class="download-color font-success" data-feather="download"></i></span>Download Complete<small class="pull-right">2:30 PM</small></h6>
                        <p class="mb-0">Lorem ipsum dolor sit amet, consectetuer.</p>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="media">
                      <div class="media-body">
                        <h6 class="mt-0 txt-danger"><span><i class="alert-color font-danger" data-feather="alert-circle"></i></span>250 MB trash files<small class="pull-right">5:00 PM</small></h6>
                        <p class="mb-0">Lorem ipsum dolor sit amet, consectetuer.</p>
                      </div>
                    </div>
                  </li>
                  <li class="bg-light txt-dark"><a href="#">All</a> notification</li>
                </ul>-->
              </li>
              <!--<li><a href="#"><i class="right_side_toggle" data-feather="message-circle"></i><span class="dot"></span></a></li>-->
              <li class="onhover-dropdown">
                <div class="media align-items-center"><img class="align-self-center pull-right img-50 rounded-circle" src="assets/images/dashboard/user.png" alt="header-user">
                  <!--<div class="dotted-animation"><span class="animate-circle"></span><span class="main-circle"></span></div>-->
                </div>
                <ul class="profile-dropdown onhover-show-div p-20"><?php
                  /*if($_SESSION["rowUsers"]["tipo"]==2){?>
                    <li>
                      <a href="editar_perfil.php">
                        <i data-feather="user"></i>                                    Editar Perfil
                      </a>
                    </li><?php
                  }*/?>
                 <!-- <li>
                    <a href="#">
                      <i data-feather="mail"></i>
                      Inbox
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i data-feather="lock"></i>                                    Lock Screen
                    </a>
                  </li>-->
                  <!--<li>
                    <a href="#">
                      <i data-feather="settings"></i>                                    Settings
                    </a>
                  </li>-->
                  <li>
                    <a href="./models/logOut.php">
                      <i data-feather="log-out"></i>                                    Salir
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
            <div class="d-lg-none mobile-toggle pull-right"><i data-feather="more-horizontal"></i></div>
          </div>
          <script id="result-template" type="text/x-handlebars-template">
            <div class="ProfileCard u-cf">                        
            <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
            <div class="ProfileCard-details">
            <div class="ProfileCard-realName">{{name}}</div>
            </div>
            </div>
          </script>
          <script id="empty-template" type="text/x-handlebars-template">
            <div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div>
            
          </script>
        </div>
      </div>