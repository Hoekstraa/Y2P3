<?php
class NavbarItem {
	public string $name;
	public string $href;
	public function __constuct($name, $href) {
		$this->name = $name;
		$this->href = $href;
	}
}
?>
