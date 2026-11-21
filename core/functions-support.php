<?php
function getSupportTicketsList()
{
    $conditions = [
        'is_active' => 1,
        'is_deleted' => 0
    ];
    $tickets = WHEREm('support_tickets', $conditions);
    $run_query = runQuery($tickets);
    return $run_query;
}

function getSupportTicketReplies($id)
{
    $conditions = [
        'reply_to_id' => $id,
        'is_active' => 1,
        'is_deleted' => 0
    ];
    $tickets = WHEREm('support_tickets', $conditions);
    $run_query = runQuery($tickets);
    return $run_query;
}

function getSupportTicketById($id)
{
    $query = WHERE('support_tickets', 'id', $id);
    $package = runQuery($query);
    return $package;
}

function saveSupportTicket($ticket){

    $updated_by = getUserByUserid($ticket['created_by']);
    $updated_by = mysqli_fetch_assoc($updated_by);
    $updated_by = $updated_by['id'];

    $column_values = [
        "reply_to_id" => $ticket['reply_to_id'],
        "ticketid" => date('dmyhis')."SC",
        'site_name' => systemVariable('SITE_NAME'),
        'site_url' => systemVariable('SITE_HOME'),
        'title' => $ticket['title'],
        'issue_type' => $ticket['issue_type'],
        'description' => $ticket['description'],
        'attachments' => json_encode($ticket['attachments']),
        'created_by' => $updated_by,
        'updated_by' => $updated_by,
    ];
    $query = INSERT_escape_string('support_tickets', $column_values);

    // echo $query; return;
    $last_id = runQuery($query, true);
    return $last_id;
}

?>