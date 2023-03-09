
  //   $(document).ready( function () {
  //     $("#mytable").DataTable()
  //   });
  //   $("#mytable").remove();
  // $(document).ready( function () {
  $("#mytable").DataTable({
      "oLanguage": {
          "sEmptyTable": "Data Kosong",
          "sProcessing": "Tunggu Sebentar..."
        },
      "processing": true,
      "serverSide": true,
      // "ordering": true,
      "ajax" : {
          "url" : "<?= site_url('product/get_json') ?>",
          "type" : 'POST'
      },
      "columns" : [
          {render: function (data, type, row, meta) {
          return meta.row + meta.settings._iDisplayStart + 1;
          }},
          {"data" : "slug"},
          {"data" : "title"},
          {"data" : "description"},
          {"data" : "price", render: $.fn.dataTable.render.number(',', '.', '')},
      ],
      "order": [
                  [0, 'asc']
              ],
      "columnDefs" : [
          {"targets" : [0], "data" : null},
          {"targets" : [1,2,3,4], "className" : "text-center"},

      ]
     })
  // });
