    <!-- Header -->
    <!-- Header -->
    <div class="header   pb-6 bg-gradient-orange" >
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7"> 
              <h6 class="h2 text-white d-inline-block mb-0">Daftar Knowledge</h6>
             
            </div> 

             
          </div>
        </div>
        <?= $this->session->flashdata('msg2') ?>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
          <div class="row">
          <div class="col-12">
            <div class="card"> 
                <div class="card-body"  >
                  <form action="<?=base_url('admin/cari')?>" method="POST">
                  <div class="row">
                      <div class="col-4">
                          <input type="text" name="judul" class="form-control" placeholder="Cari Knowledge ...">
                      </div>
                      <div class="col-3">
                          <select class="form-control" name="kategori">
                            <option value="">Semua Kategori</option>
                            <option value="Data internal Dinas Perikanan Kabupaten Muara Enim">Data internal Dinas Perikanan Kabupaten Muara Enim</option>
                            <option value="SOP">SOP</option>
                            <option value="Hasil Rapat">Hasil Rapat</option> 
                            <option value="Data Penyuluhan">Data Penyuluhan</option>  
                          </select>
                      </div>
                      <div class="col-3">
                          <select class="form-control" name="jenis">
                            <option value="">Semua Jenis</option>
                            <option value="Tacit">Tacit</option>
                            <option value="Explicit">Explicit</option> 
                          </select>
                      </div>
                      <div class="col-2">
                          <input type="submit" name="cari" value="Cari" class="btn bg-orange text-white btn-block">
                      </div>
                  </div>
                  </form>
                </div>
              </div>
            </div> 
        <?php if (sizeof($knowledge) == 0) { ?>
        <div class="col-12">
          <div class="card"> 
            <div class="card-body"  >
              <center><h5 class="h2 card-title mb-0">Tidak ada knowledge.</h5> </center>
            </div>
          </div>
        </div>
        <?php }else{ ?>
        <?php $i = 1; foreach ($knowledge as $row): ?> 
        <div class="col-6">
          <div class="card"> 
            <div class="card-body"  >
              <h5 class="h2 card-title mb-0"><?=$row->judul?></h5>
              <small class="text-muted"><?=$this->Pengguna_m->get_row(['id_pengguna ' => $row->id_pengguna ])->nama?> | <?= date('d/m/Y',strtotime($row->tgl_buat)) ?>  | <?=$this->Like_m->get_num_row(['id_knowledge' => $row->id_knowledge])?> Suka</small><br>
               <small class="text-muted"> <?=$row->kategori?> | <?=$row->jenis?> </small>
              <?php if ($row->jenis == 'Tacit') { ?>
                <p class="card-text mt-4" style="height: 90px">
                   <?php       
                    if (strlen($row->isi) < 180) {
                        echo $row->isi;
                    }else{
                        
                    $num_char = 180;
                    $text = $row->isi;
                    echo substr($text, 0, $num_char) . '...';
                    }
                    ?>
                </p>
               <?php }else{ ?> 
                <p class="card-text mt-4" style="height: 90px">
                  <?php       
                    if (strlen($row->keterangan) < 180) {
                        echo $row->keterangan;
                    }else{
                        
                    $num_char =180;
                    $text = $row->keterangan;
                    echo substr($text, 0, $num_char) . '...';
                    }
                    ?>
                </p>
               <?php } ?>
              
              <a href="<?=base_url('admin/id/'.$row->id_knowledge)?>" class="btn btn-link px-0">Lihat Selengkapnya</a>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
        <?php } ?>

        <div class="col-12"> 
         <?php echo $this->pagination->create_links(); ?> 
          <br>
        </div>
     
      </div>
   

 