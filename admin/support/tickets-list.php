<?php
$tickets_list = getSupportTicketsList();
?>
<div class="card mb-4">
    <div class="card-body" id="section-data">

        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-tickets" aria-controls="navs-top-tickets" aria-selected="true">
                    Raised Tickets(<?= mysqli_num_rows($tickets_list) ?>)
                </button>
            </li>
            <li class="nav-item">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" aria-selected="false" onclick="window.location.href='./?new_ticket'">
                    New Ticket
                </button>
            </li>
        </ul>
        <div class="tab-content padding-left-0 padding-right-0 padding-top-1_5rem padding-bottom-1_5rem">
            <div class="tab-pane fade show active" id="navs-top-tickets" role="tabpanel">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <!-- <th>SL</th> -->
                            <th>ID</th>
                            <th>Issue</th>
                            <th>Status</th>
                            <th>Raised By</th>
                            <th>Raised On</th>
                            <th>Replied By</th>
                            <th>Last Updated On</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php


                        if (mysqli_num_rows($tickets_list) > 0) {
                            $SL = 1;
                            while ($row = mysqli_fetch_assoc($tickets_list)) {
                                if ($row['reply_to_id'] != 0) continue;
                                echo '
                               <tr>
                                    
                                    <td>#' . $row['ticketid'] . '</td>
                                    <td><a href="./?id=' . $row['id'] . '">' . $row['title'] . '</a></td>
                                    <td><span class="badge bg-dark">' . $row['status'] . '</span></td>
                                    <td>' . getUseridById($row['created_by']) . '</td>
                                    <td>' . $row['created_at'] . '</td>
                                    <td>' . getUseridById($row['updated_by']) . '</td>
                                    <td>' . $row['updated_at'] . '</td>
                                    
                                </tr>
                               
                               ';
                                $SL++;
                            }
                        } else {
                            echo '<tr><td colspan="5">No Tickets Found!</td></tr>';
                        }

                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

