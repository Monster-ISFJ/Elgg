<?php
/**
 * Elgg reported content: archive action
 *
 * @package ElggReportedContent
 */

$guid = (int) get_input('guid');

$report = get_entity($guid);
if (!$report || $report->getSubtype() !== "reported_content" || !$report->canEdit()) {
	register_error(elgg_echo("reportedcontent:notarchived"));
	forward(REFERER);
}

// allow another plugin to override
if (!elgg_trigger_plugin_hook('reportedcontent:archive', 'system', ['report' => $report], true)) {
	register_error(elgg_echo("reportedcontent:notarchived"));
	forward(REFERER);
}

// change the state
$report->state = "archived";

system_message(elgg_echo("reportedcontent:archived"));
forward(REFERER);
