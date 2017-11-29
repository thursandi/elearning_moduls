<?php
class Info_model extends CI_Model {
	
	function __construct(){
		parent::__construct();
        
	}

    public $query;
    public $sql;
    //LIMIT 5 OFFSET 0
    //$sql = "SELECT * FROM some_table WHERE id = ? AND status = ? AND author = ?"; -- adalah query binding anti sql injection
    //$this->db->query($sql, array(3, 'live', 'Rick'));

    

    public function get_link_website()
    {
        $this->query = $this->db->query("SELECT * FROM link_website ORDER BY id ASC");

        if($this->query->num_rows >0){
            return $this->query;   
        }else{
            return NULL;
        } 
    
    }


/*--------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------*/

   


/*--------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------*/

  
}
?>