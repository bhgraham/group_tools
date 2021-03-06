<?php

$group = elgg_extract("entity", $vars);
$invitations = elgg_extract("invitations", $vars);

if (!empty($invitations) && is_array($invitations)) {
	
	$content = "<ul class='elgg-list'>";

	foreach ($invitations as $user) {
		$icon = elgg_view_entity_icon($user, "tiny", array("use_hover" => "true"));

		$user_title = elgg_view("output/url", array(
			"href" => $user->getURL(),
			"text" => $user->name,
			"is_trusted" => true,
		));

		$url = "action/groups/killinvitation?user_guid=" . $user->getGUID() . "&group_guid=" . $group->getGUID();
		$delete_button = elgg_view("output/confirmlink", array(
			"href" => $url,
			"confirm" => elgg_echo("group_tools:groups:membershipreq:invitations:revoke:confirm"),
			"text" => elgg_echo("group_tools:revoke"),
			"class" => "elgg-button elgg-button-delete mlm",
		));

		$body = "<h4>$user_title</h4>";

		$content .= "<li class='elgg-item'>";
		$content .= elgg_view_image_block($icon, $body, array("image_alt" => $delete_button));
		$content .= "</li>";
	}

	$content .= "</ul>";
	
	// pagination
	$content .= elgg_view("navigation/pagination", $vars);
} else {
	$content = elgg_view("output/longtext", array("value" => elgg_echo("group_tools:groups:membershipreq:invitations:none")));
}

echo $content;