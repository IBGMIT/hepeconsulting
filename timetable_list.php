<?php
session_start();
include('header.php');
include 'Timetable.php';
$timetable = new Timetable();
$timetable->checkLoggedIn();
?>
    <title>HEPE Consulting</title>
    <script src="js/invoice.js"></script>
    <link href="css/style.css" rel="stylesheet">
<?php include('container.php');?>
    <div class="container">
        <h2 class="title">HEPE Consulting</h2>
        <?php include('timetableMenu.php');?>
        <table id="data-table" class="table table-condensed table-striped">
            <thead>
            <tr>
                <th>Timetable Nr.</th>
                <th>Date</th>
                <th>Time Defintion</th>
                <th>Description</th>
                <th>Quantity of time</th>
                <th>Project Id</th>
                <th>User Id</th>
                <th>Print</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <?php
            $TimetableList= $timetable->getTimeTableList();
            foreach($TimetableList as $timetableDetails){
                $timeTableDate = date("d/M/Y", strtotime($timetableDetails["date"]));
                echo '
              <tr>
                <td>'.$timetableDetails["timetable_id"].'</td>
                <td>'.$timeTableDate.'</td>
                <td>'.$timetableDetails["time_definition"].'</td>
                <td>'.$timetableDetails["description"].'</td>
                <td>'.$timetableDetails["time"].'</td>
                <td>'.$timetableDetails["project_id"].'</td>
                <td>'.$timetableDetails["user_id"].'</td>
                <td><a href="print_timetable.php?timetable_id='.$timetableDetails["timetable_id"].'" title="Print Timetable"><span class="glyphicon glyphicon-print"></span></a></td>
                <td><a href="edit_timetable.php?update_id='.$timetableDetails["timetable_id"].'"  title="Edit Timetable"><span class="glyphicon glyphicon-edit"></span></a></td>
                <td><a href="#" id="'.$timetableDetails["timetable_id"].'" class="deleteInvoice"  title="Delete Invoice"><span class="glyphicon glyphicon-remove"></span></a></td>
              </tr>
            ';
            }
            ?>
        </table>
    </div>
<?php include('footer.php');?>