    <!-- Header -->
    <!-- Header -->
    <div class="header   pb-6" style="background-color: blue">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7"> 
              <h6 class="h2 text-white d-inline-block mb-0">Library Knowledge</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a  href="<?=base_url('pimpinan')?>"><i class="fas fa-home"></i></a></li> 
                  <li class="breadcrumb-item active" aria-current="page">Library Knowledge</li>
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
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
              <h3 class="mb-0">Daftar Knowledge</h3>
            </div>
            <!-- Light table -->

            <div class="table-responsive py-4">
              <table class="table table-flush" id="datatable-basic">
                <thead class="thead-light">
                  <tr>  
                    <th >No.</th>
                    <th >Judul</th> 
                    <th >Kategori</th> 
                    <th >Jenis</th> 
                    <th >KM Team</th> 
                    <th >Tanggal Buat</th>  
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody class="list">

                 <?php $i = 1; foreach ($knowledge as $row): ?> 
                  <tr> 
                    <td><?=$i++?></td>
                    <td style="white-space:normal" > <?=$row->judul?> </td> 
                    <td> <?=$this->Kategori_m->get_row(['id_kategori' => $row->id_kategori])->nama_kategori?> </td> 
                    <td> <?=$row->jenis?> </td> 
                    <td> <?=$this->KMTeam_m->get_row(['id_kmteam ' => $row->id_kmteam ])->nama?> </td>
                    <td> <?= date('d-m-Y',strtotime($row->tgl_buat)) ?> </td> 
                    
                    <td class="text-right">
                      <a href="<?=base_url('pimpinan/knowledge/'.$row->id_knowledge)?>"  >
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
   
