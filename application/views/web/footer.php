<!-- begin #footer -->
  <div id="footer" class="footer">
      <!-- begin container -->
      <div class="container">
          <!-- begin row -->
          <div class="row">
              <!-- begin col-3 -->
              <div class="col-md-3 col-sm-3">
                  <!-- begin section-container -->
                  <div class="section-container">
                      <h4 class="footer-title">DAFTAR MENU</h4>
                      <ul class="categories">
                          <li><a href="">BERANDA</a></li>
                          <li><a href="javascript:;">PROFILE</a></li>
                          <li><a href="web/info_lowker.html">INFO LOWONGAN KERJA</a></li>
                          <li><a href="web/login.html">LOGIN</a></li>
                      </ul>
                  </div>
                  <!-- end section-container -->
              </div>
              <!-- end col-3 -->
              <?php
              $this->db->order_by('id_info_lowker', 'DESC');
              $this->db->limit(5);
        			$v_info = $this->db->get("tbl_info_lowker");
              ?>
              <!-- begin col-3 -->
              <div class="col-md-6 col-sm-3">
                  <!-- begin section-container -->
                  <div class="section-container">
                      <h4 class="footer-title">Info Lowongan Kerja</h4>
                      <ul class="recent-post">
                        <?php foreach ($v_info->result() as $key => $value): ?>
                          <li>
                              <h4>
                                  <a href="<?php echo $value->file; ?>" target="_blank"><?php echo ucwords($value->nama); ?></a>
                                  <span class="time"><?php echo $this->Mcrud->tgl_id(date('d-m-Y',strtotime($value->tgl_info_lowker)),'full'); ?></span>
                              </h4>
                          </li>
                        <?php endforeach; ?>
                      </ul>
                  </div>
                  <!-- end section-container -->
              </div>
              <!-- end col-3 -->
              <!-- begin col-3 -->
              <div class="col-md-3 col-sm-3">
                  <div class="section-container">
                      <h4 class="footer-title">Kontak Kami</h4>
                      <address>
                          <strong><?php echo $this->Mcrud->kontak('nama'); ?></strong>,<br />
                          <?php echo $this->Mcrud->kontak('alamat'); ?>
                          <br />
                          <br>
                          <strong><?php echo $this->Mcrud->kontak('no_hp'); ?></strong><br />
                          <a href="mailto:<?php echo $this->Mcrud->kontak('email'); ?>"><?php echo $this->Mcrud->kontak('email'); ?></a>
                      </address>
                  </div>
                  <!-- end section-container -->
              </div>
              <!-- end col-3 -->
          </div>
          <!-- end row -->
      </div>
      <!-- end container -->
  </div>
  <!-- end #footer -->
  <!-- begin #footer-copyright -->
  <div id="footer-copyright" class="footer-copyright">
      <!-- begin container -->
      <div class="container">
          <span class="copyright"><?php echo $this->Mcrud->footer(); ?></span>
          <ul class="social-media-list">
              <li><a href="<?php echo $this->Mcrud->sosmed('fb'); ?>"><i class="fa fa-facebook"></i></a></li>
              <li><a href="<?php echo $this->Mcrud->sosmed('gplus'); ?>"><i class="fa fa-google-plus"></i></a></li>
              <li><a href="<?php echo $this->Mcrud->sosmed('ig'); ?>"><i class="fa fa-instagram"></i></a></li>
              <li><a href="<?php echo $this->Mcrud->sosmed('twit'); ?>"><i class="fa fa-twitter"></i></a></li>
              <li><a href="<?php echo $this->Mcrud->sosmed('rss'); ?>"><i class="fa fa-rss"></i></a></li>
          </ul>
      </div>
      <!-- end container -->
  </div>
  <!-- end #footer-copyright -->

<!-- ================== BEGIN BASE JS ================== -->
<script src="assets/web/plugins/jquery/jquery-1.9.1.min.js"></script>
<script src="assets/web/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
<script src="assets/web/plugins/bootstrap/js/bootstrap.min.js"></script>
<!--[if lt IE 9]>
  <script src="assets/web/crossbrowserjs/html5shiv.js"></script>
  <script src="assets/web/crossbrowserjs/respond.min.js"></script>
  <script src="assets/web/crossbrowserjs/excanvas.min.js"></script>
<![endif]-->
<script src="assets/web/plugins/jquery-cookie/jquery.cookie.js"></script>

<script src="assets/panel/plugins/DataTables/media/js/jquery.dataTables.js"></script>
<script src="assets/panel/plugins/DataTables/media/js/dataTables.bootstrap.min.js"></script>
<script src="assets/panel/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/panel/js/table-manage-default.demo.min.js"></script>

<script src="assets/web/js/apps.min.js"></script>
<!-- ================== END BASE JS ================== -->

<script>
    $(document).ready(function() {
        App.init();
        TableManageDefault.init();
    });
</script>
</body>
</html>
