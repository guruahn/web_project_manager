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
            call_alert_box('프로젝트 이름을 입력하세요.');
            return false;
        }else{
            ajax_add_project(name);
        }
    });

    /*project edit*/
    $('.project_list').on('click', '.project_edit_toggle .icons .fa-pencil', function(){
        var $thisList = $(this).parent().parent().parent();
        $thisList.find('.project_edit_toggle').toggle('hide');
    });
    $('.project_list').on('click', '.project_edit_toggle .cancle', function(){
        var $thisList = $(this).parent().parent();
        $thisList.find('.project_edit_toggle').toggle('hide');
    });
    $('.project_list').on('click', '.edit_project', function(){
        var $thisList = $(this).parent().parent();
        var name = $thisList.find('input[name=project_name]').val();
        if(isEmpty(name)) {
            call_alert_box('프로젝트 이름을 입력하세요.');
            return false;
        }else{
            ajax_edit_project(name, $thisList);
        }
    });

    /*project delete*/
    $('.project_list').on('click', '.project_edit_toggle .icons .fa-times', function(){
        var idx = $(this).attr('data-project-idx');
        $('#projectDeleteModal .go-delete').attr('data-project-idx', idx);
        $('#projectDeleteModal').foundation('reveal','open');
    });
    $('#projectDeleteModal').on('click', '.cancle', function(){
        $('#projectDeleteModal').foundation('reveal','close');
    });
    $('#projectDeleteModal').on('click', '.go-delete', function(){
        var idx = $(this).attr('data-project-idx');
        ajax_delete_project(idx);
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
            html += '<li data-project-idx="'+data.idx+'">';
                html += '<div class="project_edit_toggle">';
                    html += '<i class="fa fa-caret-right" style="width: 10px;"></i>';
                    html += '<a href="/pages/view_all/'+data.idx+'" class="title">'+name+'</a>';
                    html += '<div class="icons">';
                    html += '<i class="fa fa-pencil"></i><i class="fa fa-times" data-project-idx="'+data.idx+'"></i>';
                    html += '</div>';
                html += '</div>';
                html += '<div class="project_edit_toggle hide">';
                    html += '<input type="text" name="project_name" value="'+name+'" />';
                    html += '<a href="#" class="button tiny radius alert edit_project">수정</a> <a href="#" class="cancle" >취소</a>';
                html += '</div>';
            html += '</li>';
            $('.project_list ul').prepend(html);
        }else{
            call_alert_box('프로젝트 추가 실패! 관리자에게 문의하세요.');
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
            }else{
                call_alert_box('프로젝트 추가 실패! 관리자에게 문의하세요.');
            }
        }).fail(function(response){
            console.log(printr_json(response));
        });
}

/*delete project*/
function ajax_delete_project(idx){
    $.ajax({
        type: "POST",
        url: _BASE_URL_+"/api/project/delProject/"+idx,
        data: {name: name},
        dataType: "json"
    }).success(function(data){
        if(data.result) {
            $('li[data-project-idx='+idx+']').remove();
        }else{
            call_alert_box('프로젝트 삭제 실패! 관리자에게 문의하세요.');
        }
        $('#projectDeleteModal').foundation('reveal','close');
    }).fail(function(response){
        console.log(printr_json(response));
    });
}