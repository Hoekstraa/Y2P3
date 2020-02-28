<?php
class ContentBlock {
	private $name;
	private $content;

	public function __constuct($name, $content) {
		$this->name = $name;
		$this->content = $content;
	}

	public function ContentBlock($name, $content) {
		$this->name = $name;
		$this->content = $content;
	}

	public function getName() {
		return $this->name;
	}

	public function getContent() {
		return $this->content;
	}
}
?>
