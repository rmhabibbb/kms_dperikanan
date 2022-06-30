<?php 
class Knowledge_m extends MY_Model
{

  function __construct()
  {
    parent::__construct();
    $this->data['primary_key'] = 'id_knowledge';
    $this->data['table_name'] = 'knowledge';
  }

  public function getKnowledge($limit, $start,$cond){
  	if (is_array($cond))
		$this->db->where($cond);
	if (is_string($cond) && strlen($cond) > 3)
		$this->db->where($cond);
		
  	return $this->db->get('knowledge' , $limit, $start)->result();
  }
}

 ?>
