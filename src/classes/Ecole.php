<?php 

class Ecole {

    private string $schoolName;
    private int $studentsNumber;
    private int $sportNumber;

    public function __construct(string $schoolName, int $studentsNumber, int $sportNumber) {
        $this->schoolName = $schoolName;
		$this->studentsNumber = $studentsNumber;
		$this->sportNumber = $sportNumber;
    }

	public function getSchoolName() : string {
		return $this->schoolName;
	}

	public function setSchoolName(string $value) {
		$this->schoolName = $value;
	}

	public function getStudentsNumber() : int {
		return $this->studentsNumber;
	}

	public function setStudentsNumber(int $value) {
		$this->studentsNumber = $value;
	}

	public function getSportNumber() : int {
		return $this->sportNumber;
	}

	public function setSportNumber(int $value) {
		$this->sportNumber = $value;
	}
}