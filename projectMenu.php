<ul class="nav navbar-nav">
    <li class="dropdown">
        <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown">Project
            <span class="caret"></span></button>
        <ul class="dropdown-menu">
            <li><a href="project_list.php">Project List</a></li>
            <li><a href="create_project.php">Create Project</a></li>
        </ul>
    </li>
    <?php
    if($_SESSION['userid']) { ?>
        <li class="dropdown">
            <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown">Logged in <?php echo $_SESSION['user']; ?>
                <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li><a href="edit_account.php">Account</a></li>
                <li><a href="action.php?action=logout">Logout</a></li>
            </ul>
        </li>
    <?php } ?>
</ul>
<br /><br /><br /><br />