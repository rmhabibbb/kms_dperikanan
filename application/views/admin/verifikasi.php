    <!-- Header -->
    <!-- Header -->
    <div class="header   pb-6 bg-gradient-orange" >
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7"> 
              <h6 class="h2 text-white d-inline-block mb-0">Verifikasi Knowledge</h6>
             
            </div> 

             
          </div>
        </div>
        <?= $this->session->flashdata('msg2') ?>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
              <h3 class="mb-0">Verifikasi Knowledge</h3>
            </div>
            <!-- Light table -->

            <div class="table-responsive py-4">
              <table class="table table-flush" id="datatable-basic">
                <thead class="thead-light">
                  <tr>  
                    <th>No.</th>
                    <th>Judul</th>  
                    <th>Kategori</th> 
                    <th>Jenis</th> 
                    <th>Pengguna</th> 
                    <th>Tanggal Buat</th>   
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody class="list">

                 <?php $i = 1; foreach ($list_knowledge as $row): ?> 
                  <tr> 
                    <td><?=$i?></td>
                    <td style="white-space:normal" > <?=$row->judul?> </td>  
                    <td style="white-space:normal" > <?=$row->kategori?> </td>  
                    <td> <?=$row->jenis?> </td> 
                    <td> <?=$this->Pengguna_m->get_row(['id_pengguna ' => $row->id_pengguna ])->nama?> </td>
                    <td> <?= date('d-m-Y',strtotime($row->tgl_buat)) ?> </td>  
                    <td class="text-right">
                      <a href="<?=base_url('admin/verifikasi/'.$row->id_knowledge)?>"  >
                        <button type="button" class="btn btn-twitter btn-icon"> 
                          <span class="btn-inner--text">Verifikasi</span>
                        </button>
                      </a>  
                    </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div> 
          </div>
        </div>
      </div>
   


<?php $i = 1; foreach ($list_knowledge as $row): ?> 
 
<div class="modal fade" id="delete-<?=$i++?>" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-gradient-danger"> 
              
                  <div class="modal-body">
                    
                      <div class="py-3 text-center">
                          <i class="ni ni-bell-55 ni-3x"></i>
                          <h4 class="heading mt-4"> Hapus Knowledge ini? </h4> 
                      </div>
                      
                  </div>
                  
                  <form action="<?= base_url('admin/knowledge')?>" method="Post" >  
                  <div class="modal-footer">

                   
                      <input type="hidden" value="<?=$row->id_knowledge?>" name="id_knowledge">  
                      <input type="submit" class="btn btn-white" name="delete" value="Ya!">
                     
                      <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Close</button>
                  </div>
                </form>
          </div>
  </div>
</div>
<?php endforeach; ?>