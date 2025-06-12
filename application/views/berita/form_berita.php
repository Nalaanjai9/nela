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
    <h3 class="card-title">Form Berita</h3>

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
    <form action="<?php echo base_url(). "index.php/berita/insert"; ?>" method="post">
    <div class="box-body">
        <div class="form-group">
            <label for=" judul">Judul Berita</label>
            <input type="text" class="form-control" id="judul" placeholder="judul" name="judul" required>
        </div>
        <div class="form-group">
            <label for=" judul">kategori</label>
            <select class="form-control" id="kategori" name="kategori" required>
                <option value="">Pilih Kategori</option>
                <?php if (!empty($kategori_berita));?>
                <?php foreach ($kategori_berita as $k)  {?>
                <option value="<?php echo $k->idberita;?>"><?php echo $k->kategori;?></option>
                <?php }?>
            </select>
        </div>
        <div class="form-group">
            <label for=" judul">headline</label>
            <input type="text" class="form-control" id="headline" placeholder="headline" name="headline" required>
        </div>
        <div class="form-group">
            <label for="isi">Isi Berita</label>
            <textarea class="form-control summernote" id="isi_berita" name="isi_berita" placeholder="isi_berita" required></textarea>
        </div>
        <div class="form-group">
            <label for="pengirim">pengirim</label>
            <input type="text" class="form-control" id="pengirim" placeholder="pengirim" name="pengirim" required> 
        </div>
        <div class="box-footer" >
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
    </div>
    <div class="card-footer" >
    </div>
</div>
</section>
</div>