<?php
Class getInfoByQuono extends Dbh  {


	public $runningno;
	public $qid;
	public $co_code;
	public $period;
	public $date_issue;
	public $bid;
	public $quono;
	Public $cid;
	Public $company;
    Public $stack;
    ########################
    Public $cuttingtype;
    Public $grade;
    Public $noposition;
    Public $operation;
	Public $source;
	Public $date_issue2;
	Public $completion_date;
	Public $mdt;
	Public $mdw;
	Public $mdl;
	Public $quantity;
	Public $chamfer;
	Public $process;
	Public $process_name;
	// $stack = array('base', 'category'); // in php 7 create an empty array => $stack = []
	//https://stackoverflow.com/questions/5966746/best-way-to-initialize-empty-array-in-php
	
	
	

	public function __construct($quono,$period){
		$this->quono = $quono;
		$this->period = $period;
	}

	public function getInfobyquono() {
		 $quono =  $this->quono;
		 $period = $this->period;
		 // echo "\$per = $per <br>";
	    //These two variables are just examples of inputs the user might have submitted
		$runtab = "runningno"."_".$this->period;
		// echo "\$runtab = $runtab <br>";
	 //    echo "\$quono = $quono <br>";
	    //We use prepare() and execute() to use Prepared Statements
	    $sql = "SELECT * FROM $runtab WHERE quono = '$quono'";
	     // echo "\$sql = $sql <br>";
	    $stmt = $this->connect()->prepare($sql);
	    $stmt->execute();

	    //Here I chose to show an example of how we can see the number of rows returned from the query
	    if ($stmt->rowCount()) {
	      while ($row = $stmt->fetch()) {
	        // echo $row['date_issue'],"    ", $row['bid'],"    ", $row['qid'],"    ",$row['quono'],"    ", $row['cid'], "    ",$row['company']."<br>";
	        $this->date_issue = $row['date_issue'];
	        
	        $this->bid = $row['bid'];
	        
	        $this->runningno = $row['runno'];
	        
	        $this->cid = $row['cid'];

	        $this->qid = $row['qid'];
	        
	        $this->company = $row['company'];
	        // echo "qid = ".$this->qid."<br>";
	        // echo "date_issue = ".$this->date_issue."<br>";
	        // echo "bid = ".$this->bid."<br>";
	        // echo "quono = ".$this->quono."<br>";
	        // echo "cid = ".$this->cid."<br>";
	        // echo "company = ".$this->company."<br>";
	      }
	      return $row;
	    }

	}//end of Class getInfoByQuono
}

Class getInfoByQuonoAndMore extends Dbh  {


	public $runningno;
	public $qid;
	public $co_code;
	public $period;
	public $date_issue;
	public $bid;
	public $quono;
	Public $cid;
	Public $company;
    Public $stack;
    ########################
    Public $cuttingtype;
    Public $grade;
    Public $noposition;
    Public $operation;
	Public $source;
	Public $date_issue2;
	Public $completion_date;
	Public $mdt;
	Public $mdw;
	Public $mdl;
	Public $quantity;
	Public $chamfer;
	Public $process;
	Public $process_name;
	// $stack = array('base', 'category'); // in php 7 create an empty array => $stack = []
	//https://stackoverflow.com/questions/5966746/best-way-to-initialize-empty-array-in-php
	
	
	

	public function __construct($quono,$period,$cid){
		$this->quono = $quono;
		$this->period = $period;
		$this->cid = $cid;
		// $this->noposition = $noposition;
	}

	public function getInfobyquonoandmore() {
		 $quono =  $this->quono;
		 $period = $this->period;
		 $cid = $this->cid;
		 // $qid =  $this->qid;

		 
	    //These two variables are just examples of inputs the user might have submitted
		$runtab = "runningno"."_".$this->period;
		// echo "\$runtab = $runtab <br>";
	 //    echo "\$quono = $quono <br>";
	    //We use prepare() and execute() to use Prepared Statements
	    $sql = "SELECT * FROM $runtab WHERE quono = '$quono' AND cid = $cid ";
	     // echo "\$sql = $sql <br>";
	    $stmt = $this->connect()->prepare($sql);
	    $stmt->execute();

	    //Here I chose to show an example of how we can see the number of rows returned from the query
	   if ($stmt->rowCount()) {
	   		$row = $stmt->fetch();
			foreach($row as $key=>$value) { ${$key} = $value; }// assign all key-valuepair
				$this->runningno = $runno;
				$this->bid = $bid;
				$this->date_issue = $date_issue;
				$this->cid = $cid;
				$this->qid = $qid;
				$this->company = $company;
			    // echo "qid = ".$this->qid."<br>";
		     //    echo "date_issue = ".$this->date_issue."<br>";
		     //    echo "bid = ".$this->bid."<br>";
		     //    echo "quono = ".$this->quono."<br>";
		     //    echo "cid = ".$this->cid."<br>";
		     //    echo "company = ".$this->company."<br>";

	      while ($row = $stmt->fetchAll()) {

	        
	        // $this->company = $row['company'];

	        return $row;
	      }


			
        		
      		

	      
	    }

	   
	   /* if ($stmt->rowCount()) {
	      while ($row = $stmt->fetchAll) {
	        // echo $row['date_issue'],"    ", $row['bid'],"    ", $row['qid'],"    ",$row['quono'],"    ", $row['cid'], "    ",$row['company']."<br>";
	      
	      }
	      return $row;
	    }*/

	}//end of Class getInfoByQuono
        

}


Class getInvoiceFromCustPayment extends Dbh{
    
        protected $quono;
        protected $period;
        protected $cid;
        protected $com;        
        protected $docount;

        public function __construct($quono,$period,$cid,$com){
            $this->quono = $quono;
            $this->period = $period;
            $this->cid = $cid;
            $this->com = $com;
            $this->docount = $docount;
            
            // $this->noposition = $noposition;
        }
    
    	public function getInvoiceNobyquonoandmore() {
            $quono =  $this->quono;
            $period = $this->period;
            $cid = $this->cid;
            $com = $this->com;
            $docount = $this->docount;

		 // $qid =  $this->qid;

		 
	    //These two variables are just examples of inputs the user might have submitted
            $custab = "customer_payment_".strtolower($com)."_".$this->period;
		// echo "\$runtab = $runtab <br>";
	 //    echo "\$quono = $quono <br>";
	    //We use prepare() and execute() to use Prepared Statements
            if (!isset($docount)) {
                $sql = "SELECT * FROM $custab WHERE quono = '$quono' AND "
                        . "cid = $cid ";
                
            }else{
                
            
	    $sql = "SELECT * FROM $custab WHERE quono = '$quono' "
                    . "AND cid = $cid AND docount = $docount ";
            }
//	      echo "\$sql = $sql <br>";
	    $stmt = $this->connect()->prepare($sql);
	    $stmt->execute();

	    //Here I chose to show an example of how we can see the number of rows returned from the query
	   if ($stmt->rowCount()) {
	   		$row = $stmt->fetch();
			foreach($row as $key=>$value) { ${$key} = $value; }// assign all key-valuepair
//                            $this->runningno = $runno;
//                            $this->bid = $bid;
//                            $this->date_issue = $date_issue;
//                            $this->cid = $cid;
//                            $this->qid = $qid;
//                            $this->company = $company;
//     			     echo "invdate = ".$invdate."<br>";                       $this->invdate = $invdate;
//			     echo "invdate = ".$invdate."<br>";
                               return $invdate;
		     //    echo "date_issue = ".$this->date_issue."<br>";
		     //    echo "bid = ".$this->bid."<br>";
		     //    echo "quono = ".$this->quono."<br>";
		     //    echo "cid = ".$this->cid."<br>";
		     //    echo "company = ".$this->company."<br>";

//	      while ($row = $stmt->fetchAll()) {
//
//	        
//	        // $this->company = $row['company'];
//
//	        return $row;
//	      }


			
        		
      		

	      
	    }

	   
	   /* if ($stmt->rowCount()) {
	      while ($row = $stmt->fetchAll) {
	        // echo $row['date_issue'],"    ", $row['bid'],"    ", $row['qid'],"    ",$row['quono'],"    ", $row['cid'], "    ",$row['company']."<br>";
	      
	      }
	      return $row;
	    }*/

	}//end of Class getInfoByQuono        
}


Class getJobNoFromOrderlsit extends Dbh{
	Public $quono;
	Public $cid;
	Public $bid;
    Public $period;
    
	public function __construct($period,$quono,$cid,$bid){
		$this->period=$period;
		$this->quono=$quono;
		$this->cid=$cid;
		$this->bid=$bid;

	
		
		// $this->noposition = $noposition;
	}
	public function getJobno() {
		$qno = $this->quono;
		$cid = $this->cid;
		$bid = $this->bid;
		$per = $this->period;
		echo "\$qno = $qno <br> ";
		echo "\$cid= $cid <br> ";
		echo "\$bid = $bid <br> ";
		echo "\$per = $per <br> ";
		// $period = getInfoByQuonoAndMore::getInfobyquonoandmore($period);
		$ordtab = "orderlist_pst_".$per;

	    $sql = "SELECT * FROM $ordtab WHERE quono = '$qno' AND cid = '$cid' AND bid = '$bid' ORDER BY jobno";
	    // echo "\$sql = $sql <br>";
	    $stmt = $this->connect()->prepare($sql);
		$stmt->execute();
		if ($stmt->rowCount()) {
		   	$row = $stmt->fetch();
			//foreach($row as $key=>$value) { ${$key} = $value; }// assign all key-valuepair
			return $row;

		}

	}

	public function getJobnoOfRows() {
		$qno = $this->quono;
		$cid = $this->cid;
		$bid = $this->bid;
		$per = $this->period;
		$ordtab = "orderlist_pst_".$per;
		// $ordtab = "orderlist_pst_1808";
	    $sql = "SELECT count(*) FROM $ordtab WHERE quono = '$qno' AND cid = '$cid' 
	       AND bid = '$bid'"; 
	      // echo "\$sql = $sql <br>";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute(); 
      $number_of_rows = $stmt->fetchColumn(); 
      return $number_of_rows;
	}
}
Class selectJobno extends Dbh	{

    public function __construct($period,$quono,$cid,$bid,$pin){
    	$this->period=$period;
		$this->quono=$quono;
		$this->cid=$cid;
		$this->bid=$bid;
		$this->pin=$pin;
		$this->limitpin = $pin + 3;
		// echo "\$period = $period <br>";
		// echo "\$quono= $quono <br>";
		// echo "\$cid= $cid <br>";
		// echo "\$bid= $bid <br>";
		// echo "\$pid =".$this->pin."<br>";
		// echo "\$limitpin =".$this->limitpin." <br>";
	}
	public function selectJobToUpdate(){
		$qno = $this->quono;
		$cid = $this->cid;
		$bid = $this->bid;
		$per = $this->period;
		$pin = $this->pin;
		$limitpin = $this->limitpin;
		$ordtab = "orderlist_pst_".$per;

		$sql = "SELECT * FROM $ordtab WHERE quono = '$qno' AND cid = '$cid' AND bid = '$bid' ORDER BY noposition LIMIT $pin, 3";
		// echo "\$sql = $sql <br>";
		$stmt = $this->connect()->prepare($sql);
      	$stmt->execute(); 
      	if ($stmt->rowCount()) {
	   		$row = $stmt->fetch();
			foreach($row as $key=>$value) { ${$key} = $value; }

			if($jlissue == "issued"){
    			if($jlreprint == "yes"){
    				$sqlupdord = "UPDATE $ordtab SET jlreprint = 'no' WHERE quono = '$qno' AND cid = '$cid' AND bid = '$bid' ORDER BY noposition LIMIT $limitpin";
    				$stmt = $this->connect()->prepare($sqlupdord);
    				$stmt->execute();
    				if ($stmt->rowCount()){

    				}else{
    					echo "<font color=\"#FF0000\">Re-Print joblist cannot be updated. Please contact administrator regarding this thing.</font>";
			      		 // exit();

    				}

				

			
				}else{
					    // cct3000 ADDED FOR DEBUG
					    echo "You are not allowed to re-print this joblist. <br>";
					    // exit();
								 

					}
		    }
			    
		}
	}
}
Class getNamebyaid extends Dbh {
	Public $aid;
	Public $name;

	public function __construct($aid){
		$this->aid=$aid;
	}

	public function getName() {
			$aid = $this->aid;
		    $sql = "SELECT * FROM admin WHERE aid = '$aid'";
		       // echo "\$sql = $sql <br>";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute(); 
			if ($stmt->rowCount()) {
		      while ($row = $stmt->fetch()) {
		      	$this->name=$row['name'];

		      }
		      return $this->name;
		  }
	}
	



}

Class Gradename extends Dbh {
	Public $grade;
	Public $gradename;
	Public $machiningcode;

	public function __construct($grade){
		$this->grade=$grade;
	}

	public function getGradeName() {
		$grade = $this->grade;
		$sql = "SELECT * FROM material WHERE materialcode = '$grade'";
		       // echo "\$sql = $sql <br>";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute(); 
		if ($stmt->rowCount()) {
		    while ($row = $stmt->fetch()) {
		      	$this->gradename=$row['material'];

		    }
		      return $this->gradename;
		}
	}
	public function getMachiningCode() {
		$grade = $this->grade;
		$machiningcode = $this->machiningcode;
		$sql = "SELECT * FROM material WHERE materialcode = '$grade'";
		       // echo "\$sql = $sql <br>";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute(); 
		if ($stmt->rowCount()) {
		    while ($row = $stmt->fetch()) {
		      	$this->machiningcode=$row['machiningcode'];

		    }
		      return $this->machiningcode;
		}
	}	
}

Class getProcessName extends Dbh {
	Public $pmid;
	Public $processname;

	public function __construct($pmid){
		$this->pmid=$pmid;

	}

	public function getProcessNamebyID() {
			$pmid = $this->pmid;
		    $sql = "SELECT * FROM premachining WHERE pmid = '$pmid'";
		       // echo "\$sql = $sql <br>";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute(); 
			if ($stmt->rowCount()) {
		      while ($row = $stmt->fetch()) {
		      	$this->processname=$row['process'];
		      	// echo "$this->processname";

		      }
		      return $this->processname;
		  }
	}
}


?>