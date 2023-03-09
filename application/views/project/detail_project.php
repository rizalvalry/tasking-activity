<div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalAddLabel"></h5> 
                <input type="hidden" value="" name="id_project"/>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="container mt-2">
            <!-- nav -->
            <nav class="project">
                <div class="nav nav-tabs " id="nav-tab" role="tablist">
                    <a class="nav-item nav-link fade show active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">project</a>
                    <a class="nav-item nav-link" id="nav-jadwal-tab" data-toggle="tab" href="#nav-sched" role="tab" aria-controls="nav-sched" aria-selected="false">Jadwal</a>
                    <?php 
                    if($this->session->userdata('role_id') == 1) { ?>
                    <?php } else { ?>
                        <a class="nav-item nav-link" id="nav-bayar-tab" data-toggle="tab" href="#nav-deploy" role="tab" aria-controls="nav-deploy" aria-selected="false">Deploy Task</a>
                    <?php }?>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            
                
                <form action="#" id="formupdate" class="form-horizontal">
                    <input type="hidden" value="<?php echo $getdata->id_project;?>" name="id_project" id="id_project">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-6">Nama project</label>
                            <div class="col-md-9">
                                <input name="nama_project" id="nama_project" value="<?= $getdata->nama_project; ?>" class="form-control" type="text" <?php echo $this->session->userdata('role_id') != 1 ?  "readonly" : "" ?>>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Deadline</label>
                            <div class="col-md-9">
                                <input name="tanggal_mulai" value="<?= $getdata->jatuh_tempo; ?>" class="form-control" type="date" <?php echo $this->session->userdata('role_id') != 1 ?  "readonly" : "" ?>>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-6">Sisa Pengerjaan</label>
                            <div class="col-md-9">
                            <input name="sisa_pengerjaan" value="<?= $getdata->sisa_pengerjaan; ?>"  class="form-control" type="text" <?php echo $this->session->userdata('role_id') != 1 ?  "readonly" : "" ?>>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-6">Status</label>
                            <div class="col-md-9">

                            <select type="text" class="form-control" id="approved" name="status" placeholder="">
                            <option value="Unfinished" enable>Unfinished</option>
                            <option value="finished">finished</option>
                            </select>

                            
                            </div>
                        </div>
                        <?php 
                    if($this->session->userdata('role_id') == 1) { ?>
                        <button type="button" id="btnSave" onclick="saveup()" class="btn btn-primary">Simpan</button>
                        <?php } else { ?>
                            <a href="#" class="btn btn-secondary disabled" role="button" aria-disabled="true">Monitored</a>
                        <?php } ?>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="nav-sched" role="tabpanel" aria-labelledby="nav-jadwal-tab">
            <table class="table table-sm table-dark mt-3 border-primary">      
                <thead>       
                    <td>Project ke</td>
                    <td>Tanggal Start</td>
                    <td>Task diselesaikan</td>    
                    <td>Status</td>    
                </thead>   
                <?php
                if(isset($marks) && is_array($marks) && count($marks)): $i=1;
                foreach ($marks as $key => $data) { 
                ?>
            

                <tr <?= ($data['status_bayar'] == "Belum Bayar") ? "class='table-danger'" : "class='table-success'" ?>>
                    <td class="text-danger"><?php echo $data['cicilan_ke']; ?></td>
                    <td class="text-danger">-</td>
                    <td class="text-danger"><?php echo $data['jumlah_project']; ?></td>
                    <td class="text-danger"><?php echo $data['status_bayar']; ?></td>
                </tr>
                <?php 
            }
            endif;   
        ?>   
            </table> 
            </div>

            
            <div class="tab-pane fade" id="nav-deploy" role="tabpanel" aria-labelledby="nav-bayar-tab">
            <form action="<?php echo site_url('project/create');?>" method="POST">
            <input type="hidden" value="<?= $getdata->id_project; ?>" name="id_project"/>
                <div class="form-row">
                    <div class="form-group col-md-6">
                    <label for="inputEmail4">Tanggal Deploy</label>
                    <input type="text" class="form-control" name="tanggal_bayar" id="tanggal_bayar" placeholder="Tanggal" value="<?= date("Y-m-d H:i:s"); ?>" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputAddress">Admin Approval</label>
                    <select type="text" class="form-control" name="assign" id="approved" placeholder="">
                    <?php   
                        foreach($approval as $approved){         
                    ?>
                    <option value="<?php echo $approved->id ?>"><?php echo $approved->name ?></option>
                    <?php } ?>
                    </select>
                </div>
               
                <div class="form-row">
                    <div class="form-group col-md-6">
                    <label for="inputEmail4">Pengerjaan Timeline ke</label>
                    <select type="text" class="form-control" id="timeline" placeholder="" name="cicilan_ke">
                        <?php foreach( $countproject as $total ) : ?>
                            
                            <option value="<?php echo $total->cicilan_ke ?>"><?php echo $total->cicilan_ke ?></option>

                        <?php endforeach; ?>
                    </select>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Note*</label>
                    <div class="col-sm-10">
                    <textarea class="form-control" value="" name="note"></textarea>
                    </div>
                </div>
               
                <!-- <div class="form-group">
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck">
                    <label class="form-check-label" for="gridCheck">
                        Check me out
                    </label>
                    </div>
                </div> -->
             <?php if($buttonstatus == 0) { ?>
                <a href="#" class="btn btn-secondary disabled" role="button" aria-disabled="true">Closed</a>
             <?php } else { ?>
                    <button type="submit" class="btn btn-primary" aria-disabled="true">Simpan</button>
              <?php } ?> 
            </form>
            </div>
          
            </div>
<!-- end nav -->
</div>

        <div class="modal-footer">
                
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>