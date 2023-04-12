<header class="main-header">
        <!-- Logo -->
        <a href="<?php echo site_url(_get_user_redirect($this)); ?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>E</b></span>
          <!-- logo for regular state and mobile devices -->
          
          <span class="logo-lg"><b>Education</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                 
                  <span class="hidden-xs"><?php echo _get_current_user_name($this); ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
              
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="<?php echo site_url("users/change_password") ?>" class="btn btn-default btn-flat"><i class="fa fa-key"></i>Change Password</a>
                    </div> 
                    <div class="pull-right">
                      <a href="<?php echo site_url("admin/signout") ?>" class="btn btn-default btn-flat"><i class="fa fa-sign-out"></i> Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
             
              
            </ul>
          </div>
        </nav>
      </header>