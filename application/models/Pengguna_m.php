<?php 
class Pengguna_m extends MY_Model
{

  function __construct()
  {
    parent::__construct();
    $this->data['primary_key'] = 'id_pengguna';
    $this->data['table_name'] = 'pengguna';
  }
}

 ?>
