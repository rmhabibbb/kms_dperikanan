  <div class="main-content" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark  border-bottom bg-gradient-orange"  >
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
           
          <!-- Navbar links -->
          <ul class="navbar-nav align-items-center  ml-md-auto ">
            
             
            <li class="nav-item d-xl-none">
              <!-- Sidenav toggler -->
              <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </div>
            </li>
          </ul>
          <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
            <li class="nav-item dropdown">
              <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="media align-items-center">
                   
                  <div class="media-body  ml-2  d-none d-lg-block">
                    <span class="mb-0 text-sm  font-weight-bold"><?=$profil->email?></span>
                  </div>
                </div>
              </a>
              <div class="dropdown-menu  dropdown-menu-right "> 
                <a href="<?=base_url('pimpinan/profile')?>" class="dropdown-item">
                  <i class="ni ni-single-02"></i>
                  <span>Profil Saya</span>
                </a> 
                <div class="dropdown-divider"></div>
                <a href="<?=base_url('logout')?>" class="dropdown-item">
                  <i class="ni ni-user-run"></i>
                  <span>Logout</span>
                </a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Header -->
   