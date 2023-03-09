<div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>
          <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>
            <?= $this->session->flashdata('message'); ?>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <button class="m-0 font-weight-bold btn btn-primary float-right tombolTambahData" onclick="add_product()">Tambah <?= $title; ?></button>
              
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="table" class="table table-bordered" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Slug</th>
                      <th>Title</th>
                      <th>Description</th>
                      <th>Price</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <!-- <tbody>
                    <?php $no = 1;
                    foreach($row->result() as $key => $data) :
                    ?>
                    <tr>
                      <th><?= $no++; ?></th>
                      <th><?= $data->slug ?></th>
                      <th><?= $data->title ?></th>
                      <th><?= $data->description ?></th>
                      <th><?= $data->price ?></th>
                    </tr>
                    <?php endforeach; ?>
                  </tbody> -->
                </table>
              </div>
            </div>
          </div>

</div>
<!-- /.container-fluid -->



<!-- Datatables Product -->
<script type="text/javascript">

var save_method; //for save method string
var table;

$(document).ready(function() {
//datatables
    table = $('#table').DataTable({ 

    "processing": true, //Feature control the processing indicator.
    "serverSide": true, //Feature control DataTables' server-side processing mode.
    "order": [], //Initial no order.
    "language": {
            "processing": '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
            },
    // Load data for the table's content from an Ajax source
    "ajax": {
        "url": "<?php echo site_url('product/get_json')?>",
        "type": "POST"
    },

    //Set column definition initialisation properties.
    "columnDefs": [
    { 
        "targets": [ -1 ], //last column
        "orderable": false, //set not orderable
    },
    ],

    });
});


function save() {
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    if(save_method == 'add') {
        url = "<?php echo site_url('product/ajax_add')?>";
    } else {
        url = "<?php echo site_url('product/ajax_update')?>";
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


function add_product()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Product'); // Set Title to Bootstrap modal title
}

function edit_product(id) {
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('product/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data.id);
            $('[name="slug"]').val(data.slug);
            $('[name="title"]').val(data.title);
            $('[name="description"]').val(data.description);
            $('[name="price"]').val(data.price);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Product'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function reload_table() {
    table.ajax.reload(null,false); //reload datatable ajax 
}

function delete_product(id) {
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('product/ajax_delete')?>/"+id,
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


<!-- old datatable -->
<!-- <script type="text/javascript">
var save_method; //for save method string
var table;

$(document).ready(function(){
  var table = $("#table").DataTable({
    "processing": true,
    "serverSide": true,
    "language": {
            "processing": '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '},
    "ajax" : {
        "url" : "<?= site_url('product/get_json') ?>",
        "type" : 'POST'
    },
    "columns" : [
        {
          "data": null, "render": function (data, type, full, meta) {
              return meta.row + 1;
        }
         },
            {"data" : "slug"},
            {"data" : "title"},
            {"data" : "description"},
            {"data" : "price", render: $.fn.dataTable.render.number(',', '.', '')},
            {"data" : "action"}
        ],
        "columnDefs" : [
          {
     "searchable": false,
     "orderable": false,
     "targets": 0
    },
          {"targets" : [0,1], "orderable" : false },
          {"targets" : [2], "className" : "text-center" },
        ],
        "order": [[ 1, 'asc' ]]

  });
  table.on('order.dt search.dt', function () {
        table.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();
});
</script> -->
<!-- old datatable -->

<!-- Modal -->
<div class="modal fade" id="modal_form" tabindex="-1" role="dialog" aria-labelledby="myModalAddLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalAddLabel">Product Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Slug</label>
                            <div class="col-md-9">
                                <input name="slug" placeholder="Slug" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Title</label>
                            <div class="col-md-9">
                                <input name="title" placeholder="Title" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Description</label>
                            <div class="col-md-9">
                            <input name="description" placeholder="description" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Price</label>
                            <div class="col-md-9">
                                <input name="price" placeholder="Price" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
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
<!-- end modal -->




<script>

</script>