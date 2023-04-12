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
            Manage Fees Types
            <small>Manage Fees Types</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Fees</a></li>
            <li class="active">Fees Manage</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
               
                <div class="col-md-12">
                
                <div class="col-md-4">
                    <div class="box">
                        <div class="box-header">
                           <p><strong>Add Fees (Ex. Education Fees, Seminar Fees, etc)</strong></p>
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
                                        <label for="fee_title">Fees Title <span class="red">*</span></label>
                                        <input type="text" class="form-control" id="fee_title" name="fee_title" placeholder="Ex. Education Fee, etc" />
                                    </div>
                                     <div class="col-md-12">
                                        <label for="fee_year">Fees Year <span class="red">*</span></label>
                                        <input type="text" class="form-control" id="fee_year" name="fee_year" placeholder="Ex. 2016-17" />
                                    </div>
                                     <div class="col-md-12">
                                        <label for="fee_amount">Fees Amount <span class="red">*</span></label>
                                        <input type="text" class="form-control" id="fee_amount" name="fee_amount" placeholder="Ex. 5000" />
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
                        <th>Fees Title</th>
                        <th>Fees Year</th>
                        <th>Fees Amount</th> 
                        <th width="80">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                <?php foreach($fee_type as $feetypelist){
                    ?>
                    <tr>
                        <td><?php echo $feetypelist->id; ?></td>
                        <td><?php echo substr($feetypelist->title, 0,100);?></td> 
                        <td><?php echo $feetypelist->year; ?></td>
                        <td><?php echo $feetypelist->base_amount; ?></td>
                        <td>
                            <a href="<?php echo site_url("fee/edit_fee/".$feetypelist->id); ?>" class="btn btn-success"><i class="fa fa-edit"></i></a>
                            <a href="<?php echo site_url("fee/delete_fee/".$feetypelist->id); ?>" onclick="return confirm('are you sure to delete?')" class="btn btn-danger"><i class="fa fa-remove"></i></a>
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
 
    
  </body>
</html>
