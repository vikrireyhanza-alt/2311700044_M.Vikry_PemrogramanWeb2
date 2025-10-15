<?php
class ProgramStudi {
    public $id;
    public $prodi;
    public $kode_prodi;
    public $status;
    public $jenjang;
    public $kaprodi;
    public $fakultas;

    public function __construct($id, $prodi, $kode_prodi, $status, $jenjang, $kaprodi, $fakultas) {
        $this->id = $id;
        $this->prodi = $prodi;
        $this->kode_prodi = $kode_prodi;
        $this->status = $status;
        $this->jenjang = $jenjang;
        $this->kaprodi = $kaprodi;
        $this->fakultas = $fakultas;
    }
}
?>
