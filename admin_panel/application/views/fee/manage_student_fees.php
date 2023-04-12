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
            Manage Student Fees
            <small>Manage Student Fees</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Fees</a></li>
            <li class="active">Manage Student Fees</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
               
                <div class="col-md-12">
                
                <div class="col-md-4">
                    <div class="box">
                        <div class="box-header">
                           <p><strong>Manage Student Fees  </strong></p>
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
                                        <label for="standard">Standard <span class="red">*</span></label>
                                        <select class="form-control" name="standard" id="standard" style="width: 100%;">
                                            <option value="0">Select Standard</option>
                                            <?php foreach($school_standard as $standard){
                                                ?>
                                                <option value="<?php echo $standard->standard_id; ?>" data-standardid="<?php echo $standard->standard_id; ?>"><?php echo $standard->standard_title; ?></option>
                                                <?php
                                            } ?>
                                        </select> 
                                    </div>
                                     
                                      <div class="col-md-12">
                                        <label for="fee_title">Select Student <span class="red">*</span></label>
                                         <select class="text-input form-control" id="student_id" name="student_id">
                                                <option value="0">Select student</option> 
                                            </select>
                                    </div>
                                     <div class="col-md-12">
                                        <label for="fee_year">Select Fees Type <span class="red">*</span></label>
                                       <select class="text-input form-control" id="fee_types" name="fee_types">
                                                <option value="0">Select Fees Type</option> 
                                            </select>
                                    </div>
                                     <div class="col-md-12">
                                        <label for="fee_amount">Fees Amount <span class="red"></span></label>
                                         <input type="text" name="fee_amount" id="fee_amount" class="form-control" readonly="" placeholder="00"/>
                                     </div>
                                     <div class="col-md-12">
                                        <label for="fee_amount">Pay Fees Amount <span class="red"></span></label>
                                         <input type="text" name="pay_fee_amount" id="pay_fee_amount" class="form-control"  placeholder="00"/>
                                     </div>
                                    <div class="col-md-12">
                                        <label for="pay_date">Date <span class="red">*</span></label>
                                        <input type="text" class="form-control" id="pay_date" name="pay_date" placeholder="Show Date" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask value="<?php if(isset($_REQUEST["student_birthdate"])){echo $_REQUEST["student_birthdate"]; } ?>">
                                        
                                        
                                    </div>
                                    </div>
                                </div>
                             
                              </div><!-- /.box-body -->
            
                              <div class="box-footer">
                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                              </div>
                            </form>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-8">
                    <div class="box">
                <div class="box-header">
                
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>ID</th>
                         <th>Standard</th>
                        <th>Student Name</th>
                        <th>Fees Type</th>
                        <th>Pay Fees Amount</th> 
                         <th>Date</th> 
                        <th width="80">Action</th>
                      </tr>
                    </thead>
                    <tbody> 
                <?php foreach($student_list as $student_fees_list){
                    ?>
                    <tr>
                        <td><?php echo $student_fees_list->student_fees_id; ?></td>
                         <td><?php echo $student_fees_list->standard_title; ?></td> 
                        <td><?php echo  $student_fees_list->student_user_name;?></td> 
                        <td><?php echo $student_fees_list->title; ?></td>
                        <td><?php echo $student_fees_list->pay_fee_amount; ?></td>
                        <td><?php echo $student_fees_list->pay_date ?></td>
                        <td>
                            <a href="<?php echo site_url("fee/edit_student_fees/".$student_fees_list->student_fees_id); ?>" class="btn btn-success"><i class="fa fa-edit"></i></a>
                            <a href="<?php echo site_url("fee/delete_student_fees/".$student_fees_list->student_fees_id); ?>" onclick="return confirm('are you sure to delete?')" class="btn btn-danger"><i class="fa fa-remove"></i></a>
                        </td>
                    </tr>
                    <?php
                } ?>
                    </tbody>
                </table>
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
    $("#standard").change(function(){
            $('#student_id').html("");
            var standard_id = $(this).val();
             
            $.ajax({
              method: "POST",
              url: '<?php echo site_url("fee/student_json"); ?>',
              data: { standard_id: standard_id }
            })
              .done(function( data ) { 
                     $('#student_id').append("<option>Select Student</option>");
                     $.each(data, function(index, element) { 
                                $('#student_id').append("<option value='"+element.student_id+"'>"+element.student_user_name+"</option>");
                            });
                             
            }); 
       });
    </script>
    
     <script>
    $("#standard").change(function(){
            $('#fee_types').html("");
            var fee_types = $(this).val();
             
            $.ajax({
              method: "POST",
              url: '<?php echo site_url("fee/free_type_json"); ?>',
             
              data: { fee_types: fee_types }
            })
              .done(function( data ) {
                             $('#fee_types').append("<option>Select Fees Type</option>");
                     $.each(data, function(index, element) { 
                                $('#fee_types').append("<option value='"+element.id+"'>"+element.title+"</option>");
                                 
                            });
                             
            }); 
       });
    </script>
    
    
    <script>
    $("#fee_types").change(function(){
            $('#fee_amount').html("");
            var fee_amount = $(this).val();
            var student_id = $('#student_id').val();
             
            $.ajax({
              method: "POST",
              url: '<?php echo site_url("fee/free_amount_json"); ?>',
              data: { fee_amount: fee_amount, student_id : student_id }
            })
              .done(function( data ) {
                  
                     $.each(data, function(index, element) {
                                 
                                $('#fee_amount').val(element.remain_amount);
                            });
                             
            }); 
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
           "order": [[ 0, "desc" ]],
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
    
  </body>
</html>
