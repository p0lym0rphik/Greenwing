<div class="project-overview-columns">
    <?php foreach ($columns as $column): ?>
        <div class="project-overview-column">
            <small><?= $this->text->e($column['title']) ?></small>
            <strong title="<?= t('Task count') ?>"><?= $column['nb_open_tasks'] ?></strong>
        </div>
    <?php endforeach ?>
</div>
