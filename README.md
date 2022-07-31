# WHMCS Ticket User Permissions Viewer

## What is this?
A simple hook to speed up ticket response times by checking user permissions, disabling security questions or two factor authentication for ticket users directly from the support ticket!

## How it works?

When this hook is activated, an additional menu is added to the sidebar titled **User Permissions** that lists all authorized users on the ticket (relating to the account the ticket was opened under).

When you press on the users name, a modal to edit users permissions, details as well as disable their Security Question and Two Factor Authentication shows up on the same page.

This saves you the time of having to load the clients profile and open the users tab. 

As many know, the more users you have, the slower the system runs therefore this is a covenient and fast way to perform popular tasks without leaving the support ticket.

If a ticket is opened by a guest or contact, or perhaps a guest or contact reply to the ticket, they will not be listed on the sidbar.

## How do I install this?

1. Download the zip file from the **Releases** section.

2. Copy the ```includes``` folder to your root WHMCS directory.

3. That's it, your all good to go!

## Have a feature request?

Any ideas for it please let me know! I'm happy to implement anything that may benefit the module further. Email all feature requests to lee@leemahoney.dev

## Contributions

Feel free to fork the repo, make changes, then create a pull request!

## Here's a few pictures...

Sidebar when viewing a ticket

![WHMCS Ticket User Permissions Viewer](https://static.leemahoney.tech/img/whmcs/hooks/whmcs-ticket-user-permissions-viewer/im001.png)

User Permissions modal on the ticket page

![WHMCS Ticket User Permissions Viewer](https://static.leemahoney.tech/img/whmcs/hooks/whmcs-ticket-user-permissions-viewer/im002.png)

Status updated on the same page without refreshing

![WHMCS Ticket User Permissions Viewer](https://static.leemahoney.tech/img/whmcs/hooks/whmcs-ticket-user-permissions-viewer/im003.png)

