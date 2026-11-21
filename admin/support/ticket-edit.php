<?php

$attachments = $ticket['attachments'];
$attachments = json_decode($attachments);

$images = [];
$files = [];
foreach ($attachments as $attachment) {
    if (str_ends_with($attachment, '.webp')) {
        array_push($images, $attachment);
    } else {
        array_push($files, $attachment);
    }
}

$ticket_replies = getSupportTicketReplies($ticket_id);


$raised_by = $ticket['created_by'];
$raised_by = getUseridById($raised_by);
if ($raised_by == $_SESSION[USER_AUTH]) {
    $raised_wrapper = 'align-items-end';
    $raised_bubble = 'chat-right';
} else {
    $raised_wrapper = 'align-items-start';
    $raised_bubble = 'chat-left';
}

?>
<div class="chat-wrapper">
    <div class="container-fluid chat-container">


        <!-- First Issue Creation Display -->
        <div class="chat-message <?= $raised_wrapper ?>">
            <div class="chat-bubble <?= $raised_bubble ?>">

                <!-- Username -->
                <div class="chat-username mb-1">
                    @<?= getUseridById($ticket['created_by']) ?>
                </div>

                <div class="chat-attachments">
                    <div class="chat-image-group">
                        <?php
                        if (count($images)) {
                            for ($i = 0; $i < count($images); $i++) {
                        ?>
                                <a href="<?= systemVariable('SITE_DIR') ?><?= $images[$i] ?>" target="_blank">
                                    <img src="<?= systemVariable('SITE_DIR') ?><?= $images[$i] ?>" alt="Attachment 1" class="chat-image-attachment">
                                </a>
                        <?php
                            }
                        }
                        ?>
                    </div>

                    <div class="chat-file-group">
                        <?php
                        if (count($files)) {
                            for ($i = 0; $i < count($files); $i++) {
                        ?>
                                <a href="<?= systemVariable('SITE_DIR') ?><?= $files[$i] ?>" class="chat-file-attachment" target="_blank"><?= $files[$i] ?></a>
                        <?php
                            }
                        }
                        ?>
                    </div>

                </div>

                <!-- Text content -->
                <?= $ticket['description'] ?>
                <div class="chat-time"><?= formatDateTime($ticket['created_at']) ?></div>
            </div>
        </div>

        <!-- Replies display -->
        <?php
        if (mysqli_num_rows($ticket_replies) > 0) {
            while ($row = mysqli_fetch_assoc($ticket_replies)) {
                $replied_by = $row['created_by'];
                $replied_by = getUseridById($replied_by);
                if ($replied_by == $_SESSION[USER_AUTH]) {
                    $wrapper = 'align-items-end';
                    $bubble = 'chat-right';
                } else {
                    $wrapper = 'align-items-start';
                    $bubble = 'chat-left';
                }

                // get attachments for reply
                $reply_attachments = $row['attachments'];
                $reply_attachments = json_decode($reply_attachments);

                $reply_images = [];
                $reply_files = [];
                foreach ($reply_attachments as $attachment) {
                    if (str_ends_with($attachment, '.webp')) {
                        array_push($reply_images, $attachment);
                    } else {
                        array_push($reply_files, $attachment);
                    }
                }

        ?>
                <div class="chat-message <?= $wrapper ?>">
                    <div class="chat-bubble <?= $bubble ?>">

                        <!-- Username -->
                        <div class="chat-username mb-1">
                            @<?= $replied_by ?>
                        </div>

                        <div class="chat-attachments">
                            <div class="chat-image-group">
                                <?php
                                if (count($reply_images)) {
                                    for ($i = 0; $i < count($reply_images); $i++) {
                                ?>
                                        <a href="<?= systemVariable('SITE_DIR') ?><?= $reply_images[$i] ?>" target="_blank">
                                            <img src="<?= systemVariable('SITE_DIR') ?><?= $reply_images[$i] ?>" alt="Attachment" class="chat-image-attachment">
                                        </a>
                                <?php
                                    }
                                }
                                ?>
                            </div>

                            <div class="chat-file-group">
                                <?php
                                if (count($reply_files)) {
                                    for ($i = 0; $i < count($reply_files); $i++) {
                                ?>
                                        <a href="<?= systemVariable('SITE_DIR') ?><?= $reply_files[$i] ?>" class="chat-file-attachment" target="_blank"><?= $reply_files[$i] ?></a>
                                <?php
                                    }
                                }
                                ?>
                            </div>

                        </div>

                        <!-- Text content -->
                        <?= $row['description'] ?>
                        <div class="chat-time"><?= formatDateTime($row['created_at']) ?></div>
                    </div>
                </div>
        <?php

            }
        }
        ?>


        <!-- New Reply -->
        <div class="chat-message align-items-end">
            <div class="chat-bubble chat-right">

                <!-- Username -->
                <div class="chat-username mb-1">
                    @<?= $current_admin ?>
                </div>

                <form id="add_new_ticket" method="POST" action="<?= systemVariable('SITE_DIR') ?>admin/support/update-ticket.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label" for="description">Reply</label>
                        <textarea id="description" placeholder="Reply" name="description"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="ticket_attachments">Attachments</label>
                        <input type="file" class="form-control" id="ticket_attachments" placeholder="Issue Attachments" value="" name="ticket_attachments[]" multiple>
                    </div>

                    <input type="hidden" name="ticket_id" value="<?= $ticket_id ?>">

                    <div class="mt-2">
                        <button type="submit" class="btn btn-info me-2">Reply</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>