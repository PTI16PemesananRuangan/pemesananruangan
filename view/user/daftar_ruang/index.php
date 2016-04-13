<div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3> Daftar Ruang </h3>
                        </div>

                        <div class="title_right">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                <div class="input-group">
                                <form method="get" action ="<?php echo base_url('daftar_ruang/search') ?>" >
                                    <input type="text" name="txtsearch" value="<?php echo $search ?>" class="form-control" placeholder="Search for...">
                                    <span class="input-group-btn">
                                        <input class="btn btn-default" type="submit" value="Find">
                                    </span>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <div class="col-md-8 col-sm-7 col-xs-6 text-right">
                                        <h2>Daftar Ruang </h2>
                                    </div>
                                     <div class="">
                                     <div class="col-md-4 col-sm-5 col-xs-6 form-group pull-right top_search">
                                      <div class="input-group">
                                     <form method="get" class="form-inline" action="<?php echo base_url('daftar_ruang') ?>">
                                         <?php echo form_dropdown('id_kampus' , $kampus_option,$id_kampus,' class="form-control" onchange="" '); ?>
                                           <span class="input-group-btn">
                                          <input class="btn btn-default" type="submit" value="Find">
                                          </span>
                                     </form>   
                                     </div>
                                    </div>
                                    </div> 
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                   

                                    <div class="clearfix"></div>
                                    <div class="row">
                                        <p>Daftar Ruang yang tersedia</p>
                                       
                                        <?php 
                                            foreach ($daftar_ruang as $key => $ruang) {
                                        ?>
                                            <div class="col-md-55">
                                            <div class="thumbnail">
                                                <div class="image view view-first">
                                                    <a href="<?php echo base_url('daftar_ruang/detail/'.$ruang->id) ?>">
                                                        <img style="width: 100%; display: block;" src="<?php echo base_url('upload/'.$ruang->foto )?>" alt="image" />    
                                                    </a>
                                                    
                                                </div>
                                                <div class="caption">
                                                    <p><?php echo $ruang->nama ?></p>
                                                    <p>Kampus : <?php echo $kampus_option[$ruang->id_kampus] ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                            }
                                         ?>
                      
                                    </div>
                                    <div class="col-md-6 text-right">
                                            <?php echo $pagination ?>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                // var url = '"'+ <?php echo base_url('daftar_ruang'); ?> +'"' ;
                // var submit;
                // $(document).ready(function(){
                //     submit = function(){
                //         window.location('localhost/sip/daftar_ruang');
                //     }
                // });

                </script>