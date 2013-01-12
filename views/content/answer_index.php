<h1>Answer Index</h1>
<div class="admin-box">
    <?php echo form_open(); ?>
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th class="column-check"><input class="check-all" type="checkbox" /></th>
                <th>Answer</th>
                <th style="width: 10em">Question</th>
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
        <?php if (isset($answers) && is_array($answers) && !empty($answers)) :?>
            <?php foreach ($answers as $answer) : ?>
            <tr>
                <td><input type="checkbox" name="checked[]" value="<?php echo $answer['id'] ?>" /></td>
                <td>
                    <a href="<?php echo site_url(SITE_AREA .'/content/cards/edit_answer/'. $answer['id']) ?>">
                        <?php e($answer['answer']); ?>
                    </a>
                </td>
                <td><?php echo e($answer['title']); ?></td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="3">
                    <br/>
                    <div class="alert alert-warning">
                        No answers found.
                    </div>
                </td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>

    <?php echo form_close(); ?>
</div>