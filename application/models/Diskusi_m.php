<?php 
class Diskusi_m extends MY_Model
{

  function __construct()
  {
    parent::__construct();
    $this->data['primary_key'] = 'id_diskusi';
    $this->data['table_name'] = 'diskusi';
  }
}

 ?>
