<?php 
class Like_m extends MY_Model
{

  function __construct()
  {
    parent::__construct();
    $this->data['primary_key'] = 'id';
    $this->data['table_name'] = 'like_knowledge';
  }
}

 ?>
