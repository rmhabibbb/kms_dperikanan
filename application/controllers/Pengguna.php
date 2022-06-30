<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Pengguna extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
  
        $this->data['email'] = $this->session->userdata('email');
        $this->data['id_role']  = $this->session->userdata('id_role'); 
          if (!$this->data['email'] || ($this->data['id_role'] != 3))
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
    $this->load->model('Like_m');      
    $this->load->model('Point_m');        
    
    $this->data['profil'] = $this->login_m->get_row(['email' =>$this->data['email'] ]); 
    $this->data['kar'] = $this->Pengguna_m->get_row(['email' =>$this->data['email'] ]);   
    $this->data['point'] = $this->Point_m->get_point($this->data['kar']->id_pengguna);   
    


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
    $this->data['content'] = 'pengguna/dashboard';
    $this->template($this->data,'pengguna');
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
    $this->data['content'] = 'pengguna/cari';
    $this->template($this->data,'pengguna');
  }else{
    redirect('pengguna');
    exit();
  }
}


public function point()
{    
      $this->data['list_point'] = $this->Point_m->get_by_order('dt','desc',['id_pengguna' => $this->data['kar']->id_pengguna]);
      $this->data['index'] = 4;
      $this->data['content'] = 'pengguna/point';
      $this->template($this->data,'pengguna');
}

public function like()
{    
      $this->data['list_knowledge'] = $this->Like_m->get_by_order('dt','desc',['id_pengguna' =>$this->data['kar']->id_pengguna]);
      $this->data['index'] = 3;
      $this->data['content'] = 'pengguna/suka';
      $this->template($this->data,'pengguna');
}


public function knowledge()
{     

  if ($this->POST('add')) { 
    
 
    $data = [ 
      'judul' => $this->POST('judul'),  
      'id_pengguna' => $this->data['kar']->id_pengguna,
      'tgl_buat' => date('Y-m-d H:i:s'),
      'status' => 0,
      'jenis' => $this->POST('jeniskm'),
      'kategori' => $this->POST('kategori')
    ];

    if ($this->Knowledge_m->insert($data)) {
      $id = $this->db->insert_id();
      $this->flashmsg2('Knowledge berhasil dibuat', 'success');
      redirect('pengguna/knowledge/'.$id );
      exit();  
    }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('pengguna/knowledge/');
      exit();  
    }
  } 
  elseif ($this->POST('simpan')) { 
    
    if ($this->POST('jeniskm') == 'Tacit') {
      $km = $this->POST('knowledge');
      $data = [ 
                'judul' => $this->POST('judul'),  
                'isi' => $km
              ];
    }else{
      if ($_FILES['foto']['name'] !== '') {  

         
          if ($_FILES['foto']['type'] != 'application/pdf' && $_FILES['foto']['type'] != 'application/msword' && $_FILES['foto']['type'] != 'application/octet-stream'  && $_FILES['foto']['type'] != 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'  ) {
            $this->flashmsg2('Format file harus .pdf atau .doc', 'warning');
                redirect('pengguna/knowledge/'.$this->POST('id'));
                exit();  
          }
              $files = $_FILES['foto'];
              $_FILES['foto']['name'] = $files['name'];
              $_FILES['foto']['type'] = $files['type'];
              $_FILES['foto']['tmp_name'] = $files['tmp_name'];
              $_FILES['foto']['size'] = $files['size'];
              $id_file = $_FILES['foto']['name'];
              $km = 'explicit/'.$id_file; 
              $this->upload( $id_file, 'explicit/','foto');   
              $data = [ 
                'judul' => $this->POST('judul'),  
                'keterangan' => $this->POST('keterangan'),  
                'isi' => $km,
                'nama_file' => $_FILES['foto']['name']
              ];
            }else{   
              $data = [ 
                'judul' => $this->POST('judul'),
                'keterangan' => $this->POST('keterangan')
              ];
            }

    }
    

    if ($this->Knowledge_m->update($this->POST('id'),$data)) { 
      $this->flashmsg2('Knowledge berhasil disimpan', 'success');
      redirect('pengguna/knowledge/'.$this->POST('id') );
      exit();  
    }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('pengguna/knowledge/'.$this->POST('id'));
      exit();  
    }
  } 
  elseif ($this->POST('kirim')) { 
     
    if ($this->Knowledge_m->update($this->POST('id'),['status' => 1])) { 

      
      $this->flashmsg2('Knowledge berhasil dibuat, silahkan menunggu verifikasi admin.', 'success');
      redirect('pengguna/knowledge/'.$this->POST('id') );
      exit();  
    }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('pengguna/knowledge/'.$this->POST('id'));
      exit();  
    }
  } 
  elseif ($this->POST('delete')) {
    if ($this->Knowledge_m->delete($this->POST('id'))) {
      $this->flashmsg2('Knowledge berhasil dihapus.', 'success');
      redirect('pengguna/knowledge/');
      exit();  
    }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('pengguna/knowledge/');
      exit();  
    }
  }elseif ($this->uri->segment(3)) {
    $id = $this->uri->segment(3);


    $this->data['knowledge'] = $this->Knowledge_m->get_row(['id_knowledge' => $id ]); 
    $this->data['index'] = 2;

    if ($this->data['knowledge']->status == 0) {
      $this->data['content'] = 'pengguna/detail-knowledge-draft';
    }else{
      $this->data['content'] = 'pengguna/detail-knowledge';
    }
    $this->template($this->data,'pengguna');
  }
  else {
    $this->data['knowledge'] = $this->Knowledge_m->get_by_order('tgl_buat','desc',['id_pengguna' => $this->data['kar']->id_pengguna]); 
    $this->data['index'] = 2;
    $this->data['content'] = 'pengguna/knowledge';
    $this->template($this->data,'pengguna');
  }
}

public function id()
{     

  if ($this->uri->segment(3)) {
    $id = $this->uri->segment(3);


    $this->data['knowledge'] = $this->Knowledge_m->get_row(['id_knowledge' => $id ]); 
    $this->data['list_komentar'] = $this->Komentar_m->get_by_order('dt','asc',['id_knowledge' => $id ]);
    $this->data['index'] = 1;
 
    $this->data['content'] = 'pengguna/fix-knowledge';
   
    $this->template($this->data,'pengguna');
  }
  else {
    redirect('pengguna');
    exit();
  }
}


 
public function berikomentar(){
  $data = [
    'id_knowledge' => $this->POST('id'),
    'id_pengguna' => $this->data['kar']->id_pengguna,
    'komentar' => $this->POST('komentar'),
    'dt' => date('Y-m-d H:i:s')
  ];

  if ($this->Komentar_m->insert($data)) {
      $km = $this->Knowledge_m->get_row(['id_knowledge' => $this->POST('id')]);


      if ($km->id_pengguna != $this->data['kar']->id_pengguna) {
        
        if ($km->jenis == 'Tacit') {
          $point = 5;
        }else{
          $point = 5;
        }
 
        $this->Point_m->insert(['id_pengguna' => $this->data['kar']->id_pengguna , 'dt' => date('Y-m-d H:i:s') , 'point' => $point , 'ket' => 'Memberi komentar di Knowledge : ' .$km->judul ]);

      }
      


    $this->flashmsg2('Komentar berhasil dikirim', 'success');
      redirect('pengguna/id/'.$this->POST('id'));
      exit(); 
  }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('pengguna/id/'.$this->POST('id'));
      exit();  
    }
}


public function sukai(){
  if ($this->Like_m->get_num_row(['id_knowledge' => $this->uri->segment(3), 'id_pengguna' => $this->data['kar']->id_pengguna]) != 0) {
     $this->flashmsg2('Anda sudah menyukai knowledge ini!', 'warning');
      redirect('pengguna/id/'.$this->uri->segment(3));
      exit();  
  }

  if ($this->Like_m->insert(['id_knowledge' => $this->uri->segment(3), 'id_pengguna' => $this->data['kar']->id_pengguna, 'dt' => date('Y-m-d H:i:s')])) {
    
    $this->flashmsg2('Knowledge berhasil disukai', 'success');
      redirect('pengguna/id/'.$this->uri->segment(3));
      exit(); 
  }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('pengguna/id/'.$this->uri->segment(3));
      exit();  
    }
}

public function batalsukai(){
 
  if ($this->Like_m->delete($this->uri->segment(4))) { 
    $this->flashmsg2('Knowledge batal disukai', 'success');
      redirect('pengguna/id/'.$this->uri->segment(3));
      exit(); 
  }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('pengguna/id/'.$this->uri->segment(3));
      exit();  
    }
}



 
public function hapuskomentar(){
 

  if ($this->Komentar_m->delete($this->uri->segment(4))) {
    $this->flashmsg2('Komentar berhasil dihapus', 'success');
      redirect('pengguna/id/'.$this->uri->segment(3));
      exit(); 
  }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('pengguna/id/'.$this->uri->segment(3));
      exit();  
    }
}

public function leaderboard()
{    

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
    $this->data['content'] = 'pengguna/leaderboard';
    $this->template($this->data,'pengguna');
      
}

 public function downloadexplicit()
  {  
    $this->load->helper('download');
    $km = $this->Knowledge_m->get_row(['id_knowledge' => $this->uri->segment(3)])->isi;
    $nama_file = $this->Knowledge_m->get_row(['id_knowledge' => $this->uri->segment(3)])->nama_file;
    $judul = $this->Knowledge_m->get_row(['id_knowledge' => $this->uri->segment(3)])->judul;
     
    $data = file_get_contents(base_url('assets/'.$explicit)); 
    force_download($nama_file, $data); 
    redirect('pengguna','refresh');
  }
   
 
// PROFIL
  public function profile(){
    if ($this->POST('save')) {
      if ($this->login_m->get_num_row(['email' => $this->POST('email')]) != 0 && $this->POST('email') != $this->POST('emailx')) { 
        $this->flashmsg2('Email telah digunakan!', 'warning');
        redirect('pengguna/profile/');
        exit();  
      }

      $emailx = $this->POST('emailx');
      $param2 = ['email' => $this->POST('email')];
        if ($this->login_m->update($emaix,$param2)) {

          $d = [ 
            'nama' =>  $this->POST('nama'),
            'email' => $this->POST('email'),  
            'alamat' => $this->POST('alamat'),   
            'jk' => $this->POST('jk') 
          ];

          if ($this->Pengguna_m->update($this->POST('id'),$d)) {
            $user_session = [
              'email' => $this->POST('email')
            ];
            $this->session->set_userdata($user_session);

            $this->flashmsg2('Berhasil!', 'success');
            redirect('pengguna/profile/');
            exit(); 
          }else{
            $this->flashmsg2('Gagal, Coba lagi!', 'warning');
            redirect('pengguna/profile/');
            exit();  
          } 
           
        }else{
          $this->flashmsg2('Gagal, Coba lagi!', 'warning');
          redirect('pengguna/profile/');
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
        redirect('pengguna/profile/');
        exit();  
      }

      $data = [ 
        'password' => md5($this->POST('passwordnew')) 
      ];
      if ($this->login_m->update($this->data['profil']->email, $data)) {
        $this->flashmsg2('Password berhasil diganti!', 'success');
        redirect('pengguna/profile/');
        exit();  
      }else{
        $this->flashmsg2('Gagal, Coba lagi!', 'warning');
        redirect('pengguna/profile/');
        exit();  
      } 
    }

    $this->data['index'] = 5;
    $this->data['content'] = 'pengguna/profile';
    $this->template($this->data,'pengguna');
  }
  public function proses_edit_profil(){
    if ($this->POST('edit')) {
      
      


      
    } 
    elseif ($this->POST('edit2')) { 
      
      
      $this->login_m->update($this->data['email'],$data);
  
      $this->flashmsg('PASSWORD BARU TELAH TERSIMPAN!', 'success');
      redirect('pengguna/profil');
      exit();    
    }   
    else{ 
      redirect('pengguna/profil');
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
