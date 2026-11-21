<div class="card mb-4">
    <div class="card-body">
        <form id="add_new_ticket" method="POST" action="<?= systemVariable('SITE_DIR') ?>admin/support/save-ticket.php" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label" for="title">Issue Title</label>
                <input type="text" class="form-control" id="title" placeholder="Issue Title" value="" name="title" required>
            </div>

            <div class="mb-3">
                <label class="form-label" for="issue_type">Issue Type</label>
                <select name="issue_type" id="issue_type" class="form-control" required>
                    <option value="" selected disabled>Issue Type</option>
                    <option value="Website Not Loading">Website Not Loading</option>
                    <option value="Admin Panel Authentication Errors">Admin Panel Authentication Errors</option>
                    <option value="Screen Errors">Screen Errors</option>
                    <option value="UI/UX Errors">UI/UX Errors</option>
                    <option value="Others">Others</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label" for="description">Issue Description</label>
                <textarea id="description" placeholder="Issue Description" name="description"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label" for="ticket_attachments">Issue Attachments</label>
                <input type="file" class="form-control" id="ticket_attachments" placeholder="Issue Attachments" value="" name="ticket_attachments[]" multiple>
            </div>

            <div class="mt-2">
                <button type="submit" class="btn btn-primary me-2">Report</button>
                <button type="reset" class="btn btn-secondary me-2">Reset</button>
            </div>
        </form>
    </div>
</div>