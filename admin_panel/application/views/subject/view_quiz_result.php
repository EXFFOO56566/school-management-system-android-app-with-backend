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
            Quiz Result
            <small>View Quiz Result</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Quiz Result</a></li>
            <li class="active">View Quiz Result</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
         
            <div class="row"> 
                    <div class="col-md-12">
                     <input type="button" value="Print" onclick="window.print()" class="con_txt2 non-print" />
                    <div class="box">
                      
                <div class="box-header"> 
                </table>
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>                       
                        <th>Standard</th>
                        <th>Name</th> 
                        <th>Roll No</th> 
                        <th>Quiz Subject</th>
                        <th>Total Question</th>
                         <th>Quiz Time</th> 
                        <th>Quiz Result</th>    
                      </tr>
                    </thead>
                    <tbody>
                <?php foreach($quiz_result as $subjectlist){
                    ?>
                    <tr> 
                        <td><?php echo $subjectlist->student_name; ?></td>
                        <td><?php echo $subjectlist->student_name; ?></td>
                        <td><?php echo $subjectlist->student_roll_no; ?></td> 
                        <td><?php echo $subjectlist->subject_title; ?></td>
                        <td><?php echo $subjectlist->subject_total_ques; ?></td>
                        <td><?php echo $subjectlist->quiz_time; ?> </td>
                        <td><?php echo $subjectlist->quiz_total_right_ans; ?> </td> 
                     </tr>
                    <?php
                } ?>
                    </tbody>
                </table>
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
      <script src="//cdn.datatables.net/buttons/1.2.1/js/buttons.print.min.js"></script>
    <script>
    $(document).ready(function() {
    $('.data_table').DataTable( {
        dom: 'Bfrtip',
        buttons: [
             'print'
        ]
    } );
} );
    </script>
    <script>
      $(function () {
        
         $("[data-mask]").inputmask("yyyy/mm/dd", {"placeholder": "yyyy/mm/dd"});
        $(".timepicker").timepicker({
          showInputs: false,
         showMeridian: false,  
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
