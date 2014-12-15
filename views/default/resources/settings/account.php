<?php
/**
 * Elgg user account settings.
 *
 * @package Elgg
 * @subpackage Core
 */

// Only logged in users
elgg_gatekeeper();

// Make sure we don't open a security hole ...
if ((!elgg_get_page_owner_entity()) || (!elgg_get_page_owner_entity()->canEdit())) {
	register_error(elgg_echo('noaccess'));
	forward('/');
}

$username = get_input('username');

elgg_push_breadcrumb(elgg_echo('settings'), "settings/user/$username");

$title = elgg_echo('usersettings:user', array(elgg_get_page_owner_entity()->name));

$content = elgg_view('core/settings/account');

$params = array(
	'content' => $content,
	'title' => $title,
);
$body = elgg_view_layout('one_sidebar', $params);

echo elgg_view_page($title, $body);
