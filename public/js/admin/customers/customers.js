$(document).ready(function(){
    //alert(columns);
    $('.datatable').DataTable({
        scrollX: true,
        processing: true,
        serverSide: true,
        lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
        ajax: serverSide,
        columns: js_columns
            // {data: 'id', name: 'id', class: 'col-id'},
            // {data: 'name', name: 'name'},
            // {data: 'email', name: 'email'},
            // {data: 'created_at', name: 'created_at'},
            // {data: 'updated_at', name: 'updated_at'},
            // {data: 'action', name: 'action', orderable: false, searchable: false, class: 'col-action'}
        ,
        initComplete: function () {
            this.api().columns().every(function () {
                var column = this;
                var input = document.createElement("input");
                $(input).appendTo($(column.footer()).empty())
                    .on('keyup', function () {
                        column.search($(this).val(), false, false, true).draw();
                    });
            });

            this.DataTable().draw();
        }
        // order: [ [3, 'asc'], [2, 'asc'], [1, 'asc'] ]
    });



    // $(document).on('click', '.delete-button', (function(){
    //     var rec_id = $(this).attr('rec_id');
    //     var value = $(this).val();
    //     var token = $(this).attr('data-token');
    //     var parent = $(this).parent();
    //
    //     BootstrapDialog.show({
    //         title: 'Delete Choice',
    //         message: 'Are you sure you want to delete ' + value + '?',
    //         buttons: [{
    //             label: 'Yes',
    //             icon: 'fa fa-check',
    //             cssClass: 'btn-success',
    //             action: function(dialogItself){
    //                 $.ajax({
    //                     url: url + '/' + rec_id,
    //                     type: 'post',
    //                     data: {_method: 'delete', _token: token},
    //                     success: function (msg) {
    //                         parent.slideUp(300, function () {
    //                             parent.closest("tr").remove();
    //                         });
    //                         dialogItself.close();
    //                         BootstrapDialog.show({
    //                             title: 'Record Deletion Success',
    //                             message: value + ' successfully deleted'
    //                         });
    //                     }
    //                 });
    //             }
    //         }, {
    //             label: 'No',
    //             // no title as it is optional
    //             cssClass: 'btn-danger',
    //             icon: 'fa fa-close',
    //             action: function(dialogItself){
    //                 dialogItself.close();
    //             }
    //         }]
    //     });
    // }));
});