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
          
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3> <?php 
                  $q = $this->db->query("select * from event where school_id="._get_current_user_id($this));
                                    $event =  $q->result();
                                    echo count($event);
                  ?></h3>
                  <p>School Event</p>
                </div>
                <div class="icon">
                  <i class="ion ion-calendar"></i>
                </div>
                <?php echo anchor('event/manage_event', 'Manage Event <i class="fa fa-arrow-circle-right"></i>', 'class="small-box-footer"'); ?>
                
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>
                  <?php 
                  $q = $this->db->query("select * from student_detail where school_id="._get_current_user_id($this));
                                    $student =  $q->result();
                                    echo count($student);
                  ?>
                  </h3>
                  <p>Student Available</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <?php echo anchor('student/add_student', 'Add Student <i class="fa fa-arrow-circle-right"></i>', 'class="small-box-footer"'); ?>
              </div>
            </div><!-- ./col -->
            
             <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3>
                  <?php 
                  $q = $this->db->query("select * from teacher_detail where school_id="._get_current_user_id($this));
                                    $student =  $q->result();
                                    echo count($student);
                  ?>
                  </h3>
                  <p>Teacher Available</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <?php echo anchor('teacher/add_teacher', 'Add Teacher <i class="fa fa-arrow-circle-right"></i>', 'class="small-box-footer"'); ?>
              </div>
            </div><!-- ./col -->
            
             <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3>
                  <?php 
                  $q = $this->db->query("select * from exam where school_id="._get_current_user_id($this));
                                    $student =  $q->result();
                                    echo count($student);
                  ?>
                  </h3>
                  <p>Exam </p>
                </div>
                <div class="icon">
                  <i class="ion ion-briefcase"></i>
                </div>
                <?php echo anchor('exam/manage_exam', 'Manage Exam <i class="fa fa-arrow-circle-right"></i>', 'class="small-box-footer"'); ?>
              </div>
            </div><!-- ./col -->
          
          </div><!-- /.row -->
          <div class="row">
            <div class="col-md-12">
             <div class="col-md-5">
                    <!-- quick notification widget -->
                    <form action="" method="post" enctype="multipart/form-data">
                      <div class="box box-info">
                        <div class="box-header">
                          <i class="fa fa-bell"></i> 
                          <h3 class="box-title">Quick Notification</h3>
                          <!-- tools box -->
                          <div class="pull-right box-tools">
                            <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                              <i class="fa fa-times"></i></button>
                          </div>
                          <!-- /. tools -->
                        </div>
                        <div class="box-body"> 
                            <div class="form-group">
                              <input type="text" class="form-control" name="noti_title" placeholder="Title*" required="">
                            </div>
                            <div class="form-group">
                                <span>Notification Banner :</span>
                              <input type="file" class="form-control" name="noti_image" placeholder="Attachment Image">
                            </div>
                            <div>
                              <textarea class="textarea" name="noti_description" placeholder="Message*" required="" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                            </div>
                             
                        </div>
                        <div class="box-footer clearfix">
                          <button type="submit" class="pull-right btn btn-default" id="sendEmail">Send
                            <i class="fa fa-arrow-circle-right"></i></button>
                        </div>
                      </div>
                    </form>
              </div>
            <div class="col-md-3">
             
             <div class="panel panel-default">
                                  <div class="panel-heading">Up Comming Holiday</div>
                                  <div class="panel-body">
                                   <div id="external-events">
                                 <?php
                                       $q = $this->db->query("select * from holiday where school_id="._get_current_user_id($this)." order by holiday_date desc limit 5");
                                $up_holiday = $q->result();
                                        foreach($up_holiday as $holiday){ ?>
                                        <div class="external-event bg-light-blue"><?php echo $holiday->holiday_title."(".$holiday->holiday_date.")"; ?></div>
                                        <?php } ?>
                                     </div>
                                  </div>
             </div>
            
            </div>
          <div class="col-md-4">
             
             <div class="panel panel-default">
                                  <div class="panel-heading">Today Event</div>
                                  <div class="panel-body">
                                    <div id="external-events">
                                 <?php
                                 $today = date('Y-m-d');
                                       $q = $this->db->query("select * from event where event_start='".$today."' and school_id='"._get_current_user_id($this)."'");
                                $up_holiday = $q->result();
                                if($up_holiday!=""){
                                        foreach($up_holiday as $holiday){ ?>
                                        <div class="external-event bg-green"><?php echo substr($holiday->event_title,0,100); ?></div>
                                        <?php } } ?>
                                     </div>
                                  </div>
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
    
    <!-- AdminLTE App -->
    <script src="<?php echo base_url($this->config->item("theme_admin")."/dist/js/app.min.js"); ?>"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?php echo base_url($this->config->item("theme_admin")."/dist/js/pages/dashboard.js"); ?>"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url($this->config->item("theme_admin")."/dist/js/demo.js"); ?>"></script>
  </body>
</html>
