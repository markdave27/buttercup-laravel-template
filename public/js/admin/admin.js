$(document).ready(function() {
    var url = window.location;
    // for sidebar menu but not for treeview submenu
    $('ul.sidebar-menu a').filter(function () {
        return this.href == url;
    }).parent().siblings().removeClass('active').end().addClass('active');
    // for treeview which is like a submenu
    $('ul.treeview-menu a').filter(function () {
        return this.href == url;
    }).parentsUntil(".sidebar-menu > .treeview-menu").siblings().removeClass('active').end().addClass('active');

    /**
     * Generic delete button action
     */
    $(document).on('click', '.delete-button', (function(){
        var rec_id = $(this).attr('rec_id');
        var value = $(this).val();
        var token = $(this).attr('data-token');
        var parent = $(this).parent();

        BootstrapDialog.show({
            title: 'Delete Record',
            message: 'Are you sure you want to delete ' + value + '?',
            buttons: [{
                label: 'Yes',
                icon: 'fa fa-check',
                cssClass: 'btn-success',
                action: function(dialogItself){
                    $.ajax({
                        url: url + '/' + rec_id,
                        type: 'post',
                        data: {_method: 'delete', _token: token},
                        success: function (msg) {
                            parent.slideUp(300, function () {
                                parent.closest("tr").remove();
                            });
                            dialogItself.close();
                            BootstrapDialog.show({
                                title: 'Record Deletion Success',
                                message: value + ' successfully deleted'
                            });
                        }
                    });
                }
            }, {
                label: 'No',
                // no title as it is optional
                cssClass: 'btn-danger',
                icon: 'fa fa-close',
                action: function(dialogItself){
                    dialogItself.close();
                }
            }]
        });
    }));

    $('.datetimepicker').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss'
    });
});