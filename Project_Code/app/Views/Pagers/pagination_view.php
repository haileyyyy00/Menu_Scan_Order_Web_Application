<!-- app/Views/pagination_view.php -->
<?php $pager->setSurroundCount(2) ?>

<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <?php if ($pager->hasPreviousPage()) : ?>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getPreviousPage() ?>" aria-label="Previous">
                    <span aria-hidden="true">Previous</span>
                </a>
            </li>
        <?php endif ?>

        <?php foreach ($pager->links() as $link) : ?>
            <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
                <a class="page-link" href="<?= $link['uri'] ?>">
                    <?= $link['title'] ?>
                </a>
            </li>
        <?php endforeach ?>

        <?php if ($pager->hasNextPage()) : ?>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getNextPage() ?>" aria-label="Next">
                    <span aria-hidden="true">Next</span>
                </a>
            </li>
        <?php endif ?>
    </ul>
</nav>

<!-- Custom CSS to style the pagination -->
<style>
    .pagination .page-item.active .page-link {
        background-color: #007bff; /* Customize the active page background color */
        color: white; /* Customize the active page text color */
        border-color: #007bff; /* Customize the active page border color */
    }

    .pagination .page-item .page-link {
        color: #007bff; /* Customize the text color for page links */
    }

    .pagination .page-item .page-link:hover {
        background-color: #e9ecef; /* Customize the hover background color */
    }

    .pagination .page-item.disabled .page-link {
        color: #6c757d; /* Customize the disabled page link color */
    }
</style>
