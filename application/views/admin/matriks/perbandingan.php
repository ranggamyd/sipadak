<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('_partials/header');
?>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= $title ?></h1>
        </div>

        <?php
        $colors = ["bg-primary", "bg-success", "bg-danger", "bg-warning", "badge-info"];
        foreach ($penyakit as $pe) :
            $id_penyakit = $pe['id_penyakit'];
            $nama_penyakit = $pe['nama_penyakit'];
        ?>
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Analisa Perbandingan Kriteria(Gejala) Pada Penyakit <strong><?= $nama_penyakit ?></strong></h1>
                <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate
            Report</a> -->
            </div>

            <div class="card shadow mb-3">
                <a href="#penyakit" class="d-block collapsed card-header bg-danger py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="penyakit">
                    <h5 class="m-0 font-weight-bold text-light">Analisa Perbandingan Prioritas Gejala Penyakit <?= $nama_penyakit ?></h5>
                </a>

                <div class="collapse show" id="penyakit">
                    <div class="card-body">
                        <form action="<?php echo base_url('matriks/analisa/') . $id_penyakit; ?>" method="post">
                            <input type="hidden" value="<?= $id_penyakit ?>" name="id_penyakit">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 35%;">Gejala A</th>
                                        <th style="width: 35%;" class="text-center">Skala Perbandingan</th>
                                        <th style="width: 35%;">Gejala B</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $a = $id_penyakit;

                                    $query = $this->db->select('rule.id_gejala')
                                        ->select('kode_gejala')
                                        ->from('rule')
                                        ->join('gejala', 'gejala.id_gejala=rule.id_gejala')
                                        ->where('rule.id_penyakit', $a)
                                        ->order_by('kode_gejala', 'DESC')
                                        ->limit(1)
                                        ->get();

                                    $result = $query->result_array();

                                    // var_dump($result);
                                    foreach ($result as $key) { //foreach ambil dari tabel atas (ngambil array terakhir)

                                        $query = $this->db->select('rule.id_gejala')
                                            ->select('kode_gejala')
                                            ->select('nama_gejala')
                                            ->join('gejala', 'gejala.id_gejala=rule.id_gejala')
                                            ->where('id_penyakit', $a)
                                            ->get('rule');

                                        $rules = $query->result_array();

                                        foreach ($rules as $rl) : //foreach ambil dari Controller (buat Kriteria A)
                                            $re = $key['id_gejala'];
                                            $ra = $rl['id_gejala'];
                                            for ($i = 1; $i <= $re; $i++) {
                                                $jid = $i;
                                                $jo = $jid;

                                                $query = $this->db->select('rule.id_gejala')
                                                    ->select('nama_gejala')
                                                    ->select('kode_gejala')
                                                    ->from('rule')
                                                    ->join('gejala', 'gejala.id_gejala=rule.id_gejala')
                                                    ->where('rule.id_gejala', $jo)
                                                    ->where('rule.id_penyakit', $a)
                                                    ->order_by('kode_gejala', 'ASC')
                                                    ->get();

                                                $result = $query->result_array();

                                                foreach ($result as $bc) {
                                                    if ($i == $ra) { ?>
                                                        <tr hidden>
                                                            <td><input type="hidden" name="C[<?php echo $ra . $jid; ?>]" value="<?php echo $ra; ?>"><?php echo $rl['kode_gejala']; ?></td>
                                                            <td><input type="hidden" name="W[<?php echo $ra . $jid; ?>]" value="1"> </td>
                                                            <td><input type="hidden" id="" name="X[<?php echo $ra . $jid; ?>]" value="<?php echo $jo; ?>"><?php echo $bc['kode_gejala']; ?></td>

                                                            <td><input type="hidden" name="" value="<?php echo $ra . $jid; ?>"></td>
                                                        </tr>
                                                    <?php
                                                    } else if ($ra < $i) { ?>
                                                        <tr>
                                                            <td style="font-size:15px;"><input type="hidden" name="C[<?php echo $ra . $jid; ?>]" value="<?php echo $ra; ?>" hidden><?php echo $rl['kode_gejala']; ?> - <?php echo $rl['nama_gejala']; ?></td>
                                                            <td><select required class="calculate form-control" id="W<?php echo $ra . $jid; ?>" class="" name="W[<?php echo $ra . $jid; ?>]">
                                                                    <option value="">--PILIH SKALA PERBANDINGAN--</option>
                                                                    <?php
                                                                    $this->db->order_by('id_nilai', 'DESC');
                                                                    $this->db->from('nilai');
                                                                    $query = $this->db->get();
                                                                    $nilt = $query->result();
                                                                    foreach ($nilt as $keyval) { ?>
                                                                        <option value="<?php echo $keyval->jum_nilai; ?>"><?php echo $keyval->jum_nilai; ?> - <?php echo $keyval->ket_nilai; ?></option>
                                                                    <?php } ?>
                                                                </select></td>
                                                            <td style="font-size:15px;"><input type="hidden" id="" name="X[<?php echo $ra . $jid; ?>]" value="<?php echo $jo; ?>" hidden><?php echo $bc['kode_gejala']; ?> - <?php echo $bc['nama_gejala']; ?></td>

                                                            <td><input type="hidden" id="<?php echo $ra . $jid; ?>" name="" value="<?php echo $ra . $jid; ?>" hidden></td>
                                                            <script type="text/javascript">
                                                                $(document).ready(function() {
                                                                    $('.calculate').bind("change", function(e) {
                                                                        var st = parseFloat($('#W<?php echo $ra . $jid; ?>').val()) || 0;
                                                                        var value = 1 / st;
                                                                        if (!isNaN(value) && value !== Infinity) {
                                                                            $('#W<?php echo $jid . $ra; ?>').val(value);
                                                                        }
                                                                    });
                                                                });
                                                            </script>
                                                        </tr>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <tr hidden>
                                                            <td><input type="hidden" name="C[<?php echo $ra . $jid; ?>]" value="<?php echo $ra; ?>"></td>
                                                            <td><input id="W<?php echo $ra . $jid; ?>" name="W[<?php echo $ra . $jid; ?>]" type="hidden" value=""> </td>
                                                            <td><input type="hidden" name="X[<?php echo $ra . $jid; ?>]" value="<?php echo $jid; ?>"></td>
                                                            <td><input type="hidden" name="" value="<?php echo $ra . $jid; ?>"></td>
                                                        </tr>
                                    <?php }
                                                }
                                            }
                                        endforeach;
                                    } ?>
                                    <tr>
                                        <td colspan="4"><input value="Kalkulasi" type="submit" class="btn btn-fill btn-primary" id="<?= $id_penyakit ?>" name="<?= $id_penyakit ?>"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>


            <div class="card shadow mb-3">
                <a href="#matriks" class="d-block collapsed card-header bg-info py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="matriks">
                    <h5 class="m-0 font-weight-bold text-light">Matriks Perbandingan Gejala Penyakit <?= $nama_penyakit ?></h5>
                </a>
                <div class="collapse" id="matriks">
                    <div class="card-body">
                        <!-- Tabel Analisa Kriteria(Gejala)-->
                        <div class="card shadow mb-3">
                            <?php
                            // $this->db->from('gejala');
                            // $query = $this->db->get();
                            // $listKrit = $query->result();
                            $query = $this->db->select('rule.id_gejala')
                                ->select('kode_gejala')
                                ->select('nama_gejala')
                                ->from('rule')
                                ->join('gejala', 'gejala.id_gejala=rule.id_gejala')
                                ->where('rule.id_penyakit', $id_penyakit)
                                ->order_by('kode_gejala', 'ASC')
                                ->get();
                            $listKrit = $query->result();
                            ?>
                            <!-- Analisa -->
                            <div class="card card-header">
                                <h5 class="m-0 font-weight-bold text-dark">Tabel Analisa Kriteria(Gejala)</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Kriteria</th>
                                                <?php
                                                foreach ($listKrit as $kr) { ?>
                                                    <th><?php echo $kr->kode_gejala; ?></th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($listKrit as $bc) :
                                            ?>
                                                <tr>
                                                    <?php
                                                    $this->db->from('analisa_krit');
                                                    $this->db->where('kriteria_x', $bc->id_gejala);
                                                    $this->db->where('id_penyakit', $id_penyakit);
                                                    $query = $this->db->get();
                                                    $anK = $query->result();
                                                    ?>
                                                    <td><b><?php echo $bc->kode_gejala; ?></b></td>
                                                    <?php foreach ($anK as $at) :
                                                        // $pt = explode("C",$at->kriteria_x);
                                                        // $ps = explode("C",$at->kriteria_y);
                                                        $re = $at->kriteria_y;
                                                        $rf = $at->kriteria_x;
                                                    ?>
                                                        <td class="calculate<?php echo $re; ?>" id="R<?php echo $re . $rf; ?>"><?php echo $at->nilai_krit; ?></td>
                                                    <?php endforeach; ?>
                                                </tr>
                                            <?php endforeach; ?>
                                            <tr>
                                                <td class="bg-info text-white"><b>Jumlah</b></td>
                                                <?php
                                                foreach ($listKrit as $tt) :
                                                    $pt = explode("C", $tt->id_gejala);
                                                    $re = $tt->id_gejala;
                                                ?>
                                                    <td class="bg-info text-white" id="sumR<?php echo $re; ?>"></td>
                                                    <script type="text/javascript">
                                                        $(document).ready(function() {
                                                            var sumR = 0;
                                                            $('.calculate<?php echo $re; ?>').each(function(e) {
                                                                sumR += parseFloat($(this).text());
                                                            });
                                                            var sumRText = sumR.toFixed(5);
                                                            if (parseFloat(sumRText) == Math.floor(sumR)) {
                                                                $('#sumR<?php echo $re; ?>').html(Math.floor(sumR));
                                                            } else {
                                                                $('#sumR<?php echo $re; ?>').html(sumRText);
                                                            }
                                                        });
                                                    </script>
                                                <?php endforeach; ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Perbandingan -->
                        <div class="card shadow-sm mb-3">
                            <div class="card card-header">
                                <h5 class="m-0 font-weight-bold text-dark">Tabel Perbandingan Analisa</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Kriteria</th>
                                                <?php
                                                foreach ($listKrit as $kr) { ?>
                                                    <th><?php echo $kr->kode_gejala; ?></th>
                                                <?php } ?>
                                                <th class="bg-info text-white">Jumlah</th>
                                                <th class="bg-success text-white">Prioritas</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($listKrit as $bc) :
                                                // $pt = explode("C",$bc->id_gejala);
                                                $rx = $bc->id_gejala;
                                            ?>
                                                <tr>
                                                    <?php
                                                    $this->db->from('analisa_krit');
                                                    $this->db->where('kriteria_x', $bc->id_gejala);
                                                    $this->db->where('id_penyakit', $id_penyakit);
                                                    $query = $this->db->get();
                                                    $anK = $query->result();
                                                    ?>
                                                    <td><b><?php echo $bc->kode_gejala; ?></b></td>
                                                    <?php foreach ($anK as $at) :
                                                        // $pt = explode("C",$at->kriteria_x);
                                                        // $ps = explode("C",$at->kriteria_y);
                                                        $re = $at->kriteria_y;
                                                        $rf = $at->kriteria_x;
                                                    ?>
                                                        <td class="calmul<?php echo $rf; ?>" id="ml<?php echo $re . $rf; ?>"><?php echo $at->nilai_krit; ?></td>
                                                        <script type="text/javascript">
                                                            $(document).ready(function() {
                                                                var mlty = 0;
                                                                mlty += parseFloat($('#R<?php echo $re . $rf; ?>').text()) / parseFloat($('#sumR<?php echo $re; ?>').text());
                                                                $('#ml<?php echo $re . $rf; ?>').html(mlty.toFixed(5));
                                                            });
                                                        </script>
                                                    <?php endforeach; ?>
                                                    <script type="text/javascript">
                                                        $(document).ready(function() {
                                                            var sumAX = 0;
                                                            $('.calmul<?php echo $rx; ?>').each(function(e) {
                                                                sumAX += parseFloat($(this).text());
                                                            });
                                                            $('#to<?php echo $rx; ?>').html(sumAX.toFixed(5));
                                                            avgAX = parseFloat($('#to<?php echo $rx; ?>').text()) / <?php echo sizeof($listKrit); ?>;
                                                            $('#tav<?php echo $rx; ?>').html(avgAX.toFixed(5));
                                                            $('#trap<?php echo $rx; ?>').html(avgAX.toFixed(5));
                                                        });
                                                    </script>
                                                    <td class="bg-info text-white" id="to<?php echo $rx; ?>"></td>
                                                    <td class="bg-success text-white" id="tav<?php echo $rx; ?>"></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Penjumlahan -->
                        <div class="card shadow-sm mb-3">
                            <div class="card card-header">
                                <h5 class="m-0 font-weight-bold text-dark">Tabel Analisa Prioritas</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Kriteria</th>
                                                <?php
                                                foreach ($listKrit as $kr) { ?>
                                                    <th><?php echo $kr->kode_gejala; ?></th>
                                                <?php } ?>
                                                <th class="bg-info text-white">Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($listKrit as $bc) :
                                                // $pt = explode("C",$bc->id_gejala);
                                                $rx = $bc->id_gejala;
                                            ?>
                                                <tr>
                                                    <?php
                                                    $this->db->from('analisa_krit');
                                                    $this->db->where('kriteria_x', $bc->id_gejala);
                                                    $this->db->where('id_penyakit', $id_penyakit);
                                                    $query = $this->db->get();
                                                    $anK = $query->result();
                                                    ?>
                                                    <td><b><?php echo $bc->kode_gejala; ?></b></td>
                                                    <?php foreach ($anK as $at) :
                                                        // $pt = explode("C",$at->kriteria_x);
                                                        // $ps = explode("C",$at->kriteria_y);
                                                        $re = $at->kriteria_y;
                                                        $rf = $at->kriteria_x;
                                                    ?>
                                                        <td class="mtrx<?php echo $rf; ?>" id="mt<?php echo $re . $rf; ?>"><?php echo $at->nilai_krit; ?></td>

                                                        <script type="text/javascript">
                                                            $(document).ready(function() {
                                                                var mml = 0;
                                                                mml += parseFloat($('#R<?php echo $re . $rf; ?>').text()) * parseFloat($('#tav<?php echo $re; ?>').text());
                                                                $('#mt<?php echo $re . $rf; ?>').html(mml.toFixed(5));
                                                            });
                                                        </script>
                                                    <?php endforeach; ?>
                                                    <script type="text/javascript">
                                                        $(document).ready(function() {
                                                            var tolMX = 0;
                                                            $('.mtrx<?php echo $rx; ?>').each(function(e) {
                                                                tolMX += parseFloat($(this).text());
                                                            });
                                                            $('#tpri<?php echo $rx; ?>').html(tolMX.toFixed(5));
                                                            $('#traj<?php echo $rx; ?>').html(tolMX.toFixed(5));
                                                        });
                                                    </script>
                                                    <td class="bg-info text-white" id="tpri<?php echo $rx; ?>"></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Rasio Konsistensi -->
                        <div class="card shadow-sm mb-3">
                            <div class="card card-header">
                                <h5 class="m-0 font-weight-bold text-dark">Tabel Rasio Konsistensi</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <form class="" action="<?php echo base_url('matriks/updateNiKr'); ?>" method="post" onsubmit="return check()">
                                        <table class="table border-1 table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Rasio Konsistensi</th>
                                                    <th class="bg-info text-white">Jumlah</th>
                                                    <th class="bg-success text-white">Prioritas</th>
                                                    <!-- <th class="bg-warning text-white">Hasil</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($listKrit as $bc) :
                                                    // $pt = explode("C",$bc->id_gejala);
                                                    $rx = $bc->id_gejala;
                                                ?>
                                                    <tr>
                                                        <td style="width: 55%;"><b><?php echo $bc->nama_gejala; ?></b></td>
                                                        <td class="bg-info text-white col-xs-2" id="traj<?php echo $rx; ?>"></td>
                                                        <td class="bg-success text-white col-xs-2" id="trap<?php echo $rx; ?>"></td>
                                                        <script type="text/javascript">
                                                            $(document).ready(function() {
                                                                var hsl = 0;
                                                                hsl += parseFloat($('#traj<?php echo $rx; ?>').text()) + parseFloat($('#trap<?php echo $rx; ?>').text());
                                                                $('#taha<?php echo $rx; ?>').val(hsl.toFixed(5));
                                                                $('#yo<?php echo $rx; ?>').html(hsl.toFixed(5));
                                                            });
                                                        </script>
                                                        <td hidden><input id="id_gejala" type="hidden" name="id_gejala[<?php echo $rx; ?>]" value="<?php echo $bc->id_gejala; ?>"></td>
                                                        <!-- <td class="bg-warning text-white col-xs-2"><input readonly class="form-control bg-light" type="hidden" name="hasil[<?php echo $rx; ?>]" id="taha<?php echo $rx; ?>" value=""></td> -->
                                                    </tr>
                                                <?php endforeach; ?>
                                                <!-- <table class="table" style="margin : 40px 0 10px 0;">
                                                <tr>
                                                    <td colspan="4"><input type="submit" class="btn btn-fill btn-info" name="" value="Simpan Ke Database"> </td>
                                                </tr>
                                            </table> -->
                                            </tbody>
                                        </table>
                                    </form>
                                    <!-- finish -->
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </section>
</div>

<?php $this->load->view('_partials/footer'); ?>