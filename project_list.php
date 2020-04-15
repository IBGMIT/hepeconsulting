<?php
session_start();
include('header.php');
include 'Project.php';
$project = new Project();
$project->checkLoggedIn();
?>
    <title>HEPE Consulting</title>
    <script src="js/invoice.js"></script>
    <link href="css/style.css" rel="stylesheet">
<?php include('container.php');?>
    <div class="container">
        <h2 class="title">HEPE Consulting</h2>
        <?php include('projectMenu.php');?>
        <table id="data-table" class="table table-condensed table-striped">
            <thead>
            <tr>
                <th>Project Nr.</th>
                <th>Date Created</th>
                <th>Project Name</th>
                <th>customer_id</th>
                <th>Sats</th>
                <th>Print</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <?php
            $projectList = $project->getProjectList();
            foreach($projectList as $projectDetails){
                $projectDate = date("d/M/Y, H:i:s", strtotime($projectDetails["date_created"]));
                echo '
              <tr>
                <td>'.$projectDetails["project_id"].'</td>
                <td>'.$projectDate.'</td>
                <td>'.$projectDetails["name"].'</td>
                <td>'.$projectDetails["customer_id"].'</td>
                <td>'.$projectDetails["sats"].'</td>
                <td><a href="print_invoice.php?project_id='.$projectDetails["project_id"].'" title="Print Project"><span class="glyphicon glyphicon-print"></span></a></td>
                <td><a href="edit_project.php?update_id='.$projectDetails["project_id"].'"  title="Edit Project"><span class="glyphicon glyphicon-edit"></span></a></td>
                <td><a href="#" id="'.$projectDetails["project_id"].'" class="deleteInvoice"  title="Delete Invoice"><span class="glyphicon glyphicon-remove"></span></a></td>
              </tr>
            ';
            }
            ?>
        </table>
    </div>
<?php include('footer.php');?>