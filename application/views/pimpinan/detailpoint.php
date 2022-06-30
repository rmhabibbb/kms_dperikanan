    <!-- Header -->
    <!-- Header -->
    <div class="header   pb-6 bg-gradient-orange" >
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7"> 
              <h6 class="h2 text-white d-inline-block mb-0">Point Pengguna</h6>
             
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
              <h3 class="mb-0"><?=$pengguna->nama?> (Point : <?=$point?>)</h3>
            </div>
            <!-- Light table -->

            <div class="table-responsive py-4">
              <table class="table table-flush" id="datatable-buttons">
                <thead class="thead-light">
                  <tr>  
                    <th >No.</th>
                    <th >Point</th>   
                    <th >Tanggal</th>   
                    <th >Keterangan</th>   
                  </tr>
                </thead>
                <tbody class="list">

                 <?php $i = 1; foreach ($list_point as $row): ?> 
                  <tr> 
                    <td><?=$i++?></td>
                    <td style="white-space:normal" > <?=$row->point?> </td>    
                    <td> <?= date('d-m-Y H:i:s',strtotime($row->dt)) ?> </td> 
                    <td style="white-space:normal" > <?=$row->ket?> </td>    
                   
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div> 
          </div>
        </div>
      </div>
   