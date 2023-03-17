<?php 
namespace App\Model;
class Ecole {

    private string $schoolName;

    public function __construct(string $schoolName) {
        $this->schoolName = $schoolName;
    }

	public function getSchoolName() : string {
		return $this->schoolName;
	}

	public function setSchoolName(string $value) {
		$this->schoolName = $value;
	}

}