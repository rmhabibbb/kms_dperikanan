    <!-- Header -->
    <!-- Header -->
    <div class="header   pb-6 bg-gradient-orange" >
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-12">  
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a  href="<?=base_url('pengguna')?>" ><i class="fas fa-home"></i></a></li> 
                  <li class="breadcrumb-item active" aria-current="page"><a  href="<?=base_url('pengguna/knowledge')?>" >Knowledge </a></li>
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
            <div class="card-header border-0">  
            </div>
            <!-- Light table --> 
            
                
                <div class="col-xl-12 order-xl-1">
                  <form id="identifier" action="<?=base_url('pengguna/knowledge/')?>" method="POST" enctype="multipart/form-data"> 
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

                    <div class="col-lg-12"> 
                        <input type="hidden" name="id" value="<?=$knowledge->id_knowledge?>">
                        <input type="hidden" name="jeniskm" value="<?=$knowledge->jenis?>">
                        <div class="form-group">

                          <label class="form-control-label" >Judul</label>
                          <input required type="text" class="form-control" id="judul" name="judul" value="<?=$knowledge->judul?>"> 
                        </div>

                        

                        <?php if ($knowledge->jenis == 'Tacit') { ?>
                          <div class="form-group">
                          <label class="form-control-label" >Knowledge</label>  
                            <textarea name="knowledge" class="form-control"  required><?=$knowledge->isi?></textarea>
                        </div>
                        <?php }else{ ?>
                          <div class="form-group">
                          <?php if ($knowledge->isi != NULL) { ?>
                             <object data="<?=base_url('assets/'.$knowledge->isi)?>" type="application/pdf" width="100%" height="500">
                              <p>Plugin penampil PDF tidak tersedia di browser Anda, <a href="<?=base_url('pengguna/downloadexplicit/'.$knowledge->id_knowledge)?>">Silahkan klik disini untuk mendownload file.</a></p>
                            </object> 
                          <?php  } ?>
                          <label class="form-control-label" >Knowledge (.pdf atau .doc)</label> 
                          <input  type="file" class="form-control" id="file" name="foto" > 
                        </div>

                        <div class="form-group">
                          <label class="form-control-label" >Keterangan</label>  
                            <textarea name="keterangan" class="form-control"  ><?=$knowledge->keterangan?></textarea>
                        </div>
                        <?php } ?> 

                      </div> 


                      <div class="col-lg-12">
                        <center> 
                          <a  href="#" data-toggle="modal" data-target="#delete" class="btn bg-danger text-white">
                          Hapus
                          </a>
                          <input type="submit" name="simpan" value="Simpan" class="btn bg-primary text-white"><br><br>
                        </center>
                      </div>
                  </div>
                
                    
                  </form>
                </div> 
               
          </div>

         
          <div class="card col-lg-12">
            <!-- Card header -->
            <div class="card-header border-0">  
            </div> 

              <a href="#" data-toggle="modal" data-target="#kirim" class="btn bg-primary text-white">Post Knowledge</a>

              <br>
            </div> 
          </div> 
      </div>
  
 </div>

 

<div class="modal fade" id="kirim" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
    <div class="modal-dialog modal-primar modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-gradient-success"> 
              
                  <div class="modal-body">
                    
                      <div class="py-3 text-center">
                          <i class="ni ni-bell-55 ni-3x text-white"></i>
                          <h4 class="heading mt-4 text-white"> Post Knowledge sekarang ?</h4> 
                      </div>
                      
                  </div>
                  
                  <form action="<?= base_url('pengguna/knowledge')?>" method="Post" >  
                  <div class="modal-footer">

                   
                      <input type="hidden" value="<?=$knowledge->id_knowledge?>" name="id">  
                      <input type="submit" class="btn btn-white" name="kirim" value="Post">
                     
                      <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Batal</button>
                  </div>
                </form>
          </div>
  </div>
</div>

<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
    <div class="modal-dialog modal-primar modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-gradient-danger"> 
              
                  <div class="modal-body">
                    
                      <div class="py-3 text-center">
                          <i class="ni ni-bell-55 ni-3x text-white"></i>
                          <h4 class="heading mt-4 text-white"> Hapus Knowledge ?</h4> 
                      </div>
                      
                  </div>
                  
                  <form action="<?= base_url('pengguna/knowledge')?>" method="Post" >  
                  <div class="modal-footer">

                   
                      <input type="hidden" value="<?=$knowledge->id_knowledge?>" name="id">  
                      <input type="submit" class="btn btn-white" name="delete" value="Hapus">
                     
                      <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Batal</button>
                  </div>
                </form>
          </div>
  </div>
</div>