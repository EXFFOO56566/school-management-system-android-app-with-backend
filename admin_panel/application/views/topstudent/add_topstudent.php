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
            Add Top 10 Student
            <small>Manage Top 10 Student</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Top 10 Student</a></li>
            <li class="active">Add Top 10 Student</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
               <?php 
                  echo $this->session->flashdata("message");
                               ?>
                                <? if(isset($error)){
                            echo $error;
                        } ?>
             
             
                <form method="post">
                
                <div class="col-md-3">
                <label for="standard">Select Standard<span class="red">*</span></label>
                 <select class="form-control select2" name="standard" id="standard" style="width: 100%;">
                                           <option value="">Select Standard</option>
                                            <?php foreach($school_standard as $standard){
                                                ?>
                                                <option value="<?php echo $standard->standard_id; ?>" <?php  if(isset($_POST["standard"]) && $_POST["standard"]==$standard->standard_id){ echo "selected"; } ?>><?php echo $standard->standard_title; ?></option>
                                                <?php
                                            } ?>
                 </select>
                </div>
                  
             
                                        
                  <div class="col-md-2">
                  <div class="form-group">
                                  <label for="start_date">View Student </label>
                                    <div class="input-group">
                                  <input type="submit" name="studentlist" class="btn btn-primary" value="View Student"/>   
                                  
                                  </div>
                                </div>
                 
                </div>
                </form>
                
                
                
                
         </div>

        
            <?php if(isset($student)){ ?>
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header">
                           
                        </div>
                        <div class="box-body">
                        
                            <form role="form" action="" method="post" enctype="multipart/form-data">
                              <div class="box-body">
                              
                               <strong>Manualy Add Student Rank (Please Enter Rank in 1 to 10 Number Only)</strong>
                     <input type="hidden" name="standard" value="<?php echo ($this->input->post('standard')!="")? $this->input->post('standard') : "";  ?>" />           
                  <table id="example2" class="table table-bordered table-hover display">
                    <thead>
                      <tr>
                      <th>ID</th>
                        <th>Standard Name</th>
                        <th>Student Name</th>
                         <th>Student Roll No</th>
                        <th>Student Rank</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php  foreach($student as $students){
                        
                           $array = array('student_rank'=>'');
                                foreach($att_student as $att_students){
                                    
                                    if($att_students->standard_id==$students->standard_id && $att_students->student_id==$students->student_id && $att_students->school_id==$students->school_id){
                                        $array = array('student_rank'=>$att_students->student_rank);
                                     
                                     }
                                }
                                
                                     ?>
                                      <tr>
                         <td><?php echo $students->student_id; ?>
                      </td>
                        <td>
                       
                        <input type="hidden" name="student_id[]" value="<?php echo $students->student_id; ?>"/>
                        <?php echo $students->standard_title; ?></td>
                       <td><?php echo $students->student_name; ?></td>
                       <td><?php echo $students->student_roll_no; ?></td>
                        <td><input class="" type="number" name="note<?php echo $students->student_id ?>" placeholder="Student Rank" value="<?php if(isset($array['student_rank'])) echo $array['student_rank']; ?>"/></td>
                             
                    </tr>
                                    
                   
               <?php
              }  ?>
                    </tbody>
                </table>

                         
                                
                              
                              </div><!-- /.box-body -->
            
                             <div class="box-footer">
                                <button type="submit" name="savetop" class="btn btn-primary">Save Data</button>
                              </div>
                            </form>
                        </div>
                    </div>
                </div>
               <?php } ?>
                
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
    $(function(){
       $(".select2").select2();
    });
    </script>
 
   
  </body>
</html>
