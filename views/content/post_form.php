<div class="admin-box">
    <h3>New Quiz</h3>
    
    <?php echo form_open(current_url(), 'class="form-horizontal"'); ?>
    
    <div class="control-group <?php if (form_error('title')) echo 'error'; ?>">
        <label for="title">Title</label>
        <div class="controls">
            <input type="text" name="title" class="input-xxlarge" value="<?php echo set_value('title', isset($post) ? $post->title : ''); ?>" />
            <?php if (form_error('title')) echo '<span class="help-inline">'. form_error('title') .'</span>'; ?>
        </div>
    </div>
        
    <div class="control-group <?php if (form_error('description')) echo 'error'; ?>">
        <label for="description">Description</label>
        <div class="controls">
            <?php if (form_error('description')) echo '<span class="help-inline">'. form_error('description') .'</span>'; ?>
            <input type="text" name="description" class="input-xxlarge" value="<?php echo set_value('description', isset($post) ? $post->description : ''); ?>" />
        </div>
    </div>
    
    <div class="form-actions">
        <input type="submit" name="submit" class="btn btn-primary" value="Save Quiz" />
        or <a href="<?php echo site_url(SITE_AREA .'/content/cards') ?>">Cancel</a>
    </div>
    
    <?php echo form_close(); ?>
</div>