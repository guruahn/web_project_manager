/**
 * Created by 개발2 on 15. 2. 11.
 */
$(function(){
    /*project add*/
    $('.project_add_toggle a').click(function(){
        $('.project_add_toggle').toggle('hide');
    });
    $('.add_project').click(function(){
        var name = $('.project_add_toggle input[name=project_name]').val();
        if(isEmpty(name)) {
            alert('프로젝트 이름을 입력하세요.');
            return false;
        }else{
            ajax_add_project(name);
        }
    });

    /*project edit*/
    $('.project_edit_toggle .icons .fa-pencil').click(function(){
        var $thisList = $(this).parent().parent().parent();
        $thisList.find('.project_edit_toggle').toggle('hide');
    });
    $('.project_edit_toggle .cancle').click(function(){
        var $thisList = $(this).parent().parent();
        $thisList.find('.project_edit_toggle').toggle('hide');
    });
    $('.edit_project').click(function(){
        var $thisList = $(this).parent().parent();
        var name = $thisList.find('input[name=project_name]').val();
        if(isEmpty(name)) {
            alert('프로젝트 이름을 입력하세요.');
            return false;
        }else{
            ajax_edit_project(name, $thisList);
        }
    });
});

/*add project*/
function ajax_add_project(name){
    $.ajax({
        type: "POST",
        url: _BASE_URL_+"/api/project/addProject/",
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

/*edit project*/
function ajax_edit_project(name, $thisList){
    var idx = $thisList.attr('data-project-idx');
    $.ajax({
        type: "POST",
        url: _BASE_URL_+"/api/project/editProject/"+idx,
        data: {name: name},
        dataType: "json"
    }).success(function(data){
        if(data.result) {
            $thisList.find('.title').text(name);
            $thisList.find('.project_edit_toggle').toggle('hide');
        }
    }).fail(function(response){
        console.log(printr_json(response));
    });
}