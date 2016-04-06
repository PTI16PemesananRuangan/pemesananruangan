
        <h2 style="margin-top:0px">Pemesanan <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
                <label for="int">Pemesan <?php echo form_error('id_member') ?></label>
                 <?php echo form_dropdown('id_member' , $user_option,$id_member,' class="form-control" '); ?>

            </div>
	    <div class="form-group">
                <label for="int">Ruangan <?php echo form_error('id_ruangan') ?></label>
                 <?php echo form_dropdown('id_ruangan' , $ruang_option,$id_ruangan,' class="form-control" '); ?>
            </div>
	    <div class="form-group">
                <label for="date">Tanggal Mulai <?php echo form_error('tanggal_mulai') ?></label>
                <input id="tanggal_mulai" name="tanggal_mulai" readonly value="<?php echo $tanggal_mulai; ?>" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text">


                <!-- <input type="text" class="form-control" name="tanggal_mulai" id="tanggal_mulai" placeholder="tanggal_mulai" value="<?php echo $tanggal_mulai; ?>" /> -->
            </div>
	    <div class="form-group">
                <label for="date">Tanggal Selesai <?php echo form_error('tanggal_selesai') ?></label>
                 <input id="tanggal_selesai" name="tanggal_selesai" readonly  value="<?php echo $tanggal_selesai; ?>" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text">
            </div>
	    <div class="form-group">
                <label for="time">Jam Mulai <?php echo form_error('jam_mulai') ?></label>
                <input type="text" class="form-control" name="jam_mulai" id="jam_mulai" placeholder="jam_mulai" value="<?php echo $jam_mulai; ?>" />
            </div>
	    <div class="form-group">
                <label for="time">Jam Selesai <?php echo form_error('jam_selesai') ?></label>
                <input type="text" class="form-control" name="jam_selesai" id="jam_selesai" placeholder="jam_selesai" value="<?php echo $jam_selesai; ?>" />
            </div>
	    <div class="form-group">
                <label for="acara">Acara <?php echo form_error('acara') ?></label>
                <textarea class="form-control" rows="3" name="acara" id="acara" placeholder="acara"><?php echo $acara; ?></textarea>
            </div>
	    <div class="form-group">
                <label for="varchar">Ketua Acara <?php echo form_error('ketua_acara') ?></label>
                <input type="text" class="form-control" name="ketua_acara" id="ketua_acara" placeholder="ketua_acara" value="<?php echo $ketua_acara; ?>" />
            </div>
	    <div class="form-group">
                <label for="int">Jumlah Peserta <?php echo form_error('jumlah_peserta') ?></label>
                <input type="text" class="form-control" name="jumlah_peserta" id="jumlah_peserta" placeholder="jumlah_peserta" value="<?php echo $jumlah_peserta; ?>" />
            </div>
	    <div class="form-group">
                <label for="int">Status <?php echo form_error('status') ?></label>
                  <?php echo form_dropdown('status' , $status_option,$status,' class="form-control" '); ?>
            </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('daftar_pemesanan') ?>" class="btn btn-default">Cancel</a>
	</form>
      <script type="text/javascript">
                        $(document).ready(function () {
                            $('#tanggal_mulai').daterangepicker({
                                singleDatePicker: true,
                                calender_style: "picker_4",
                                 format: 'DD/MM/YYYY',
                            }, function (start, end, label) {
                                 console.log(start.toISOString(), end.toISOString(), label);
                            });

                            $('#tanggal_selesai').daterangepicker({
                                singleDatePicker: true,
                                calender_style: "picker_4",
                                format: 'DD/MM/YYYY',
                            }, function (start, end, label) {
                                console.log(start.toISOString(), end.toISOString(), label);
                            });
                        });
        </script>
