<?php

// Fetch Active & Trashed
$transactions = fetchAsArray(getInventoryTransactionsById($inventory_id));

// Columns for the table
$columns = [
    [
        'key'   => 'transactionid',
        'label' => 'Transaction ID',
        'renderer' => function ($row) {

            // get transactionid from row
            $transactionid = 'TI-' . prefix_00($row['transactionid']);

            // get invoice from row
            // If invoice is not empty, return a link to the invoice
            $invoice = $row['invoice'] ?? '';
            $transaction_type = $row['transaction_type'] ?? '';
            $invoice_link = ''; // Initialize invoice_link as an empty string
            if ($invoice) {
                // 	0=incoming,1=outgoing
                // If transaction_type is 0, it means incoming, so we use system_generated
                // Otherwise, we use uploads
                if ($transaction_type) {
                    $invoice_link = '<a href="' . SITE_URL . 'system_generated/' . $invoice . '" target="_blank" class="text-decoration-none"><i class="fas fa-receipt"></i></a>';
                } else {
                    $invoice_link = '<a href="' . SITE_URL . 'uploads/' . $invoice . '" target="_blank" class="text-decoration-none"><i class="fas fa-receipt"></i></a>';
                }
            }

            return $transactionid . ' ' . $invoice_link;
        }
    ],
    [
        'key'   => 'old_quantity',
        'label' => 'Previous Stock',
    ],
    [
        'key'   => 'change_quantity',
        'label' => 'Change',
        'renderer' => function ($row) {
            $change_quantity = $row['new_quantity'] - $row['old_quantity'];
            // If change_quantity is 0, return 0
            if ($change_quantity == 0) {
                return '0';
            }
            // If change_quantity is positive, return it with a '+' sign
            // If change_quantity is negative, return it as is
            return $change_quantity > 0
                ?
                '<span class="text-danger"><strong><i class="fas fa-plus"></i> ' . $change_quantity . '</strong></span>'
                :
                '<span class="text-primary"><strong><i class="fas fa-minus"></i> ' . abs($change_quantity) . '</strong></span>';
        }
    ],
    [
        'key'   => 'new_quantity',
        'label' => 'New Stock',
    ],
    [
        'key'   => 'amount',
        'label' => 'Amount',
        'renderer' => function ($row) {
            $amount = $row['amount'] ?? '0';
            return rupee($amount);
        }
    ],
    [
        'key'   => 'remarks',
        'label' => 'Remarks'
    ],
    [
        'key'   => 'updated_by',
        'label' => 'Updated By',
    ],
    [
        'key'   => 'created_at',
        'label' => 'DATE',
        'renderer' => function ($row) {
            return date('d M Y', strtotime($row['created_at']));
        }
    ]
];

?>


<div class="card mb-4">
    <div class="card-body" id="section-data">

        <?php
        renderPermissionAwareTable(
            'transaction_details',   // module name
            $transactions,
            $columns,
            [],   // no allowed actions for active list
            'id'  // rowIdKey
        );
        ?>

    </div>
</div>