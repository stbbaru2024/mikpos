<?php foreach ($router as $row) {
    $routerid = $row->id;
    $userid = $row->user_id;
    $routername = $row->router_name;
    $routerdns = $row->router_dns;
}
function ratelimit($str) {
    $mainlimit = explode(" ",$str)[0];
    $upto = explode(" ",$str)[1];
    if (!empty($upto)) {
        $upto = explode("/",$upto)[1];
        $upto = preg_replace('/k|K|m|M/', '', $upto); 
        if ($upto >= 100)
        {
            $upto = number_format($upto / 1024, 1) . 'Mbps';
        } else if ($upto < 100) {
            $upto = 'UpTo ' . $upto . 'Mbps';
        }
        return $upto;
    } else {
        $mainlimit = explode("/",$mainlimit)[1];
        $mainlimit = preg_replace('/k|K|m|M/', '', $mainlimit); 
        if ($mainlimit >= 100)
        {
            $mainlimit = number_format($mainlimit / 1024, 1) . 'Mbps';
        } else if ($mainlimit < 100) {
            $mainlimit = $mainlimit . 'Mbps';
        }
        return $mainlimit;
    }
}
function totalratelimit($str,$str2) {
    $str = explode("/",$str)[1];
    $str = preg_replace('/k|K|m|M/', '', $str); 
    if ($str >= 100)
    {
        $str = number_format($str / 1024, 1) * $str2. 'Mbps';
    } else if ($str < 100) {
         $str = $str * $str2 . 'Mbps';
    }
    return $str;
}
function formatBytes($size, $precision = 2)
{
    if ($size == '0') {
        return $size;
    } else {
    $base = log($size, 1024);
    $suffixes = array('', 'KB', 'MB', 'GB', 'TB');   

    return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
    }
}
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Status: <?= $membername ?></title>
<link id="style" href="<?php echo base_url() ?>/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<style>
@media only screen and (max-width: 600px) {
    .memberdetail {
        margin-left:1px;
    }
    .mob1 {
        margin-top:5px !important;
    }
}
</style>
</head>
<body class="">
<div class="container" style="max-width:500px;">
    <div class="row">
        
        <div class="col-md-7 col-lg-12 mt-1">
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="text-muted">Kode Akses</h6>
                    </div>
                    <div>
                        <h6><?= $membername ?></h6>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="text-muted">Shared Device</h6>
                    </div>
                    <div>
                        <h6><?= $shared ?> Device</h6>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="text-muted">Speed</h6>
                    </div>
                    <div>
                        <h6>
                        <?php if ($shared > 1)  {?>
                            <?= ratelimit($ratelimit) ?>/Device
                        <?php } else { ?> 
                            <?= ratelimit($ratelimit) ?>
                        <?php } ?>
                    </h6>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="text-muted">Total Download</h6>
                    </div>
                    <div>
                        <h6><?= formatBytes($download) ?></h6>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="text-muted">Total Upload</h6>
                    </div>
                    <div>
                        <h6><?= formatBytes($upload) ?></h6>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="text-muted">Masa Aktif</h6>
                    </div>
                    <div>
                        <h6><?= $validity ?></h6>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="text-muted">Kadaluarsa</h6>
                    </div>
                    <div>
                        <h6><?= $exp ?></h6>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="text-muted">Status</h6>
                    </div>
                    <div>
                        <h6><?= $status ?></h6>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="text-muted">Harga</h6>
                    </div>
                    <div>
                        <h6><?= $price ?></h6>
                    </div>
                </li>
            </ul>
        </div>
       
            <div class="d-flex justify-content-center">
                <button type="button" class="btn btn-primary" onclick='history.go(-1)'>< Kembali</button>
                <br/> 
            </div>
</div>



        <div class="modal-footer d-flex justify-content-center">
            <button type="button" class="btn btn-secondary btn-sm" onclick="closeModal()">Tutup</button>
        </div>
    </div>
</div>
</div>
<div class="modal-backdrop fade show" id="backdrop" style="display: none;"></div>

<script>
    function openModal() {
        document.getElementById("backdrop").style.display = "block";
        document.getElementById("exampleModal").style.display = "block";
        document.getElementById("exampleModal").classList.add("show");
    }
    function closeModal() {
        document.getElementById("backdrop").style.display = "none";
        document.getElementById("exampleModal").style.display = "none";
        document.getElementById("exampleModal").classList.remove("show");
    }
</script>
</body>
</html>
