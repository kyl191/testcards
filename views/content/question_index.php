<h1>Question Index</h1>
<div class="admin-box">
    <?php echo form_open(); ?>
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th class="column-check"><input class="check-all" type="checkbox" /></th>
                <th>Question</th>
                <th style="width: 10em">Quiz</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <td colspan="3">
                    With selected: 
                    <input type="submit" name="submit" class="btn" value="Delete"> 
                </td>
            </tr>
        </tfoot>
        <tbody>
        <?php if (isset($questions) && is_array($questions)) :?>
            <?php foreach ($questions as $question) : ?>
            <tr>
                <td><input type="checkbox" name="checked[]" value="<?php echo $question['id'] ?>" /></td>
                <td>
                    <a href="<?php echo site_url(SITE_AREA .'/content/cards/edit_question/'. $question['id']) ?>">
                        <?php e($question['question']); ?>
                    </a>
                </td>
                <td><?php echo e($question['title']); ?></td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="3">
                    <br/>
                    <div class="alert alert-warning">
                        No questions found.
                    </div>
                </td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>

    <?php echo form_close(); ?>
</div>