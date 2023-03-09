<div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>
          <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>
            <?= $this->session->flashdata('message'); ?>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <button class="m-0 font-weight-bold btn btn-primary float-right tombolTambahData" data-toggle="modal" data-target="#FormModal">Tambah <?= $title; ?></button>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="clientTable" class="table table-bordered" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Client</th>
                      <th>Status</th>
                      <th>Duration</th>
                      <th>Type Order</th>
                      <th>Domain Name</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1;
                    foreach($row->result() as $key => $data) :
                    ?>
                    <tr>
                      <th><?= $no++; ?></th>
                      <th><?= $data->client_name; ?></th>
                      <th>
                        <?php if($data->status = 1) : ?>
                        <?= "aktif"; ?>
                        <?php endif; ?>
                      </th>
                      <th><?= $data->duration; ?></th>
                      <th><?= $data->order_type; ?></th>
                      <th><?= $data->domain_name; ?></th>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

</div>
<!-- /.container-fluid -->

        <!-- Modal -->
<div class="modal fade" id="FormModal" tabindex="-1" role="dialog" aria-labelledby="FormModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel">Tambah Data Client</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('client/save'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="slug" name="slug" placeholder="Client Name">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Status">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="description" name="description" placeholder="Duration">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="price" name="price" placeholder="Order Type">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div> 

<!-- Data Client -->
<!-- <script>

var t = $('#clientTable').DataTable( {
    "columnDefs": [ {
        "processing": true,
        "serverSide": true,
        "searchable": false,
        "orderable": false,
        "targets": 0
    } ],
    "ajax" : {
        "url" : "<?= site_url('product/get_json') ?>",
        "type" : 'POST'
    },
    "columns" : [
        {"data" : "slug"},
            {"data" : "title"},
            {"data" : "description"},
            {"data" : "price", render: $.fn.dataTable.render.number(',', '.', '')},
        {
        "render" : function (data, type, row) {
            var bindHtml = '';
            
            bindHtml += '<a data-toggle="modal" data-target="#FormModal" href="javascript:void(0);" id="tampilModalUbah" title="Edit Staff" class="update-staff-details ml-1 btn-ext-small btn btn-sm btn-primary"  data-staffid="' + row[0] + '"><i class="fas fa-edit"></i></a>';
            bindHtml += '<a data-toggle="modal" data-target="#delete-staff" href="javascript:void(0);" title="Delete Stff" class="delete-staff-details ml-1 btn-ext-small btn btn-sm btn-danger" data-staffid="' + row[0] + '"><i class="fas fa-times"></i></a>';
            return bindHtml;
        }
    }
    ],
    "order": [[ 0, 'asc' ]]
} );

t.on( 'order.dt search.dt', function () {
    t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        cell.innerHTML = i+1;
    });
}).draw();
</script> -->
