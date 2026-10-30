  <script>
      function validasiFile(){
        var inputFile = document.getElementById('file');
        var pathFile = inputFile.value;
        var file_size = $('#file')[0].files[0].size;
        var ekstensiOk = /(\.jpg|\.jpeg|\.png)$/i;
        if(!ekstensiOk.exec(pathFile)){
            alert('Mohon maaf, file yang diperbolehkan untuk upload berformat .JPG / .JPEG / .PNG');
            inputFile.value = '';
            return false;
        }else if(file_size > 2000000){
            alert('Mohon maaf, file yang diperbolehkan untuk upload maksimal 2 Mb');
            inputFile.value = '';
            return false;
        }
      }

      function tampilkanPreview(gambar,idpreview){
          var gb = gambar.files;
          for (var i = 0; i < gb.length; i++){
              var gbPreview = gb[i];
              var imageType = /image.*/;
              var preview=document.getElementById(idpreview);            
              var reader = new FileReader();
              
              if (gbPreview.type.match(imageType)) {
                  preview.file = gbPreview;
                  reader.onload = (function(element) { 
                      return function(e) { 
                          element.src = e.target.result; 
                      }; 
                  })(preview);
                  reader.readAsDataURL(gbPreview);
              }else{
                  alert("Type file tidak sesuai. Khusus image.");
              }
          }    
      }
  </script>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-user-secret text-warning"></i> Profil Administrator
        <small><?= htmlspecialchars($record['nama_lengkap']) ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Profil Administrator</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <?php if($this->session->flashdata('sukses')){ ?>
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <p><center><?php echo $this->session->flashdata('sukses'); ?></center></p>
            </div>
          <?php }?>
          <?php if($this->session->flashdata('gagal')){ ?>
            <div class="alert alert-warning alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <p><center><?php echo $this->session->flashdata('gagal'); ?></center></p>
            </div>
          <?php }?>
          <div class="box box-primary" style="border-radius:8px;">
            <!-- /.box-header -->
            <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?= base_url('dashboard/update_administrator'); ?>">
            <div class="box-header with-border">
              <h3 class="box-title" style="font-weight:700;"><i class="fa fa-edit text-warning"></i> Pengaturan Akun Super Administrator</h3>
            </div>
            <div class="box-body" style="padding:24px;">
              <div class="col-md-3 col-sm-4 text-center">
                <div class="form-group" style="margin-bottom:15px;">
                  <div class="thumbnail" style="border-radius:8px; border:2px dashed #cbd5e1; padding:6px; background:#f8fafc;">
                    <img id="preview" style="width: 100%; max-height: 220px; object-fit: cover; border-radius:6px; display: block;" src="<?= base_url() ?>assets/foto/<?= !empty($record['foto']) ? $record['foto'] : 'user.png' ?>" alt="Foto Admin" />
                  </div>
                  <label class="btn btn-sm btn-default btn-block" style="border-radius:6px; cursor:pointer;">
                    <i class="fa fa-upload text-warning"></i> Pilih Foto Baru
                    <input type="file" style="display:none;" name="foto" accept="image/*" onchange="tampilkanPreview(this,'preview')">
                  </label>
                  <small class="text-muted d-block" style="margin-top:6px; font-size:11px;">Maks. 2MB (JPG, JPEG, PNG)</small>
                </div>
              </div>
              <div class="col-md-9 col-sm-8">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Nama Lengkap</label>
                  <div class="col-sm-9">
                    <input type="text" name="nama_lengkap" class="form-control" required="true" value="<?= htmlspecialchars($record['nama_lengkap']) ?>" style="border-radius:6px;">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Email Address</label>
                  <div class="col-sm-9">
                    <input type="email" class="form-control" required="true" name="email" value="<?= htmlspecialchars($record['email']) ?>" style="border-radius:6px;">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Password Baru</label>
                  <div class="col-sm-9">
                    <input type="password" class="form-control" name="password" placeholder="Kosongkan jika tidak ingin mengubah password" style="border-radius:6px;">
                    <small class="text-muted" style="font-size:11px;">Biarkan kosong jika tetap menggunakan password saat ini.</small>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Hak Akses</label>
                  <div class="col-sm-4">
                    <input type="text" readonly="true" class="form-control" name="hak_akses" value="<?= htmlspecialchars($record['hak_akses']) ?>" style="border-radius:6px; background:#f1f5f9;">
                  </div>
                  <label class="col-sm-2 control-label">Status Akun</label>
                  <div class="col-sm-3">
                    <input type="text" readonly="true" class="form-control" name="status" value="<?= htmlspecialchars($record['status']) ?>" style="border-radius:6px; background:#f1f5f9; color:#16a34a; font-weight:700;">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Terdaftar Sejak</label>
                  <div class="col-sm-9">
                    <input type="text" readonly="true" class="form-control" value="<?= date('d F Y', strtotime($record['tgl_daftar'])) ?>" style="border-radius:6px; background:#f1f5f9;">
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-right" style="padding:16px 24px; background:#f8fafc;">
              <button type="submit" class="btn btn-warning" style="font-weight:700; border-radius:6px; padding:8px 24px;">
                <i class="fa fa-save"></i> Simpan Perubahan Profil
              </button>
            </div>
            <!-- /.box-footer -->
          </form>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

