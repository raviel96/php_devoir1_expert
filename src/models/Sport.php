<?php
namespace App\models;

class Sport {

    private string $sportName;

    public function __construct(string $sportName) {
        $this->sportName = $sportName;
    }

	public function getSportName() : string {
		return $this->sportName;
	}

	public function setSportName(string $value) {
		$this->sportName = $value;
	}
}