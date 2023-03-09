
<!-- Datatables Product -->
<script type="text/javascript">

var save_method; //for save method string
var table;

function saveup() {
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable
    var url;
 
    url = "<?php echo site_url('project/ajax_update') ?>";
    

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#formupdate').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.response) //if success close modal and reload ajax table
            {
                $('#modal_form').modal('hide');
                reload_table();
            }

            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable

        }
    });
}

function save() {
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable
    var url;

    if(save_method == 'add') {
        url = "<?php echo site_url('project/ajax_add') ?>";
    }

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_form_tambah').modal('hide');
                $('#modal_form').modal('hide');
                // reload_table();
            }

            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable

        }
    });
}


function add_product()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form_tambah').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambah project'); // Set Title to Bootstrap modal title
    $('.project').hide(); // Set Title to Bootstrap modal title

}



function edit_project(id_project) {
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('.project').show();
    
    // alert(id_project);

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('project/ajax_edit') ?>/" + id_project,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            console.log(data.data_deploy);
            

            $('[name="id_project"]').val(data.data.id_project);
            $('[name="nama_project"]').val(data.data.nama_project);
            $('[name="tanggal_mulai"]').val(data.data.tanggal_mulai);
            $('[name="sisa_pengerjaan"]').val(data.data.sisa_pengerjaan);
            var nValue = $('[name="status"]').val(data.data.status);
            if( nValue != " " ) {
                $("#n").prop("readonly",true);
            }
            
            var trHTML = '';
            trHTML += '<table class="table table-sm table-dark mt-3 border-primary"><thead> <td>Pengerjaan ke</td> <td>Tanggal Start Task</td> <td>Jumlah Resource Digunakan</td> <td>Status</td> </thead>';
            $.each(data.data_detail, function(i, item) {
                // console.log(item.tanggal_bayar);
                var status_jelas = (item.status_bayar === "Unfinished") ? "table-danger" : "table-success"; 
            // console.log(status_jelas);
                trHTML += '<tr class="'+status_jelas+'" style="color:black;">' + '<td>' + item.cicilan_ke + '</td><td>' + item.tanggal_bayar + '</td><td>' + item.jumlah_project + '</td><td>' + item.status_bayar + '</td></tr>';
                // console.log(trHTML);
            });
            trHTML += '</table>';
            $('#nav-sched').html(trHTML);

            var dropDown = '';
            $.each(data.data_deploy, function(i, item) {
            // console.log(item.cicilan_ke);

            dropDown += '<option>' + item.cicilan_ke + '</option>';
                // console.log(trHTML);
            });
            $('#timeline').html(dropDown);

            
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Detail project'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function reload_table() {
    table.ajax.reload(null,false); //reload datatable ajax
    location.reload();
}

function delete_project(id) {
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('product/ajax_delete') ?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

    }
}
</script>

<div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800"><?=$title;?></h1>
          <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the 
          <!-- <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addNewModal">Add New Package</button> -->
          <br/>.</p>
            <?=$this->session->flashdata('message');?>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
                <?php 
                // if($cekproject > 0) {
                    ?>
                <!-- <a href="#" class="btn btn-secondary disabled" role="button" aria-disabled="true">Closed</a> -->
                <?php 
            // } else { 
                ?>
              <button class="m-0 font-weight-bold btn btn-primary float-right tombolTambahData" onclick="add_product()">Tambah <?=$title;?></button>
                <?php 
            // }
             ?>

            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="postable" class="table table-bordered" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama project</th>
                      <th>Durasi/Bulan</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                </thead>
                <?php 
                $no = 1;
                foreach($statuscicil as $item) { 
                ?>
                    <tr>
                <input type="hidden" name="id_project" value="<?php echo $item->id_project ?>">
                    <td><?php echo $no; ?></td>
                    <td><?php echo $item->nama_project ?></td>
                    <td><?php echo $item->tenor ?></td>
                    <td><?php echo $item->status ?></td>
                    <td><a class="btn btn-sm btn-primary" href="javascript:void(0)" onclick="edit_project(<?php echo $item->id_project; ?>)" title="Detail"><i class="glyphicon glyphicon-pencil"></i> Detail Task</a></td>
                </tr>
                    <?php $no++; } ?>
                </table>
              </div>
            </div>
          </div>

</div>
<!-- /.container-fluid -->
<!-- Modal tambah project -->
<div class="modal fade" id="modal_form_tambah" tabindex="-1" role="dialog" aria-labelledby="myModalAddLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalAddLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" id="form" class="form-horizontal">
            <input type="hidden" value="" name="id_project"/>
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-6">Nama project</label>
                            <div class="col-md-12">
                                <input name="nama_project" placeholder="project" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="control-label col-md-3">Tanggal Mulai</label>
                            <div class="col-md-9">
                                <input name="tanggal_mulai" placeholder="Title" class="form-control" type="date">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="seeAnotherFieldGroup">Status</label>
                            <select class="form-control" name="status" id="seeAnotherFieldGroup">
                                <option value="Done">Done</option>
                                <option value="Unfinished">Unfinished</option>
                            </select>
                        </div>

                        <div class="form-group m-2" id="otherFieldGroupDiv">
                            <div class="row">
                            <div class="form-group col-md-4">
                                <label for="otherField1">Durasi Pengerjaan</label>
                                <select class="form-control" name="cicilan_ke" id="seeAnotherFieldGroup">
                                <?php foreach($tempo as $row){ ?>
                                    <option value="<?php echo $row->tempo ?>"> <?php echo ($row->tempo) ?></option>
                                <?php } ?>
                            </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="otherField2">Sisa Pengerjaan</label>
                                <input type="text" name="sisa_pengerjaan" class="form-control w-100" id="otherField2">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="otherField2">Jatuh Tempo</label>
                                <input type="date" name="jatuh_tempo" class="form-control w-100" id="otherField2">
                            </div>
                            </div>
                        </div>

                        <div class="form-group col-md-8">
                                <label for="otherField2">Jumlah resource project</label>
                                <input type="text" name="jumlah_project" class="form-control w-100" id="otherField2">
                        </div>

                    </div>
                </form>
        <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div> 
<!-- end modal tambah project -->

<script>
$("#seeAnotherField").change(function() {
  if ($(this).val() == "Unfinished") {
    $('#otherFieldDiv').show();
    $('#otherField').attr('required', '');
    $('#otherField').attr('data-error', 'This field is required.');
  } else {
    $('#otherFieldDiv').hide();
    $('#otherField').removeAttr('required');
    $('#otherField').removeAttr('data-error');
  }
});
$("#seeAnotherField").trigger("change");

$("#seeAnotherFieldGroup").change(function() {
  if ($(this).val() == "Unfinished") {
    $('#otherFieldGroupDiv').show();
    $('#otherField1').attr('required', '');
    $('#otherField1').attr('data-error', 'This field is required.');
    $('#otherField2').attr('required', '');
    $('#otherField2').attr('data-error', 'This field is required.');
  } else {
    $('#otherFieldGroupDiv').hide();
    $('#otherField1').removeAttr('required');
    $('#otherField1').removeAttr('data-error');
    $('#otherField2').removeAttr('required');
    $('#otherField2').removeAttr('data-error');
  }
});
$("#seeAnotherFieldGroup").trigger("change");
</script>


<!-- Modal detail project -->
<div class="modal fade bd-example-modal-lg" id="modal_form" tabindex="-1" role="dialog" aria-labelledby="myModalAddLabel" aria-hidden="true">
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
                    <input type="hidden" value="" name="id_project" id="id_project" />
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-6">Nama project</label>
                            <div class="col-md-9">
                                <input name="nama_project" id="nama_project" placeholder="project" class="form-control" type="text" <?php echo $this->session->userdata('role_id') != 1 ?  "readonly" : "" ?>>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Tanggal</label>
                            <div class="col-md-9">
                                <input name="tanggal_mulai" placeholder="Title" class="form-control" type="date" <?php echo $this->session->userdata('role_id') != 1 ?  "readonly" : "" ?>>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-6">Sisa Pengerjaan di Awal</label>
                            <div class="col-md-9">
                            <input name="sisa_pengerjaan" placeholder="Durasi Pengerjaan" class="form-control" type="text" <?php echo $this->session->userdata('role_id') != 1 ?  "readonly" : "" ?>>
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
            
            </div>

            
            <div class="tab-pane fade" id="nav-deploy" role="tabpanel" aria-labelledby="nav-bayar-tab">
            <form action="<?php echo site_url('project/create');?>" method="POST">
            <input type="text" value="" name="id_project"/>
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
                    
                    </select>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Note*</label>
                    <div class="col-sm-10">
                    <textarea class="form-control" value="" name="note"></textarea>
                    </div>
                </div>
               
                <div class="form-group">
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck">
                    <label class="form-check-label" for="gridCheck">
                        Check me out
                    </label>
                    </div>
                </div>
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
</div>
<!-- end modal -->

