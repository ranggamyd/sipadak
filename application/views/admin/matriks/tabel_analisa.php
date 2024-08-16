<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('_partials/header');
?>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1></h1>
        </div>

        <div class="container-fluid text-dark">
            <?php
            $colors = ["bg-primary", "bg-success", "bg-danger", "bg-warning", "badge-info"];
            foreach ($penyakit as $pe) :
                $id_penyakit = $pe['id_penyakit'];
                $nama_penyakit = $pe['nama_penyakit'];
            ?>
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Matriks Perbandingan Gejala Penyakit <?= $nama_penyakit ?></h1>
                    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate
            Report</a> -->
                </div>

                <div class="card shadow-sm mb-3">
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
                        <h4 class="title">Tabel Analisa Kriteria(Gejala) </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Kriteria</th>
                                        <?php
                                        foreach ($listKrit as $kr) { ?>
                                            <th><?= $kr->kode_gejala; ?></th>
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
                                            <td><b><?= $bc->kode_gejala; ?></b></td>
                                            <?php foreach ($anK as $at) :
                                                // $pt = explode("C",$at->kriteria_x);
                                                // $ps = explode("C",$at->kriteria_y);
                                                $re = $at->kriteria_y;
                                                $rf = $at->kriteria_x;
                                            ?>
                                                <td class="calculate<?= $re; ?>" id="R<?= $re . $rf; ?>"><?= $at->nilai_krit; ?></td>
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
                                            <td class="bg-info text-white" id="sumR<?= $re; ?>"></td>
                                            <script type="text/javascript">
                                                $(document).ready(function() {
                                                    var sumR = 0;
                                                    $('.calculate<?= $re; ?>').each(function(e) {
                                                        sumR += parseFloat($(this).text());
                                                    });
                                                    $('#sumR<?= $re; ?>').html(sumR.toFixed(5));
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
                        <h4 class="title">Tabel Perbandingan Analisa</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Kriteria</th>
                                        <?php
                                        foreach ($listKrit as $kr) { ?>
                                            <th><?= $kr->kode_gejala; ?></th>
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
                                            <td><b><?= $bc->kode_gejala; ?></b></td>
                                            <?php foreach ($anK as $at) :
                                                // $pt = explode("C",$at->kriteria_x);
                                                // $ps = explode("C",$at->kriteria_y);
                                                $re = $at->kriteria_y;
                                                $rf = $at->kriteria_x;
                                            ?>
                                                <td class="calmul<?= $rf; ?>" id="ml<?= $re . $rf; ?>"><?= $at->nilai_krit; ?></td>
                                                <script type="text/javascript">
                                                    $(document).ready(function() {
                                                        var mlty = 0;
                                                        mlty += parseFloat($('#R<?= $re . $rf; ?>').text()) / parseFloat($('#sumR<?= $re; ?>').text());
                                                        $('#ml<?= $re . $rf; ?>').html(mlty.toFixed(5));
                                                    });
                                                </script>
                                            <?php endforeach; ?>
                                            <script type="text/javascript">
                                                $(document).ready(function() {
                                                    var sumAX = 0;
                                                    $('.calmul<?= $rx; ?>').each(function(e) {
                                                        sumAX += parseFloat($(this).text());
                                                    });
                                                    $('#to<?= $rx; ?>').html(sumAX.toFixed(5));
                                                    avgAX = parseFloat($('#to<?= $rx; ?>').text()) / <?= sizeof($listKrit); ?>;
                                                    $('#tav<?= $rx; ?>').html(avgAX.toFixed(5));
                                                    $('#trap<?= $rx; ?>').html(avgAX.toFixed(5));
                                                });
                                            </script>
                                            <td class="bg-info text-white" id="to<?= $rx; ?>"></td>
                                            <td class="bg-success text-white" id="tav<?= $rx; ?>"></td>
                                            <!-- <td class="bg-warning text-white" id="λmaks<?= $rx; ?>"></td> -->
                                            <script type="text/javascript">
                                                $(document).ready(function() {
                                                    <?php foreach ($listKrit as $tt) : ?>
                                                        var sumR<?= $tt->id_gejala; ?> = parseFloat($('#sumR<?= $tt->id_gejala; ?>').text());
                                                    <?php endforeach; ?>

                                                    <?php foreach ($listKrit as $bc) : ?>
                                                        var rx<?= $bc->id_gejala; ?> = <?= $bc->id_gejala; ?>;
                                                        var sumAX<?= $bc->id_gejala; ?> = 0;
                                                        $('.calmul<?= $bc->id_gejala; ?>').each(function(e) {
                                                            sumAX<?= $bc->id_gejala; ?> += parseFloat($(this).text());
                                                        });
                                                        $('#to<?= $bc->id_gejala; ?>').html(sumAX<?= $bc->id_gejala; ?>.toFixed(4));
                                                        $('#top<?= $bc->id_gejala; ?>').html(sumAX<?= $bc->id_gejala; ?>.toFixed(4));
                                                        var avgAX<?= $bc->id_gejala; ?> = sumAX<?= $bc->id_gejala; ?> / <?= count($listKrit); ?>;
                                                        $('#tav<?= $bc->id_gejala; ?>').html(avgAX<?= $bc->id_gejala; ?>.toFixed(4));

                                                        // Perhitungan #λmaks
                                                        var λmaks<?= $bc->id_gejala; ?> = avgAX<?= $bc->id_gejala; ?> * sumR<?= $bc->id_gejala; ?>;
                                                        $('#λmaks<?= $bc->id_gejala; ?>').html(λmaks<?= $bc->id_gejala; ?>.toFixed(4));
                                                    <?php endforeach; ?>
                                                });
                                            </script>
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
                        <h4 class="title">Tabel Analisa Prioritas</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Kriteria</th>
                                        <?php
                                        foreach ($listKrit as $kr) { ?>
                                            <th><?= $kr->kode_gejala; ?></th>
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
                                            <td><b><?= $bc->kode_gejala; ?></b></td>
                                            <?php foreach ($anK as $at) :
                                                // $pt = explode("C",$at->kriteria_x);
                                                // $ps = explode("C",$at->kriteria_y);
                                                $re = $at->kriteria_y;
                                                $rf = $at->kriteria_x;
                                            ?>
                                                <td class="mtrx<?= $rf; ?>" id="mt<?= $re . $rf; ?>"><?= $at->nilai_krit; ?></td>

                                                <script type="text/javascript">
                                                    $(document).ready(function() {
                                                        var mml = 0;
                                                        mml += parseFloat($('#R<?= $re . $rf; ?>').text()) * parseFloat($('#tav<?= $re; ?>').text());
                                                        $('#mt<?= $re . $rf; ?>').html(mml.toFixed(5));
                                                    });
                                                </script>
                                            <?php endforeach; ?>
                                            <script type="text/javascript">
                                                $(document).ready(function() {
                                                    var tolMX = 0;
                                                    $('.mtrx<?= $rx; ?>').each(function(e) {
                                                        tolMX += parseFloat($(this).text());
                                                    });
                                                    $('#tpri<?= $rx; ?>').html(tolMX.toFixed(5));
                                                    $('#traj<?= $rx; ?>').html(tolMX.toFixed(5));
                                                });
                                            </script>
                                            <td class="bg-info text-white" id="tpri<?= $rx; ?>"></td>
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
                        <h4 class="title">Tabel Rasio Konsistensi</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <form class="" action="<?= base_url('matriks/updateNiKr/') . $id_penyakit; ?>" method="post" onsubmit="return check()">
                                <table class="table border-1 table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>Kriteria</th>
                                            <th class="bg-warning text-white">(λ maks)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($listKrit as $bc) :
                                            $rx = $bc->id_gejala;
                                        ?>
                                            <tr>
                                                <td style="width: 55%;"><b><?= $bc->nama_gejala; ?></b></td>
                                                <td class="bg-warning text-white" id="λmaks<?= $rx; ?>"></td>

                                                <script type="text/javascript">
                                                    $(document).ready(function() {
                                                        var sumAX = 0;
                                                        $('.calmul<?= $rx; ?>').each(function(e) {
                                                            sumAX += parseFloat($(this).text());
                                                        });
                                                        $('#to<?= $rx; ?>').html(sumAX.toFixed(4));
                                                        avgAX = parseFloat($('#to<?= $rx; ?>').text()) / <?= sizeof($listKrit); ?>;
                                                        $('#tav<?= $rx; ?>').html(avgAX.toFixed(4));
                                                        $('#trap<?= $rx; ?>').html(avgAX.toFixed(4));
                                                        $('#trap2<?= $rx; ?>').val(avgAX.toFixed(4));
                                                    });
                                                </script>
                                                <td hidden><input id="id_gejala" type="text" name="id_gejala[<?= $rx; ?>]" value="<?= $bc->id_gejala; ?>"></td>
                                                <td hidden>
                                                    <input type="text" name="id_penyakit" value="<?= $id_penyakit ?>">
                                                </td>
                                                <td hidden class="bg-warning text-white w-50">
                                                    <input readonly class="form-control" type="text" name="hasil[<?= $rx; ?>]" id="trap2<?= $rx; ?>" value="">
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <tr>
                                            <th class="bg-secondary text-light">Jumlah</th>

                                            <th class="bg-secondary text-light" id="sumλmaks"></th>
                                            <script type="text/javascript">
                                                $(document).ready(function() {
                                                    var sumλmaks = 0;
                                                    $('.bg-warning.text-white').each(function() {
                                                        var val = parseFloat($(this).text());
                                                        if (!isNaN(val)) {
                                                            sumλmaks += val;
                                                        } else {
                                                            console.error("Nilai NaN ditemukan:", $(this).text());
                                                        }
                                                    });

                                                    $('#sumλmaks').html(sumλmaks.toFixed(4));
                                                });
                                            </script>

                                        </tr>
                                        <tr>
                                            <th class="bg-light">Consistency Index (CI) <span id="cri" style="float: right;"></span></th>

                                            <th class="bg-light ci" id="cr"></th>
                                            <script type="text/javascript">
                                                $(document).ready(function() {
                                                    var cr = 0,
                                                        a = 0,
                                                        b = 0;

                                                    a = parseFloat($('#sumλmaks').text()) - <?= sizeof($listKrit); ?>;
                                                    b = <?= sizeof($listKrit); ?> - 1;
                                                    cr = a / b;

                                                    $('#cr').append(cr.toFixed(4));
                                                });
                                            </script>

                                        </tr>
                                        <tr>
                                            <th class="bg-light">Consistency Ratio (CR)</th>
                                            <th class="bg-light" id="finalCR"></th>
                                            <script>
                                                $(document).ready(function() {
                                                    const RI = {
                                                        1: 0.00,
                                                        2: 0.00,
                                                        3: 0.58,
                                                        4: 0.90,
                                                        5: 1.12,
                                                        6: 1.24,
                                                        7: 1.32,
                                                        8: 1.41,
                                                        9: 1.45,
                                                        10: 1.49
                                                    };

                                                    const CI = $('.ci').text();
                                                    const n = <?= sizeof($listKrit); ?>;

                                                    let RI_value = RI[n];
                                                    if (n > 10) RI_value = RI[10]

                                                    const CR = CI / RI_value;

                                                    console.log("n = " + n);
                                                    console.log("CI = " + CI);
                                                    console.log("RI = " + RI_value);
                                                    console.log("CR = " + CR);

                                                    $('#finalCR').html(CR.toFixed(4));

                                                    if (CR < 0.1) {
                                                        status = 'Konsisten';
                                                        msg = '<span class="float-right badge badge-sm badge-info d-flex align-items-center"><i class="fas fa-check text-white mr-2"></i> <strong>CR KONSISTEN</strong></span>';
                                                    } else {
                                                        status = 'Tidak Konsisten';
                                                        msg = '<span class="float-right badge badge-sm badge-danger d-flex align-items-center"><i class="fas fa-times text-white mr-2"></i> <strong>CR TIDAK KONSISTEN</strong></span>';
                                                        document.getElementById("<?= $id_penyakit ?>").disabled = true;
                                                    }

                                                    $('#finalCR').append(msg);
                                                })
                                            </script>
                                        </tr>
                                        <table class="table" style="margin : 40px 0 10px 0;">
                                            <tr>
                                                <td>
                                                    <input type="submit" class="btn btn-fill btn-primary" name="" value="Simpan Ke Database" id="<?= $id_penyakit ?>" name="<?= $id_penyakit ?>">
                                                    <button class="btn btn-fill btn-danger float-right" onclick="history.back()"><i class="fas fa-sync-alt mr-2"></i>Bandingkan ulang</button>
                                                </td>
                                            </tr>
                                        </table>
                                    </tbody>
                                </table>
                            </form>
                            <!-- finish -->
                        </div>
                    </div>
                </div>
            <?php endforeach ?>

        </div>
    </section>
</div>

<?php $this->load->view('_partials/footer'); ?>