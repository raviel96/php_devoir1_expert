<?php
namespace App\Model;

class Sport {

    private string $sportNom;

    public function __construct(string $sportNom) {
        $this->sportNom = $sportNom;
    }

	public function getSportNom() : string {
		return $this->sportNom;
	}

	public function setSportNom(string $value) {
		$this->sportNom = $value;
	}
}