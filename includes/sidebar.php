<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link " href="index.php">
        <i class=""><img src="images/dashboard.gif" width="30px" height="30px" alt=""></i>
        <span>Dashboard</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#components-nav" href="school-profile.php"> <!-- data-bs-toggle="collapse" -->
        <i class=""><img src="images/school.gif" width="30px" height="30px" alt=""></i>
        <span>School Profile</span>
        <!-- <i class="bi bi-chevron-down ms-auto"></i> -->
      </a>
    </li>

    <?php
    // if - logged in user is developer(codsmine)
    if ($level == 'developer') {
    ?>
      <li class="nav-item">
        <a class="nav-link collapsed" href="./subs-codsmine.php">
          <i class=><img src="images/subscribe.gif" width="30px" height="30px" alt=""></i>
          <span>Subscriptions</span>
        </a>
      </li>
    <?php
    } // end of if - codsmine subscription tab
    ?>

    <?php
    // if - logged in user is clerk/super
    if ($level == 'clerk' || $level == 'super') {
    ?>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#profiling" data-bs-toggle="collapse" href="#">
          <i class=""><img src="images/profile.gif" width="30px" height="30px" alt=""></i>
          <span>Profiles</span>
          <i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="profiling" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li>
            <a href="teachers.php">
              <i class="bi bi-arrow-right"></i><span>Teacher Profiles</span>
            </a>
          </li>
          <li>
            <a href="staff.php">
              <i class="bi bi-arrow-right"></i><span>Staff Profiles</span>
            </a>
          </li>
          <li>
            <a href="students.php">
              <i class="bi bi-arrow-right"></i><span>Student Profiles</span>
            </a>
          </li>
        </ul>
      </li>
    <?php
    } // end of if - profiles tab
    ?>

    <?php
    // if - logged in user is clerk/super
    if ($level == 'clerk' || $level == 'super') {
    ?>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#chart-nav" data-bs-toggle="collapse" href="">
          <i class=><img src="images/calendar.gif" width="30px" height="30px" alt=""></i><span>Class Management</span>
          <i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="chart-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="add-class-section.php">
              <i class="bi bi-arrow-right"></i><span>Class & Sections</span>
            </a>
          </li>
          <li>
            <a href="add-section-subjects.php">
              <i class="bi bi-arrow-right"></i><span>Subjects</span>
            </a>
          </li>
          <li>
            <a href="./promote-class.php">
              <i class="bi bi-arrow-right"></i><span>Promote Class</span>
            </a>
          </li>
          <li>
            <a href="add-time-table.php">
              <i class="bi bi-arrow-right"></i><span>Timetables</span>
            </a>
          </li>
          <li>
            <a href="add-exam-schedule.php">
              <i class="bi bi-arrow-right"></i><span>Exam Schedules</span>
            </a>
          </li>
        </ul>
      </li>
    <?php
    } // end of if - classes management tabs
    ?>

    <?php
    // if - logged in user is accountant/super
    if ($level == 'accountant' || $level == 'super') {
    ?>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class=""><img src="images/asset-management.gif" width="30px" height="30px" alt=""></i><span>Finance Management</span>
          <i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="expense-receving.php">
              <i class="bi bi-arrow-right"></i><span>Expense/Receiving</span>
            </a>
          </li>
          <li>
            <a href="salaries.php">
              <i class="bi bi-arrow-right"></i><span>Salaries</span>
            </a>
          </li>
          <li>
            <a href="owner-payment.php">
              <i class="bi bi-arrow-right"></i><span>Pay Owner</span>
            </a>
          </li>
          <li>
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
      </li>
    <?php
    } // end of if - expence/receiving tabs
    ?>

    <?php
    // if the logged in user is accountant/super
    if ($level == 'accountant' || $level == 'super') {
    ?>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
          <i class=><img src="images/feee.gif" width="30px" height="30px" alt=""></i><span>Student Fee</span>
          <i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="issue-fee.php">
              <i class="bi bi-arrow-right"></i><span>Issue Fees</span>
            </a>
          </li>
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
      </li>
    <?php
    } // end of if - student fee tab
    ?>

    <?php
    // if - logged in user is clerk/super
    if ($level == 'clerk' || $level == 'super') {
    ?>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#student-tracking" data-bs-toggle="collapse" href="#">
          <i class=><img src="images/analytics.gif" width="30px" height="30px" alt=""></i><span>Student Reports</span>
          <i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="student-tracking" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="progress-reports.php">
              <i class="bi bi-arrow-right"></i><span>Progress Reports</span>
            </a>
          </li>
          <li>
            <a href="homework-diary.php">
              <i class="bi bi-arrow-right"></i><span>Homework Diary</span>
            </a>
          </li>
          <li>
            <a href="attendance.php">
              <i class="bi bi-arrow-right"></i><span>Attendance</span>
            </a>
          </li>
          <li>
            <a href="exam-results.php">
              <i class="bi bi-arrow-right"></i><span>Exam Results</span>
            </a>
          </li>
        </ul>
      </li>
    <?php
    } // end of if - student reports tab
    ?>

    <?php
    // if - loggd in user is from school
    if ($level == 'super' || $level == 'accountant' || $level == 'clerk') {
    ?>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" href="fee-vouchers.php">
          <i class=><img src="images/voucher.gif" width="30px" height="30px" alt=""></i><span>Fee Vouchers</span>
          <!-- <i class="bi bi-chevron-down ms-auto"></i> -->
        </a>
      </li>
    <?php
    } // end of if - fee vouchers tab
    ?>

    <?php
    // if - logged in user is accountant/super
    if ($level == 'accountant' || $level == 'super') {
    ?>
      <li class="nav-item">
        <a class="nav-link collapsed" href="./subs-school.php">
          <i class=><img src="images/subscribe.gif" width="30px" height="30px" alt=""></i>
          <span>Subscriptions</span>
        </a>
      </li>
    <?php
    } // end of if - subscriptions tab
    ?>

    <?php
    // if - logged in user is from school
    if ($level == 'super' || $level == 'accountant' || $level == 'clerk') {
    ?>

      <li class="nav-item">
        <a class="nav-link collapsed" href="add-announcements.php">
          <i class=><img src="images/promote.gif" width="30px" height="30px" alt=""></i>
          <span>Add Announcements</span>
        </a>
      </li>
    <?php
    } // end of if - announcements tab
    ?>

    <?php
    // if - not showing for now the mcqs section
    if ($level == 'not=here') {
    ?>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#syllabus" data-bs-toggle="collapse" href="#">
          <i class=><img src="images/syllabus.jpeg" width="30px" height="30px" alt=""></i><span>Academics</span>
          <i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="syllabus" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <!-- <li>
          <a href="http://localhost:8501">
            <i class="bi bi-arrow-right"></i><span>Books</span>
          </a>
        </li> -->
          <li>
            <a href="add-mcq.php">
              <i class="bi bi-arrow-right"></i><span>Add Mcq's</span>
            </a>
          </li>
          <li>
            <a href="generate-mcq.php">
              <i class="bi bi-arrow-right"></i><span>Generate Mcq's</span>
            </a>
          </li>
          <li>
            <a href="view-mcq.php">
              <i class="bi bi-arrow-right"></i><span>View Mcq's</span>
            </a>
          </li>
        </ul>
      </li>
    <?php
    } // end of if - not showing for now the mcqs section
    ?>

    <?php
    // if - logged in user is from the school
    if ($level == 'super' || $level == 'accountant' || $level == 'clerk') {
    ?>

      <li class="nav-item">
        <a class="nav-link collapsed" href="more-reports.php">
          <i class=><img src="images/more.gif" width="30px" height="30px" alt=""></i>
          <span>More Features</span>
        </a>
      </li>
    <?php
    } // end of if - more fatures tab
    ?>

  </ul>

</aside><!-- End Sidebar-->