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
                <input type="hidden" name="id" value="<?php echo $item->id ?>">
                    <td><?php echo $no; ?></td>
                    <td><?php echo $item->nama_project ?></td>
                    <td><?php echo $item->tenor ?></td>
                    <td><?php echo $item->status ?></td>
                    <td><a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-primary" onclick="javascript:edit_project(<?php echo $item->id; ?>)" title="Detail"><i class="glyphicon glyphicon-pencil"></i> Detail Task</a></td>
                </tr>
                    <?php $no++; } ?>
                </table>
              </div>
            </div>
          </div>

</div>



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
            console.log(data);

            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_form_tambah').modal('hide');
                $('#modal_form').modal('hide');
                reload_table();
            }

            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            console.log(data);
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



function edit_project(id) {
    // save_method = 'update';
    // $('#form')[0].reset(); // reset form on modals
    // $('.form-group').removeClass('has-error'); // clear error class
    // $('.help-block').empty(); // clear error string
    // $('.project').show();
    
    // alert(id);

    //Ajax Load data from ajax
    $.ajax({
                type: "POST",
                url: "<?php echo site_url('project/ajax_edit');?>",
                data: "id="+id,
                success: function (data) {
                    // console.log(data);
                $(".displaycontent").html(data);

                  
                },
                error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
            });
}

function reload_table() {
    location.reload();
    // $('#postable').DataTable().ajax.reload()
    // table.ajax.reload(null,false); //reload datatable ajax
    // location.reload();
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

<div class="modal displaycontent" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <?php include('detail_project.php'); ?>
</div>

<!-- Modal tambah project -->
<div class="modal fade" id="modal_form_tambah" tabindex="-1" role="dialog" aria-labelledby="myModalAddLabel" aria-hidden="true">
    <?php include('tambah_project.php'); ?>
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



