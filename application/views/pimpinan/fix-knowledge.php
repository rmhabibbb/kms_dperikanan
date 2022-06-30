    <!-- Header -->
    <!-- Header -->
  <?php 
  function humanTiming ($time)
        {

            $time = time() - $time; // to get the time since that moment
            $time = ($time<1)? 1 : $time;
            $tokens = array (
                31536000 => 'tahun yang lalu',
                2592000 => 'bulan yang lalu',
                604800 => 'minggu yang lalu',
                86400 => 'haru yang lalu',
                3600 => 'jam yang lalu',
                60 => 'menit yang lalu',
                1 => 'detik yang lalu'
            );

            foreach ($tokens as $unit => $text) {
                if ($time < $unit) continue;
                $numberOfUnits = floor($time / $unit);
                return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'':'');
            }

        }?>

    <div class="header   pb-6 bg-gradient-orange" >
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-12">  
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a  href="<?=base_url('pimpinan')?>" ><i class="fas fa-home"></i></a></li> 
                  <li class="breadcrumb-item active" aria-current="page"><a  href="<?=base_url('pimpinan/')?>" >Library Knowledge</a></li>
                  <li class="breadcrumb-item active" aria-current="page"><?=$knowledge->id_knowledge?></li>
                </ol>
              </nav>
            </div>  
          </div>
        </div>
        <?= $this->session->flashdata('msg2') ?>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row"> 
          <div class="card col-lg-12">
            <!-- Card header -->
            <div class="card-header border-0" style="padding-bottom: 0"><center>
              <h3 class="mb-0"><?=$knowledge->judul?></h3> 
            </div>  
            <!-- Light table --> 
            <br>
                
                <div class="col-xl-12 order-xl-1">
                  <form id="identifier" action="<?=base_url('pimpinan/knowledge/')?>" method="POST" enctype="multipart/form-data"> 
                    <div class="row">
                      <div class="col-lg-3">
                        <div class="form-group">
                            <label class="form-control-label" >Kategori</label><br>
                            <?=$knowledge->kategori?> 
                        </div> 
                      </div> 
                      <div class="col-lg-3">
                        <div class="form-group">
                            <label class="form-control-label" >Jenis</label><br>
                            <?=$knowledge->jenis?> 
                        </div> 
                      </div> 
                      
                       <div class="col-lg-3">
                        <div class="form-group">
                          <label class="form-control-label" >Tanggal Buat</label><br> 
                          <?=date('d-m-Y', strtotime($knowledge->tgl_buat))?>
                        </div>
                      </div> 
                      <div class="col-lg-3">
                        <div class="form-group">
                          <label class="form-control-label" >Dibuat Oleh</label><br> 
                          <?=$this->Pengguna_m->get_row(['id_pengguna' => $knowledge->id_pengguna])->nama?>
                        </div>
                      </div> 

                      <div class="col-lg-3">
                        <div class="form-group">
                          <label class="form-control-label" >Disukai </label><br> 
                          
                         <?=$this->Like_m->get_num_row(['id_knowledge' => $knowledge->id_knowledge])?> Pengguna
                        </div>
                      </div> 

                    <div class="col-lg-12">  
                        

                        <?php if ($knowledge->jenis == 'Tacit') { ?>
                          <div class="form-group">
                          <label class="form-control-label" >Knowledge : </label>  
                          <br>
                          <?=$knowledge->isi?>
                        </div>
                        <?php }else{ ?>
                          <div class="form-group">
                          <label class="form-control-label" >Knowledge : </label>  
                          <?php if ($knowledge->isi != NULL) { ?>
                            <object data="<?=base_url('assets/'.$knowledge->isi)?>" type="application/pdf" width="100%" height="500">
                              <p>Plugin penampil PDF tidak tersedia di browser Anda, <a href="<?=base_url('pengguna/downloadexplicit/'.$knowledge->id_knowledge)?>">Silahkan klik disini untuk mendownload file.</a></p>
                            </object> 
                          <?php  } ?>
                         
                        </div>
                        <div class="form-group">
                          <label class="form-control-label" >Keterangan : </label>  
                          <br>
                          <?=$knowledge->keterangan?>
                        </div>
                        <?php } ?> 

                      </div> 


                    
                  </div>
                
                    
                  </form>
                </div> 
               
          </div>


          <div class="card col-lg-12">
            <!-- Card header -->
            <div class="card-header">
              <!-- Title -->
              <h5 class="h3 mb-0">Komentar</h5>
            </div>
            <!-- Card body -->
            <div class="card-body p-0">
              <!-- List group -->
              <div class="list-group list-group-flush">
                
                <?php foreach ($list_komentar as $k) { ?> 
                <span   class="list-group-item list-group-item-action flex-column align-items-start py-4 px-4">
                  <div class="d-flex w-100 justify-content-between">
                    <div>
                      <div class="d-flex w-100 align-items-center"> 
                        <h5 class="mb-1"><?=$this->Pengguna_m->get_row(['id_pengguna' => $k->id_pengguna])->nama?> 

                      
                      </h5>
                      </div>
                    </div>
                    <small>
                      <?php 
                        echo humanTiming( strtotime($k->dt) ); 
                      ?>


                    </small>
                  </div> 
                  <p class="text-sm mb-0"><?=$k->komentar?>
                    
                
                  </p>

                  
                </span> 

                <?php } ?>

              </div>

                
              <?php if (sizeof($list_komentar) == 0) {
                    echo "<center><p style='margin-top:5px'>Tidak ada komentar.</p></center>";
                  }
                    ?>
            </div>
          </div>
         
      </div>
  
 </div>

 