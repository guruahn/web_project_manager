<?php
/**
 * User add
 *
 * @category  View
 * @package   user
 * @author    Gongjam <guruahn@gmail.com>
 * @copyright Copyright (c) 2014
 * @license   http://opensource.org/licenses/gpl-3.0.html GNU Public License
 * @version   1.0
 **/

if ($idx) {
    $obj_user = (object) $user;
}
?>

</head>
<body>

<div id="wrapper">
    <div id="title-area" class="small-5 small-centered panel radius columns">
        <h2><?php echo $title;?></h2>
    </div>
    <div id="content-area" class="small-5 small-centered panel radius columns">
        <form action="<?php echo _BASE_URL_;?>/users/add/<?php echo $idx; ?>" method="post" name="joinForm">
            <ul>

                <li>
                    <label for="id">Email</label>
                    <input name="id" id="id" type="email" size="30" value="<?php echo ($idx) ? $obj_user->id : '' ?>" require <?php if($idx) { ?>disabled="true" <?php } ?> />
                </li>
                <li>
                    <label for="name">Name</label>
                    <input name="name" id="name" type="text" size="30" value="<?php echo ($idx) ? $obj_user->name : '' ?>" />
                </li>
                <li>
                    <label for="team">Team
                        <select name="team" id="team">
                            <option value="">선택</option>
                            <option value="임원" <?php if ($idx) { if ($obj_user->team == '임원') { ?>selected<?php } } ?>>임원</option>
                            <option value="기획팀" <?php if ($idx) { if ($obj_user->team == '기획팀') { ?>selected<?php } } ?>>기획팀</option>
                            <option value="디자인팀" <?php if ($idx) { if ($obj_user->team == '디자인팀') { ?>selected<?php } } ?>>디자인팀</option>
                            <option value="개발팀" <?php if ($idx) { if ($obj_user->team == '개발팀') { ?>selected<?php } } ?>>개발팀</option>
                            <option value="경영지원팀" <?php if ($idx) { if ($obj_user->team == '경영지원팀') { ?>selected<?php } } ?>>경영지원팀</option>
                    </select>
                    </label>
                </li>
                <li>
                    <label for="password">password</label>
                    <input name="password" id="password" type="password" size="30" value="" />
                </li>
                <li>
                    <label for="repassword">repeat password</label>
                    <input name="repassword" id="repassword" type="password" size="30" value="" />
                </li>
                <li>
                    <label for="level">Level
                        <select name="level" id="level">
                            <option value="0" <?php if ($idx) { if ($obj_user->level == '0') { ?>selected<?php } } ?>>최고관리자</option>
                            <option value="1" <?php if ($idx) { if ($obj_user->level == '1') { ?>selected<?php } } ?>>PM</option>
                            <option value="2" <?php if ($idx) { if ($obj_user->level == '2') { ?>selected<?php } } ?>>팀장</option>
                            <option value="3" <?php if ($idx) { if ($obj_user->level == '3') { ?>selected<?php } } else { ?>selected<?php } ?>>팀원</option>
                        </select>
                    </label>
                </li>

            </ul>
            <p><input type="submit" value="submit" class="button radius small"/> </p>
        </form>
    </div>
</div>

<script type="text/javascript">
    $("#name").click(function(){
        var id = $('#id').val();
        $.ajax({
            type: "POST",
            url: "<?php echo _BASE_URL_;?>/users/existIdCheck",
            data: "id=" + id,
            cache: false,
            success: function(data){
                $("#name").html(data);
            }
        });
    });
</script>