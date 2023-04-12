<!DOCTYPE html>
<html>
  <?php  $this->load->view("common/common_head"); ?>
  <body onload="window.print();">
    <div class="wrapper">
      <!-- Main content -->
      <section class="invoice">
        <!-- title row -->
        <div class="row">
          <div class="col-xs-12">
            <h2 class="page-header">
              <i class="fa fa-globe"></i> Student Data
              <small class="pull-right">Date: <?php echo date('Y-m-d');?></small>
            </h2>
          </div><!-- /.col -->
        </div>
        <!-- info row -->
       
        <!-- Table row -->
        <div class="row">
          <div class="col-xs-12 table-responsive">
            <table id="example2" class="example table table-bordered table-hover display" >
                    <thead>
                      <tr>
                       <th>ID</th> 
                        <th>Student Name</th>
                         <th>Standard</th>
                        <th>Student Roll No</th>
                        <th>Birthdate</th>
                        <th>Student Address</th>
                        <th>Student City</th>
                      <th>Student Phone</th>
                      <th>Student Parent Phone</th>
                      </tr>
                    </thead>
                    <tbody>
                <?php foreach($student as $students){
                    ?>
                    <tr>
                    <form method="post">
                       <td><?php echo $students->student_id; ?>
                        <td>
                        <?php echo $students->student_name; ?>
                        </td>
                        <td><?php echo $students->standard_title; ?>
                      </td>
                        <td><?php echo $students->student_roll_no; ?></td>
                        <td><?php echo $students->student_birthdate; ?></td>
                        <td><?php echo $students->student_address; ?></td>
                        <td><?php echo $students->student_city; ?>
                        <td><?php echo $students->student_phone; ?></td>
                        <td><?php echo $students->student_parent_phone; ?>
                        </form>
                    </tr>
                    <?php
                } ?>
                    </tbody>
                </table>
          </div><!-- /.col -->
        </div><!-- /.row -->


      </section><!-- /.content -->
    </div><!-- ./wrapper -->

    <!-- AdminLTE App -->
   
  </body>
</html>
