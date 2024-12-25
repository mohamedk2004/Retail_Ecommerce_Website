<?php if (!empty($cart)): ?>
    <ul class="list-group">
        <?php foreach ($cart as $index => $item): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <?= htmlspecialchars($item['name']) ?> x <?= $item['quantity'] ?>
                </div>
                <div>
                    EGP <?= number_format($item['price'] * $item['quantity'], 2) ?>
                    <button class="btn btn-danger btn-sm" onclick="removeItem(<?= $index ?>)">Remove</button>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
    <p class="mt-3"><strong>Total:</strong> EGP <?= number_format($total, 2) ?></p>
<?php else: ?>
    <p>Your cart is empty.</p>
<?php endif; ?>

<script>
    function removeItem(index) {
        fetch('', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ajax_request: 'remove_item', item_index: index })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                location.reload(); // Reloads the page to reflect changes
            } else {
                alert(data.message);
            }
        });
    }
</script>