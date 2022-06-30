<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Admin extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
  
        $this->data['email'] = $this->session->userdata('email');
        $this->data['id_role']  = $this->session->userdata('id_role'); 
          if (!$this->data['email'] || ($this->data['id_role'] != 1))
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
    $this->data['content'] = 'admin/dashboard';
    $this->template($this->data,'admin');
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
    $this->data['content'] = 'admin/cari';
    $this->template($this->data,'admin');
  }else{
    redirect('admin');
    exit();
  }
}

public function verifikasi()
{     

    if ($this->POST('terima')) {
        $data = [  
          'status' => 2 
        ];
             

        if ($this->Knowledge_m->update($this->POST('id'),$data)) {
           $km = $this->Knowledge_m->get_row(['id_knowledge' => $this->POST('id')]);

          if ($km->jenis == 'Tacit') {
            $point = 20;
          }else{
            $point = 10;
          }

          $this->Point_m->insert(['id_pengguna' => $km->id_pengguna , 'dt' => date('Y-m-d H:i:s') , 'point' => $point , 'ket' => 'Membuat Knowledge : ' .$km->judul ]);
          $this->flashmsg2('Knowledge berhasil dibuat, mendapatkan point : ' . $point , 'success');
          redirect('admin/id/'.$this->POST('id'));
          exit();   
        }else{
           $this->flashmsg2('Gagal, coba lagi.' , 'success');
          redirect('admin/id/'.$this->POST('id'));
          exit();  
        }
         
    }elseif ($this->POST('tolak')) {
        $data = [  
          'status' =>  3,
          'pesan' => $this->POST('keterangan')
        ];
            
          
        $this->Knowledge_m->update($this->POST('id'),$data); 

        $this->flashmsg2('Knowledge berhasil ditolak!', 'success');
        redirect('admin/id/'.$this->POST('id'));
        exit();    
    }
    elseif ($this->uri->segment(3)) {
    $id = $this->uri->segment(3);


    $this->data['knowledge'] = $this->Knowledge_m->get_row(['id_knowledge' => $id ]); 
    $this->data['list_komentar'] = $this->Komentar_m->get_by_order('dt','asc',['id_knowledge' => $id ]);
    $this->data['index'] = 4;
 
    $this->data['content'] = 'admin/verifikasi-knowledge';
   
    $this->template($this->data,'admin');
  }else{
    $this->data['list_knowledge'] = $this->Knowledge_m->get_by_order('tgl_buat','desc',['status' => 1]);
    $this->data['index'] = 4;
    $this->data['content'] = 'admin/verifikasi';
    $this->template($this->data,'admin');
  }
    
}


public function id()
{     

  if ($this->uri->segment(3)) {
    $id = $this->uri->segment(3);


    $this->data['knowledge'] = $this->Knowledge_m->get_row(['id_knowledge' => $id ]); 
    $this->data['list_komentar'] = $this->Komentar_m->get_by_order('dt','asc',['id_knowledge' => $id ]);
    $this->data['index'] = 1;
 
    $this->data['content'] = 'admin/fix-knowledge';
   
    $this->template($this->data,'admin');
  }
  else {
    redirect('admin');
    exit();
  }
}

public function hapuskomentar(){ 

    $komen = $this->Komentar_m->get_row(['id' => $this->uri->segment(4)]);
  if ($this->Komentar_m->delete($this->uri->segment(4))) {

    $km = $this->Knowledge_m->get_row(['id_knowledge' => $this->uri->segment(3)]);

  
    if ($km->id_pengguna != $komen->id_pengguna) {
      $this->Point_m->insert(['id_pengguna' => $komen->id_pengguna , 'dt' => date('Y-m-d H:i:s') , 'point' => -5 , 'ket' => 'Admin menghapus komentarmu di Knowledge : ' .$km->judul ]); 

    }
    $this->flashmsg2('Komentar berhasil dihapus', 'success');
      redirect('admin/id/'.$this->uri->segment(3));
      exit(); 
  }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('admin/id/'.$this->uri->segment(3));
      exit();  
    }
}

public function akun()
{     

  if ($this->POST('add')) { 
        
    if ($this->login_m->get_num_row(['email' => $this->POST('email')]) != 0) {
      $this->flashmsg2('Email telah digunakan!', 'warning');
      redirect('admin/akun/');
      exit();  
    }

     
    $data = [
      'email' => $this->POST('email'), 
      'role' => $this->POST('role'),
      'password' => md5($this->POST('password')) 
    ];

    if ($this->login_m->insert($data)) {
      $this->flashmsg2('Akun berhasil ditambah', 'success');
      redirect('admin/akun/');
      exit();  
    }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('admin/akun/');
      exit();  
    }
  }
  elseif ($this->POST('edit')) { 
        
    if ($this->login_m->get_num_row(['email' => $this->POST('email')]) != 0 && $this->POST('email_x') != $this->POST('email')) {
      $this->flashmsg2('Email telah digunakan!', 'warning');
      redirect('admin/akun/');
      exit();  
    }

   
    $data = [
      'email' => $this->POST('email'), 
      'role' => $this->POST('role')
    ];
    
    

    if ($this->login_m->update($this->POST('email_x'),$data)) {
      $this->flashmsg2('Akun berhasil diedit.', 'success');
      redirect('admin/akun/');
      exit();  
    }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('admin/akun/');
      exit();  
    }
  }
  elseif ($this->POST('edit2')) { 
        
    if ($this->POST('password') != $this->POST('password2')) {
      $this->flashmsg2('Konfirmasi password tidak sama!', 'warning');
      redirect('admin/akun/');
      exit();  
    }

   
    $data = [
      'password' => md5($this->POST('password') )
    ];
    
    

    if ($this->login_m->update($this->POST('email'),$data)) {
      $this->flashmsg2('Password '.$this->POST('email'). ' berhasil diganti.', 'success');
      redirect('admin/akun/');
      exit();  
    }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('admin/akun/');
      exit();  
    }
  }
  elseif ($this->POST('delete')) {
    if ($this->login_m->delete($this->POST('email'))) {
      $this->flashmsg2('Akun berhasil dihapus.', 'success');
      redirect('admin/akun/');
      exit();  
    }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('admin/akun/');
      exit();  
    }
  }
  else {
    $this->data['users'] = $this->login_m->get(['email !=' => $this->data['email']  ]);
    $this->data['index'] = 2;
    $this->data['content'] = 'admin/users';
    $this->template($this->data,'admin');
  }
}
 
public function pengguna()
{     

  if ($this->POST('add')) { 
    $cek = 0;
    $msg = ''; 
    if ($this->login_m->get_num_row(['email' => $this->POST('email')]) != 0) {
      $msg = $msg . 'Email telah digunakan!<br>';
      $cek++;
    }
    if ($this->Pengguna_m->get_num_row(['id_pengguna' => $this->POST('id')]) != 0) { 
      $msg = $msg . 'ID pengguna telah digunakan!<br>'; 
      $cek++;
    }

    if ($cek != 0) {

      $this->flashmsg2($msg, 'warning');
      redirect('admin/pengguna/');
      exit();  
    }
     
    $data = [
      'email' => $this->POST('email'), 
      'role' => 3,
      'password' => md5($this->POST('password')) 
    ];

    if ($this->login_m->insert($data)) {

      $d = [
        'id_pengguna' =>  $this->POST('id'),
        'nama' =>  $this->POST('nama'),
        'email' => $this->POST('email'),  
        'alamat' => $this->POST('alamat'),  
        'jabatan' => $this->POST('jabatan'),  
        'jk' => $this->POST('jk') 
      ];

      if ($this->Pengguna_m->insert($d)) {
         $this->flashmsg2('Data pengguna berhasil ditambah', 'success');
          redirect('admin/pengguna/');
          exit(); 
      }else{
        $this->login_m->delete($this->POST('email'));
        $this->flashmsg2('Gagal, Coba lagi!', 'warning');
        redirect('admin/pengguna/');
        exit();  
      }

      
    }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('admin/pengguna/');
      exit();  
    }
  }
  elseif ($this->POST('edit')) { 
         
    $cek = 0;
    $msg = ''; 
    if ($this->login_m->get_num_row(['email' => $this->POST('email')]) != 0 && $this->POST('email_x') != $this->POST('email')) {
      $msg = $msg . 'Email telah digunakan!<br>';
      $cek++;
    }
    if ($this->Pengguna_m->get_num_row(['id_pengguna' => $this->POST('id')]) != 0 && $this->POST('id_x') != $this->POST('id')) { 
      $msg = $msg . 'ID pengguna telah digunakan!<br>'; 
      $cek++;
    }

    if ($cek != 0) {

      $this->flashmsg2($msg, 'warning');
      redirect('admin/pengguna/');
      exit();  
    }
     
   
    $data = [
      'email' => $this->POST('email') 
    ];
    
    

    if ($this->login_m->update($this->POST('email_x'),$data)) {

      $d = [
        'id_pengguna' =>  $this->POST('id'),
        'nama' =>  $this->POST('nama'),
        'email' => $this->POST('email'),  
        'alamat' => $this->POST('alamat'),  
        'jabatan' => $this->POST('jabatan'),  
        'jk' => $this->POST('jk') 
      ];

      if ($this->Pengguna_m->update($this->POST('id_x'), $d)) {
        $this->flashmsg2('Data pengguna berhasil diedit.', 'success');
        redirect('admin/pengguna/');
        exit(); 
      }else{
        $this->flashmsg2('Gagal, Coba lagi!', 'warning');
        redirect('admin/pengguna/');
        exit();  
    }

       
    }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('admin/pengguna/');
      exit();  
    } 
  } 
  elseif ($this->POST('delete')) {
    if ($this->login_m->delete($this->POST('email'))) {
      $this->flashmsg2('Data pengguna berhasil dihapus.', 'success');
      redirect('admin/pengguna/');
      exit();  
    }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('admin/pengguna/');
      exit();  
    }
  }
  else {
    $this->data['pengguna'] = $this->Pengguna_m->get();
    $this->data['index'] = 3;
    $this->data['content'] = 'admin/pengguna';
    $this->template($this->data,'admin');
  }
}


public function point()
{    

    if ($this->uri->segment(3)) {
      $this->data['pengguna'] = $this->Pengguna_m->get_row(['id_pengguna' => $this->uri->segment(3)]);
      $this->data['list_point'] = $this->Point_m->get(['id_pengguna' => $this->uri->segment(3)]);
      $this->data['point'] = $this->Point_m->get_point($this->uri->segment(3));   
      $this->data['index'] = 6;
      $this->data['content'] = 'admin/detailpoint';
      $this->template($this->data,'admin');
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

    $this->data['index'] = 6;
    $this->data['content'] = 'admin/point';
    $this->template($this->data,'admin');
    }
      
}

public function knowledge()
{     

  if ($this->POST('delete')) {
    if ($this->Knowledge_m->delete($this->POST('id_knowledge'))) {
      $this->flashmsg2('Knowledge berhasil dihapus.', 'success');
      redirect('admin/');
      exit();  
    }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('admin/');
      exit();  
    }
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
        redirect('admin/profile/');
        exit();  
      }

        if ($this->login_m->update($this->POST('emailx'),['email' => $this->POST('email')])) {
          $user_session = [
            'email' => $this->POST('email')
          ];
          $this->session->set_userdata($user_session);

          $this->flashmsg2('Berhasil!', 'success');
          redirect('admin/profile/');
          exit();  
        }else{
          $this->flashmsg2('Gagal, Coba lagi!', 'warning');
          redirect('admin/profile/');
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
        redirect('admin/profile/');
        exit();  
      }

      $data = [ 
        'password' => md5($this->POST('passwordnew')) 
      ];
      if ($this->login_m->update($this->data['profil']->email, $data)) {
        $this->flashmsg2('Password berhasil diganti!', 'success');
        redirect('admin/profile/');
        exit();  
      }else{
        $this->flashmsg2('Gagal, Coba lagi!', 'warning');
        redirect('admin/profile/');
        exit();  
      } 
    }

    $this->data['index'] = 5;
    $this->data['content'] = 'admin/profile';
    $this->template($this->data,'admin');
  }
  public function proses_edit_profil(){
    if ($this->POST('edit')) {
      
      


      
    } 
    elseif ($this->POST('edit2')) { 
      
      
      $this->login_m->update($this->data['email'],$data);
  
      $this->flashmsg('PASSWORD BARU TELAH TERSIMPAN!', 'success');
      redirect('admin/profil');
      exit();    
    }   
    else{ 
      redirect('admin/profil');
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
