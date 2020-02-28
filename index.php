<?php
require 'twig.php';

$page_title = "Test!";
$navigation = [
	new NavbarItem("Home", "index.php"),
	new NavbarItem("Hypotheken", "hypotheken.php")
];

$contentblocks = [
	new ContentBlock("Welkom bij Ritsema Banken!",
"Molestiae animi veritatis ad explicabo. Qui aut optio exercitationem quia illum sed cupiditate corrupti. Atque et fugiat molestiae est et et.\n
Et eum ea voluptatem neque ut. Aut nisi modi molestiae iste vero sapiente. Itaque dolorem est reprehenderit. Voluptatum illum labore et ducimus esse.\n
Excepturi eos odit voluptate facilis. Qui fugiat nemo enim cum animi voluptatibus quia et. Enim ut quidem quam commodi id rem omnis.\n
Eos excepturi sint molestiae vero. Quod autem quas nemo commodi praesentium magni. Dicta id nostrum illum porro eum asperiores aut. Dicta autem tempora sit quo voluptas. Facilis reprehenderit explicabo eos ea quia dicta dolor sapiente. Sunt amet magnam labore debitis officia inventore ad aperiam.\n
Quae blanditiis ex ex ad consequatur. Eos illo beatae quo dolore corrupti. Neque maxime dolore corporis officiis mollitia et. Debitis dolor quisquam asperiores ut accusantium id rerum. Incidunt sit qui exercitationem vero corporis. Ab est voluptatem mollitia quos.\n")
];	

$scripts = array();
// Starting at 2 so . and .. aren't included
for ($i = 2; $i < sizeof($SCRIPT_FILES); $i++)
{
	array_push($scripts, file_get_contents("scripts/" . $SCRIPT_FILES[$i]));
}

// Render page
echo $twig->render('body.html', [
	'title' => $page_title,
	'style' => $STYLE,
   	'navigation' => $navigation,
	'contentblocks' => $contentblocks,
	'scripts' => $scripts
]);
?>
