<!DOCTYPE html>
<html>
 <?php  $this->load->view("common/common_head"); ?>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <?php  $this->load->view("admin/common/common_header"); ?>
      <!-- Left side column. contains the logo and sidebar -->
      <?php  $this->load->view("admin/common/common_sidebar"); ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Users
            <small>Manage Users</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
            <li class="active">Add Users</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
            <div class="col-md-3"></div>
                        <div id="signupbox" style="margin-top: 50px;" class="mainbox col-md-6 col-sm-12 ">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">
                                            <div class="panel-title">Change Password</div>
                                            
                                        </div>  
                                        <div class="panel-body" >
                                        <?php if(isset($error)) { echo $error; } echo $this->session->flashdata("message");  ?>
                                            <form id="signupform" class="form-horizontal"  enctype="multipart/form-data"  action="" method="post" role="form">
                                                
                                                <div class="form-group">
                                                    <label for="c_password" class="col-md-3 control-label">Current Password</label>
                                                    <div class="col-md-9">
                                                        <input type="password" class="form-control" name="c_password"  placeholder="Current Password"  required="">
                                                    </div>
                                                </div>
                                               <div class="form-group">
                                                    <label for="n_password" class="col-md-3 control-label">New Password</label>
                                                    <div class="col-md-9">
                                                        <input type="password" class="form-control" name="n_password"  placeholder="New Password"  required="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="r_password" class="col-md-3 control-label">Re Password</label>
                                                    <div class="col-md-9">
                                                        <input type="password" class="form-control" name="r_password"  placeholder="Re Password"  required="">
                                                    </div>
                                                </div>
                                                
                                                  
                                              
                
                                                <div class="form-group">
                                                    <!-- Button -->                                        
                                                    <div class="col-md-offset-3 col-md-9">
                                                        <input type="submit" name="register" value='Update Password' id="btn-signup" type="button" class="btn btn-primary" />
                                                        
                                                           
                                                    </div>
                                                </div>
                                                
                                               
                                                
                                                
                                            </form>
                                         </div>
                                    </div>
                
                               
                               
                                
                         </div> 
                       
                   </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      
      <?php  $this->load->view("admin/common/common_footer"); ?>  

      
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url($this->config->item("theme_admin")."/plugins/jQuery/jQuery-2.1.4.min.js"); ?>"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url($this->config->item("theme_admin")."/bootstrap/js/bootstrap.min.js"); ?>"></script>
    <!-- Select2 -->
    <script src="<?php echo base_url($this->config->item("theme_admin")."/plugins/select2/select2.full.min.js"); ?>"></script>
    <!-- DataTables -->
    <script src="<?php echo base_url($this->config->item("theme_admin")."/plugins/datatables/jquery.dataTables.min.js"); ?>"></script>
    <script src="<?php echo base_url($this->config->item("theme_admin")."/plugins/datatables/dataTables.bootstrap.min.js"); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url($this->config->item("theme_admin")."/dist/js/app.min.js"); ?>"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url($this->config->item("theme_admin")."/dist/js/demo.js"); ?>"></script>
 
    
  </body>
</html>



