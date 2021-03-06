<?php
/**
 * Content filter for river
 *
 * @uses $vars[]
 */

// create selection array
$options = [];
$options['type=all'] = elgg_echo('river:select', [elgg_echo('all')]);
$registered_entities = elgg_get_config('registered_entities');

if (!empty($registered_entities)) {
	foreach ($registered_entities as $type => $subtypes) {
		// subtype will always be an array.
		if (!count($subtypes)) {
			$label = elgg_echo('river:select', [elgg_echo("item:$type")]);
			$options["type=$type"] = $label;
		} else {
			foreach ($subtypes as $subtype) {
				$label = elgg_echo('river:select', [elgg_echo("item:$type:$subtype")]);
				$options["type=$type&subtype=$subtype"] = $label;
			}
		}
	}
}

$params = [
	'id' => 'elgg-river-selector',
	'options_values' => $options,
];
$selector = $vars['selector'];
if ($selector) {
	$params['value'] = $selector;
}
$select = elgg_view('input/select', $params);

$input = elgg_format_element([
	'#tag_name' => 'label',
	'class' => 'elgg-river-selector',
	'#text' => elgg_format_element('span', [], elgg_echo('filter')) . " $select",
]);

echo elgg_format_element('div', ['class' => 'clearfix'], $input);
