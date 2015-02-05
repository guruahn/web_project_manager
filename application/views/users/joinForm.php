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
                    <label for="id">ID</label>
                    <input name="id" id="id" type="text" size="30" value="<?php echo ($idx) ? $obj_user->id : '' ?>" />
                </li>
                <li>
                    <label for="name">Name</label>
                    <input name="name" id="name" type="text" size="30" value="<?php echo ($idx) ? $obj_user->name : '' ?>" />
                </li>
                <li>
                    <label for="team">Team</label>
                    <input name="team" id="team" type="text" size="30" value="<?php echo ($idx) ? $obj_user->team : '' ?>" />
                </li>
                <li>
                    <label for="password">password</label>
                    <input name="password" id="password" type="text" size="30" value="" />
                </li>
                <li>
                    <label for="repassword">repeat password</label>
                    <input name="repassword" id="repassword" type="text" size="30" value="" />
                </li>
                <li>
                    <label for="level">Level</label>
                    <select name="level" id="level" size="30">
                        <option value="0" <?php if ($idx) { if ($obj_user->level == '0') { ?>selected<?php } } ?>>최고관리자</option>
                        <option value="1" <?php if ($idx) { if ($obj_user->level == '1') { ?>selected<?php } } ?>>PM</option>
                        <option value="2" <?php if ($idx) { if ($obj_user->level == '2') { ?>selected<?php } } ?>>팀장</option>
                        <option value="3" <?php if ($idx) { if ($obj_user->level == '3') { ?>selected<?php } } else { ?>selected<?php } ?>>팀원</option>
                    </select>
                </li>

            </ul>
            <p><input type="submit" value="submit" class="button radius small"/> </p>
        </form>
    </div>
</div>