<?php
class NavbarItem {
	private $name;
	private $href;

	public function __constuct($nm, $hr) {
		$this->name = $nm;
		$this->href = $hr;
	}

	public function NavbarItem($nm, $hr) {
		$this->name = $nm;
		$this->href = $hr;
	}

	public function getName() {
		return $this->name;
	}

	public function getHref() {
		return $this->name;
	}
}
?>
