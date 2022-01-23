<?php

class AttendanceContr extends Attendance
{
    private $nip;
    private $nama;
    private $tanggal;
    private $waktu;

    public function __construct($nip, $nama, $tanggal, $waktu)
    {
        $this->nip = $nip;
        $this->nama = $nama;
        $this->tanggal = $tanggal;
        $this->waktu = $waktu;
    }

    public function masuk()
    {
        if($this->attendanceTakenCheck() == false) {
            header("location: ../user/dahsboard-user.php?error=alreadysubmit");
            exit();
        }

        $this->setDataMasuk($this->nip, $this->nama, $this->tanggal, $this->waktu);
    }

    public function pulang()
    {
        if($this->attendanceTakenCheck() == false) {
            header("location: ../user/dahsboard-user.php?error=alreadysubmit");
            exit();
        }
        $this->setDataPulang($this->nip, $this->waktu);
    }

    private function attendanceTakenCheck()
    {
        if(!$this->checkAttendanceinDatabase($this->nip, $this->tanggal)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
   
}