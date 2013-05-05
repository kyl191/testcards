<div class="admin-box">
    <h3><?php echo $toolbar_title; ?></h3>
    
    <?php echo form_open(current_url(), 'class="form-horizontal"'); ?>
    
    <div class="control-group <?php if (form_error('question')) echo 'error'; ?>">
        <div class="controls">
            <?php if (form_error('question')) echo '<span class="help-inline">'. form_error('question') . 'please choose a different question.</span>'; ?>
            Add an answer to quiz: <?php echo form_dropdown('question', $questions, $questionid); ?>
        </div>
    </div>
    
    <div class="control-group <?php if (form_error('answer')) echo 'error'; ?>">
        <label for="answer">Answer Text</label>
        <div class="controls">
            <?php echo form_checkbox('correct', '1', $correct); ?>
            <?php if (form_error('answer')) echo '<span class="help-inline">'. form_error('answer') .'</span>'; ?>
            <textarea name="answer" class="input-xxlarge" rows="15"><?php echo set_value('answer', isset($answer) ? $answer->answer : '') ?></textarea>
            
        </div>
    </div>
    
    <div class="form-actions">
        <input type="submit" name="submit" class="btn btn-primary" value="Save Answer" />
        or <a href="<?php echo site_url(SITE_AREA .'/content/cards/edit_question/'.$questionid); ?>">Cancel</a>
    </div>
    
    <?php echo form_close(); ?>
</div>