<?php
session_start();
include 'Timetable.php';
$timetable = new Timetable();
$timetable->checkLoggedIn();
if(!empty($_GET['timetable_id']) && $_GET['timetable_id']) {
    $timetableValues = $timetable->getTimetable($_GET['timetable_id']);
    $timetableItems = $timetable->getTimetableItems($_GET['timetable_id']);
}
$timetableDate = date("d/M/Y", strtotime($timetableValues['date']));
$output = '';
$output .= '<table width="100%" border="1" cellpadding="5" cellspacing="0">
	<tr>
	<td colspan="2" align="center" style="font-size:18px"><b>Timetable</b></td>
	</tr>
	<tr>
	<td colspan="2">
	<table width="100%" cellpadding="5">
	<tr>
	<td width="33%">
	From,<br />
	<b>SENDER (BILL FROM)</b><br />
	Name : HEPE <br /> 
	Email : henning@hepe.com <br /> 
	Org Nr : 9801 2947 291 <br /> 
	Billing Address : Åsveien 7 <br />
	</td>
	
		<td width="33%">
	To,<br />
	<b>RECEIVER (BILL TO)</b><br />
	Name : BROR <br /> 
	Billing Address : HvorDuVil<br />
	</td>
	
	<td width="33%">         
	Timetable No. : '.$timetableValues['timetable_id'].'<br />
	Timetable Date : '.$timetableDate.'<br />
	</td>
	</tr>
	</table>
	<br />
	<table width="100%" border="1" cellpadding="5" cellspacing="0">
	<tr>
	<th align="left">Count</th>
	<th align="left">TimeTable ID</th>
	<th align="left">Date</th>
	<th align="left">Time Definition</th>
	<th align="left">Description</th>
	<th align="left">Time</th>
	<th align="left">Project ID</th>
	</tr>';
$count = 0;
foreach($timetableItems as $timetableItem){
    $count++;
    $output .= '
	<tr>
	<td align="left">'.$count.'</td>
	<td align="left">'.$timetableItem["timetable_id"].'</td>
	<td align="left">'.$timetableItem["date"].'</td>
	<td align="left">'.$timetableItem["time_definition"].'</td>
	<td align="left">'.$timetableItem["description"].'</td>
	<td align="left">'.$timetableItem["time"].'</td>   
	<td align="left">'.$timetableItem["project_id"].'</td>   
	</tr>';
}
$output .= '
	<tr>
	<td align="right" colspan="10"><b>Total</b></td>
	<td align="left"><b>'.$timetableValues['time'].'</b></td>
	</tr>';

$output .= '
	</table>
	</td>
	</tr>
	</table>';
// create pdf of invoice
$invoiceFileName = 'TimeTable-'.$timetableValues['timetable_id'].'.pdf';
require_once 'dompdf/src/Autoloader.php';
Dompdf\Autoloader::register();
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$dompdf->loadHtml(html_entity_decode($output));
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream($invoiceFileName, array("Attachment" => false));
?>
