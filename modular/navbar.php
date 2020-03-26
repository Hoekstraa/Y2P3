<nav class="pure-menu pure-menu-horizontal">
    <a class="pure-menu-heading pure-menu-link" href="#" title="Ritsema Banken">
    </a>
    <ul class="pure-menu-list">
		<?php
			if (isset($_SESSION['user']) && isset($_SESSION['userId'])) {
				// if current page is dashboard.php, set active
				if (basename($_SERVER['PHP_SELF']) == "dashboard.php") {
					array_push($navigation, new NavbarItem($_SESSION['user'], "dashboard.php", true));
				}
				else {
					array_push($navigation, new NavbarItem($_SESSION['user'], "dashboard.php"));
				}
			}
			foreach($navigation as $navbaritem) {
				echo "<li class=\"pure-menu-item\"><a class=\"pure-menu-link"; if($navbaritem->getActive()) { echo " active"; } echo "\" href=\"" . $navbaritem->getHref() . "\">" . $navbaritem->getName() . "</a></li>";
			}
		?>
    </ul>
</nav>
