<div class="admin-box">
    <h3>New Answer</h3>
    
    <?php echo form_open(current_url(), 'class="form-horizontal"'); ?>
    
    <div class="control-group <?php if (form_error('question')) echo 'error'; ?>">
        <div class="controls">
            <?php if (form_error('question')) echo '<span class="help-inline">'. form_error('question') . 'please choose a different question.</span>'; ?>
            Add an answer to quiz: <?php echo form_dropdown('question', $questions, 0); ?>
        </div>
    </div>
    
    <div class="control-group <?php if (form_error('answer')) echo 'error'; ?>">
        <label for="answer">Answer Text</label>
        <div class="controls">
            <?php echo form_checkbox('correct', '1', false); ?>
            <?php if (form_error('answer')) echo '<span class="help-inline">'. form_error('answer') .'</span>'; ?>
            <textarea name="answer" class="input-xxlarge" rows="15"><?php echo set_value('answer', isset($answer) ? $answer->answer : '') ?></textarea>
            
        </div>
    </div>
    
    <div class="form-actions">
        <input type="submit" name="submit" class="btn btn-primary" value="Save Question" />
        or <a href="<?php echo site_url(SITE_AREA .'/content/list_answers') ?>">Cancel</a>
    </div>
    
    <?php echo form_close(); ?>
</div>