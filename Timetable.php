<?php
class Timetable{
    private $host  = 'localhost';
    private $user  = 'root';
    private $password   = "peder1017";
    private $database  = "banks";
    private $invoiceUserTable = 'invoice_user';
    private $invoiceOrderTable = 'invoice_order';
    private $invoiceOrderItemTable = 'invoice_order_item';
    private $projectTable = 'project';
    private $customerTable = 'customer';
    private $TimeTable = 'timetable';
    private $dbConnect = false;
    public function __construct(){
        if(!$this->dbConnect){
            $conn = new mysqli($this->host, $this->user, $this->password, $this->database);
            if($conn->connect_error){
                die("Error failed to connect to MySQL: " . $conn->connect_error);
            }else{
                $this->dbConnect = $conn;
            }
        }
    }
    private function getData($sqlQuery) {
        $result = mysqli_query($this->dbConnect, $sqlQuery);
        if(!$result){
            die('Error in query: '. mysqli_error());
        }
        $data= array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $data[]=$row;
        }
        return $data;
    }
    private function getNumRows($sqlQuery) {
        $result = mysqli_query($this->dbConnect, $sqlQuery);
        if(!$result){
            die('Error in query: '. mysqli_error());
        }
        $numRows = mysqli_num_rows($result);
        return $numRows;
    }
    public function loginUsers($email, $password){
        $sqlQuery = "
			SELECT id, email, first_name, last_name, address, mobile 
			FROM ".$this->invoiceUserTable." 
			WHERE email='".$email."' AND password='".$password."'";
        return  $this->getData($sqlQuery);
    }
    public function checkLoggedIn(){
        if(!$_SESSION['userid']) {
            header("Location:index.php");
        }
    }
    public function saveTimetable($POST) {
        $sqlInsert = "
			INSERT INTO ".$this->TimeTable."(date, time_definition, description, time, project_id) 
			VALUES ('".$POST['date']."', '".$POST['time_definition']."', '".$POST['description']."', '".$POST['time']."', '".$POST['project_id']."')";
        mysqli_query($this->dbConnect, $sqlInsert);

    }
    public function updateTimetable($POST) {
        if($POST['timetableId']) {
            $sqlInsert = "
				UPDATE ".$this->TimeTable." 
				SET date = '".$POST['date']."', time_definition= '".$POST['timeDefinition']."', description = '".$POST['description']."', project_id = '".$POST['projectId']."'
				timetable_id = '".$POST['timetableId']."'";
            mysqli_query($this->dbConnect, $sqlInsert);
        }
        $this->deleteTimetableItems($POST['timetableId']);
        for ($i = 0; $i < count($POST['timetableId']); $i++) {
            $sqlInsertItem = "
				INSERT INTO ".$this->TimeTable."(date, time_definition, description, time, project_id) 
				VALUES ('".$POST['timetableid']."', '".$POST['date'][$i]."', '".$POST['timeDefinition'][$i]."', '".$POST['description'][$i]."', '".$POST['time'][$i]."', '".$POST['projectId'][$i]."')";
            mysqli_query($this->dbConnect, $sqlInsertItem);
        }
    }
    public function getCustomerList(){
        $sqlQuery = "
			SELECT * FROM ".$this->customerTable." 
			WHERE user_id = '".$_SESSION['userid']."'";
        return  $this->getData($sqlQuery);
    }

    public function getTimeTableList(){
        $sqlQuery = "
			SELECT * FROM ".$this->TimeTable."
			 WHERE timetable_id = '3'";
        return  $this->getData($sqlQuery);
    }

    public function getTimetable($timetableId){
        $sqlQuery = "
			SELECT * FROM ".$this->TimeTable." where
		 timetable_id = '$timetableId'";
        $result = mysqli_query($this->dbConnect, $sqlQuery);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $row;
    }

    public function getProjectList(){
        $sqlQuery = "
			SELECT * FROM ".$this->projectTable."'";

        return  $this->getData($sqlQuery);
    }
    public function getCustomer($customer_id){
        $sqlQuery = "
			SELECT * FROM ".$this->invoiceOrderTable." 
			WHERE user_id = '".$_SESSION['userid']."' AND customer_id = '$customer_id'";
        $result = mysqli_query($this->dbConnect, $sqlQuery);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $row;
    }

    public function getInvoiceUser($invoiceId){
        $sqlQuery = "
			SELECT * FROM ".$this->invoiceOrderTable." inner join ".$this->invoiceUserTable."
			WHERE user_id = '".$_SESSION['userid']."' AND order_id = '$invoiceId'";
        $result = mysqli_query($this->dbConnect, $sqlQuery);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $row;
    }

    public function getTimetableItems($timetable_Id){
        $sqlQuery = "
			SELECT * FROM ".$this->TimeTable." 
			WHERE timetable_id = '$timetable_Id'";
        return  $this->getData($sqlQuery);
    }
    public function deleteInvoiceItems($invoiceId){
        $sqlQuery = "
			DELETE FROM ".$this->invoiceOrderItemTable." 
			WHERE order_id = '".$invoiceId."'";
        mysqli_query($this->dbConnect, $sqlQuery);
    }

    public function deleteTimetableItems($timetableId){
        $sqlQuery = "
			DELETE FROM ".$this->TimeTable." 
			WHERE timetable_id = '".$timetableId."'";
        mysqli_query($this->dbConnect, $sqlQuery);
    }

    public function deleteInvoice($invoiceId){
        $sqlQuery = "
			DELETE FROM ".$this->invoiceOrderTable." 
			WHERE order_id = '".$invoiceId."'";
        mysqli_query($this->dbConnect, $sqlQuery);
        $this->deleteInvoiceItems($invoiceId);
        return 1;
    }
}
?>