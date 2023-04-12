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
        <section class="content-header ">
          <h1>
            Teacher 
            <small>Teacher Detail</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Teacher</a></li>
            <li class="active">Teacher Detail</li>
          </ol>
        </section>

        <!-- Main content -->
      <section class="content">

          <div class="row">
            <div class="col-md-3">

              <!-- Profile Image -->
              <div class="box box-primary">
                <div class="box-body box-profile">
                 <?php
                $img = base_url("img/default.png");
                if($teacher_detail->teacher_image != ""){
                $img = $this->config->item('base_url').'uploads/teacherphoto/'.$teacher_detail->teacher_image; } 
            ?> 
            <img src="<?php echo $img; ?>" alt="Teacher Photo" title="Teacher Photo" class="profile-user-img img-responsive img-circle" />
                  
                  <h3 class="profile-username text-center"><?php echo $teacher_detail->teacher_name; ?></h3>
                  <p class="text-muted text-center"><i class="fa fa-phone"></i> <?php echo $teacher_detail->teacher_phone; ?></p>
 
                </div><!-- /.box-body -->
              </div><!-- /.box -->

              <!-- About Me Box -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">About Me</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <strong><i class="fa fa-book margin-r-5"></i>  Education</strong>
                  <p class="text-muted">
                    <?php echo $teacher_detail->teacher_education; ?>
                  </p>

                  <hr>

                  <strong><i class="fa fa-map-marker margin-r-5"></i> Address</strong>
                  <p class="text-muted"><?php echo $teacher_detail->teacher_address; ?></p>

                  <hr>
                <strong><i class="fa fa-birthday-cake margin-r-5"></i> Birthdate</strong>
                  <p class="text-muted"><?php echo $teacher_detail->teacher_birthdate; ?></p>

                  
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
            <div class="col-md-9">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#activity" data-toggle="tab">Teacher Information</a></li>
                  
                </ul>
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <!-- Post -->
                    <div class="post">
                      <div class="user-block">
                       <?php
                $img = base_url("img/default.png");
                if($teacher_detail->teacher_image != ""){
                $img = $this->config->item('base_url').'uploads/teacherphoto/'.$teacher_detail->teacher_image; } 
            ?> 
                        <img class="img-circle img-bordered-sm" src="<?php echo $img; ?>" alt="image">
                        <span class='username'>
                          <a href="#"><?php echo $teacher_detail->teacher_name; ?></a>
                          
                        </span>
                        
                      </div><!-- /.user-block -->
                      <p>
                      <strong><i class="fa fa-graduation-cap"></i> Teacher School Description: </strong>
                       <b> <?php echo $teacher_detail->teacher_detail; ?></b>
                      </p>
                      <p>
                     
                      <strong><i class="fa fa-graduation-cap"></i> Teaching Experience: </strong>
                         <?php if($teacher_detail->teacher_exp!="") {?>
                        <?php echo $teacher_detail->teacher_exp; ?>
                         <?php }else{echo "No Data Available";} ?>
                      </p>
                     
                    </div><!-- /.post -->
                    
                   

                  <ul class="timeline timeline-inverse">
                      <!-- timeline time label -->
                      <li class="time-label">
                        <span class="bg-red">
                          <?php echo date('Y-m-d'); ?>
                        </span>
                      </li>
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                     
                      <!-- END timeline item -->
                      <!-- timeline item -->
                      <li>
                        <i class="fa fa-transgender bg-aqua"></i>
                        <div class="timeline-item">
                          
                          <h3 class="timeline-header no-border"><a href="#">Gender: </a> <?php echo $teacher_detail->gender; ?></h3>
                        </div>
                      </li>
                       <li>
                        <i class="fa fa-user bg-yellow"></i>
                        <div class="timeline-item">
                          
                          <h3 class="timeline-header no-border"><a href="#">Marriage Status: </a> <?php echo $teacher_detail->maritalstatus; ?></h3>
                        </div>
                      </li>
                      
                       <li>
                        <i class="fa fa-envelope bg-blue"></i>
                        <div class="timeline-item">
                          
                          <h3 class="timeline-header no-border"><a href="#">Email: </a> <?php if($teacher_detail->teacher_email!=""){ echo $teacher_detail->teacher_email;} else{ echo "No Data Available";} ?></h3>
                        </div>
                      </li>
                      <!-- END timeline item -->
                
                      <!-- END timeline item -->
                      <li>
                        <i class="fa fa-clock-o bg-gray"></i>
                      </li>
                    </ul>
                     <strong><i class="fa fa-file-text-o margin-r-5"></i> Extra Notes</strong>
                  <p>
                  <?php if($teacher_detail->teacher_notes!=""){ 
                    echo $teacher_detail->teacher_notes;
                    }else{
                    ?>
                    <label>No Data Available</label>
                  <?php }?>
                  </p>
                  
                  </div><!-- /.tab-pane -->
              

                  
                </div><!-- /.tab-content -->
              </div><!-- /.nav-tabs-custom -->
            </div><!-- /.col -->
          </div><!-- /.row -->

        </section><!-- /.content -->
      
      
      </div><!-- /.content-wrapper -->
      
       

      
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
    <!-- DataTables -->
    <script src="<?php echo base_url($this->config->item("theme_admin")."/plugins/datatables/jquery.dataTables.min.js"); ?>"></script>
    <script src="<?php echo base_url($this->config->item("theme_admin")."/plugins/datatables/dataTables.bootstrap.min.js"); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url($this->config->item("theme_admin")."/dist/js/app.min.js"); ?>"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url($this->config->item("theme_admin")."/dist/js/demo.js"); ?>"></script>
 
  </body>
</html>
