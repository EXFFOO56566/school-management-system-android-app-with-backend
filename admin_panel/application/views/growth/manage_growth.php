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
            Student Growth
            <small>Manage Growth</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Growth</a></li>
            <li class="active">Manage Student Growth</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
               
                <div class="col-md-12">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="box">
                        <div class="box-header">
                           <p><strong>Add Student Growth (Ex. 1-25=bad,26-50=medium, 51-75=good, 76-100=excellent)</strong></p>
                        </div>
                        <div class="box-body">
                        
                            <form role="form" action="" method="post">
                              <div class="box-body">
                              <?php 
                                echo $this->session->flashdata("message");
                               ?>
                                <? if(isset($error)){
                            echo $error;
                        } ?>
                                <div class="form-group">
                                    <div class="row">
                                    <input type="hidden" name="student_id" value="<?php echo $student->student_id; ?>"/>
                                    <input type="hidden" name="standard_id" value="<?php echo $student->student_standard; ?>"/>
                                   <p style="padding-left: 10px; border: 1px solid black;"> <strong>Add Student Growth for : <?php echo $student->student_name; ?></strong></p>
                                      <!--<div class="col-md-12">
                                        <label for="growth_title">Growth Title <span class="red">*</span></label>
                                        <input type="text" class="form-control" id="growth_title" name="growth_title" placeholder="Ex. Good, Average, etc" />
                                    </div> -->
                                     <div class="col-md-12">
                                        <label for="growth_per">Growth Percentage <span class="red">*</span></label>
                                        <input type="text" class="form-control" id="growth_per" name="growth_per" placeholder="Ex. 20, 40, 50, 60, 80, etc (only no)" />
                                    </div>
                                    <div class="col-md-12">
                                        <label for="month">Select Growth Month <span class="red">*</span></label>
                                        <select name="month" class="form-control select2"> 
                                            <?php foreach($this->config->item("growth") as $month){ ?>
                                            <option value="<?php echo $month; ?>"><?php echo $month; ?></option>
                                            <?php } ?>
                                            </select>
                                    </div>
                                   
                                    
                                    </div>
                                </div>
                             
                              </div><!-- /.box-body -->
            
                              <div class="box-footer">
                                <button type="submit" name="savegrowth" class="btn btn-primary">Add Growth</button>
                                <a href="javascript:window.history.go(-1);" class="btn btn-info">Back</a>
                              </div>
                            </form>
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
    <!-- Select2 -->
    <script src="<?php echo base_url($this->config->item("theme_admin")."/plugins/select2/select2.full.min.js"); ?>"></script>
    <!-- DataTables -->
    <script src="<?php echo base_url($this->config->item("theme_admin")."/plugins/datatables/jquery.dataTables.min.js"); ?>"></script>
    <script src="<?php echo base_url($this->config->item("theme_admin")."/plugins/datatables/dataTables.bootstrap.min.js"); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url($this->config->item("theme_admin")."/dist/js/app.min.js"); ?>"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url($this->config->item("theme_admin")."/dist/js/demo.js"); ?>"></script>

 
    <script>
    $(function(){
       $(".select2").select2();
    });
    </script>
    
  </body>
</html>
