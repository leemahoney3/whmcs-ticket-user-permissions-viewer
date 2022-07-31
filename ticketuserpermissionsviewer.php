<?php

use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * WHMCS Support Tickets User Permission Viewer
 *
 * Speed up ticket response times by checking user permissions, disabling security questions or two factor authentication for ticket users directly from the support ticket. 
 *
 * @package    WHMCS
 * @author     Lee Mahoney <lee@leemahoney.dev>
 * @copyright  Copyright (c) Lee Mahoney 2022
 * @license    MIT
 * @version    1.0.0
 * @link       https://leemahoney.dev
 */

# No direct calls please
if (!defined('WHMCS')) {
    die('This file cannot be accessed directly');
}

function ticket_user_permissions_viewer($vars) {

    # Grab the ticket ID
    $ticketid = $vars['ticketid'];

    # Grab the ticket details as well as all replies to the ticket
    $ticket         = Capsule::table('tbltickets')->where('id', $ticketid)->first();
    $ticketReplies  = Capsule::table('tblticketreplies')->where('tid', $ticketid)->get();

    # Store the user ID's for those involved with the tickes
    $userIds = [];

    # Add in the ticket creator (only if they are an actual user...)
    if ($ticket->requestor_id != 0) {
        $userIds[] = $ticket->requestor_id;
    }

    # Check all replies and add the related users (only if they are an actual user and have not already been added to the userIds array)
    foreach ($ticketReplies as $reply) {

        if ($reply->requestor_id != 0 && !in_array($reply->requestor_id, $userIds)) {
            $userIds[] = $reply->requestor_id;
        }

    }

    # Have to turn to JavaScript to add the actual sidebar content -_-
    $html = '
    <script type="text/javascript">

        $(document).ready(function () {

            let content = `
                <div class="sidebar-header">
                    <i class="fad fa-lock"></i>
                    User Permissions
                </div>
                <div class="content-padded small">
                    
    ';

    # For each user in the userIds array, grab their details and create the link that opens the modal to edit them. If no items then output a message.

    if(count($userIds)) {

        $html .= '<ol>';
        foreach ($userIds as $userId) {

            $user = Capsule::table('tblusers')->where('id', $userId)->first();

            $html .= '<li><a href="/admin/index.php?rp=/admin/client/' . $ticket->userid . '/user/' . $user->id . '/manage" data-user-id="' . $user->id . '" class="btn-permissions open-modal" data-modal-title="Manage User: ' . $user->email . '" data-modal-size="modal-lg" data-btn-submit-label="Save" data-btn-submit-id="btnSetPermissions">' . $user->first_name . ' ' . $user->last_name . '</li>';

        }
        $html .= '</ol>';
    } else {
        $html .= 'No users found';
    }

    $html .= '
                    </ol>
                </div>
            
            `;

            $(".sidebar-collapse > div:nth-child(2)").after(content);

        });

    </script>
    ';

    # Output the JavaScript
    return $html;

}

# Make sure we call the hook
add_hook('AdminAreaViewTicketPage', 1, 'ticket_user_permissions_viewer');