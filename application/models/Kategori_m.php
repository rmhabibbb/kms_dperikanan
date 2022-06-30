<?php 
class Kategori_m extends MY_Model
{

  function __construct()
  {
    parent::__construct();
    $this->data['primary_key'] = 'id_kategori';
    $this->data['table_name'] = 'kategori';
  }
}

 ?>
