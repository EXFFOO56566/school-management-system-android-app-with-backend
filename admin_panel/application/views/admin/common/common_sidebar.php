<aside class="main-sidebar" >
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          
          
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
           
       <?php if(_get_current_user_type_id($this)==0){ ?>
             <li>
              <a href="<?php echo site_url("admin/dashboard"); ?>">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> <small class="label pull-right bg-green"></small>
              </a>
               
            </li>
           <!--  <li>
              <a href="<?php echo site_url("requestdemo"); ?>">
                <i class="fa fa-reply"></i> <span>Demo Request</span> <small class="label pull-right bg-green"></small>
              </a>
               
            </li> -->
            <li>
              <a href="#">
                <i class="fa fa-user"></i> <span>User Management</span> <small class="label pull-right bg-green"></small>
              </a>
              <ul class="treeview-menu">
                        <li><a href="<?php echo site_url("users/add_user"); ?>"><i class="fa fa-plus"></i>New User</a></li>
                        <li><a href="<?php echo site_url("users"); ?>"><i class="fa fa-list"></i>List Users</a></li>
              </ul>
            </li>
           <?php } ?> 
            
            
              <?php if(_get_current_user_type_id($this)==1){ ?>
               <li>
              <a href="<?php echo site_url("school/dashboard"); ?>">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> <small class="label pull-right bg-green"></small>
              </a>
               
            </li>
               <li>
              <a href="<?php echo site_url("school/profile"); ?>">
                <i class="fa fa-refresh"></i> <span>Update School Profile</span> <small class="label pull-right bg-green"></small>
              </a>
               
            </li>
             <li>
              <a href="#">
                <i class="fa fa-graduation-cap"></i> <span>Teacher Management</span> <small class="label pull-right bg-green"></small>
              </a>
              <ul class="treeview-menu">
                        <li><a href="<?php echo site_url("teacher/add_teacher"); ?>"><i class="fa fa-plus"></i>Add Teacher</a></li>
                        <li><a href="<?php echo site_url("teacher/list_teacher"); ?>"><i class="fa fa-list"></i>List Teacher</a></li>
              </ul>
            </li>
            <li>
              <a href="<?php echo site_url("standard/manage_standard"); ?>">
                <i class="fa fa-tasks "></i> <span>Standard Management</span> <small class="label pull-right bg-green"></small>
              </a>
               
            </li>
             
              <li>
              <a href="#">
                <i class="fa fa-user"></i> <span>Student Management</span> <small class="label pull-right bg-green"></small>
              </a>
              <ul class="treeview-menu">
                        <li><a href="<?php echo site_url("student/add_student"); ?>"><i class="fa fa-plus"></i>Add Student</a></li>
                        <li><a href="<?php echo site_url("student/list_student"); ?>"><i class="fa fa-list"></i>List Student</a></li>
              </ul>
            </li>
             <li>
              <a href="<?php echo site_url("attendence/add_attendence"); ?>">
                <i class="fa fa-calendar-check-o"></i> <span>Student Attendence</span> <small class="label pull-right bg-green"></small>
              </a>
               
            </li>
             
           <li> 
              <a href="<?php echo site_url("exam/manage_exam"); ?>">
                <i class="fa fa-briefcase"></i> <span>Exam Management</span> <small class="label pull-right bg-green"></small>
              </a>
               
            </li>
              <li>
              <a href="<?php echo site_url("timetable/manage_timetable"); ?>">
                <i class="fa fa-calendar-o"></i> <span>Timetable Management</span> <small class="label pull-right bg-green"></small>
              </a>
               
            </li>
             
            
            <li>
              <a href="<?php echo site_url("event/manage_event"); ?>">
                <i class="fa fa-calendar"></i> <span>Event Management</span> <small class="label pull-right bg-green"></small>
              </a>
               
            </li>
             <li>
              <a href="#">
                <i class="fa fa-calendar"></i> <span>Holiday Management</span> <small class="label pull-right bg-green"></small>
              </a>
              <ul class="treeview-menu">
                        <li><a href="<?php echo site_url("holiday/manage_holiday"); ?>"><i class="fa fa-plus"></i>Add Holiday Or View Calender</a></li>
                        <li><a href="<?php echo site_url("holiday/list_holiday"); ?>"><i class="fa fa-list"></i>List Holiday</a></li>
              </ul>
            </li>
            
            <li>
              <a href="#">
                <i class="fa fa-money"></i> <span>Fees Management</span> <small class="label pull-right bg-green"></small>
              </a>
              <ul class="treeview-menu">
                        <li><a href="<?php echo site_url("fee/manage_feetypes"); ?>"><i class="fa fa-plus"></i>Manage Fees Types</a></li>
                        <li><a href="<?php echo site_url("fee/add_student_fees"); ?>"><i class="fa fa-list"></i>Add Student Fees</a></li>
               </ul>
            </li>
             <li>
              <a href="#">
                <i class="fa fa-calendar"></i> <span>Quiz</span> <small class="label pull-right bg-green"></small>
              </a>
              <ul class="treeview-menu">
                        <li><a href="<?php echo site_url("subject/manage_subject"); ?>"><i class="fa fa-plus"></i>Manage Quiz Subject</a></li>
                      
              </ul>
            </li>
          <li>
              <a href="#">
                <i class="fa fa-user"></i> <span>Top 10 Student</span> <small class="label pull-right bg-green"></small>
              </a>
              <ul class="treeview-menu">
                        <li><a href="<?php echo site_url("topstudent/add_topstudent"); ?>"><i class="fa fa-plus"></i>Add Student Rank</a></li>
                        <!--<li><a href="<?php echo site_url("topstudent/list_top"); ?>"><i class="fa fa-list"></i>List Student Rank</a></li> -->
              </ul>
            </li>
            <li>
              <a href="<?php echo site_url("noticeboard/manage_noticeboard"); ?>">
                <i class="fa fa-tasks"></i> <span>Noticeboard Management</span> <small class="label pull-right bg-green"></small>
              </a> 
            </li> 
            
            <li>
              <a href="<?php echo site_url("chat/manage_chat"); ?>">
                <i class="fa fa-pencil-square-o"></i> <span>Student Enquiry</span> <small class="label pull-right bg-green"></small>
              </a> 
            </li>
            
             <li>
              <a href="<?php echo site_url("notification/manage_notification"); ?>">
                <i class="fa fa-pencil-square-o"></i> <span>Notification</span> <small class="label pull-right bg-green"></small>
              </a> 
            </li>
             <li>
              <a href="<?php echo site_url("book/manage_book"); ?>"><i class="fa fa-book"></i>E-Book</a>
               
            </li>
           <?php } ?>  
           
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>