<?php
class API extends MY_Controller {
    public function index()
    {
        echo "INI API SEMINAR";    
    }
    public function addParticipant()
    {
        // Tangkap data JSON dari frontend
        $json = file_get_contents('php://input');
        if(empty($json)){
            $fb = ["statusCode" => 500, "errors" => "Data kosong"];
            $this->fb($fb);
        }
        $data = json_decode($json, true); // Decode jadi array

        // Validasi hanya bisa jalan jika kita set data-nya dulu
        $this->form_validation->set_data($data);

        // Validasi umum
        $this->form_validation
            ->set_rules("universitas", "Asal Universitas", "required|trim")
            ->set_rules("namaLengkap", "Nama Lengkap", "required|trim|max_length[25]")
            ->set_rules("nomorHP", "Nomor HP", "required|trim")
            ->set_rules("email", "Email", "required|trim|valid_email")
            ->set_rules("seminar", "Seminar", "required|trim");

        $universitas = $data['universitas'] ?? '';

        // Validasi tambahan sesuai nilai universitas
        if ($universitas === "Other") {
            $this->form_validation->set_rules('otherUniversity', 'Nama Universitas', 'trim|required');
        } elseif ($universitas === "Universitas Pelita Bangsa") {
            $this->form_validation
                ->set_rules("nim", "NIM", "required|trim")
                ->set_rules("kelas", "Kelas", "required|trim");
        }

        // Jika validasi gagal
        if ($this->form_validation->run() === FALSE) {
            $fb = ["statusCode" => 500, "errors" => validation_errors()];
            $this->fb($fb);
        }

        // Ambil data dari JSON
        $namaLengkap = $data['namaLengkap'] ?? '';
        $nomorHP = $data['nomorHP'] ?? '';
        $email = $data['email'] ?? '';
        $seminar = $data['seminar'] ?? '';
        $nim = $universitas === "Universitas Pelita Bangsa" ? ($data['nim'] ?? '') : '';
        $kelas = $universitas === "Universitas Pelita Bangsa" ? ($data['kelas'] ?? '') : '';
        $otherUniversity = $universitas === "Other" ? ($data['otherUniversity'] ?? '') : $universitas;

        // Cek duplikasi email
        $check_email = $this->model->gd("peserta", "email", "email = '$email'", "row");
        if (!empty($check_email->email)) {
            $fb = ["statusCode" => 500, "errors" => "Email anda sudah terdaftar"];
            $this->fb($fb);
        }

        // Data untuk insert
        $dataInput = [
            "namalengkap" => $namaLengkap,
            "nomorhp" => $nomorHP,
            "email" => $email,
            "otheruniversity" => $universitas === "Other" ? "Other" : "",
            "universitas" => $universitas === "Other" ? $otherUniversity : $universitas,
            "seminar" => $seminar
        ];

        if ($universitas === "Universitas Pelita Bangsa") {
            $dataInput["nim"] = $nim;
            $dataInput["kelas"] = $kelas;
        }

        // Simpan ke database
        $this->model->insert("peserta", $dataInput);

        // Respon sukses
        $fb = ["statusCode" => 200, "message" => "Data berhasil disimpan"];
        $this->fb($fb);
    }
    public function getParticipant()
    {
        // Ambil data JSON dari body request
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        // Validasi seminar
        if (!isset($data['seminar']) || empty($data['seminar'])) {
            $fb = ["statusCode" => 400, "errors" => "Seminar tidak valid"];
            $this->fb($fb);
        }

        $seminar = $data['seminar'];
        // Jalankan query

        $dataPeserta = $this->model->gd("peserta","universitas, namalengkap, kelas, status_kehadiran, status_cetak_sertifikat","email != '' AND seminar = '$seminar' ORDER BY namalengkap ASC","result");

        // Sukses
        $fb = ["statusCode" => 200, "data" => $dataPeserta];
        $this->fb($fb);
    }
    public function attendanceParticipant()
    {
        // Ambil data JSON dari body request
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        $email = isset($data['email']) ? trim($data['email']) : '';
        $seminar = isset($data['seminar']) ? trim($data['seminar']) : '';

        if (empty($email)) {
            $this->fb(["statusCode" => 400, "errors" => "Isi data email anda terlebih dahulu"]);
        }

        if (empty($seminar)) {
            $this->fb(["statusCode" => 400, "errors" => "Seminar tidak valid"]);
        }

        $peserta = $this->model->gd("peserta", "email", "email = '$email' AND seminar = '$seminar'", "row");

        if (!$peserta) {
            $this->fb(["statusCode" => 404, "errors" => "Data peserta tidak ditemukan"]);
        }

        // Update status kehadiran
        $update = $this->model->update("peserta", "email = '$email' AND seminar = '$seminar'", ["status_kehadiran" => "Hadir"]);
        if (!$update) {
            $this->fb(["statusCode" => 500, "errors" => "Gagal update status kehadiran"]);
        }

        $this->fb(["statusCode" => 200, "data" => $peserta]);
    }
    public function certificateParticipant()
    {
        // Ambil data JSON dari body request
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        $email = isset($data['email']) ? trim($data['email']) : '';
        $seminar = isset($data['seminar']) ? trim($data['seminar']) : '';

        if (empty($email)) {
            $this->fb(["statusCode" => 400, "errors" => "Isi data email anda terlebih dahulu"]);
        }

        if (empty($seminar)) {
            $this->fb(["statusCode" => 400, "errors" => "Seminar tidak valid"]);
        }

        $peserta = $this->model->gd("peserta", "IF(otheruniversity != '', otheruniversity, universitas) as universitas, namalengkap,kelas,status_kehadiran,status_cetak_sertifikat", "email = '$email' AND seminar = '$seminar'", "row");

        if (!$peserta) {
            $this->fb(["statusCode" => 404, "errors" => "Data peserta tidak ditemukan"]);
        }

        // Update status kehadiran
        $update = $this->model->update("peserta", "email = '$email' AND seminar = '$seminar'", ["status_cetak_sertifikat" => "Sudah"]);
        if (!$update) {
            $this->fb(["statusCode" => 500, "errors" => "Gagal update status kehadiran"]);
        }

        $this->fb(["statusCode" => 200, "data" => $peserta]);
    }

}
