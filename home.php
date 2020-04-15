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

<title>phpzag.com : Demo Build Invoice System with PHP & MySQL</title>
<script src="js/invoice.js"></script>
<link href="css/style.css" rel="stylesheet">
<?php include('container.php');?>
<div class="container content-invoice">
    <form action="" id="invoice-form" method="post" class="invoice-form" role="form" novalidate="">
        <div class="load-animate animated fadeInUp">
            <div class="row">
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                    <h1 class="title">JHMP Invoice System</h1>
                    <?php include('invoiceMenu.php');?>
                </div>
            </div>
            </div>
            </div>

<body>
<style type="text/css">

    body {
       background-image: url(images/fly.jpg);
    }
</style>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hey</title>

</body>
</html>
