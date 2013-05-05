<h1>Quiz Index</h1>
<div class="admin-box">
    <?php echo form_open(); ?>

    <table class="table table-striped">
        <thead>
            <tr>
                <th class="column-check"><input class="check-all" type="checkbox" /></th>
                <th>Title</th>
                <th style="width: 10em">Owner</th>
                <th style="width: 3em">Questions</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <td colspan="4">
                    With selected: 
                    <input type="submit" name="delete" class="btn" value="Delete"> 
                </td>
            </tr>
        </tfoot>
        <tbody>
        <?php if (isset($quizzes) && is_array($quizzes) && !empty($quizzes)) :?>
            <?php foreach ($quizzes as $quiz) : ?>
            <tr>
                <td><input type="checkbox" name="checked[]" value="<?php echo $quiz['id'] ?>" /></td>
                <td>
                    <a href="<?php echo site_url(SITE_AREA .'/content/cards/edit_test/'. $quiz['id']) ?>">
                        <?php e($quiz['title']); ?>
                    </a>
                </td>
                <td>
                    <?php echo $quiz['username']; ?>
                </td>
                <td>
                    <?php echo $quiz['numQuestions']; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">
                    <br/>
                    <div class="alert alert-warning">
                        No quizzes found.
                    </div>
                </td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>

    <?php echo form_close(); ?>
</div>