<?php if ($pager->hasPrevious()) : ?>
    <a href="<?= $pager->getPreviousPage() ?>">Previous</a>
<?php endif ?>

<?php foreach ($pager->links() as $link): ?>
    <?php if ($link['active']) : ?>
        <strong><?= $link['title'] ?></strong>
    <?php else : ?>
        <a href="<?= $link['uri'] ?>"><?= $link['title'] ?></a>
    <?php endif ?>
<?php endforeach ?>

<?php if ($pager->hasNext()) : ?>
    <a href="<?= $pager->getNextPage() ?>">Next</a>
<?php endif ?>
    