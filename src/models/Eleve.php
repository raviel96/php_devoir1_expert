<?php
namespace App\models;

class Eleve {

    private string $studentName;
    private string $schoolName;
    private string $sportName;

    public function __construct(string $studentName , string $schoolName, string $sportName) {
        $this->studentName = $studentName;
        $this->schoolName = $schoolName;
        $this->sportName = $sportName;
    }

	public function getStudentName() : string {
		return $this->studentName;
	}

	public function setStudentName(string $value) {
		$this->studentName = $value;
	}

	public function getSchoolName() : string {
		return $this->schoolName;
	}

	public function setSchoolName(string $value) {
		$this->schoolName = $value;
	}

	public function getSportName() : string {
		return $this->sportName;
	}

	public function setSportName(string $value) {
		$this->sportName = $value;
	}
}