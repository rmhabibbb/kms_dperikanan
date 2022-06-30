<?php
/**
 *
 */
class Login extends MY_Controller {
  function __construct() {
    parent::__construct();
    $this->data['email'] = $this->session->userdata('email');
    $this->data['id_role']  = $this->session->userdata('id_role');
    if (isset($this->data['email'], $this->data['id_role']))
    { 
      if ($this->data['id_role'] == 1) { 
          redirect('admin');
          exit();
      } elseif ($this->data['id_role'] == 2) {
          redirect('pimpinan');
          exit();
      }elseif ($this->data['id_role'] == 3) {
          redirect('pengguna');
          exit();
      }
    }
    $this->load->model('Login_m'); 
    date_default_timezone_set("Asia/Jakarta"); 
  }

  
  public function index() {
    $this->data[ 'title' ] = 'Login | ' . $this->title;
    $this->data[ 'content' ] = 'login';
    $this->load->view('sign-in');
  }

  public function cek(){
      $email = $this->POST('email');
      $password = $this->POST('password');
      if($this->Login_m->cek_login($email,$password) == 0){
        $this->flashmsg('Email tidak terdaftar!', 'danger');
        redirect('login');
        exit;
      }else if($this->Login_m->cek_login($email,$password) == 1){
        setcookie('email_temp', $email, time() + 5, "/");
        $this->flashmsg('Password Salah!', 'danger');
        redirect('login');
        exit;
      } 
    redirect('login');
  }


}

?>
