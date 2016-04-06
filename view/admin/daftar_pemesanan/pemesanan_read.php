
        <h2 style="margin-top:0px">Pemesanan Read</h2>
        <table class="table">
	    <tr><td>Pemesan</td><td><?php echo $pemesan; ?></td></tr>
	    <tr><td>Ruangan</td><td><?php echo $ruang; ?></td></tr>
	    <tr><td>Tanggal Mulai</td><td><?php echo $tanggal_mulai; ?></td></tr>
	    <tr><td>Tanggal Selesai</td><td><?php echo $tanggal_selesai; ?></td></tr>
	    <tr><td>Jam Mulai</td><td><?php echo $jam_mulai; ?></td></tr>
	    <tr><td>Jam Selesai</td><td><?php echo $jam_selesai; ?></td></tr>
	    <tr><td>Acara</td><td><?php echo $acara; ?></td></tr>
	    <tr><td>Ketua Acara</td><td><?php echo $ketua_acara; ?></td></tr>
	    <tr><td>Jumlah Peserta</td><td><?php echo $jumlah_peserta; ?></td></tr>
	    <tr><td>Status</td><td><?php echo form_dropdown('status' , $status_option,$status,' class="form-control" disabled'); ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('daftar_pemesanan') ?>" class="btn btn-default">Cancel</button></td></tr>
	</table>
