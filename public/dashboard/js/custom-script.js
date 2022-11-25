// confirm link
$('.confirm-alert').confirm({
    title: '<span style="color: #ff0000;"><i class="fas fa-exclamation-triangle"></i> Confirmation Required</span>',
    content: '<span>Are you sure want to continue?</span>',
    buttons: {
        cancel: {
            text: 'No',
            btnClass: 'btn-danger',
            action: function(){}
        },
        confirm: {
            text: 'Yes',
            btnClass: 'btn-success',
            action: function(){
                location.href = this.$target.attr('href');
            }
        },
    }
});

// confirm form
function ConfirmForm(formId){
    $.confirm({
        title: '<span style="color: #ff0000;"><i class="fas fa-exclamation-triangle"></i> Confirmation Required</span>',
        content: '<span>Are you sure want to delete?</span>',
        buttons: {
            cancel: {
                text: 'No',
                btnClass: 'btn-danger',
                action: function(){}
            },
            confirm: {
                text: 'Yes',
                btnClass: 'btn-success',
                action: function(){
                    $('#'+formId).submit();
                }
            },
        }
    });
    return false;
}
