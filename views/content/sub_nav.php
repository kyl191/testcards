<ul class="nav nav-pills">
    <li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
        <a href="<?php echo site_url(SITE_AREA .'/content/cards') ?>">List of Quizzes</a>
    </li>
    <li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?>>
        <a href="<?php echo site_url(SITE_AREA .'/content/cards/create') ?>">New Quiz</a>
    </li>
    <li <?php echo $this->uri->segment(4) == 'list_questions' ? 'class="active"' : '' ?>>
        <a href="<?php echo site_url(SITE_AREA .'/content/cards/list_questions') ?>">List of Questions</a>
    </li>
    <li <?php echo $this->uri->segment(4) == 'add_question' ? 'class="active"' : '' ?>>
        <a href="<?php echo site_url(SITE_AREA .'/content/cards/add_question') ?>">Add a Question</a>
    </li>
</ul>
