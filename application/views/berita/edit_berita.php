<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>form berita</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blank Page</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">

<!-- Default box -->
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Update Berita</h3>

    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
        <i class="fas fa-minus"></i>
      </button>
      <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
        <i class="fas fa-times"></i>
      </button>
    </div>
  </div>
  <div class="box-body">
    <form action="<?= base_url(). ("index.php/berita/update/". $berita['idberita']);?>" method="post">
    <div class="box-body">
        <div class="form-group">
            <label for=" judul">Judul Berita</label>
            <input type="text" class="form-control" id="judul" value="<?= $berita['judul'];?>" placeholder="judul" name="judul" required>
        </div>
        <div class="form-group">
            <label for=" judul">kategori</label>
            <input type="text" class="form-control" id="kategori" value="<?= $berita['kategori'];?>" placeholder="kategori" name="kategori" required>
        </div>
        <div class="form-group">
            <label for=" judul">headline</label>
            <input type="text" class="form-control" id="headline" value="<?= $berita['headline'];?>" placeholder="headline" name="headline" required>
        </div>
        <div class="form-group">
            <label for="isi">Isi Berita</label>
            <textarea class="form-control summernote" id="isi_berita" name="isi_berita" placeholder="isi_berita" required><?= $berita['isi_berita'];?></textarea>
        </div>
        <div class="form-group">
            <label for="pengirim">pengirim</label>
            <input type="text" class="form-control" id="pengirim" value="<?= $berita['pengirim'];?>" placeholder="pengirim" name="pengirim" required> 
        </div>
        <div class="box-footer" >
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="<?= base_url('berita');?>" class="btn btn-secondary">Batal</a>
        </div>
    </form>
    </div>
    <div class="card-footer" >
    </div>
</div>
</section>
</div>