    <!-- Header -->
    <!-- Header -->
    <div class="header   pb-6" style="background-color: blue">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7"> 
              <h6 class="h2 text-white d-inline-block mb-0">Kelola KM Team</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href=" href="<?=base_url('admin')?>"><i class="fas fa-home"></i></a></li> 
                  <li class="breadcrumb-item active" aria-current="page">Kelola KM Team</li>
                </ol>
              </nav>
            </div> 
            <div class="col-lg-6 col-5 text-right">
              <a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-sm btn-neutral">Tambah KM Team</a> 
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
              <h3 class="mb-0">Data KM Team</h3>
            </div>
            <!-- Light table -->

            <div class="table-responsive py-4">
              <table class="table table-flush" id="datatable-basic">
                <thead class="thead-light">
                  <tr>  
                    <th>ID KM Team</th>
                    <th>Nama</th>  
                    <th>Email</th>   
                    <th>Jenis Kelamin</th>  
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody class="list">

                 <?php $i = 1; foreach ($kmteam as $row): ?> 
                  <tr> 
                    <td>
                      <?=$row->id_kmteam?>
                    </td> 
                    <td>
                      <?=$row->nama?>
                    </td> 
                    <td>
                      <?=$row->email?>
                    </td>  
                    <td>
                      <?=$row->jk?>
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
        <h5 class="modal-title" id="exampleModalLabel">Form Tambah KM Team</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <?= form_open_multipart('admin/kmteam/') ?>
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
                <label for="example-email-input" class="form-control-label">ID KM Team</label>
                <input class="form-control" type="text" required name="id" >
            </div> 
            <div class="form-group">
                <label for="example-email-input" class="form-control-label">Nama</label>
                <input class="form-control" type="text" required name="nama" >
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
 
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="add" value="Submit"> 
      </div>
      </form>
    </div>
  </div>
</div>

<?php $i = 1; foreach ($kmteam as $row): ?> 
<div class="modal fade" id="edit-<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Edit KM Team</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <?= form_open_multipart('admin/kmteam/') ?>
      <div class="modal-body">
        
          <input type="hidden" required name="email_x"  value="<?=$row->email?>"> 
          <input type="hidden" required name="id_x"  value="<?=$row->id_kmteam?>"> 
          
             <div class="form-group">
                <label for="example-email-input" class="form-control-label">Email</label>
                <input class="form-control" type="email" required name="email" value="<?=$row->email?>">
            </div>  
            <div class="form-group">
                <label for="example-email-input" class="form-control-label">ID Karyawan</label>
                <input class="form-control" type="text" required name="id" value="<?=$row->id_kmteam?>">
            </div> 
            <div class="form-group">
                <label for="example-email-input" class="form-control-label">Nama</label>
                <input class="form-control" type="text" required name="nama" value="<?=$row->nama?>" >
            </div>  
            <div class="form-group">
                <label for="example-email-input" class="form-control-label">Jenis Kelamin</label>
                <div class="custom-control custom-radio mb-3">
                        <input class="custom-control-input" name="jk" value="Laki - Laki" id="customRadio5-<?=$row->id_kmteam?>" <?php if ($row->jk == 'Laki - Laki') { echo "checked";    } ?> type="radio">
                        <label class="custom-control-label" for="customRadio5-<?=$row->id_kmteam?>">Laki - Laki</label>
                      </div>
                      <div class="custom-control custom-radio mb-3">
                        <input class="custom-control-input" name="jk" value="Perempuan" id="customRadio6-<?=$row->id_kmteam?>" <?php if ($row->jk == 'Perempuan') { echo "checked";    } ?>  type="radio">
                        <label class="custom-control-label" for="customRadio6-<?=$row->id_kmteam?>">Perempuan</label>
                      </div>
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
 

<div class="modal fade" id="delete-<?=$i++?>" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-gradient-danger"> 
              
                  <div class="modal-body">
                    
                      <div class="py-3 text-center">
                          <i class="ni ni-bell-55 ni-3x"></i>
                          <h4 class="heading mt-4"> Hapus Data KM Team ini? </h4> 
                      </div>
                      
                  </div>
                  
                  <form action="<?= base_url('admin/kmteam')?>" method="Post" >  
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