<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.1.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= base_url('aset/adminlte/plugins/jquery/jquery.min.js');?>"></script>
<script src="<?= base_url('aset/adminlte/plugins/jquery-ui/jquery-ui.min.js');?>"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('aset/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
<script src="<?= base_url('aset/adminlte/plugins/chart.js/chart.min.js')?>"></script>
<script src="<?= base_url('aset/adminlte/plugins/sparklines/sparkline.js')?>"></script>
<script src="<?= base_url('aset/adminlte/plugins/jqvmap/jquery.vmap.min.js')?>"></script>
<script src="<?= base_url('aset/adminlte/plugins/jqvmap/maps/jquery.vmap.usa.js')?>"></script>
<script src="<?= base_url('aset/adminlte/plugins/jquery-knob/jquery.knob.min.js')?>"></script>
<script src="<?= base_url('aset/adminlte/plugins/moment/moment.min.js')?>"></script>
<script src="<?= base_url('aset/adminlte/plugins/daterangepicker/daterangepicker.js')?>"></script>
<script src="<?= base_url('aset/adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')?>"></script>
<script src="<?= base_url('aset/adminlte/plugins/summernote/summernote-bs4.min.js')?>"></script>
<script src="<?= base_url('aset/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('aset/adminlte/dist/js/adminlte.min.js');?>"></script>
<script src="<?= base_url('aset/adminlte/dist/js/pages/dashboard.js');?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('aset/adminlte/dist/js/demo.js');?>"></script>
<script src="<?= base_url('aset/adminlte/plugins/datatables/jquery.dataTables.min.js');?>"></script>
<script src="<?= base_url('aset/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js');?>"></script>
<script src="<?= base_url('aset/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js');?>"></script>
<script src="<?= base_url('aset/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js');?>"></script>
<script src="<?= base_url('aset/adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js');?>"></script>
<script src="<?= base_url('aset/adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js');?>"></script>
<script src="<?= base_url('aset/adminlte/plugins/jszip/jszip.min.js');?>"></script>
<script src="<?= base_url('aset/adminlte/plugins/pdfmake/pdfmake.min.js');?>"></script>
<script src="<?= base_url('aset/adminlte/plugins/pdfmake/vfs_fonts.js');?>"></script>
<script src="<?= base_url('aset/adminlte/plugins/datatables-buttons/js/buttons.html5.min.js');?>"></script>
<script src="<?= base_url('aset/adminlte/plugins/datatables-buttons/js/buttons.print.min.js');?>"></script>
<script>
  $(document).ready(function() {
    $('#datatable').DataTable({
      "responsive": true,
      "autoWidth": true,
      buttons: [{
        extend: 'excelHtml5',
        className: 'btn btn-success btn-sm',
        title:  'Data Berita'
      },
      {
        extend: 'pdfHtml5',
        className: 'btn btn-danger btn-sm',
        title:  'Data Berita',
        orientation: 'landscape',
        pageSize: 'A4'
      },
      {
        extend: 'print',
        className: 'btn btn-info btn-sm',
        title:  'Data Berita'
      }
      ]
    }).buttons().container().appendTo('#datatable_wrapper .col-md-6:eq(0)');

    const $summernote = $('.summernote');
    $summernote.summernote({
      height: 300,
      toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'italic', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['insert', ['link', 'picture', 'video']],
        ['view', ['fullscreen', 'codeview', 'help']]
      ],
      callbacks: {
        onImageUpload: function(files) {
          for (let i = 0; i < files.length; i++) {
            uploadSummernoteImage(files[i]);
          }
        }
      }
    });

    function uploadSummernoteImage(file) {
      const data = new FormData();
      data.append('image', file);

      $.ajax({
        url: '<?= base_url("berita/upload_summernote_image"); ?>',
        type: 'POST',
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        success: function(responce) {
          try {
            const parsedResponse = JSON.parse(responce);
            if (parsedResponse && parsedResponse.url) {
              $summernote.sumernote('insertImage', parsedResponse.url);
            } else {
              console.error('Invalid response format or missing URL:', parsedResponse);
            }
          } catch (e) {
            console.error('Error parsing JSON response:', e);
            console.log('Raw response:', responce);
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.error('Image upload failed:', textStatus, errorThrown);
        }
      });
    }
  });
</script>
</body>
</html>