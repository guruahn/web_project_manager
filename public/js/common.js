$(function(){
    /*init foundation*/
    $(document).foundation();



});

/*alert box*/
function call_alert_box(msg){
    var html = '<div data-alert class="alert-box warning radius">';
    html += '<span class="alert-content">'+msg+'</span>';
    html += '<a href="#" class="close">&times;</a>';
    html += '</div>';
    $('#wrapper').append(html);
    var $alertBox = $('.alert-box');
    $alertBox.find('.alert-content').text(msg);
    $alertBox.find('.close').click(function(){
        $alertBox.hide();
    });
    $alertBox.show();
}