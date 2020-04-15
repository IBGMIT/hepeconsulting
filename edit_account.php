<?php
session_start();
include('header.php');
include 'Invoice.php';
$invoice = new Invoice();
$invoice->checkLoggedIn();
if(!empty($_POST['email']) && $_POST['address'] && !empty($_POST['userid']) && $_POST['userid']) {
    $invoice->updateUser($_POST);
    header("Location:home.php");
}
if(!empty($_GET['update_id'])) {
    $userValues = $invoice->getCurrentUser($_GET[$_SESSION['userid']]);
}
?>
    <title>phpzag.com : Demo Build Invoice System with PHP & MySQL</title>
    <script src="js/invoice.js"></script>
    <link href="css/style.css" rel="stylesheet">
<?php include('container.php');?>
    <div class="container content-invoice">
        <form action="" id="invoice-form" method="post" class="invoice-form" role="form" novalidate="">
            <div class="load-animate animated fadeInUp">
                <div class="row">
                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        <h1 class="title">PHP Invoice System</h1>
                        <?php include('invoiceMenu.php');?>
                    </div>
                </div>
                <input id="currency" type="hidden" value="$">
                <div class="row">
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                        <h3>Current Information,</h3>
                        <?php echo $_SESSION['user']; ?><br>
                        <?php echo $_SESSION['address']; ?><br>
                        <?php echo $_SESSION['mobile']; ?><br>
                        <?php echo $_SESSION['email']; ?><br>
                    </div>

                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <table class="table table-bordered table-hover" id="invoiceItem">
                            <tr>
                                <th width="2%"><input id="checkAll" class="formcontrol" type="checkbox"></th>
                                <th width="15%">Name</th>
                                <th width="38%">Address</th>
                                <th width="15%">Mobile</th>
                                <th width="15%">Email</th>
                            </tr>

                                <tr>
                                    <td><input class="itemRow" type="checkbox"></td>
                                    <td><input type="text" value="<?php echo $userValues['user']; ?>" name="name[]" id="name_<?php echo $count; ?>" class="form-control" autocomplete="off"></td>
                                    <td><input type="text" value="<?php echo $userValues['address']; ?>" name="address[]" id="address_<?php echo $count; ?>" class="form-control" autocomplete="off"></td>
                                    <td><input type="number" value="<?php echo $userValues['mobile']; ?>" name="mobile[]" id="mobile_<?php echo $count; ?>" class="form-control quantity" autocomplete="off"></td>
                                    <td><input type="text" value="<?php echo $userValues['email']; ?>" name="email[]" id="email_<?php echo $count; ?>" class="form-control price" autocomplete="off"></td>

                                </tr>
                        </table>
                    </div>
                </div>
                <div class="row">

                        <br>
                        <div class="form-group">
                            <input type="hidden" value="<?php echo $_SESSION['userid']; ?>" class="form-control" name="userId">
                            <input type="hidden" value="<?php echo $userValues['user_id']; ?>" class="form-control" name="userid" id="userid">
                            <input data-loading-text="Updating Invoice..." type="submit" name="invoice_btn" value="Save Information" class="btn btn-success submit_btn invoice-save-btm">
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