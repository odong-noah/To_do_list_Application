<?php

session_start();

require_once 'config/auth_guard.php';
require_once 'config/dataconnect.php';
require_once 'get_task.php';

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>To_Do_list | Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="Assets/To_do_list_index.css">
</head>

<body>

<!--MOBILE NAVIGATION BAR -->
<nav class="navbar navbar-light bg-white border-bottom d-md-none px-3">
    <button class="btn btn-outline-secondary" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar">
        <i class="bi bi-list"></i>
    </button>
    <span class="fw-semibold">Dashboard</span>
</nav>


<!--MOBILE OFFCANVAS MENU-->
<div class="offcanvas offcanvas-start d-md-none" tabindex="-1" id="mobileSidebar" aria-labelledby="mobileSidebarLabel">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title fw-bold text-primary" id="mobileSidebarLabel">Menu</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="nav flex-column mb-4">
            <li class="nav-item mb-2">
                <a class="nav-link active py-2" href="#"><i class="bi bi-calendar-day me-2"></i>Tasks</a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link py-2" href="#" data-bs-toggle="modal" data-bs-target="#calendarModal"><i class="bi bi-calendar3 me-2"></i>Calendar</a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link py-2" href="#" data-bs-toggle="modal" data-bs-target="#stickyWallModal"><i class="bi bi-stickies me-2"></i>Sticky Wall</a>
            </li>
        </ul>
        <small class="text-muted fw-bold d-block mb-2">LISTS</small>
        <ul class="nav flex-column mb-4">
            <li class="nav-item">
                <a class="nav-link d-flex justify-content-between" href="#">
                    <span><span class="badge bg-danger me-2">&nbsp;</span>Personal</span>
                    <span class="text-muted small"><?php echo $personalCount; ?></span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex justify-content-between" href="#">
                    <span><span class="badge bg-info me-2">&nbsp;</span>Work</span>
                    <span class="text-muted small"><?php echo $workCount; ?></span>
                </a>
            </li>
        </ul>
        <hr>
        <h5 class="fw-medium mb-3">Account</h5>
        <a href="#" class="d-block text-decoration-none text-muted mb-3" data-bs-toggle="modal" data-bs-target="#editAccountModal">
            <i class="bi bi-gear me-2"></i>Settings
        </a>
        <a href="#" class="d-block text-decoration-none text-danger" data-bs-toggle="modal" data-bs-target="#logoutConfirmModal">
            <i class="bi bi-box-arrow-right me-2"></i>Sign out
        </a>
    </div>
</div>

<div class="container-fluid">
    <div class="row">


        <!--COLUMN 1: DESKTOP SIDEBAR-->
        <div class="col-md-3 col-lg-2 p-4 sidebar d-none d-md-block border-end vh-100">
            <h5 class="fw-bold mb-4 text-primary"><i class="bi bi-check2-square me-2"></i>To-Do Menu</h5>
            <input type="text" class="form-control mb-4" placeholder="Search tasks...">

            <small class="text-muted fw-bold">TASKS</small>
            <ul class="nav flex-column mb-4">
                <li class="nav-item"><a class="nav-link active" href="#"><i class="bi bi-calendar-day me-2"></i>Tasks</a></li>
                <li class="nav-item"><a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#calendarModal"><i class="bi bi-calendar3 me-2"></i>Calendar</a></li>
                <li class="nav-item"><a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#stickyWallModal"><i class="bi bi-stickies me-2"></i>Sticky Wall</a></li>
            </ul>


            <small class="text-muted fw-bold mb-4">LISTS</small>
            <ul class="nav flex-column mb-4">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <span class="badge bg-danger me-2">&nbsp;</span>Personal
                        <span class="float-end text-muted small"><?php echo $personalCount; ?></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <span class="badge bg-info me-2">&nbsp;</span>Work
                        <span class="float-end text-muted small"><?php echo $workCount; ?></span>
                    </a>
                </li>
            </ul>

            <hr>
            <div class="mt-4">
                <h5 class="fw-medium mb-3">Account</h5>
                <a href="#" class="d-block text-decoration-none text-muted mb-2 small" data-bs-toggle="modal" data-bs-target="#editAccountModal">
                    <i class="bi bi-gear me-2"></i>Settings
                </a>
                <a href="#" class="d-block text-decoration-none text-danger small" data-bs-toggle="modal" data-bs-target="#logoutConfirmModal">
                    <i class="bi bi-box-arrow-right me-2"></i>Sign out
                </a>
            </div>
        </div>



        <!--MAIN TASK PANEL (Center)-->
        <div class="col-md-5 col-lg-6 p-4 bg-light overflow-auto vh-100">
            <div class="mb-4">
                <h3 class="fw-bold text-dark">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h3>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0 text-info"><i class="bi bi-list-task me-2"></i>Your Tasks</h5>
                <button class="btn btn-primary btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#addTaskModal">
                    <i class="bi bi-plus-lg me-1"></i> New Task
                </button>
            </div>

            <div class="list-group">
                <?php if (empty($userTasks)) { ?>
                    <div class="text-center py-5 bg-white border rounded-4 shadow-sm">
                        <i class="bi bi-clipboard-x text-muted opacity-50" style="font-size: 4rem;"></i>
                        <h5 class="text-muted mt-3">No tasks found</h5>
                    </div>
                <?php } else { 
                    foreach ($userTasks as $task) { ?>
                        <div class="list-group-item border-0 shadow-sm rounded-4 mb-3 p-3 bg-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <input class="form-check-input me-3 border-primary" type="checkbox">
                                    <span class="fw-bold text-dark"><?php echo htmlspecialchars($task['to_do_list_task_title']); ?></span>
                                </div>
                                <i class="bi bi-chevron-down text-muted cursor-pointer" data-bs-toggle="collapse" data-bs-target="#details_<?php echo $task['to_do_list_task_id']; ?>"></i>
                            </div>
                            <div id="details_<?php echo $task['to_do_list_task_id']; ?>" class="collapse mt-3 ps-4 border-start border-2 border-info">
                                <p class="small text-muted mb-2"><?php echo htmlspecialchars($task['to_do_list_task_description']); ?></p>
                                <div class="d-flex gap-2">
                                    <span class="badge bg-light text-primary border small">Due: <?php echo $task['to_do_list_task_date']; ?></span>
                                    <span class="badge bg-info-subtle text-info border small"><?php echo htmlspecialchars($task['to_do_list_task_category']); ?></span>
                                </div>
                            </div>
                        </div>
                <?php } } ?>
            </div>
        </div>

        <!--COLUMN 3: RIGHT PANEL (Work/Personal separation)-->
        <div class="col-md-4 col-lg-4 p-4 border-start bg-white vh-100 overflow-auto">
            
            <div class="mb-5">
                <h5 class="fw-bold mb-4 text-primary"><i class="bi bi-briefcase me-2"></i>Work Tasks</h5>
                <?php 
                $workTasks = array_filter($userTasks, function($t) { return strtolower($t['to_do_list_task_category']) === 'work'; });
                if (empty($workTasks)) { ?>
                    <div class="category-empty text-muted small">No work tasks found.</div>
                <?php } else {
                    foreach ($workTasks as $wTask) { ?>
                        <div class="p-3 bg-light rounded-3 mb-2 d-flex justify-content-between align-items-center">
                            <span class="small fw-bold text-dark"><?php echo htmlspecialchars($wTask['to_do_list_task_title']); ?></span>
                            <small class="text-muted"><?php echo $wTask['to_do_list_task_date']; ?></small>
                        </div>
                <?php } } ?>
            </div>

            <hr class="my-4 opacity-25">

            <div class="mb-5">
                <h5 class="fw-bold mb-4 text-success"><i class="bi bi-person me-2"></i>Personal Tasks</h5>
                <?php 
                $personalTasks = array_filter($userTasks, function($t) { return strtolower($t['to_do_list_task_category']) === 'personal'; });
                if (empty($personalTasks)) { ?>
                    <div class="category-empty text-muted small">No personal tasks found.</div>
                <?php } else {
                    foreach ($personalTasks as $pTask) { ?>
                        <div class="p-3 bg-light rounded-3 mb-2 d-flex justify-content-between align-items-center">
                            <span class="small fw-bold text-dark"><?php echo htmlspecialchars($pTask['to_do_list_task_title']); ?></span>
                            <small class="text-muted"><?php echo $pTask['to_do_list_task_date']; ?></small>
                        </div>
                <?php } } ?>
            </div>
        </div>

    </div> 
</div> 


   

<!-- MODAL IMPORTS-->
<?php
    include 'Modals/To_do_list_index_stickywall.php'; 
    include 'Modals/To_do_list_index_calender.php';
    include 'Modals/To_do_list_logout_modal.php';
    include 'Modals/To_do_list_add_task.php';
    include 'Modals/To_do_list_delete_task.php';
    include 'Modals/To_do_list_edit_account.php';
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="Assets/To_do_list_index.js"></script>
</body>
</html>