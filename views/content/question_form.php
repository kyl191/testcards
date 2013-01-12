<div class="admin-box">
    <h3>New Question</h3>
    
    <?php echo form_open(current_url(), 'class="form-horizontal"'); ?>
    
    <div class="control-group <?php if (form_error('test')) echo 'error'; ?>">
        <div class="controls">
            <?php if (form_error('test')) echo '<span class="help-inline">'. form_error('test') . 'please choose a different test.</span>'; ?>
            Add a question to quiz: <?php echo form_dropdown('test', $tests, 0); ?>
        </div>
    </div>
    
    <div class="control-group <?php if (form_error('question')) echo 'error'; ?>">
        <label for="question">Question Text</label>
        <div class="controls">
            <?php if (form_error('question')) echo '<span class="help-inline">'. form_error('question') .'</span>'; ?>
            <textarea name="question" class="input-xxlarge" rows="15"><?php echo set_value('question', isset($question) ? $question->question : '') ?></textarea>
        </div>
    </div>
    
    <div class="form-actions">
        <input type="submit" name="submit" class="btn btn-primary" value="Save Question" />
        or <a href="<?php echo site_url(SITE_AREA .'/content/cards') ?>">Cancel</a>
    </div>
    
    <?php echo form_close(); ?>
</div>