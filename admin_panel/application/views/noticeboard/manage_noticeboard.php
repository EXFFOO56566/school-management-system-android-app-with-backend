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
            Notice Board
            <small>Manage Notice Board</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Notice Board</a></li>
            <li class="active">Manage Noticeboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
               
                <div class="col-md-12">
                
                <div class="col-md-4">
                    <div class="box">
                        <div class="box-header">
                           <p><strong>Add Notice (Ex. Holiday, Parent Meating, other, etc)</strong></p>
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
                                    
                                    <div class="col-md-12">
                                        <label for="notice_description">Notice Description <span class="red">*</span></label>
                                       <textarea maxlength="160" rows="5" id="notice_description" name="notice_description" class="form-control" placeholder="Notice Detail"></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="notice_type">Select Notice Type <span class="red">*</span></label>
                                        <select name="notice_type" class="form-control select2"> 
                                            <?php foreach($this->config->item("notice_type") as $notice){ ?>
                                            <option value="<?php echo $notice; ?>"><?php echo $notice; ?></option>
                                            <?php } ?>
                                            </select>
                                    </div>
                                        
                                        <div class="col-md-12">
                                        <label for="send_SMS">Do you want to send SMS<span class="red">*</span></label>
                                        <select name="send_SMS" class="form-control select2">
                                            <option value="NO">NO</option>
                                            <option value="YES">YES</option>
                                            </select>
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
                <p><strong>Note*: If Status is off then not display notice in student application</strong></p>
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Notice Description Title</th>
                        <th>Notice Type</th>
                        <th>Created Date</th>
                        <th>Status</th>
                        <th width="100">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                <?php  foreach($noticeboard as $noticelist){
                    ?>
                    <tr>
                        
                        <td><?php echo $noticelist->notice_id; ?></td>
                        <td><?php echo $noticelist->notice_description; ?></td>
                        <td><?php echo $noticelist->notice_type; ?></td>
                        <td><?php echo $noticelist->on_date; ?></td>
                         <td><input class='tgl tgl-ios tgl_checkbox' data-table="notice_board" data-status="notice_status" data-idfield="notice_id"  data-id="<?php echo $noticelist->notice_id; ?>" id='cb_<?php echo $noticelist->notice_id; ?>' type='checkbox' <?php echo ($noticelist->notice_status==1)? "checked" : ""; ?> />
    <label class='tgl-btn' for='cb_<?php echo $noticelist->notice_id; ?>'></label></td>
                        <td>
                            <a href="<?php echo site_url("noticeboard/edit_noticeboard/".$noticelist->notice_id); ?>" class="btn btn-success"><i class="fa fa-edit"></i></a>
                            <a href="<?php echo site_url("noticeboard/delete_notice/".$noticelist->notice_id); ?>" onclick="return confirm('are you sure to delete?')" class="btn btn-danger"><i class="fa fa-remove"></i></a>
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
        
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": true,
           "order": [[ 0, "desc" ]],
          "info": true,
          "autoWidth": false
        });
        $("body").on("change",".tgl_checkbox",function(){
            var table = $(this).data("table");
            var status = $(this).data("status");
            var id = $(this).data("id");
            var id_field = $(this).data("idfield");
            var bin=0;
                                         if($(this).is(':checked')){
                                            bin = 1;
                                         }
            $.ajax({
              method: "POST",
              url: "<?php echo site_url("noticeboard/change_status"); ?>",
              data: { table: table, status: status, id : id, id_field : id_field, on_off : bin }
            })
              .done(function( msg ) {
                //alert(msg);
              }); 
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
