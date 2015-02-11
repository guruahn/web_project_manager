/**
 * Created by 개발2 on 15. 2. 11.
 */
$(function(){
    $('.project_add_toggle a').click(function(){
        $('.project_add_toggle').toggle('hide');
    });
    $('.add_project').click(function(){
        var name = $('input[name=project_name]').val();
        if(isEmpty(name)) {
            alert('프로젝트 이름을 입력하세요.');
            return false;
        }else{
            ajax_add_project(name);
        }
    });
});

/*add project*/
function ajax_add_project(name){
    $.ajax({
        type: "POST",
        url: _BASE_URL+"/api/project/addProject/",
        data: {name: name},
        dataType: "json"
    }).success(function(data){
        if(data.result) {
            var html = '';
            html += '<li><i class="fa fa-caret-right" style="width: 10px;"></i>';
            html += '<a href="/pages/view_all/'+data.idx+'">'+name+'</a>';
            html += '</li>';
            $('.project_list ul').prepend(html);
        }
    }).fail(function(response){
        console.log(printr_json(response));
    });
}