
        <h2 style="margin-top:0px">Pemesanan List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('daftar_pemesanan/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
           <!--  <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message"> -->
                    <?php /*echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; */?>
               <!--  </div>
            </div> -->
            <div class="col-md-8 text-right">
                <form action="<?php echo site_url('daftar_pemesanan/search'); ?>" class="form-inline" method="get">
                    <?php 
                        $option = array(
                            'u.name' => 'Pemesan',
                            'r.nama' => 'Nama Ruang',
                            'tanggal_mulai' => 'Tanggal Mulai',
                            'jam_mulai' => 'Jam Mulai',
                            'acara' => 'acara',
                        );
                       
                     ?>

                    <?php echo form_dropdown('kolom' , $option, $kolom ,' class="form-control" '); ?>
                    <input name="keyword" class="form-control" value="<?php echo $keyword; ?>" />
                    <?php 
                    if ($keyword <> '')
                    {
                        ?>
                        <a href="<?php echo site_url('daftar_pemesanan'); ?>" class="btn btn-default">Reset</a>
                        <?php
                    }
                    ?>
                    <input type="submit" value="Search" class="btn btn-primary" />
                </form>
            </div>
        </div>
        <table class="table table-striped responsive-utilities jambo_table bulk_action" style="margin-bottom: 10px">
            <thead>
            <tr class="headings">
                <th>No</th>
        		<th><a href="<?php echo $pemesan_order; ?>" style="color:#fff"> Pemesan</a></th>
        		<th><a href="<?php echo $ruang_order; ?>"  style="color:#fff">Ruangan</a> </th>
        		<th><a href="<?php echo $tanggal_order; ?>"  style="color:#fff">Tanggal Mulai</a> </th>
        		<th> <a href="<?php echo $jam_order; ?>"  style="color:#fff">Jam Mulai</a> </th>
        		<th><a href="<?php echo $acara_order; ?>"  style="color:#fff">acara</a> </th>
        		<th><a href="<?php echo $status_order; ?> "  style="color:#fff">status</a> </th>
        		<th>Action</th>
            </tr></thead>
            <?php
            foreach ($daftar_pemesanan_data as $daftar_pemesanan)
            {
                ?>
                <tr>
			<td><?php echo ++$start ?></td>
			<td><?php echo $daftar_pemesanan->pemesan ?></td>
			<td><?php echo $daftar_pemesanan->ruang ?></td>
			<td><?php echo date_formater($daftar_pemesanan->tanggal_mulai) ?></td>
			<td><?php echo $daftar_pemesanan->jam_mulai ?></td>
			<td><?php echo $daftar_pemesanan->acara ?></td>
			<td><?php echo getStatusByValue($daftar_pemesanan->status) ?></td>
			<td style="text-align:center">
				<?php 
				echo anchor(site_url('daftar_pemesanan/read/'.$daftar_pemesanan->id),'<i class="fa fa-eye"></i>'); 
				echo ' '; 
				echo anchor(site_url('daftar_pemesanan/update/'.$daftar_pemesanan->id),'<i class="fa fa-pencil"></i>'); 
				echo ' '; 
				echo anchor(site_url('daftar_pemesanan/delete/'.$daftar_pemesanan->id),'<i class="fa fa-eraser"></i>','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
