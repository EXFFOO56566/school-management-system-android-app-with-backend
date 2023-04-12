<!DOCTYPE html>
<html>
 <?php  $this->load->view("common/common_head"); ?>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <?php  $this->load->view("admin/common/common_header"); ?>
      <!-- Left side column. contains the logo and sidebar -->
      <?php  $this->load->view("admin/common/common_sidebar"); ?>
      <script type="text/javascript" src="jquery-1.3.2.min.js"></script>

 <style>
 .margina{
    margin-top: 15px;
 }
 </style>


      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Question
            <small>Manage Question</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Question</a></li>
            <li class="active">Manage Question</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
               
                <div class="col-md-12">
                
                <div class="col-md-4">
                    <div class="box">
                        <div class="box-header">
                           <p><strong>Add Question (Ex. where is Taj Mahal?)</strong></p>
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
                                           <textarea rows="5" id="question" name="question" class="form-control" placeholder="where is Taj Mahal?"></textarea>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="col-md-12">
                                           <div id='TextBoxesGroup'>
                                        	<div id="TextBoxDiv1">
                                        		<label>Option #1 : </label> <br /> <input type='textbox' name="textbox[1]" class="form-control" id='textbox[1]' >
                                        	</div>
                                            </div>
                                            <div class="margina">
                                                 <div class="col-md-5">
                                                     <input type='button' value='Add Textview' id='addButton'>
                                                 </div> 
                                                 <div class="col-md-5">
                                                     <input type='button' value='Remove Textview' id='removeButton'>
                                                 </div>
                                            </div> 
                                         </div>
                                       <div class="col-md-12 margina">
                                            <label for="r_ans">Right Answer<span class="red"></span></label>
                                           <input type="text" id="r_ans" name="r_ans" class="form-control" placeholder="2" />
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
                    <div class="col-md-8">
                    <div class="box">
                <div class="box-header">
                
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Question</th>
                        <th>Right An</th>  
                        <th width="100">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                <?php foreach($question as $questionlist){
                    ?>
                    <tr>
                        <td><?php echo $questionlist->ques_id; ?></td>
                        <td><?php echo $questionlist->question; ?></td> 
                         <td><?php echo $questionlist->r_ans; ?></td>  
                        <td>
                            <!--<a href="<?php echo site_url("event/edit_event/".$questionlist->ques_id); ?>" class="btn btn-success"><i class="fa fa-eye"></i></a>-->
                            <a href="<?php echo site_url("question/edit_question/".$questionlist->ques_id); ?>" class="btn btn-success"><i class="fa fa-edit"></i></a>
                            <a href="<?php echo site_url("question/delete_question/".$questionlist->ques_id); ?>" onclick="return confirm('are you sure to delete?')" class="btn btn-danger"><i class="fa fa-remove"></i></a>
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
           "order": [[ 0, "desc" ]],
          "info": true,
          "autoWidth": false
        });

      });
    </script>
 
    
  </body>
</html>
