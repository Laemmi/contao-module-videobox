<div id="<?php echo $this->id; ?>">
    <iframe src="<?= $this->vimeolink ?>"<?php if($this->fs): ?> webkitallowfullscreen mozallowfullscreen allowfullscreen<?php endif; ?> width="<?php echo $this->width; ?>" height="<?php echo $this->height; ?>" frameborder="0"></iframe>
</div>