<div class="p-5 m-0 border border-primary">
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#"><?php wp_tag_cloud() ?></a>
        </li>
    </ul>
    <div>
        <?php
        if (is_active_sidebar('right_sidebar2')) {
            dynamic_sidebar('right_sidebar2');
        } else {
            echo 'No widgets assigned to the right sidebar.';
        }
        ?>
    </div>
</div>