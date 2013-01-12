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
    
    <?php for($i = 1; $i<=3; $i++){ ?>
    <div class="control-group <?php if (form_error('answer'.$i)) echo 'error'; ?>">
        <label for="answer<?php echo $i; ?>">Answer <?php echo $i; ?></label>
        <div class="controls">
            <?php if (form_error('answer'.$i)) echo '<span class="help-inline">'. form_error('answer'.$1) .'</span>'; ?>
            <textarea name="answer<?php echo $i; ?>" class="input-xxlarge" rows="15"><?php echo set_value('answer'.$i, isset($answers) ? $answers[$i-1]['answer'] : '') ?></textarea>
        </div>
    </div>
    <?php } ?>
    
    <div class="form-actions">
        <input type="submit" name="submit" class="btn btn-primary" value="Save Question" />
        or <a href="<?php echo site_url(SITE_AREA .'/content/cards') ?>">Cancel</a>
    </div>
    
    <?php echo form_close(); ?>
</div>