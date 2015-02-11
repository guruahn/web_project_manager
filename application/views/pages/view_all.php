<?php
/**
 * Post list
 *
 * @category  View
 * @package   post
 * @author    Gongjam <guruahn@gmail.com>
 * @copyright Copyright (c) 2014
 * @license   http://opensource.org/licenses/gpl-3.0.html GNU Public License
 * @version   1.0
 **/
?>


<div id="content" class="large-9 columns">
    <link rel="stylesheet" href="<?php echo _BASE_URL_;?>/public/css/select/jquery.dateselect.css">


    <div class="small-11 columns ">

        <div class="state_list">
            <ul class="button-group">
              <li><a href="#" class="button tiny radius alert state1">진행중</a></li>
              <li><a href="#" class="button tiny radius success state4">완료</a></li>
              <li class="task_all_toggle_wrap">
                  <a href="#" class="button tiny radius task_all_toggle  off">할일 모두 닫기 <i class="fa fa-angle-double-up"></i></a>
                  <a href="#" class="button tiny radius task_all_toggle hidden">할일 모두 열기 <i class="fa fa-angle-double-down"></i></a>
              </li>
            </ul>
        </div>

    </div>
    <div id="content-area" class="small-11 panel radius columns">
        <div class="progress small-4 success round" style="float: right;">
            <span class="meter" style="width: 0%"></span><span id="meter_text">0</span>%
        </div>


        <div class="page_list ">
            <?php
            echo $tree;
            ?>
        </div>
    </div>
    <div class="small-11 columns">
        <p class="button-group radius">
            <span><a href="<?php echo _BASE_URL_;?>/pages/writeform/<?php echo $filter_project_id; ?>" class="button radius tiny">Add Page</a></span>
            <span><a href="<?php echo _BASE_URL_;?>/categories/view_all/<?php echo $filter_project_id; ?>" class="button secondary radius tiny">Category Add</a></span>
        </p>
    </div>
</div><!--//#content-->
<!--popup-->
<div id="task_to_pop_up" class="panel radius">
    <a href="#" class="b-close"><i class="fa fa-times"></i></a>
    <h3>할일 추가</h3>
    <div class="content">
        <div class="row submit_task_wrap">

            <div class="large-3 columns" >
                <select name="user" id="user">
                   <!--<option value="0">담당자</option>-->
                    <?php
                    foreach($users as $user):
                        $obj_user = (object) $user;
                    ?>
                        <option value="<?php echo $obj_user->idx;?>" <?php echo ($obj_user->name == $_SESSION['LOGIN_NAME']) ? 'selected' : ''; ?>><?php echo $obj_user->name; ?></option>
                    <?php
                    endforeach;
                    ?>
                </select>
            </div>
            <div class="large-6 columns" style="padding:0">
                <input type="text" name="title" />
            </div>
            <div class="large-3 columns" style="padding:0">
                <div class="small-9 columns">
                    <input type="text" name="due_date" class="form-control"/>
                </div>
                <div class="small-3 columns">
                    <i class="fa fa-calendar btn-date"></i>
                </div>
            </div>

        </div>
        <div class="row submit_task_button_wrap">
            <button class="submit_task button radius tiny" data-page-idx="" data-project-idx="<?php echo $filter_project_id; ?>">추가</button>
        </div>

    </div>
</div>
<script src="<?php echo _BASE_URL_;?>/public/js/jquery.bpopup.min.js"></script>
<script type="text/javascript" src="<?php echo _BASE_URL_;?>/public/js/jquery.dateselect.min.js"></script>
<script type="text/javascript">
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
            url: "<?php echo _BASE_URL_;?>/api/tasks/updateStatus/"+idx,
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
            url: "<?php echo _BASE_URL_;?>/api/tasks/addTask/",
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
            }
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
</script>