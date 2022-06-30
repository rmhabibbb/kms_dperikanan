    <!-- Header -->
    <!-- Header -->
    <div class="header   pb-6 bg-gradient-orange" >
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7"> 
              <h6 class="h2 text-white d-inline-block mb-0">Knowledge yang Disukai</h6>
             
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
           
            <!-- Light table -->

             <div class="table-responsive py-4">
              <table class="table table-flush" id="datatable-basic">
                <thead class="thead-light">
                  <tr>  
                    <th >No.</th>
                    <th >Judul</th>  
                    <th >Kategori</th> 
                    <th >Jenis</th> 
                    <th >Pengguna</th> 
                    <th >Tanggal Buat</th>  
                    <th >Jumlah Suka</th> 
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody class="list">

                 <?php $i = 1; foreach ($list_knowledge as $row): ?> 
                 <?php $kms  = $this->Knowledge_m->get_row(['id_knowledge' => $row->id_knowledge]) ?>
                  <tr> 
                    <td><?=$i++?></td>
                    <td style="white-space:normal" > <?=$kms->judul?> </td>  
                    <td style="white-space:normal" > <?=$kms->kategori?> </td>  
                    <td> <?=$kms->jenis?> </td> 
                    <td> <?=$this->Pengguna_m->get_row(['id_pengguna ' => $kms->id_pengguna ])->nama?> </td>
                    <td> <?= date('d-m-Y',strtotime($kms->tgl_buat)) ?> </td> 
                    <td><?=$this->Like_m->get_num_row(['id_knowledge' => $kms->id_knowledge])?></td>
                    <td class="text-right">
                      <a href="<?=base_url('pengguna/id/'.$kms->id_knowledge)?>"  >
                        <button type="button" class="btn btn-twitter btn-icon"> 
                          <span class="btn-inner--text">Lihat</span>
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
   