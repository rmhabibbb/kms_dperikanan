    <!-- Header -->
    <!-- Header -->
    <div class="header   pb-6 bg-gradient-orange"  >
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7"> 
              <h6 class="h2 text-white d-inline-block mb-0">Kelola Pengguna</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href=" href="<?=base_url('admin')?>"><i class="fas fa-home"></i></a></li> 
                  <li class="breadcrumb-item active" aria-current="page">Kelola Pengguna</li>
                </ol>
              </nav>
            </div> 
            <div class="col-lg-6 col-5 text-right">
              <a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-sm btn-neutral">Tambah Pengguna</a> 
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
              <h3 class="mb-0">Data Pengguna</h3>
            </div>
            <!-- Light table -->

            <div class="table-responsive py-4">
              <table class="table" id="datatable-basic">
                <thead class="thead-light">
                  <tr>  
                    <th>ID Pengguna</th>
                    <th>Nama</th>  
                    <th>Email</th>  
                    <th>Jabatan</th>  
                    <th>Jenis Kelamin</th>  
                    <th>Alamat</th>    
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody class="list">

                 <?php $i = 1; foreach ($pengguna as $row): ?> 
                  <tr> 
                    <td>
                      <?=$row->id_pengguna?>
                    </td> 
                    <td>
                      <?=$row->nama?>
                      <br>
                       <a href="" data-toggle="modal" data-target="#trophy-<?=$i?>"> 
                          <span class="btn-inner--text">Trophy</span> 
                      </a>
                      |
                       <a href="" data-toggle="modal" data-target="#badge-<?=$i?>"> 
                          <span class="btn-inner--text">Badge</span> 
                      </a>
                      
                    </td> 
                    <td>
                      <?=$row->email?>
                    </td> 
                    <td>
                      <?=$row->jabatan?>
                    </td> 
                    <td>
                      <?=$row->jk?>
                    </td> 
                    <td style="white-space:normal">
                      <?=$row->alamat?>
                    </td>  
                    <td class="text-right"> 
                      <a href="" data-toggle="modal" data-target="#edit-<?=$i?>">
                        <button type="button" class="btn btn-twitter btn-icon"> 
                          <span class="btn-inner--text">Edit</span>
                        </button>
                      </a>
                      
                      <a href="" data-toggle="modal" data-target="#delete-<?=$i++?>">
                        <button type="button" class="btn btn-instagram btn-icon"> 
                          <span class="btn-inner--text">Delete</span>
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
  


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Tambah Pengguna</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <?= form_open_multipart('admin/pengguna/') ?>
      <div class="modal-body">
         
            <div class="form-group">
                <label for="example-email-input" class="form-control-label">Email</label>
                <input class="form-control" type="email" required name="email" >
            </div> 
            <div class="form-group">
                <label for="example-password-input" class="form-control-label">Password</label>
                <input class="form-control" type="password"  required name="password" id="example-password-input">
            </div> 
            <hr>
            <div class="form-group">
                <label for="example-email-input" class="form-control-label">ID Pengguna</label>
                <input class="form-control" type="text" required name="id" >
            </div> 
            <div class="form-group">
                <label for="example-email-input" class="form-control-label">Nama</label>
                <input class="form-control" type="text" required name="nama" >
            </div> 
            <div class="form-group">
                <label for="example-email-input" class="form-control-label">Jabatan</label>
                <input class="form-control" type="text" required name="jabatan" >
            </div>  
            <div class="form-group">
                <label for="example-email-input" class="form-control-label">Jenis Kelamin</label>
                <div class="custom-control custom-radio mb-3">
                        <input class="custom-control-input" name="jk" value="Laki - Laki" id="customRadio5" type="radio">
                        <label class="custom-control-label" for="customRadio5">Laki - Laki</label>
                      </div>
                      <div class="custom-control custom-radio mb-3">
                        <input class="custom-control-input" name="jk" value="Perempuan" id="customRadio6"  type="radio">
                        <label class="custom-control-label" for="customRadio6">Perempuan</label>
                      </div>
            </div>  

            <div class="form-group">
                <label for="example-email-input" class="form-control-label">Alamat</label>
                <textarea class="form-control" required name="alamat" ></textarea> 
            </div>  
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="add" value="Submit"> 
      </div>
      </form>
    </div>
  </div>
</div>

<?php $i = 1; foreach ($pengguna as $row): ?> 

<div class="modal fade" id="trophy-<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Trophy <?=$row->nama?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       
      <div class="modal-body">
         <?php 
            $list_trophy = $this->Point_m->get_trophy($row->id_pengguna);
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


<div class="modal fade" id="badge-<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Badge <?=$row->nama?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       
      <div class="modal-body">
         <center>
           <img src="<?=base_url('assets/badge/0.jpeg')?>" style="width: 72px">
           <?php   
           $point = $this->Point_m->get_point($row->id_pengguna);
           $like = $this->Like_m->get_num_row(['id_pengguna' => $row->id_pengguna]);
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



<div class="modal fade" id="edit-<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Edit Pengguna</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <?= form_open_multipart('admin/pengguna/') ?>
      <div class="modal-body">
        
          <input type="hidden" required name="email_x"  value="<?=$row->email?>"> 
          <input type="hidden" required name="id_x"  value="<?=$row->id_pengguna?>"> 
          
             <div class="form-group">
                <label for="example-email-input" class="form-control-label">Email</label>
                <input class="form-control" type="email" required name="email" value="<?=$row->email?>">
            </div>  
            <div class="form-group">
                <label for="example-email-input" class="form-control-label">ID Pengguna</label>
                <input class="form-control" type="text" required name="id" value="<?=$row->id_pengguna?>">
            </div> 
            <div class="form-group">
                <label for="example-email-input" class="form-control-label">Nama</label>
                <input class="form-control" type="text" required name="nama" value="<?=$row->nama?>" >
            </div> 
            <div class="form-group">
                <label for="example-email-input" class="form-control-label">Jabatan</label>
                <input class="form-control" type="text" required name="jabatan" value="<?=$row->jabatan?>">
            </div>  
            <div class="form-group">
                <label for="example-email-input" class="form-control-label">Jenis Kelamin</label>
                <div class="custom-control custom-radio mb-3">
                        <input class="custom-control-input" name="jk" value="Laki - Laki" id="customRadio5-<?=$row->id_pengguna?>" <?php if ($row->jk == 'Laki - Laki') { echo "checked";    } ?> type="radio">
                        <label class="custom-control-label" for="customRadio5-<?=$row->id_pengguna?>">Laki - Laki</label>
                      </div>
                      <div class="custom-control custom-radio mb-3">
                        <input class="custom-control-input" name="jk" value="Perempuan" id="customRadio6-<?=$row->id_pengguna?>" <?php if ($row->jk == 'Perempuan') { echo "checked";    } ?>  type="radio">
                        <label class="custom-control-label" for="customRadio6-<?=$row->id_pengguna?>">Perempuan</label>
                      </div>
            </div>  

            <div class="form-group">
                <label for="example-email-input" class="form-control-label">Alamat</label>
                <textarea class="form-control" required name="alamat" ><?=$row->alamat?></textarea> 
            </div>  
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="edit" value="Submit"> 
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="gp-<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Ganti Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <?= form_open_multipart('admin/pengguna/') ?>
      <div class="modal-body">
        
          <input type="hidden" required name="email"  value="<?=$row->email?>"> 
          
            <div class="form-group">
                <label for="example-email-input" class="form-control-label">Email</label>
                <input class="form-control" type="email" readonly   value="<?=$row->email?>">
            </div>   
            

            <div class="form-group">
                <label for="example-password-input" class="form-control-label">Password Baru</label>
                <input class="form-control" type="password"  required name="password" id="example-password-input">
            </div> 

            <div class="form-group">
                <label for="example-password-input" class="form-control-label">Konfirmasi Password</label>
                <input class="form-control" type="password"  required name="password2" id="example-password-input">
            </div> 

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="edit2" value="Submit"> 
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="delete-<?=$i++?>" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-gradient-danger"> 
              
                  <div class="modal-body">
                    
                      <div class="py-3 text-center">
                          <i class="ni ni-bell-55 ni-3x"></i>
                          <h4 class="heading mt-4"> Hapus Data Pengguna ini? </h4> 
                      </div>
                      
                  </div>
                  
                  <form action="<?= base_url('admin/Pengguna')?>" method="Post" >  
                  <div class="modal-footer">

                   
                      <input type="hidden" value="<?=$row->email?>" name="email">  
                      <input type="submit" class="btn btn-white" name="delete" value="Ya!">
                     
                      <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Close</button>
                  </div>
                </form>
          </div>
  </div>
</div>
<?php endforeach; ?>