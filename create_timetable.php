<?php
session_start();
include('header.php');
include 'Timetable.php';
$timetable = new Timetable();
$timetable->checkLoggedIn();
if(!empty($_POST['companyName']) && $_POST['companyName']) {
    $timetable->saveTimetable($_POST);
    $invoiceDate = date("d/M/Y, H:i:s", strtotime($timetable['date']));
    header("Location:timetable_list.php");
}
?>
    <title>HEPE ConsultingL</title>
    <script src="js/timetable.js"></script>
    <link href="css/style.css" rel="stylesheet">
<?php include('container.php');?>
    <div class="container content-timetable">
        <form action="" id="timetable-form" method="post" class="timetable-form" role="form" novalidate="">
            <div class="load-animate animated fadeInUp">
                <div class="row">
                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        <h2 class="title">HEPE Consulting</h2>
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

                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <table class="table table-bordered table-hover" id="TimetableItem">
                            <tr>
                                <th width="2%"><input id="checkAll" class="formcontrol" type="checkbox"></th>
                                <th width="15%">Date</th>
                                <th width="15%">Time Defintion</th>
                                <th width="15%">Description</th>
                                <th width="15%">time</th>
                                <th width="15%">project_id</th>
                            </tr>
                            <tr>
                                <td><input class="itemRow" type="checkbox"></td>
                                <td><input type="date" name="date[]" id="date_1" class="form-control" autocomplete="off"></td>
                                <td><input type="text" name="timeDefinition[]" id="timeDefinition_1" class="form-control" autocomplete="off"></td>
                                <td><input type="text" name="description[]" id="description_1" class="form-control" autocomplete="on"></td>
                                <td><input type="number" name="time[]" id="time_1" class="form-control" autocomplete="off"></td>
                                <td><input type="number" name="projectID[]" id="projectID_1" class="form-control quantity" autocomplete="off"></td>
                            </tr>
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
                            <input data-loading-text="Saving Timetable..." type="submit" name="invoice_btn" value="Save Timetable" class="btn btn-success submit_btn timetable-save-btm">
                        </div>

                    </div>
					<span class="form-inline">
						<div class="form-group">
							<label>Total Hours/Days: &nbsp;</label>
							<div class="input-group">
								<div class="input-group-addon currency">🕒</div>
								<input value="" type="number" class="form-control" name="hours_days" id="hours_days" placeholder="hours_days">
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