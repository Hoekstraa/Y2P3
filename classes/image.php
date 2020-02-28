<?php
class Image {
	private $name;
	private $src;

	public function __constuct($name, $src) {
		$this->name = $name;
		$this->src = $src;
	}

	public function Image($name, $src) {
		$this->name = $name;
		$this->src = $src;
	}

	public function getName() {
		return $this->name;
	}

	public function getSrc() {
		return $this->src;
	}
}
?>
