<?php

Class getBranchIndicator extends  Dbh{

	public $bjlindicator;
	public $bid;
	public $branchname;
	public $invtype;
	public $bivindicator;



	public function __construct($bid){
		$this->bid = $bid;
		// if ($bid = 1) {
		// 	$this->bjlindicator='CJ';
		// }
		


	}
	public function getBranchindicatorbyBId(){
		#$branch = $this->bid; // assign back the value of bid
		switch ($this->bid) {
			case 1:
				$this->bjlindicator='CJ';
				$this->branchname = 'Cheras Jaya';
				$this->invtype = '3';
				$this->bivindicator = 'C';
				break;
			case 2:
				$this->bjlindicator='SB';
				$this->branchname = 'Puchong';
				$this->invtype = '3';
				$this->bivindicator = 'S';
				break;
			case 3:
				$this->bjlindicator='ID';
				$this->branchname = 'Indonesia';
				$this->invtype = '6';
				$this->bivindicator = 'I';
				break;				
			
			default:
				# code...
				break;
		}
		return $this->bjlindicator;
	}


	public function getBranchbyBid() {

   	$branch = $this->bid;
   	
  	$sql_branch = "SELECT * FROM branch WHERE bid = $branch";
  	// echo "\$sql_branch = $sql_branch <br>";
    $stmt = $this->connect()->prepare($sql_branch);
    $stmt->execute();
     if ($stmt->rowCount()) {
       $row = $stmt->fetch();
       foreach($row as $key=>$value) { ${$key} = $value; }// assign all key-valuepair
        
      }
      $this->bjlindicator = $bjlindicator;
      $this->branchname = $branchname;
      $this->invtype = $pst;


      	// echo "\$this->\$bjlindicator = $bjlindicator<br>";
      	// echo "\$bjlindicator = $bjlindicator";
      	// echo "<br>";
       //  print_r($row);
       // echo "<br>";
        return $bjlindicator;
    }



}
?>