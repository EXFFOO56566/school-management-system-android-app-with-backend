<!DOCTYPE html>
<html>
 <?php  $this->load->view("common/common_head"); ?>
  <body class="hold-transition skin-blue sidebar-mini" >
    <div class="wrapper">

      <?php  $this->load->view("admin/common/common_header"); ?>
      <!-- Left side column. contains the logo and sidebar -->
      <?php  $this->load->view("admin/common/common_sidebar"); ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
           
            <div class="col-lg-3">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3> <?php 
                                     $this->db->select('*');
                                    $this->db->from('users');
                                    $q = $this->db->get();
                                    $usertotal =  $q->result();
                                    echo count($usertotal)-1;
                                    
                                    ?></h3>
                  <p>User Registrations</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <?php echo anchor('users/add_user', 'Add User <i class="fa fa-arrow-circle-right"></i>', 'class="small-box-footer"'); ?>
                
              </div>
            </div><!-- ./col -->
            
             <div class="col-lg-6">
              <!-- small box -->
              <strong>New User List</strong>
              <table id="example2" class="table table-bordered table-hover" >
                    <thead>
                      <tr>
                        
                        <th>User Name</th>
                         <th>On Date</th>
                      </tr>
                    </thead>
                    <tbody>
                <?php
                 
                                    $q = $this->db->query("select * from users order by user_id desc limit 10");
                                    $users =  $q->result();
                 foreach($users as $user){
                    ?>
                    <tr>
                        
                        <td><?php echo $user->user_name; ?></td>
                        <td><?php echo $user->on_date; ?></td>
                       
                    </tr>
                    <?php
                } ?>
                    </tbody>
                </table>
            </div><!-- ./col -->
            
          </div><!-- /.row -->
          

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
    
    <!-- AdminLTE App -->
    <script src="<?php echo base_url($this->config->item("theme_admin")."/dist/js/app.min.js"); ?>"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?php echo base_url($this->config->item("theme_admin")."/dist/js/pages/dashboard.js"); ?>"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url($this->config->item("theme_admin")."/dist/js/demo.js"); ?>"></script>
    
  
  </body>
</html>
