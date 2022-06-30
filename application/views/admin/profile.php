 <!-- Header -->
    <div class="header  pb-6 bg-gradient-orange"  >
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              
              <h6 class="h2 text-white d-inline-block mb-0">Profil Saya</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href=" href="<?=base_url('admin')?>"><i class="fas fa-home"></i></a></li> 
                  <li class="breadcrumb-item active" aria-current="page">My Profile</li>
                </ol>
              </nav>
            </div>
            
          </div> 
        </div>
        <?= $this->session->flashdata('msg2') ?>
      </div>
    </div>  

    <div class="container-fluid mt--6">
      <div class="row">
 
        <div class="col-xl-7 order-xl-1">
           
          <div class="card"> 
            <div class="card-body">
             
              <form action="<?=base_url('admin/profile/')?>" method="POST" id="formprofile">
                <div class="pl-lg-4">
                  <div class="row">

                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" >Email</label>
                        <input type="hidden" name="emailx" value="<?=$profil->email?>">
                        <input required type="email" class="form-control" id="email" name="email" value="<?=$profil->email?>">
                        <div id="pesan1_pgw" style="color: red; font-style: italic;"></div>
                      </div>
                    </div>  
                  </div>
                
                    

                    <div class="row">
                      <div class="col-lg-12">
                        <center> 
                          <input type="submit" name="save" value="Save" class="btn bg-primary text-white">
                        </center>
                      </div>
                    </div>
                </div> 
              </form>
              <hr>
              <a href="" data-toggle="modal" data-target="#edit-pw">Ganti Password</a>
            </div>
          </div>
        </div>
      </div> 
    </div>
 
<div class="modal fade" id="edit-pw" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Ganti Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      
      <form action="<?=base_url('admin/profile/')?>" method="POST" id="formgpw">
      <div class="modal-body">
          <div class="form-group">
                <label  class="form-control-label">Password Lama</label>
                <input required type="password" class="form-control" id="passwordold" name="passwordold">
                <div id="pesan2_pgw" style="color: red; font-style: italic;"></div>
          </div> 
          <div class="form-group">
                <label  class="form-control-label">Password Baru</label>
                <input required type="password" class="form-control" id="passwordnew" name="passwordnew">
                <div id="pesan3_pgw" style="color: red; font-style: italic;"></div>
          </div> 
          <div class="form-group">
                <label  class="form-control-label">Konfirmasi Password Baru</label>
                <input required type="password" class="form-control" id="passwordnew2" name="passwordnew2">
                <div id="pesan4_pgw" style="color: red; font-style: italic;"></div>
          </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="gpw" value="Save"> 
      </div>
      </form>
    </div>
  </div>
</div>

