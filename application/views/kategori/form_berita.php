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
    <form action="<?php echo base_url(). "index.php/kategori/insert"; ?>" method="post">
    <div class="box-body">
        <div class="form-group">
            <label for=" judul">kategori</label>
            <input type="text" class="form-control" id="kategori" placeholder="kategori" name="kategori" required>
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