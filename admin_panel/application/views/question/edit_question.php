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
            Question
            <small>Edit Question</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Standard</a></li>
            <li class="active">Edit Standard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                <a href="<?php echo site_url("event/manage_event"); ?>" class="btn btn-primary pull-right">List</a>
                </div>
                <div class="col-md-12">
                <div class="col-md-3"></div>
                    <div class="col-md-6">
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
                                            <label for="question">Question <span class="red">*</span></label>
                                            <textarea rows="5" id="question" name="question" class="form-control" placeholder="where is Taj Mahal?"><?php echo $question->question; ?></textarea>
                                         </div>
                                         
                                        <?php if($question->ans_1 != ""){ ?>
                                          <div class="col-md-12">
                                           <label for="question">Option 1</label>
                                                <input type="text" id="r_ans" name="ans_1" class="form-control"  value="<?php echo $question->ans_1; ?>" />
                                         </div>
                                         <?php } ?>
                                         
                                        <?php if($question->ans_2 != ""){ ?>
                                         
                                         <div class="col-md-12">
                                           <label for="question">Option 2</label>
                                                <input type="text" id="r_ans" name="ans_2" class="form-control"  value="<?php echo $question->ans_2; ?>" />
                                         </div>
                                         <?php } ?>
                                         
                                        <?php if($question->ans_3 != ""){ ?>
                                        
                                        
                                         <div class="col-md-12">
                                           <label for="question">Option 3</label>
                                                <input type="text" id="r_ans" name="ans_3" class="form-control"   value="<?php echo $question->ans_3; ?>" />
                                         </div>
                                         <?php } ?>
                                         
                                        <?php if($question->ans_4 != ""){ ?>
                                        
                                         <div class="col-md-12">
                                           <label for="question">Option 4</label>
                                                <input type="text" id="r_ans" name="ans_4" class="form-control"   value="<?php echo $question->ans_4; ?>" />
                                         </div>
                                         <?php } ?>
                                         
                                        <?php if($question->ans_5 != ""){ ?>
                                        
                                         <div class="col-md-12">
                                           <label for="question">Option 5</label>
                                                <input type="text" id="r_ans" name="ans_5" class="form-control"   value="<?php echo $question->ans_5; ?>" />
                                         </div>
                                         <?php } ?>
                                         
                                        <?php if($question->ans_6 != ""){ ?>
                                        
                                         <div class="col-md-12">
                                           <label for="question">Option 6</label>
                                                <input type="text" id="r_ans" name="ans_6" class="form-control"   value="<?php echo $question->ans_6; ?>" />
                                         </div>
                                     <?php } ?>
                                         
                                        
                                        <div class="col-md-12 margina">
                                            <label for="r_ans">Right Answer<span class="red"></span></label>
                                           <input type="text" id="r_ans" name="r_ans" class="form-control"   value="<?php echo $question->r_ans; ?>" />
                                           <small>Note : write opetion number in Right Answer. Example Option 4 is correct answer then write "4" in input.</small>
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
                    <div class="col-md-3"></div>
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
    <script type="text/javascript">

$(document).ready(function(){

    var counter = 2;

    $("#addButton").click(function () {

	if(counter>6){
            alert("Only 6 option allow");
            return false;
	}

	var newTextBoxDiv = $(document.createElement('div'))
	     .attr("id", 'TextBoxDiv' + counter);

	newTextBoxDiv.after().html('<label>Option #'+ counter + ' : </label>' +
	      '<input type="text" class="form-control" name="textbox[' + counter +
	      ']" id="textbox' + counter + '" value="" >');

	newTextBoxDiv.appendTo("#TextBoxesGroup");


	counter++;
     });

     $("#removeButton").click(function () {
	if(counter==1){
          alert("No more textbox to remove");
          return false;
       }

	counter--;

        $("#TextBoxDiv" + counter).remove();

     });

     $("#getButtonValue").click(function () {

	var msg = '';
	for(i=1; i<counter; i++){
   	  msg += "\n Textbox #" + i + " : " + $('#textbox' + i).val();
	}
    	  alert(msg);
     });
  });
</script>
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
          "info": true,
          "autoWidth": false
        });

      });
    </script>
    
  </body>
</html>
