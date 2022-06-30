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
           
            <!-- Light table -->

           <div class="card-body">
            <form action="<?=base_url('pimpinan/point')?>" method="post">
              <div class="pl-lg-2">
                  <div class="row"> 
                    <div class="col-lg-3">
                      <?php if ($bulan) { ?>
                        <input type="number" name="bulan" min="1" max="12" placeholder="Bulan" class="form-control" value="<?=$bulan?>"> 
                      <?php }else { ?> 
                        <input type="number" name="bulan" min="1" max="12" placeholder="Bulan" class="form-control" value="<?=date('m')?>"> 
                      <?php } ?>
                      
                    </div>
                     <div class="col-lg-3">

                      <?php if ($tahun) { ?>
                      <input type="number" name="tahun" min="2000" max="<?=date('Y')?>" value="<?=$tahun?>" placeholder="Tahun" class="form-control"> 
                      <?php }else { ?> 
                      <input type="number" name="tahun" min="2000" max="<?=date('Y')?>" value="<?=date('Y')?>" placeholder="Tahun" class="form-control"> 
                      <?php } ?>
                      
                    </div>

                    <div class="col-lg-3">
                      <input type="submit" name="cari"  class="btn bg-gradient-orange text-white" value="Cari"> 
                    </div>
                    

                  </div>
                </div>
            </form>
              <div class="table-responsive py-4">
              <table class="table table-flush" id="datatable-buttons">
                <thead class="thead-light">
                  <tr>  
                    <th >No.</th> 
                    <th >Nama Pengguna</th>
                    <th >Point</th>      
                    <th >Aksi</th>   
                  </tr>
                </thead>
                <tbody class="list">

                 <?php $i = 1; foreach ($list_pengguna as $row): ?> 
                  <tr> 
                    <td><?=$i?></td>
                    <td style="white-space:normal" > <?=$row['nama']?> 
                    <br>
                       <a href="" data-toggle="modal" data-target="#trophy-<?=$i?>"> 
                          <span class="btn-inner--text">Trophy</span> 
                      </a>
                      |
                       <a href="" data-toggle="modal" data-target="#badge-<?=$i++?>"> 
                          <span class="btn-inner--text">Badge</span> 
                      </a>
                  </td>     
                    <td style="white-space:normal" > <?=$row['point']?> </td>      
                     <td>
                       <a href="<?=base_url('pimpinan/point/'.$row['id'])?>"  >
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
      </div>
   


<?php $i = 1; foreach ($list_pengguna as $row): ?> 

<div class="modal fade" id="trophy-<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Trophy <?=$row['nama']?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       
      <div class="modal-body">
         <?php 
            $list_trophy = $this->Point_m->get_trophy($row['id']);
         ?>

         
            <div class="table-responsive py-4">
              <table class="table" id="datatable-basic">
                 <thead>
                   <th style="width: 10%">No.</th>
                   <th>Trophy</th>
                   <th>Keterangan</th>
                 </thead>
                 <tbody>
                   <?php if (sizeof($list_trophy) == 0) {
                     echo "<td colspan='3'><center>Tidak ada trophy</center></td>";
                   }else {
                    ?>

                    <?php $x = 1; foreach ($list_trophy as $t): ?> 

                     <tr>
                       <td style="vertical-align: middle;">
                         <?=$x++?>
                       </td>
                       <td>
                         <?php if ($t['rank'] == 1) {  ?>  
                          <img src="<?=base_url('assets/trophy/1.png')?>" style="width: 64px; margin : 0 10px">
                        <?php  }  ?>
                         <?php if ($t['rank'] == 2) {  ?>  
                          <img src="<?=base_url('assets/trophy/2.png')?>" style="width: 64px; margin : 0 10px">
                        <?php  }  ?>
                       </td>
                       <td style="vertical-align: middle;">
                         Rank <?=$t['rank']?>, periode <?=$t['bulan']?>/<?=$t['tahun']?>
                       </td>
                     </tr>
                     


                   <?php endforeach; ?>

                   <?php } ?>
                 </tbody>
               </table>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
      </div>
      </form>
    </div>
  </div>
</div>


<div class="modal fade" id="badge-<?=$i++?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Badge <?=$row['nama']?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       
      <div class="modal-body">
         <center>
           <img src="<?=base_url('assets/badge/0.jpeg')?>" style="width: 72px">
           <?php   
           $point = $this->Point_m->get_point($row['id']);
           $like = $this->Like_m->get_num_row(['id_pengguna' => $row['id']]);
              if ($point >= 50) {
            ?> <img src="<?=base_url('assets/badge/p1.jpeg')?>" style="width: 72px; margin : 0 10px">
            <?php  }  ?>
            <?php   
              if ($point >= 100) {
            ?> <img src="<?=base_url('assets/badge/p2.jpeg')?>" style="width: 72px; margin : 0 10px">
            <?php  }  ?>
            <?php    
              if ($point >= 150) {
            ?> <img src="<?=base_url('assets/badge/p3.jpeg')?>" style="width: 72px; margin : 0 10px">
            <?php  }  ?>
            <?php  if ($point >= 200) {
            ?> <img src="<?=base_url('assets/badge/p4.jpeg')?>" style="width: 72px; margin : 0 10px">
            <?php  }  ?>
             <?php  if ($like >= 10) {
            ?> <img src="<?=base_url('assets/badge/l1.jpeg')?>" style="width: 72px; margin : 0 10px">
            <?php  }  ?>
             <?php  if ($like >= 20) {
            ?> <img src="<?=base_url('assets/badge/l2.jpeg')?>" style="width: 72px; margin : 0 10px">
            <?php  }  ?>


         </center>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
      </div>
      </form>
    </div>
  </div>
</div> 
 
<?php endforeach; ?>