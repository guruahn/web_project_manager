<?php
/**
 * Post Add
 *
 * @category  View
 * @package   post
 * @author    Gongjam <guruahn@gmail.com>
 * @copyright Copyright (c) 2014
 * @license   http://opensource.org/licenses/gpl-3.0.html GNU Public License
 * @version   1.0
 **/
?>

</head>
<body>

<div id="wrapper">
    <div id="title-area" class="small-11 small-centered columns">
        <h2><?php echo $title?></h2>
    </div>
    <div id="content-area" class="small-11 small-centered panel radius columns ">

        <div class="project_list ">
            <?php
            foreach($project as $item):
                $obj_project = (object) $item;
                ?>
                <h3>
                    <a href="<?php echo _BASE_URL_;?>/pages/view_all/<?php echo $obj_project->idx; ?>">
                        <?php echo text_cut_utf8($obj_project->name, 70); ?>
                    </a>
                </h3>
            <?php
            endforeach;
            ?>

        </div>

        <div class="row">
            <div class="large-12 columns button-group">

                <a href="<?php echo _BASE_URL_;?>/project/view_all/" class="button radius secondary tiny">
                    list project
                </a>
            </div>
        </div>
    </div>
</div>

