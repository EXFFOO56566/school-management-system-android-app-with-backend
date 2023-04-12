<!DOCTYPE html>
<html>
 <?php  $this->load->view("common/common_head"); ?>
    <style>
     @media print{
        .non-print{
            display: none;
        }
     }
    
     
     </style> 
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
            Student Exam Result
            <small>Manage Result</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Exam Result</a></li>
            <li class="active">Manage Student Exam Result</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
               
                <div class="col-md-12">
                
                <div class="col-md-6 non-print">
                    <div class="box">
                        <div class="box-header">
                           <p style="padding-left: 10px; border: 1px solid black; font-size: 18px;"> 
                           <strong>Exam Name : <?php echo $exam->exam_title; ?></strong><br />
                           <strong>Exam Date :  <?php echo $exam->exam_date; ?></strong><br />
                           <strong>Standard Name :  <?php echo $exam->standard_title; ?></strong>
                           </p>
                        </div>
                        <div class="box-body">
                        
                             
                              <div class="box-body">
                              
                          <table id="example2" class="table table-bordered table-hover display">
                    <thead>
                      <tr>
                        <th>Student Name</th>
                        <th>Student Roll No</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php
               
                 foreach($student as $students){
                    ?>
                    <tr>
                       
                        <td><?php echo $students->student_name; ?></td>
                        <td><?php echo $students->student_roll_no; ?></td>
                        <td><a href="<?php echo site_url("examresult/manage_result/".$exam->exam_id."/".$students->student_id); ?>" class="btn btn-success"><i class="fa fa-plus"></i>Add Marks</a></td>
                        
                    </tr>
                    <?php
                } ?>
                    </tbody>
                </table>
                        
                                
                             
                              </div><!-- /.box-body -->
            
                            
                        </div>
                    </div>
                    </div>
                    <?php 
                    if(isset($studentdata->student_id)){?>
                     <div class="col-md-6">
                     
                    <div class="box">
                        <div class="box-header non-print">
                           <p><strong>Add Mark</strong></p>
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
                                <div class="form-group non-print">
                                    <div class="row">
                                   
                                      <div class="col-md-12">
                                      <input type="hidden" name="exam_id" value="<?php echo $exam->exam_id; ?>"/>
                                      <input type="hidden" name="student_id" value="<?php echo $studentdata->student_id; ?>"/>
                                       <p style="padding-left: 10px; border: 1px solid black; font-size: 14px;"><strong>Student Name : <?php echo $studentdata->student_name; ?></strong></p>
                                      </div>
                                      
                                      <div class="col-md-12">
                                        <label for="subject_name">Subject Name <span class="red">*</span></label>
                                        <input type="text" class="form-control" id="subject_name" name="subject_name" placeholder="Ex. Gujarati, Math, English, etc" />
                                    </div>
                                     <div class="col-md-12">
                                        <label for="mark_obtain">Mark Obtain <span class="red">*</span></label>
                                        <input type="text" class="form-control" id="mark_obtain" name="mark_obtain" placeholder="Out Of Total Mark" />
                                    </div>
                                    <div class="col-md-12">
                                        <label for="total_mark">Total Mark <span class="red">*</span></label>
                                        <input type="text" class="form-control" id="total_mark" name="total_mark" placeholder="Total Mark" />
                                    </div>
                                 
                                    
                                    </div>
                                </div>
                             
                              </div><!-- /.box-body -->
            
                              <div class="box-footer">
                                <button type="submit" name="saveresult" class="btn btn-success non-print">Add Mark</button>
                              </div>
                            </form>
                        </div>
                        <div class="">
                        <p style="padding-left: 10px; border: 1px solid black;"> <strong>Exam Name : <?php echo $exam->exam_title; ?></strong><br />
                           <strong>Exam Date :  <?php echo $exam->exam_date; ?></strong><br />
                           <strong>Standard Name :  <?php echo $exam->standard_title; ?></strong><br /> <strong>Student Name : <?php echo $studentdata->student_name; ?></strong> <div class="pull-right">
         <input type="button" value="Print" onclick="window.print()" class="btn btn-primary non-print" />
        </div></p>
                          <table id="example2" class="table table-bordered table-hover display">
                    <thead>
                      <tr>
                        <th>Subject Name</th>
                        <th>Obtain Mark</th>
                        <th>Total Mark</th>
                        <th class="non-print">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php
               
                 foreach($studentmark as $studentmarks){
                    ?>
                    <tr>
                    <form method="post">
                     
                    <input type="hidden" name="result_id" value="<?php echo $studentmarks->exam_result_id; ?>"/>
                        <td><input type="text" name="subject_name" value="<?php echo $studentmarks->subject; ?>"/></td>
                        <td><input type="text" name="mark_obtain" value="<?php echo $studentmarks->mark_obtain; ?>" size="5"/></td>
                        <td><input type="text" name="total_mark" value="<?php echo $studentmarks->total_mark; ?>" size="5"/></td>
                        <td><input type="submit" name="updatemark" value="Update" class="btn btn-primary non-print"/>
                        <a href="<?php echo site_url("examresult/delete_examresult/".$studentmarks->exam_result_id); ?>" onclick="return confirm('are you sure to delete?')" class="btn btn-danger non-print"><i class="fa fa-remove"></i></a>
                        </td>
                    </form>    
                    </tr>
                    <?php
                } ?>
                    </tbody>
                </table>
                        </div>
                    </div>
                    </div> 
                    <?php } else{ ?>
                        <div class="col-md-6">
                            <div class="box">
                                    <p><strong>No Record Found</strong></p>    
                            </div>
                        </div>
                        
                    <?php }?>
                    
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
