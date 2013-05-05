<div class="admin-box">
    <h3><?php echo $toolbar_title; ?></h3>
    
    <?php echo form_open(current_url(), 'class="form-horizontal"'); ?>
    
    <div class="control-group <?php if (form_error('test')) echo 'error'; ?>">
        <div class="controls">
            <?php if (form_error('test')) echo '<span class="help-inline">'. form_error('test') . 'please choose a different test.</span>'; ?>
            Add a question to quiz: <?php echo form_dropdown('test', $tests, $testid); ?>
        </div>
    </div>
    
    <div class="control-group <?php if (form_error('question')) echo 'error'; ?>">
        <label for="question">Question Text</label>
        <div class="controls">
            <?php if (form_error('question')) echo '<span class="help-inline">'. form_error('question') .'</span>'; ?>
            <textarea name="question" class="input-xxlarge" rows="15"><?php echo set_value('question', isset($question) ? $question->question : '') ?></textarea>
        </div>
    </div>

    <?php if (isset($answers) && is_array($answers) && !empty($answers)) :?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="column-check"><input class="check-all" type="checkbox" /></th>
                    <th>Answer</th>
                    <th style="width: 10em">Correct Answer</th>
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
            <?php foreach ($answers as $answer) : ?>
            <tr>
                <td><input type="checkbox" name="checked[]" value="<?php echo $answer['id'] ?>" /></td>
                <td>
                    <a href="<?php echo site_url(SITE_AREA .'/content/cards/edit_answer/'. $answer['id']) ?>">
                        <?php e($answer['answer']); ?>
                    </a>
                </td>
                <td><?php if ($answer['correct'] == 1){
                     e("X");
                 }  ?></td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <div class="form-actions">
        <input type="submit" name="add" class="btn btn-primary" value="Add an answer" /> 
        or <input type="submit" name="submit" class="btn btn-primary" value="Save Question" />
        or <a href="<?php echo site_url(SITE_AREA .'/content/cards/edit_test/'.$testid) ?>">Cancel</a>
    </div>
    
    <?php echo form_close(); ?>
</div>
