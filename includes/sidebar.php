<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link " href="index.php">
        <i class=""><img src="images/dashboard.jpeg" width="30px" height="30px" alt=""></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Sidebar -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#components-nav" href="school-profile.php"> <!-- data-bs-toggle="collapse" -->
        <i class=""><img src="images/schoolprofile1.jpeg" width="30px" height="30px" alt=""></i>
        <span>School Profile</span>
        <!-- <i class="bi bi-chevron-down ms-auto"></i> -->
      </a>
    </li><!-- End School Profile Sidebar -->
    <?php
    // checking session for appropriate access
    if ($_SESSION['login_access'] == 'developer' || $_SESSION['login_access'] == 'profiler' || $_SESSION['login_access'] == 'super') {
    ?>

      <!-- <li class="nav-item">
        <a class="nav-link" data-bs-target="#component," href="./add-subjects.php">
          <i class=""><img src="images/schoolprofile1.jpeg" width="30px" height="30px" alt=""></i>
          <span>Add subjects</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-bs-target="#component," href="./student-migration.php"> data-bs-toggle="collapse"
          <i class=""><img src="images/schoolprofile1.jpeg" width="30px" height="30px" alt=""></i>
          <span>Student Migration</span>
        </a>
      </li> -->
      <!-- End student migration tab -->

      <!-- <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#profiling" data-bs-toggle="collapse" href="#">
          <i class=""><img src="images/profile.jpeg" width="30px" height="30px" alt=""></i>
          <span>Profiles</span>
          <i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="profiling" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="teachers.php" onclick="keepDropdownOpen(event, this.href)">
              <i class="bi bi-arrow-right"></i><span>Teacher Profiles</span>
            </a>
          </li>
          <li>
            <a href="students.php">
              <i class="bi bi-arrow-right"></i><span>Student Profiles</span>
            </a>
        </ul>
      </li> -->
      <!-- End student and staff profiles -->

      <!-- testing code -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#profiling" data-bs-toggle="collapse" href="#">
          <i class=""><img src="images/profile.jpeg" width="30px" height="30px" alt=""></i>
          <span>Profiles</span>
          <i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="profiling" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li>
            <a href="teachers.php" class="dropdown-item">
              <i class="bi bi-arrow-right"></i><span>Teacher Profiles</span>
            </a>
          </li>
          <li>
            <a href="students.php" class="dropdown-item">
              <i class="bi bi-arrow-right"></i><span>Student Profiles</span>
            </a>
          </li>
        </ul>
      </li>




      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#chart-nav" data-bs-toggle="collapse" href="">
          <i class=><img src="images/timeable.png" width="30px" height="30px" alt=""></i><span>Time Table/Schedules</span>
          <i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="chart-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="add-time-table.php">
              <i class="bi bi-arrow-right"></i><span>Add Time Table</span>
            </a>
          </li>
          <li>
            <a href="add-exam-schedule.php">
              <i class="bi bi-arrow-right"></i><span>Add Exam Schedule</span>
            </a>
          </li>
        </ul>
      </li><!-- End Timetable and exam schedule -->
    <?php
      // end of if statement
    }
    ?>
    <?php
    // checking session for appropriate access
    if ($_SESSION['login_access'] == 'developer' || $_SESSION['login_access'] == 'accountant' || $_SESSION['login_access'] == 'super') {
    ?>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class=""><img src="images/dailyexpness.jpg" width="30px" height="30px" alt=""></i><span>Finance Management</span>
          <i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>

            <a href="expense-receving.php">
              <i class="bi bi-arrow-right"></i><span>Expense/Receving</span>
            </a>
            <a href="add-expense.php">
              <i class="bi bi-arrow-right"></i><span>Add Expense</span>
            </a>
          </li>
          <li>
            <a href="add-receiving.php">
              <i class="bi bi-arrow-right"></i><span>Add Receiving</span>
            </a>
          </li>
        </ul>
      </li><!-- End Finance Management -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
          <i class=><img src="images/fee.jpg" width="30px" height="30px" alt=""></i><span>Student Fee</span>
          <i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="fee-requests.php">
              <i class="bi bi-arrow-right"></i><span>Fee paid requests</span>
            </a>
          </li>
          <li>
            <a href="dues-requests.php">
              <i class="bi bi-arrow-right"></i><span>Dues paid requests</span>
            </a>
          </li>
          <li>
            <a href="fee-paid.php">
              <i class="bi bi-arrow-right"></i><span>Students - fee paid</span>
            </a>
          </li>
          <li>
            <a href="fee-dues.php">
              <i class="bi bi-arrow-right"></i><span>Students - pending dues</span>
            </a>
          </li>
          <li>
            <a href="fee-not-paid.php">
              <i class="bi bi-arrow-right"></i><span>Students - fee not-paid</span>
            </a>
          </li>
        </ul>
      </li><!-- End Student Fee Section -->
    <?php
      // end of if statement
    }
    ?>
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#tables-nav" href="fee-vouchers.php">
        <i class=><img src="images/reporttracking.jpg" width="30px" height="30px" alt=""></i><span>Fee Vouchers</span>
        <!-- <i class="bi bi-chevron-down ms-auto"></i> -->
      </a>
    </li><!-- End Student Fee Vouchers -->
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#tables-nav" href="progress-reports.php">
        <i class=><img src="images/reporttracking.jpg" width="30px" height="30px" alt=""></i><span>Progress Reports</span>
        <!-- <i class="bi bi-chevron-down ms-auto"></i> -->
      </a>
    </li><!-- End Student Progress Report -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#tables-nav" href="homework-diary.php">
        <i class=><img src="images/reporttracking.jpg" width="30px" height="30px" alt=""></i><span>Home Work Diary</span>
        <!-- <i class="bi bi-chevron-down ms-auto"></i> -->
      </a>
    </li><!-- End Homework Diary -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#tables-nav" href="attendance.php">
        <i class=><img src="images/reporttracking.jpg" width="30px" height="30px" alt=""></i><span>Attendance</span>
        <!-- <i class="bi bi-chevron-down ms-auto"></i> -->
      </a>
    </li><!-- End Student Attendance -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="add-announcements.php">
        <i class=><img src="images/announcments.jpg" width="30px" height="30px" alt=""></i>
        <span>Add Announcements</span>
      </a>
    </li><!-- End Announcements tab -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="#">
        <i class=><img src="images/morereports.jpg" width="30px" height="30px" alt=""></i>
        <span>More Reports</span>
      </a>
    </li><!-- Undefined functionality -->

  </ul>

</aside><!-- End Sidebar-->