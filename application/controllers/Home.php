<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function index()
    {
        $this->load->view('index');
    }

    public function diagnosa()
    {
        switch ($this->input->post()) {
            default:
                if ($this->input->post()) {
                    $nama       = $this->input->post('nama');
                    $umur       = $this->input->post('umur');
                    $no_hp      = $this->input->post('no_hp');
                    $jenis_hewan      = $this->input->post('jenis_hewan');
                    $alamat     = $this->input->post('alamat');

                    $data1 = [
                        'nama'  => $nama,
                        'umur'  => $umur,
                        'no_hp' => $no_hp,
                        'jenis_hewan' => $jenis_hewan,
                        'alamat' => $alamat,
                    ];

                    $this->pasien_model->tambah2($data1);

                    $id_pasien      = $this->input->post('id_pasien');
                    $tgl_diagnosa   = $this->input->post('tgl_diagnosa');
                    $kondisi        = $this->input->post('kondisi');
                    $arbobot        = array('0', '1', '0.8', '0.6', '0.4', '0.2');
                    $argejala       = array();

                    foreach ($kondisi as $kondisi_item) {
                        $kondisi = explode("_", $kondisi_item);
                        if (strlen($kondisi_item) > 1) {
                            $argejala[$kondisi[0]] = $kondisi[1];
                        }
                    }

                    //PERHITUNGAN CF
                    $arpenyakit = array();
                    $sqlpenyakit = $this->diagnosa_model->get_penyakit();
                    foreach ($sqlpenyakit->result_array() as $rpenyakit) {
                        $id_penyakit = $rpenyakit['id_penyakit'];
                        $cftotal_temp = 0;
                        $cf = 0;
                        $sqlgejala = $this->diagnosa_model->get_rule_where($id_penyakit);
                        $cf_old = 0;
                        foreach ($sqlgejala as $rgejala) {
                            $arkondisi = explode("_", $_POST['kondisi'][0]);
                            $gejala = $arkondisi[0];
                            if (is_array($_POST['kondisi'])) {
                                foreach ($_POST['kondisi'] as $kondisi) {
                                    $arkondisi = explode("_", $kondisi);
                                    $gejala = $arkondisi[0];
                                    if ($rgejala['id_gejala'] == $gejala) {
                                        $cf = $rgejala['cf_pakar'] * $arbobot[$arkondisi[1]];
                                        if (($cf >= 0) && ($cf * $cf_old >= 0)) {
                                            $cf_old = $cf_old + ($cf * (1 - $cf_old));
                                        }
                                        if ($cf * $cf_old < 0) {
                                            $cf_old = ($cf_old + $cf) / (1 - min(abs($cf_old), abs($cf)));
                                        }
                                        if (($cf < 0) && ($cf * $cf_old >= 0)) {
                                            $cf_old = $cf_old + ($cf * (1 + $cf_old));
                                        }
                                    }
                                }
                            }
                        }
                        if ($cf_old > 0) {
                            $arpenyakit[$rpenyakit['id_penyakit']] = number_format($cf_old, 4);
                        }
                    }

                    arsort($arpenyakit);

                    $inpgejala = serialize($argejala);
                    $inppenyakit = serialize($arpenyakit);

                    $np1 = 0;
                    foreach ($arpenyakit as $key1 => $value1) {
                        $np1++;
                        $idpkt1[$np1] = $key1;
                        $vlpkt1[$np1] = $value1;
                        if ($idpkt1[$np1] == NULL && $vlpkt1[$np1] == null) {
                            $idpkt1[1] = 0;
                            $vlpkt1[1] = 0;
                        } else {
                            $idpkt1[$np1] = $key1;
                            $vlpkt1[$np1] = $value1;
                        }
                    }

                    // END CF

                    $data = [
                        'id_pasien'     => $id_pasien,
                        'tanggal'       => $tgl_diagnosa,
                        'gejala'        => $inpgejala,
                        'penyakit'      => $inppenyakit,
                        'hasil_id'      => $idpkt1[1],
                        'hasil_nilai'   => $vlpkt1[1]
                    ];

                    $this->diagnosa_model->simpanHasil($data);
                    $this->session->set_flashdata('sukses', 'Berhasil Melakukan Diagnosa !');

                    $data['pasien'] = $this->diagnosa_model->get_pasien_where($id_pasien);
                    $data['tanggal'] = $tgl_diagnosa;
                    $data['arkondisitext'] = $this->diagnosa_model->getKondisiText();
                    $data['argejala'] = $argejala;
                    $data['arpenyakit'] = $arpenyakit;
                    $data['arpkt'] = $this->diagnosa_model->getPenyakit();
                    $data['arspkt'] = $this->diagnosa_model->getPenyakit2();

                    $this->load->view('hasil_diagnosa', $data);
                } else {

                    $data['pasien'] = $this->pasien_model->get_pasien();
                    $data['idpasien'] = $this->pasien_model->get_id_pasien_baru();
                    $data['kondisi'] = $this->diagnosa_model->get_kondisi();
                    $data['penyakit'] = $this->penyakit_model->get_penyakit();
                    $data['gejala'] = $this->gejala_model->get_gejala();

                    $this->load->view('form_diagnosa', $data);
                }
                break;
        }
    }
}
