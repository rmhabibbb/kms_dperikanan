<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Pimpinan extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
  
        $this->data['email'] = $this->session->userdata('email');
        $this->data['id_role']  = $this->session->userdata('id_role'); 
          if (!$this->data['email'] || ($this->data['id_role'] != 2))
          {
            $this->flashmsg('<i class="glyphicon glyphicon-remove"></i> Anda harus login terlebih dahulu', 'danger');
            redirect('login');
            exit;
          }  
    
    $this->load->model('login_m');  
    $this->load->model('Pengguna_m');   
    $this->load->model('Kategori_m');   
    $this->load->model('Diskusi_m');         
    $this->load->model('Komentar_m');     
    $this->load->model('Knowledge_m');     
    $this->load->model('pengguna_m');        
    $this->load->model('Like_m');      
    $this->load->model('Point_m');        
    
    $this->data['profil'] = $this->login_m->get_row(['email' =>$this->data['email'] ]);   
     
    date_default_timezone_set("Asia/Jakarta");


  }


public function index()
{     
    $this->load->library('pagination');


      $config['base_url'] = base_url('admin/index');
      $config['total_rows'] = $this->Knowledge_m->get_num_row(['status' => 2]);
      $config['per_page'] =  6;


      $config['full_tag_open'] = '<nav aria-label="Page navigation example"><ul class="pagination pagination-blog justify-content-center">'; 
      $config['full_tag_close'] = '</ul></nav>';
      $config['first_link'] = '<span aria-hidden="true">«</span>';
      $config['first_tag_open'] = '<li class="page-item">';
      $config['first_tag_close'] = '</li>';

      $config['last_link'] = '<span aria-hidden="true">»</span>';
      $config['last_tag_open'] = '<li class="page-item">';
      $config['last_tag_close'] = '</li>';


      $config['next_link'] = '<span aria-hidden="true">›</span>';
      $config['next_tag_open'] = '<li class="page-item">';
      $config['next_tag_close'] = '</li>';


      $config['prev_link'] = '<span aria-hidden="true">‹</span>';
      $config['prev_tag_open'] = '<li class="page-item">';
      $config['prev_tag_close'] = '</li>';

      $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#!">';
      $config['cur_tag_close'] = '<a/></li>';

      $config['num_tag_open'] = '<li class="page-item">';
      $config['num_tag_close'] = '</li>';

      $config['attributes'] = array('class' => 'page-link');


      $this->pagination->initialize($config);

      if ($this->uri->segment(3)) {
        $s = $this->uri->segment(3)+1;
      }else{
        $s = 1;
      }

    $this->data['knowledge'] = $this->Knowledge_m->getKnowledge($config['per_page'] ,  $s, ['status' => 2]);
 
    $this->data['index'] = 1;
    $this->data['content'] = 'pimpinan/dashboard';
    $this->template($this->data,'pimpinan');
}

public function cari(){
  if ($this->POST('cari')) {

    if ($this->POST('judul') == '' && $this->POST('kategori') == '' && $this->POST('jenis') == '') {
      $this->data['knowledge'] = $this->Knowledge_m->get(['status' => 2]);  
    }elseif ($this->POST('judul') == '' && $this->POST('kategori') != '' && $this->POST('jenis') == '') {
      $this->data['knowledge'] = $this->Knowledge_m->get(['status' => 2,'kategori' => $this->POST('kategori')]);
    }elseif ($this->POST('judul') == '' && $this->POST('kategori') == '' && $this->POST('jenis') != '') {
      $this->data['knowledge'] = $this->Knowledge_m->get(['status' => 2 , 'jenis' => $this->POST('jenis')]);  
    }elseif ($this->POST('judul') == '' && $this->POST('kategori') != '' && $this->POST('jenis') != '') {
      $this->data['knowledge'] = $this->Knowledge_m->get(['status' => 2,'kategori' => $this->POST('kategori'), 'jenis' => $this->POST('jenis')]);  
    }


    elseif ($this->POST('judul') != '' && $this->POST('kategori') == '' && $this->POST('jenis') == '') {
      $this->data['knowledge'] = $this->Knowledge_m->getDataLike2('judul', $this->POST('judul'),  ['status' => 2]);  
    }elseif ($this->POST('judul') != '' && $this->POST('kategori') != '' && $this->POST('jenis') == '') {
      $this->data['knowledge'] = $this->Knowledge_m->getDataLike2('judul', $this->POST('judul'),  ['status' => 2 , 'kategori' => $this->POST('kategori')]);  
    }elseif ($this->POST('judul') != '' && $this->POST('kategori') == '' && $this->POST('jenis') != '') {
      $this->data['knowledge'] = $this->Knowledge_m->getDataLike2('judul', $this->POST('judul'),  ['status' => 2 , 'jenis' => $this->POST('jenis')]);  
    }elseif ($this->POST('judul') != '' && $this->POST('kategori') != '' && $this->POST('jenis') != '') {
      $this->data['knowledge'] = $this->Knowledge_m->getDataLike2('judul', $this->POST('judul'),  ['status' => 2 , 'kategori' => $this->POST('kategori'), 'jenis' => $this->POST('jenis')]);  
    }
    
    $this->data['judul'] = $this->POST('judul');
    $this->data['kategori'] = $this->POST('kategori');
    $this->data['jenis'] = $this->POST('jenis');
 
    $this->data['index'] = 1;
    $this->data['content'] = 'pimpinan/cari';
    $this->template($this->data,'pimpinan');
  }else{
    redirect('pimpinan');
    exit();
  }
}

 

public function point()
{    

    if ($this->uri->segment(3)) {
      $this->data['pengguna'] = $this->Pengguna_m->get_row(['id_pengguna' => $this->uri->segment(3)]);
      $this->data['list_point'] = $this->Point_m->get(['id_pengguna' => $this->uri->segment(3)]);
      $this->data['point'] = $this->Point_m->get_point($this->uri->segment(3));   
      $this->data['index'] = 2;
      $this->data['content'] = 'pimpinan/detailpoint';
      $this->template($this->data,'pimpinan');
    }else{
      
     $list_pengguna = $this->Pengguna_m->get();
     $point = array();
     foreach ($list_pengguna as $p) {

      if ($this->POST('cari')) { 
        $pp = $this->Point_m->get_point_m($p->id_pengguna, $this->POST('bulan'), $this->POST('tahun'));
        $this->data['bulan'] = $this->POST('bulan');
        $this->data['tahun'] = $this->POST('tahun');
      }else{ 
        $pp = $this->Point_m->get_point_m($p->id_pengguna, date('m'), date('Y'));
        $this->data['bulan'] = NULL;
        $this->data['tahun'] = NULL;
      }

       if (!$pp) {
         $pp = 0;
       }

       $data = [
          'point' => $pp,
          'nama' => $p->nama,
          'id' => $p->id_pengguna
       ];

       array_push($point, $data);
     }

     rsort($point);
     $this->data['list_pengguna'] = $point;

    $this->data['index'] = 2;
    $this->data['content'] = 'pimpinan/point';
    $this->template($this->data,'pimpinan');
    }
      
}


public function id()
{     

  if ($this->uri->segment(3)) {
    $id = $this->uri->segment(3);


    $this->data['knowledge'] = $this->Knowledge_m->get_row(['id_knowledge' => $id ]); 
    $this->data['list_komentar'] = $this->Komentar_m->get_by_order('dt','asc',['id_knowledge' => $id ]);
    $this->data['index'] = 1;
 
    $this->data['content'] = 'pimpinan/fix-knowledge';
   
    $this->template($this->data,'pimpinan');
  }
  else {
    redirect('admin');
    exit();
  }
}



// PROFIL
  public function profile(){
    if ($this->POST('save')) {
      if ($this->login_m->get_num_row(['email' => $this->POST('email')]) != 0 && $this->POST('email') != $this->POST('emailx')) { 
        $this->flashmsg2('Email telah digunakan!', 'warning');
        redirect('pimpinan/profile/');
        exit();  
      }

        if ($this->login_m->update($this->POST('emailx'),['email' => $this->POST('email')])) {
          $user_session = [
            'email' => $this->POST('email')
          ];
          $this->session->set_userdata($user_session);

          $this->flashmsg2('Berhasil!', 'success');
          redirect('pimpinan/profile/');
          exit();  
        }else{
          $this->flashmsg2('Gagal, Coba lagi!', 'warning');
          redirect('pimpinan/profile/');
          exit();  
        } 
       

    } 

    if ($this->POST('gpw')) { 

      $cek = 0;
      $msg = ''; 
      if (md5($this->POST('passwordold')) != $this->data['profil']->password) {
        $msg = $msg . 'Password lama salah! <br>';
        $cek++;
      }

      if ($this->POST('passwordnew') != $this->POST('passwordnew2')) {
        $msg = $msg . 'Password baru tidak sama!';
        $cek++;
      }

      if ($cek != 0) {

        $this->flashmsg2($msg, 'warning');
        redirect('pimpinan/profile/');
        exit();  
      }

      $data = [ 
        'password' => md5($this->POST('passwordnew')) 
      ];
      if ($this->login_m->update($this->data['profil']->email, $data)) {
        $this->flashmsg2('Password berhasil diganti!', 'success');
        redirect('pimpinan/profile/');
        exit();  
      }else{
        $this->flashmsg2('Gagal, Coba lagi!', 'warning');
        redirect('pimpinan/profile/');
        exit();  
      } 
    }

    $this->data['index'] = 5;
    $this->data['content'] = 'pimpinan/profile';
    $this->template($this->data,'pimpinan');
  }
  public function proses_edit_profil(){
    if ($this->POST('edit')) {
      
      


      
    } 
    elseif ($this->POST('edit2')) { 
      
      
      $this->login_m->update($this->data['email'],$data);
  
      $this->flashmsg('PASSWORD BARU TELAH TERSIMPAN!', 'success');
      redirect('pimpinan/profil');
      exit();    
    }   
    else{ 
      redirect('pimpinan/profil');
      exit();
    } 
  }  
 
  public function cekemail(){ echo $this->login_m->cekemail2($this->input->post('email')); } 
  public function cekpasslama(){ echo $this->login_m->cekpasslama2($this->data['email'],$this->input->post('password')); } 
  public function cekpass(){ echo $this->login_m->cek_password_length2($this->input->post('password')); }
  public function cekpass2(){ echo $this->login_m->cek_passwords2($this->input->post('password'),$this->input->post('password2')); }
// PROFIL
 
}

 ?>
