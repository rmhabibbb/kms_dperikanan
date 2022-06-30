<?php
$data =[ 
  'index' => $index
];
$this->load->view('admin/template/header',$data);
$this->load->view('admin/template/sidebar',$data);
$this->load->view('admin/template/navbar');
$this->load->view($content);
$this->load->view('admin/template/footer');
 ?>
