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
<script>
  $(function(){
    $('.summernote').summernote({
      height:300,
      toolbar:[
        ['style',['style']],
        ['font', ['bold','underline','italic','clear']],
        ['color',['color']],
        ['para',['ul','ol','paragraph']],
        ['table',['table']],
        ['insert',['link','picture','video']],
        ['view',['fullscreen','codeview','help']]
      ]
    });
  });
  </script>
</body>
</html>