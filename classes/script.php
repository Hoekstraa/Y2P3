<?php
class Script {
	private $name;
	private $contents;

	public function __constuct($name, $contents) {
		$this->name = $name;
		$this->contents = $contents;
	}

	public function NavbarItem($name, $contents) {
		$this->name = $name;
		$this->contents = $contents;
	}

	public function getName() {
		return $this->name;
	}

	public function getContents() {
		return $this->contents;
	}
}
?>
