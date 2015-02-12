/**
 * Created by 개발2 on 15. 2. 11.
 */
$(function(){
    var total_page = $('.page').length;
    var success_page = $('.page .success').length;
    print_progress(total_page, success_page);

    /*할일 아코디언*/
    $('.task').click(function(){
        var $hiddentasks = $(this).parent().parent().find('.task-list');
        var $task = $(this);
        $hiddentasks.slideToggle(300, function(){
            $task.find('.bullet_on').toggle();
            $task.find('.bullet_off').toggle();
        });

        return false;
    });

    /*할일추가 팝업*/
    $('.task-list .add').click(function(){
        var page_idx = $(this).attr('data-page-idx');
        $('#task_to_pop_up').bPopup({
            onOpen: function(){
                $('.submit_task').attr('data-page-idx',page_idx);
            }
        });
        return false;
    });

    /*할일 추가*/
    $('#task_to_pop_up').on('click', '.submit_task', function(){
        var title = $('input[name=title]').val();
        var receiver_idx = $('select[name=user]').val();
        var due_date = $('input[name=due_date]').val();
        if( !title){
            alert('내용을 입력해주세요.');
            return false;
        }else{
            ajax_insert_task(title, $(this).attr('data-page-idx'), $(this).attr('data-project-idx'), receiver_idx, $('select[name=user] option:selected').text(), due_date);
        }
        return false;
    });

    /*change task status*/
    $('.task-list').on('click', '.do i', function(){
        var status = 2;//status value to update
        var page_idx = $(this).parent().parent().parent().attr('data-page-idx');
        if($(this).hasClass('fa-check-square-o')) status = 1;//check checked!
        ajax_update_task_status($(this).parent().parent().attr('data-idx'), status, page_idx);
    });

    /*toggle all task list*/
    $('.task_all_toggle').click(function(){
        if($(this).hasClass('off')){
            $('.task-list').slideUp();
            $('.bullet_on').hide();
            $('.bullet_off').show();
        }else{
            $('.task-list').slideDown();
            $('.bullet_on').show();
            $('.bullet_off').hide();
        }
        $('.task_all_toggle').toggleClass('hidden');
    });
    /*할일 완전삭제*/
    $('.delComplete').click(function(){
        if(!confirm("정말 삭제하시겠습니까? 이 페이지에 할당된 할일이 모두 삭제됩니다. 완전삭제 하시면 복구되지 않습니다.")){
            return false;
        }

    });

    /*datepicker*/
    $('.btn-date').on('click', function(e) {
        e.preventDefault();
        $.dateSelect.show({
            element: 'input[name="due_date"]'
        });
    });

});
/*change task status*/
function ajax_update_task_status(idx, status, page_idx){
    $.ajax({
        type: "POST",
        url: _BASE_URL+"/api/tasks/updateStatus/"+idx,
        data: {status: status},
        dataType: "json"
    }).success(function(data){
            if(data.result) {
                $('li[data-idx='+idx+'] .do').toggle();
                $countObj = $('.task a[data-idx='+page_idx+'] span');
                var count = $countObj.text();
                if(status == 2) {
                    $('li[data-idx='+idx+']').addClass('completed').removeClass('ing');
                    $countObj.text(Number(count)-1);
                }else{
                    $('li[data-idx='+idx+']').addClass('ing').removeClass('completed');
                    $countObj.text(Number(count)+1);
                }
            }
        }).fail(function(response){
            console.log(printr_json(response));
        });
}
/*task 추가*/
function ajax_insert_task(title, page_idx, project_idx, receiver_idx, receiver_name, due_date){
    $.ajax({
        type: "POST",
        url: _BASE_URL+"/api/tasks/addTask/",
        data: {title: title, page_idx: page_idx, project_idx: project_idx, receiver_idx: receiver_idx, due_date: due_date},
        dataType: "json"
    }).success(function(data){
            if(data.result) {
                $('.task-list[data-page-idx='+page_idx+']').prepend('<li class="ing" data-idx="'+data.idx+'"><span class="do off"><i class="fa fa-check-square-o"></i></span><span class="do on"><i class="fa fa-square-o"></i></span><span class="receiver">'+receiver_name+'</span><span class="title">'+title+'</span>');
                $('input[name=title]').val('');
                $countObj = $('.task a[data-idx='+page_idx+'] span');
                var count = $countObj.text();
                $countObj.text(Number(count)+1);
                $('#task_to_pop_up').bPopup().close();
                ajax_sendmail(title, receiver_idx, receiver_name, due_date);
            }
        }).fail(function(response){
            console.log(printr_json(response));
        });
}

function ajax_sendmail(title, receiver_idx, receiver_name, due_date) {
    $.ajax({
        type: "POST",
        url: _BASE_URL+"/api/tasks/sendMail/",
        data: {title: title, receiver_idx: receiver_idx, receiver_name: receiver_name, due_date: due_date},
        dataType: "json"
    }).success(function(data){
        console.log(data.result);
    }).fail(function(response){
        console.log(printr_json(response));
    });
}

function makeStatus(status){
    if( status == 1 ){
        return 'ing';
    }else if( status == 2 ){
        return 'completed';
    }else{
        return "delete";
    }
}
/*task 상태바 애니메이션*/
function print_progress(total_page, success_page){
    if( success_page > 0){
        var success_percent = (success_page/total_page)*100;
        /*progress animation start*/
        $('.meter').animate({
            width: success_percent+"%"
        },2000, function(){});
        var rn = Math.round(Math.random() * 99999);
        $("#msg").text("Random Number = " + rn);

        /*percent text animation start*/
        var $el = $("#meter_text");
        $({ val : 0 }).animate({ val : success_percent }, {
            duration: 2000,
            step: function() {
                $el.text(Math.floor(this.val));
            },
            complete: function() {
                $el.text(Math.floor(this.val));
            }
        });
    }
}