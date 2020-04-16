<?php
session_start();
include('header.php');
include 'Timetable.php';
$timetable = new Timetable();
$timetable->checkLoggedIn();
if(!empty($_POST['time']) && $_POST['time'] && !empty($_POST['description']) && $_POST['description']) {
    $timetable->updateTimetable($_POST);
    header("Location:timetable_list.php");
}
if(!empty($_GET['update_id']) && $_GET['update_id']) {
    $timetableValues = $timetable->getTimetable($_GET['update_id']);
    $timetableItems = $timetable->getTimetableItems($_GET['update_id']);
}
?>
    <title>JHMP Timetable</title>
    <script src="js/timetable.js"></script>
    <link href="css/style.css" rel="stylesheet">
<?php include('container.php');?>
    <div class="container content-timetable">
        <form action="" id="timetable-form" method="post" class="timetable-form" role="form" novalidate="">
            <div class="load-animate animated fadeInUp">
                <div class="row">
                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        <h1 class="title">PHP Invoice System</h1>
                        <?php include('timetableMenu.php');?>
                    </div>
                </div>
                <input id="currency" type="hidden" value="$">
                <div class="row">
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                        <h3>From,</h3>
                        <?php echo $_SESSION['user']; ?><br>
                        <?php echo $_SESSION['address']; ?><br>
                        <?php echo $_SESSION['mobile']; ?><br>
                        <?php echo $_SESSION['email']; ?><br>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 pull-right">
                        <h3>To,</h3>
                        <div class="form-group">
                            <input value="<?php echo $timetableValues['project_id']; ?>" type="text" class="form-control" name="project_id" id="project_id" placeholder="Project ID" autocomplete="off">
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <table class="table table-bordered table-hover" id="timetableItem">
                            <tr>
                                <th width="2%"><input id="checkAll" class="formcontrol" type="checkbox"></th>
                                <th width="15%">Timetable No</th>
                                <th width="15%">Date</th>
                                <th width="15%">Time Defintion</th>
                                <th width="15%">Description</th>
                                <th width="15%">time</th>
                                <th width="15%">project_id</th>
                                <th width="15%">user_id</th>
                            </tr>
                            <?php
                            $count = 0;
                            foreach($timetableItems as $timetableItem){
                                $count++;
                                ?>
                                <tr>
                                    <td><input class="itemRow" type="checkbox"></td>
                                    <td><input type="text" value="<?php echo $timetableItem["timetable_id"]; ?>" name="timetableID[]" id="timetableID_<?php echo $count; ?>" class="form-control" autocomplete="off"></td>
                                    <td><input type="date" value="<?php echo $timetableItem["date"]; ?>" name="date[]" id="date_<?php echo $count; ?>" class="form-control" autocomplete="off"></td>
                                    <td><input type="text" value="<?php echo $timetableItem["time_definition"]; ?>" name="timeDefinition[]" id="timeDefinition_<?php echo $count; ?>" class="form-control quantity" autocomplete="off"></td>
                                    <td><input type="text" value="<?php echo $timetableItem["description"]; ?>" name="description[]" id="description_<?php echo $count; ?>" class="form-control price" autocomplete="off"></td>
                                    <td><input type="number" value="<?php echo $timetableItem["time"]; ?>" name="time[]" id="time_<?php echo $count; ?>" class="form-control total" autocomplete="off"></td>
                                    <td><input type="number" value="<?php echo $timetableItem["project_id"]; ?>" name="projectID[]" id="projectID_<?php echo $count; ?>" class="form-control total" autocomplete="off"></td>
                                    <td><input type="number" value="<?php echo $timetableItem["user_id"]; ?>" name="userID[]" id="userID_<?php echo $count; ?>" class="form-control total" autocomplete="off"></td>
                                    <input type="hidden" value="<?php echo $timetableItem['project_id']; ?>" class="form-control" name="projectId[]">
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                        <button class="btn btn-danger delete" id="removeRows" type="button">- Delete</button>
                        <button class="btn btn-success" id="addRows" type="button">+ Add More</button>
                    </div>
                </div>
                        <br>
                        <div class="form-group">
                            <input type="hidden" value="<?php echo $_SESSION['userid']; ?>" class="form-control" name="userId">
                            <input type="hidden" value="<?php echo $timetableValues['timetable_id']; ?>" class="form-control" name="timetableId" id="timetableId">
                            <input data-loading-text="Updating Timetable..." type="submit" name="invoice_btn" value="Save Timetable" class="btn btn-success submit_btn invoice-save-btm">
                        </div>

                    </div>
						<span class="form-inline">
							<div class="form-group">
								<label>Total Time: &nbsp;</label>
								<div class="input-group">
									<div class="input-group-addon currency">$</div>
									<input value="<?php echo $timetableValues['time']; ?>" type="number" class="form-control" name="totaltime" id="totaltime" placeholder="Total Time">
								</div>
							</div>

						</span>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </form>
    </div>
    </div>
<?php include('footer.php');?>