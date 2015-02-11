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
<script type="text/javascript" src="<?php echo _BASE_URL_;?>/public/js/page.js"></script>