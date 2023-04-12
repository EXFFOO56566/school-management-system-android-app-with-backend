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
            Add Attendence
            <small>Manage Attendence</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Attendence</a></li>
            <li class="active">Add Attendence</li>
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
              <strong>Manualy Add Attendence</strong>
             
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
                  <div class="col-md-3">
                     <div class="form-group">
                                  <label for="attendencedate">Attendence Date <span class="red">*</span></label>
                                    <div class="input-group">
                                      <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                      </div>
                                  <input type="text" class="form-control" id="attendencedate" name="attendencedate" placeholder="Show Date" value="<?php  if(isset($_POST["attendencedate"])) echo $_POST["attendencedate"]; ?>" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask>
                                  </div>
                                </div>
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

         
          <div class="col-md-12">
               <strong>Upload Excel File To Add Attendence</strong>
                <form method="post" enctype="multipart/form-data">
 
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
                  <div class="col-md-3">
                     <div class="form-group">
                                  <label for="attendencedate">Attendence Date <span class="red">*</span></label>
                                    <div class="input-group">
                                      <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                      </div>
                                  <input type="text" class="form-control" id="attendencedate" name="attendencedate" placeholder="Show Date" value="<?php  if(isset($_POST["attendencedate"])) echo $_POST["attendencedate"]; ?>" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask>
                                  </div>
                                </div>
                </div>
                 <div class="col-md-2">
                  <div class="form-group">
                                  <label for="start_date">Upload Excle File<span class="red">*</span> </label>
                                    <div class="input-group">
                                   <input class="" required="" name="logfile"  type="file" />   
                                  
                                  </div>
                                </div>
                 
                </div>
                                        
                  <div class="col-md-2">
                  <div class="form-group">
                                  <label for="start_date">Upload </label>
                                    <div class="input-group">
                                  <input type="submit" name="upload" class="btn btn-primary" value="Upload Attendence"/>   
                                  
                                  </div>
                                </div>
                 
                </div>
                </form>
                
                
                
                
         </div>
         
         <div class="col-md-12">
              <strong>Download Attendence For Excel File</strong>
              
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
                  <div class="col-md-3">
                     <div class="form-group">
                                  <label for="attendencedate">Attendence Date <span class="red">*</span></label>
                                    <div class="input-group">
                                      <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                      </div>
                                  <input type="text" class="form-control" id="attendencedate" name="attendencedate" placeholder="Show Date" value="<?php  if(isset($_POST["attendencedate"])) echo $_POST["attendencedate"]; ?>" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask>
                                  </div>
                                </div>
                </div>
             
                                        
                  <div class="col-md-2">
                  <div class="form-group">
                    <label for="start_date">Download </label>
                       <div class="input-group">
                         <input type="submit" name="download" class="btn btn-primary" value="Download Attendence"/>   
                                  
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
                               <div class="col-md-3">
                     <div class="form-group">
                                  <label for="attendencedate">Attendence Date <span class="red">*</span></label>
                                    <div class="input-group">
                                      <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                      </div>
                                  <input type="hidden" name="standard" value="<?php echo ($this->input->post('standard')!="")? $this->input->post('standard') : "";  ?>" />    
                                  <input type="text" class="form-control" id="attendencedate" name="attendencedate" placeholder="Show Date" value="<?php  if(isset($_POST["attendencedate"])) echo $_POST["attendencedate"]; ?>" readonly="" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask>
                                  </div>
                                </div>
                </div>
                              
                               
                  <table id="example2" class="table table-bordered table-hover display">
                    <thead>
                      <tr>
                      <th>ID</th>
                        <th>Standard Name</th>
                        <th>Student Name</th>
                         <th>Student Roll No</th>
                        <th style="color: white; background: green;">Present</th>
                        <th style="color: white; background: red;">Absent</th>
                        <th>Attendence Note</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php  foreach($student as $students){
                                $array = array('attended'=>'' , 'attendence_reason'=>'');
                                foreach($att_student as $att_students){
                                    
                                    if($att_students->standard_id==$students->standard_id && $att_students->student_id==$students->student_id && $att_students->school_id==$students->school_id){
                                        $array = array('attended'=>$att_students->attended , 'attendence_reason'=>$att_students->attendence_reason);
                                     
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
                        <td style="color: green;"><input type="radio" checked="checked" name="attendence<?php echo $students->student_id ?>" value="1"  <?php if(isset($array['attended']) && $array['attended']=="1") {echo "checked";} ?>/>Presend</td>
                        <td style="color: red;"><input type="radio"   name="attendence<?php echo $students->student_id ?>" value="0" <?php if(isset($array['attended']) && $array['attended']=="0") {echo "checked";} ?>/>Absent</td> 
                        <td><input type="text" name="note<?php echo $students->student_id ?>" placeholder="Student Abesent Note Here" value="<?php if(isset($array['attendence_reason'])) echo $array['attendence_reason']; ?>"/></td>
                             
                    </tr>
                                    
                   
               <?php
              }  ?>
                    </tbody>
                </table>

                         
                                
                              
                              </div><!-- /.box-body -->
            
                             <div class="box-footer">
                                <button type="submit" name="saveattendence" class="btn btn-primary">Save Data</button>
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
     <script>
      $(function () {
        
         $("[data-mask]").inputmask("yyyy/mm/dd", {"placeholder": "yyyy/mm/dd"});
        $(".timepicker").timepicker({
          showInputs: false
        });
      

      });
    </script>
   
  </body>
</html>
