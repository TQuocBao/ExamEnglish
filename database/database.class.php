
<?php 
class database{

	private $boolean = '';
	private $Connection= '';
	private $result ='';
	private $query='';
	private $host='';
	private $user='';
	private $pass='';
	private $nameDB='';
	public function __construct($config){
		$this->host = $config['host'];
		$this->user = $config['user'];
		$this->pass = $config['pass'];
		$this->nameDB = $config['nameDB'];

		$this->connect();

	}

	public function connect(){
		$this->Connection = mysqli_connect($this->host,$this->user,$this->pass,$this->nameDB) or die ('error connect');
		$this->query=mysqli_query($this->Connection,"set names 'utf8'");
	}
	public function ManipulationDB($sql){
		$this->query = $sql;
		$this->result = mysqli_query($this->Connection,$this->query);
	  	return $this->result;
	}
	public function check($sql){
		$this->query = $sql;
		$this->result = mysqli_query($this->Connection,$this->query);
		if (!$this->result) { 
    		printf("Error: %s\n", mysqli_error($this->Connection)); 
    		exit(); 
			} 
		if(mysqli_num_rows($this->result))
		 $this->boolean = false;
		else
		 $this->boolean = true;
		return $this->boolean;
	}
	
}
 ?>