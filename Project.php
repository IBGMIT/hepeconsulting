<?php
class Project{
    private $host  = 'localhost';
    private $user  = 'root';
    private $password   = "Sugmegsidelengs123";
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


    public function deleteInvoiceItems($invoiceId){
        $sqlQuery = "
			DELETE FROM ".$this->invoiceOrderItemTable." 
			WHERE order_id = '".$invoiceId."'";
        mysqli_query($this->dbConnect, $sqlQuery);
    }


    public function getProjectList(){
        $sqlQuery = "
			SELECT * FROM ".$this->projectTable."
			where user_id = '".$_SESSION['userid']."'";
        return  $this->getData($sqlQuery);
    }

    public function getProjectItems($project_Id){
        $sqlQuery = "
			SELECT * FROM ".$this->projectTable." 
			WHERE project_id = '$project_Id'";
        return  $this->getData($sqlQuery);
    }

    public function deleteProjectItems($projectId){
        $sqlQuery = "
			DELETE FROM ".$this->projectTable." 
			WHERE project_id = '".$projectId."'";
        mysqli_query($this->dbConnect, $sqlQuery);
    }

    public function getProject($projectId){
        $sqlQuery = "
			SELECT * FROM ".$this->projectTable." where
		 project_id = '$projectId'";
        $result = mysqli_query($this->dbConnect, $sqlQuery);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $row;
    }
    public function updateProject($POST) {
        if($POST['projectId']) {
            $sqlInsert = "
				UPDATE ".$this->projectTable." 
				SET name = '".$POST['name']."', date= '".$POST['date']."', customer_id= '".$POST['customerId']."', sats = '".$POST['sats']."', user_id ='".$POST['userId']."'
				WHERE project_id = '".$POST['projectId']."' AND user_id = '".$POST['user_id']."'";
            mysqli_query($this->dbConnect, $sqlInsert);
        }
        $this->deleteProjectItems($POST['projectId']);
        for ($i = 0; $i < count($POST['projectId']); $i++) {
            $sqlInsertItem = "
				INSERT INTO ".$this->projectTable."(project_id,name,date,customer_id,sats,user_id ) 
				VALUES ('".$POST['projectId']."', '".$POST['name'][$i]."', '".$POST['date'][$i]."', '".$POST['customerId'][$i]."', '".$POST['sats'][$i]."','".$POST['userId'][$i]."' )";
            mysqli_query($this->dbConnect, $sqlInsertItem);
        }
    }
}
?>