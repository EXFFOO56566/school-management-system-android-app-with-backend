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
            Update Student
            <small>Manage Student</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Student</a></li>
            <li class="active">Update Student</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                <a href="<?php echo site_url("student/list_student"); ?>" class="btn btn-primary pull-right">List</a>
                </div>
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header">
                           
                        </div>
                        <div class="box-body">
                        
                            <form role="form" action="" method="post" enctype="multipart/form-data">
                              <div class="box-body">
                              <?php 
                                echo $this->session->flashdata("message");
                               ?>
                                <? if(isset($error)){
                            echo $error;
                        } ?>
                        
 
                                <div class="form-group">
                                    <div class="row">
                                    <div class="col-md-12">
                                    <p style="border-bottom: 1px solid black;"><strong>Student Detail</strong></p>
                                    </div>
                                    
                                      <div class="col-md-6">
                                        <label for="student_name">Student Name <span class="red">*</span></label>
                                        <input type="text" class="form-control" id="student_name" name="student_name" value="<?php echo $student->student_name; ?>"/>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="student_birthdate">Student Birthdate <span class="red">*</span></label>
                                        <input type="text" class="form-control" id="student_birthdate" name="student_birthdate" placeholder="Show Date" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask value="<?php echo $student->student_birthdate; ?>">
                                    </div>
                                      <div class="col-md-6">
                                        <label for="student_roll_no">Student Roll No <span class="red">*</span></label>
                                        <input type="text" class="form-control" id="student_roll_no" name="student_roll_no" value="<?php echo $student->student_roll_no; ?>"/>
                                    </div>
                                     <div class="col-md-6">
                                        <label for="student_standard">Student Standard <span class="red">*</span></label>
                                        <select class="form-control select2" name="student_standard" id="student_standard" style="width: 100%;">
                                            <?php foreach($school_standard as $standard){
                                                ?>
                                                <option value="<?php echo $standard->standard_id; ?>" <?php if($standard->standard_id == $student->student_standard){echo "selected";} ?>><?php echo $standard->standard_title; ?></option>
                                                <?php
                                            } ?>
                                        </select>
                                        <p>Note: Standard Not Available in list Please : <a href="<?php echo site_url("standard/manage_standard"); ?>"> Add Standard</a></p>
                                    </div>
                                     <div class="col-md-6">
                                        <label for="student_address">Student Address <span class="red">*</span></label>
                                       <textarea rows="2" id="student_address" name="student_address" class="form-control"><?php echo $student->student_address; ?></textarea>
                                    </div>
                                    
                                     <div class="col-md-6">
                                        <label for="student_city">Student City <span class="red">*</span></label>
                                        <input type="text" class="form-control" id="student_city" name="student_city" value="<?php echo $student->student_city; ?>"/>
                                    </div>
                                     <div class="col-md-6">
                                        <label for="student_phone">Student Phone  <span class="red">*</span></label>
                                        <input type="text" class="form-control" id="student_phone" name="student_phone" value="<?php echo $student->student_phone; ?>"/>
                                    </div>
                                     <div class="col-md-6">
                                        <label for="student_parent_phone">Student Parent Phone  </label>
                                        <input type="text" class="form-control" id="student_parent_phone" name="student_parent_phone" value="<?php echo $student->student_parent_phone; ?>"/>
                                    </div>
                                     <div class="col-md-6">
                                        <label for="student_enr_no">Student Enrolment No  </label>
                                        <input type="text" class="form-control" id="student_enr_no" name="student_enr_no" value="<?php echo $student->student_enr_no; ?>"/>
                                    </div>
                                     <div class="col-md-6">
                                        <label for="student_email">Student Email  </label>
                                        <input type="email" class="form-control" id="student_email" name="student_email" value="<?php echo $student->student_email; ?>"/>
                                    </div>
                                     <div class="col-md-6">
                                        <label for="student_branch">Student Branch </label>
                                        <input type="text" class="form-control" id="student_branch" name="student_branch" value="<?php echo $student->student_branch; ?>"/>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="student_semester">Student Semester </label>
                                        <input type="text" class="form-control" id="student_semester" name="student_semester" value="<?php echo $student->student_semester; ?>"/>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="student_division">Student Division</label>
                                        <input type="text" class="form-control" id="student_division" name="student_division" value="<?php echo $student->student_division; ?>"/>
                                    </div> 
                                     <div class="col-md-6">
                                        <label for="student_batch">Student Batch </label>
                                        <input type="text" class="form-control" id="student_batch" name="student_batch" value="<?php echo $student->student_batch; ?>"/>
                                    </div>
                                    
                                    
                                     <div class="col-md-6">
                                        <label for="student_photo">Student Photo </label>
                                        <input type="file" class="form-control" id="student_photo" name="student_photo" />
                                    </div>
                                    <?php if($student->student_photo!=""){ ?>
                                     <div class="col-md-12" >
                                        <label for="" class="pull-right">Student Photo </label>
                                      <?php
                                            $img = $this->config->item('base_url')."uploads/studentphoto/".$student->student_photo; ?>                                 
                                            <img src="<?php echo $img; ?>" style="height: 50px; width: 50px; margin-top: 10px;" class="pull-right"/>
                                    </div>
                                    <?php } ?>
                                    
                                    
                                    
                                    </div>
                                </div>
                              
                              </div><!-- /.box-body -->
            
                              <div class="box-footer">
                                <button type="submit" name="savestudent" class="btn btn-primary">Update Data</button>
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
    <!-- InputMask -->
    <script src="<?php echo base_url($this->config->item("theme_admin")."/plugins/input-mask/jquery.inputmask.js"); ?>"></script>
    <script src="<?php echo base_url($this->config->item("theme_admin")."/plugins/input-mask/jquery.inputmask.date.extensions.js"); ?>"></script>
    <script src="<?php echo base_url($this->config->item("theme_admin")."/plugins/input-mask/jquery.inputmask.extensions.js"); ?>"></script>
    <!-- bootstrap time picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="<?php echo base_url($this->config->item("theme_admin")."/plugins/daterangepicker/daterangepicker.js"); ?>"></script>
   
    <script src="<?php echo base_url($this->config->item("theme_admin")."/plugins/timepicker/bootstrap-timepicker.min.js"); ?>"></script>
    <!-- DataTables -->
    <script src="<?php echo base_url($this->config->item("theme_admin")."/plugins/datatables/jquery.dataTables.min.js"); ?>"></script>
    <script src="<?php echo base_url($this->config->item("theme_admin")."/plugins/datatables/dataTables.bootstrap.min.js"); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url($this->config->item("theme_admin")."/dist/js/app.min.js"); ?>"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url($this->config->item("theme_admin")."/dist/js/demo.js"); ?>"></script>
    <script>
      $(function () {
        
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });

      });
    </script>
    <script>
    $(function(){
       $(".select2").select2();
    });
    </script>
     <script>
      $(function () {
        
         $("[data-mask]").inputmask("yyyy/mm/dd", {"placeholder": "yyyy/mm/dd"});
        $(".timepicker").timepicker({
          showInputs: false
        });
        
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });

      });
    </script>
    
  </body>
</html>
