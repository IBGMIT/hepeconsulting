<?php
session_start();
include('header.php');
include 'Invoice.php';
$invoice = new Invoice();
$invoice->checkLoggedIn();
if(!empty($_POST['companyName']) && $_POST['companyName']) {
    $invoice->saveInvoice($_POST);
    header("Location:invoice_list.php");
}
?>
    <title>HEPE ConsultingL</title>
    <script src="js/invoice.js"></script>
    <link href="css/style.css" rel="stylesheet">
<?php include('container.php');?>
    <div class="container content-invoice">
        <form action="" id="invoice-form" method="post" class="invoice-form" role="form" novalidate="">
            <div class="load-animate animated fadeInUp">
                <div class="row">
                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        <h2 class="title">HEPE Consulting</h2>
                        <?php include('invoiceMenu.php');?>
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
                            <input type="text" class="form-control" name="companyName" id="companyName" placeholder="Company Name" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="3" name="address" id="address" placeholder="Your Address"></textarea>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <table class="table table-bordered table-hover" id="invoiceItem">
                            <tr>
                                <th width="2%"><input id="checkAll" class="formcontrol" type="checkbox"></th>
                                <th width="15%">Day number</th>
                                <th width="38%">Description of time</th>
                                <th width="38%">Project Name</th>
                                <th width="15%">Quantity</th>
                            </tr>
                            <tr>
                                <td><input class="itemRow" type="checkbox"></td>
                                <td><input type="text" name="productCode[]" id="productCode_1" class="form-control" autocomplete="off"></td>
                                <td><input type="text" name="productName[]" id="productName_1" class="form-control" autocomplete="on"></td>
                                <td><input type="text" name="project[]" id="projectName_1" class="form-control" autocomplete="off"></td>
                                <td><input type="number" name="quantity[]" id="quantity_1" class="form-control quantity" autocomplete="off"></td>
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
                <div class="row">
                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                        <h3>Notes: </h3>
                        <div class="form-group">
                            <textarea class="form-control txt" rows="5" name="notes" id="notes" placeholder="Your Notes"></textarea>
                        </div>
                        <br>
                        <div class="form-group">
                            <input type="hidden" value="<?php echo $_SESSION['userid']; ?>" class="form-control" name="userId">
                            <input data-loading-text="Saving Timetable..." type="submit" name="invoice_btn" value="Save Timetable" class="btn btn-success submit_btn timetable-save-btm">
                        </div>

                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
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