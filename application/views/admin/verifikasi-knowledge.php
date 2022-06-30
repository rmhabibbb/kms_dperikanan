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
                  <li class="breadcrumb-item"><a  href="<?=base_url('admin')?>" ><i class="fas fa-home"></i></a></li> 
                  <li class="breadcrumb-item active" aria-current="page"><a  href="<?=base_url('admin/')?>" >Library Knowledge</a></li>
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
                              <p>Plugin penampil PDF tidak tersedia di browser Anda, <a href="<?=base_url('admin/downloadexplicit/'.$knowledge->id_knowledge)?>">Silahkan klik disini untuk mendownload file.</a></p>
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
                
                  <hr>
                  <center>
                     
                <a href="#" data-toggle="modal" data-target="#tolak" class="btn bg-red text-white">Tolak</a>
                <a href="#" data-toggle="modal" data-target="#terima" class="btn bg-green text-white">Terima</a>
                  </center>
                  <br>
                </div> 
               
          </div> 
      </div>
  
 </div>



<div class="modal fade" id="tolak" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
    <div class="modal-dialog modal-primar modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-gradient-danger"> 
              
                  <div class="modal-body">
                    
                      <div class="py-3 text-center">
                          <i class="ni ni-bell-55 ni-3x text-white"></i>
                          <h4 class="heading mt-4 text-white"> Tolak knowledge ?</h4> 
                      </div>
                      
                  </div>
                  
                  <form action="<?= base_url('admin/verifikasi')?>" method="Post" >  
                  

                   
                      <input type="hidden" value="<?=$knowledge->id_knowledge?>" name="id">  

                      <table class="table table-bordered" style="max-height: 300px; color : white">

                              <tbody> 
                                  <tr>
                                       <th style="width: 30%">
                                          ID Knowledge
                                       </th>
                                       <td> 
                                          <?=$knowledge->id_knowledge?>
                                       </td>
                                   </tr>
                                   <tr>
                                       <th style="width: 30%">
                                          Judul
                                       </th>
                                       <td> 
                                          <?=$knowledge->judul?>
                                       </td>
                                   </tr> 
                                   <tr>
                                       <th style="width: 30%">
                                          Keterangan
                                       </th>
                                       <td> 
                                          <textarea class="form-control" name="keterangan" ></textarea>
                                       </td>
                                   </tr> 
                              </tbody>
                      </table> 
                      <div class="modal-footer">
                      <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Batal</button>
                      <input type="submit" class="btn bg-green text-white" name="tolak" value="Tolak">
                  </div>
                </form>
          </div>
  </div>
</div>


 <div class="modal fade" id="terima" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
    <div class="modal-dialog modal-primar modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-gradient-success"> 
              
                  <div class="modal-body">
                    
                      <div class="py-3 text-center">
                          <i class="ni ni-bell-55 ni-3x text-white"></i>
                          <h4 class="heading mt-4 text-white"> Terima Pengajuan knowledge ?</h4> 
                      </div>
                      
                  </div>
                  
                  <form action="<?= base_url('admin/verifikasi')?>" method="Post" >  
                  

                   
                      <input type="hidden" value="<?=$knowledge->id_knowledge?>" name="id">  

                      <table class="table table-bordered table-striped table-hover" style="max-height: 300px; color : white">

                              <tbody> 
                                  <tr>
                                       <th style="width: 30%">
                                          ID Pengajuan
                                       </th>
                                       <td> 
                                          <?=$knowledge->id_knowledge?>
                                       </td>
                                   </tr>
                                   <tr>
                                       <th style="width: 30%">
                                          Judul
                                       </th>
                                       <td> 
                                          <?=$knowledge->judul?>
                                       </td>
                                   </tr> 
                                    
                              </tbody>
                      </table> 
                      <div class="modal-footer">
                      <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Batal</button>
                      <input type="submit" class="btn bg-orange text-white" name="terima" value="Terima">
                  </div>
                </form>
          </div>
  </div>
</div>

 