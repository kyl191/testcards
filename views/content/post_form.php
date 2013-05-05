<div class="admin-box">
    <h3><?php echo $toolbar_title; ?></h3>
    
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

    <?php if (isset($questions) && is_array($questions) && !empty($questions)) :?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="column-check"><input class="check-all" type="checkbox" /></th>
                    <th>Question</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td colspan="2">
                        With selected: 
                        <input type="submit" name="delete" class="btn" value="Delete"> 
                    </td>
                </tr>
            </tfoot>
            <tbody>
            <?php foreach ($questions as $question) : ?>
                <tr>
                    <td><input type="checkbox" name="checked[]" value="<?php echo $question['id'] ?>" /></td>
                    <td>
                        <a href="<?php echo site_url(SITE_AREA .'/content/cards/edit_question/'. $question['id']) ?>">
                            <?php e($question['question']); ?>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    <div class="form-actions">
        <?php if (isset($questions) && is_array($questions) && !empty($questions)) :?>
            <input type="submit" name="add" class="btn btn-primary" value="Add a question" /> or 
        <?php endif; ?>
        <input type="submit" name="submit" class="btn btn-primary" value="Save Quiz" />
        or <a href="<?php echo site_url(SITE_AREA .'/content/cards') ?>">Cancel</a>
    </div>
    
    <?php echo form_close(); ?>
</div>