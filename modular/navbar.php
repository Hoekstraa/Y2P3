<nav class="pure-menu pure-menu-horizontal">
    <a class="pure-menu-heading pure-menu-link" href="#" title="Ritsema Banken">
	<h5 class="title">Ritsema Banken</h1>
    </a>
    <ul class="pure-menu-list">
		<?php
			foreach($navigation as $navbaritem) {
				echo "<li class=\"pure-menu-item\"><a class=\"pure-menu-link\" href=\"" . $navbaritem->getHref() . "\">" . $navbaritem->getName() . "</a></li>";
			}
		?>
    </ul>
</nav>
