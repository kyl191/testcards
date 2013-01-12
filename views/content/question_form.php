<div class="admin-box">
    <h3>New Question</h3>
    
    <?php echo form_open(current_url(), 'class="form-horizontal"'); ?>
    
    <div class="control-group <?php if (form_error('question')) echo 'error'; ?>">
        <label for="question">Question Text</label>
        <div class="controls">
            <?php if (form_error('question')) echo '<span class="help-inline">'. form_error('question') .'</span>'; ?>
            <textarea name="question" class="input-xxlarge" rows="15"><?php echo set_value('question', isset($question) ? $question->question : '') ?></textarea>
        </div>
    </div>
    
    <div class="control-group <?php if (form_error('answer1')) echo 'error'; ?>">
        <label for="answer1">Answer 1</label>
        <div class="controls">
            <?php if (form_error('answer1')) echo '<span class="help-inline">'. form_error('answer1') .'</span>'; ?>
            <textarea name="answer1" class="input-xxlarge" rows="15"><?php echo set_value('answer1', isset($answer) ? $answer->answer1 : '') ?></textarea>
        </div>
    </div>
        
    <div class="control-group <?php if (form_error('answer2')) echo 'error'; ?>">
        <label for="answer2">Answer 2</label>
        <div class="controls">
            <?php if (form_error('answer2')) echo '<span class="help-inline">'. form_error('answer2') .'</span>'; ?>
            <textarea name="answer2" class="input-xxlarge" rows="15"><?php echo set_value('answer2', isset($answer) ? $answer->answer2 : '') ?></textarea>
        </div>
    </div>
        
    <div class="control-group <?php if (form_error('answer3')) echo 'error'; ?>">
        <label for="answer3">Answer 3</label>
        <div class="controls">
            <?php if (form_error('answer3')) echo '<span class="help-inline">'. form_error('answer3') .'</span>'; ?>
            <textarea name="answer3" class="input-xxlarge" rows="15"><?php echo set_value('answer3', isset($answer) ? $answer->answer3 : '') ?></textarea>
        </div>
    </div>
    
    <div class="form-actions">
        <input type="submit" name="submit" class="btn btn-primary" value="Save Question" />
        or <a href="<?php echo site_url(SITE_AREA .'/content/cards') ?>">Cancel</a>
    </div>
    
    <?php echo form_close(); ?>
</div>