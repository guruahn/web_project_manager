<?php
/**
 * Created by PhpStorm.
 * User: 개발2
 * Date: 15. 2. 6
 * Time: 오후 8:29
 */
?>
<div id="sidebar" class="large-3 columns">
    <div class="logo">Project Manager</div>
    <div class="project_list">
        <ul>
        <?php
        if($project_list){
            foreach($project_list as $project):
                $obj_project = (object) $project;
                $selected = "";
                $title = text_cut_utf8($obj_project->name, 70);
                if( $obj_project->idx == $filter_project_id )$selected = "selected";
                ?>
                <li class='<?php echo $selected; ?>' data-project-idx="<?php echo $obj_project->idx; ?>">
                    <div class="project_edit_toggle">
                        <i class="fa fa-caret-right"></i>
                        <a href="<?php echo _BASE_URL_;?>/pages/view_all/<?php echo $obj_project->idx; ?>" class="title"><?php echo $title; ?></a>
                        <div class="icons">
                            <i class="fa fa-pencil"></i>
                            <i class="fa fa-times" data-project-idx="<?php echo $obj_project->idx; ?>"></i>
                        </div>
                    </div>
                    <div class="project_edit_toggle hide">
                        <input type="text" name="project_name" value="<?php echo $title; ?>" />
                        <a href="#" class="button tiny radius alert edit_project">수정</a> <a href="#" class="cancle" >취소</a>
                    </div>
                </li>
            <?php
            endforeach;
        }

        ?>
        </ul>

    </div>
    <div class="widget">
        <ul>
            <li>
                <div class="project_add_toggle"><a href="#"><i class="fa fa-plus"></i> 프로젝트 추가하기</a></div>
                <div class="project_add_toggle hide">
                    <input type="text" name="project_name" />
                    <a href="#" class="button tiny radius alert add_project">추가하기</a> <a href="#" class="cancle" >취소</a>
                </div>
            </li>
        </ul>
    </div>
    <div class="widget ">
        <ul>
            <li><a href="<?php echo _BASE_URL_; ?>/users/joinForm/<?php echo $_SESSION['LOGIN_NO']; ?>"><?php echo $_SESSION['LOGIN_ID']."님"; ?>&nbsp;&nbsp;</a></li>
            <li><a href="<?php echo _BASE_URL_; ?>/users/logout">Logout</a></li>
        </ul>
    </div>
</div>

<div id="projectDeleteModal" class="reveal-modal" data-reveal>
    <h2>정말 삭제하시겠습니까?</h2>
    <p class="lead">프로젝트를 삭제하면 관련 자료들도 모두 함께 삭제되며 복구할 수 없습니다.</p>
    <p>
        <a href="#" class="button small radius go-delete" data-project-idx="">예, 삭제하겠습니다.</a>
        <a href="#" class="cancle">취소</a>
    </p>
    <a class="cancle close-reveal-modal">&#215;</a>
</div>

<script type="text/javascript" src="<?php echo _BASE_URL_;?>/public/js/project.js"></script>