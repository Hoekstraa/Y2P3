<?php
class NavbarItem {
	public $name;
	public $href;
	public $active;

	public function __constuct($nm, $hr, $active = false) {
		$this->name = $nm;
		$this->href = $hr;
		$this->active = $active;
	}

	public function NavbarItem($nm, $hr, $active = false) {
		$this->name = $nm;
		$this->href = $hr;
		$this->active = $active;
	}

	public function getName() {
		return $this->name;
	}

	public function getHref() {
		return $this->href;
	}

	public function getActive() {
		return $this->active;
	}
}
?>
