<!DOCTYPE html>
<html lang="fr">
<head>
    <title>DashBoard - Administration - Cyberus Network</title>
    <?php include_once __DIR__ . "/../../css/header.php"; ?>
</head>

<body>
<div class="container-fluid" >

    <!-- Header -->
    <div class="page-header">
        <h1>Toutes les informations de votre système <small><i>Il y a plein de thermomètres !</i></small></h1>
    </div>

    <!-- Navigation bar -->
    <?php
    $class_dashboard = "active";
    include __DIR__."/../../global/view/nav_bar.php"
    ?>

    <!-- Contents -->
    <p class="lead">Gérer efficacement votre solution.</p>
    <p>Voici la "fiche" de renseignement de votre machine. C'est comme ma-config.com mais en interne</p>

    <!-- USER info -->
    <h4>Informations Machine</h4>

    <h5>Global</h5>
    <dl class="dl-horizontal">
        <dt>Name</dt>
        <dd><?php echo $sysname ?></dd>
        <dt>Version</dt>
        <dd><?php echo $sysdescrip ?></dd>
        <dt>Uptime</dt>
        <dd><?php echo $sysuptime ?></dd>
        <dt>Current time</dt>
        <dd><?php echo $systime ?></dd>
    </dl>

    <h5>Processeur</h5>
    <dl class="dl-horizontal">
        <dt>Utilisation</dt>
        <dd><img src="rrdtool/graph/cpuused-1h.png" /><img src="rrdtool/graph/cpuused-1d.png" /><img src="rrdtool/graph/cpuused-1w.png" /></dd>
    </dl>

    <h5>Mémoire Vive</h5>
    <dl class="dl-horizontal">
        <dt>Utilisation</dt>
        <dd><img src="rrdtool/graph/ramused-1h.png" /><img src="rrdtool/graph/ramused-1d.png" /><img src="rrdtool/graph/ramused-1w.png" /></dd>
    </dl>

    <h5>Disque Dur</h5>
    <dl class="dl-horizontal">
        <dt>Utilisation</dt>
        <dd><img src="rrdtool/graph/diskused-1d.png" /></dd>
    </dl>

    <h4>Informations Interfaces</h4>

    <h5>sisO</h5>

    <dl class="dl-horizontal">
        <dt>Adresse MAC</dt>
        <dd><?php echo $infoifmacsis0 ?></dd>
        <dt>IP</dt>
        <dd><?php echo $infoifipsis0 ?></dd>
        <dt>Utilisation</dt>
        <dd><img src="rrdtool/graph/network-sis0-1h.png" /><img src="rrdtool/graph/network-sis0-1d.png" /><img src="rrdtool/graph/network-sis0-1w.png" /></dd>
    </dl>

    <h5>sis1</h5>

    <dl class="dl-horizontal">
        <dt>Adresse MAC</dt>
        <dd><?php echo $infoifmacsis1 ?></dd>
        <dt>IP</dt>
        <dd><?php echo $infoifipsis1 ?></dd>
        <dt>Utilisation</dt>
        <dd><img src="rrdtool/graph/network-sis1-1h.png" /><img src="rrdtool/graph/network-sis1-1d.png" /><img src="rrdtool/graph/network-sis1-1w.png" /></dd>
    </dl>

    <h5>sis2</h5>

    <dl class="dl-horizontal">
        <dt>Adresse MAC</dt>
        <dd><?php echo $infoifmacsis2 ?></dd>
        <dt>IP</dt>
        <dd><?php echo $infoifipsis2 ?></dd>
        <dt>Utilisation</dt>
        <dd><img src="rrdtool/graph/network-sis2-1h.png" /><img src="rrdtool/graph/network-sis2-1d.png" /><img src="rrdtool/graph/network-sis2-1w.png" /></dd>
    </dl>

    <h5>sis3</h5>

    <dl class="dl-horizontal">
        <dt>Adresse MAC</dt>
        <dd><?php echo $infoifmacsis3 ?></dd>
        <dt>IP</dt>
        <dd><?php echo $infoifipsis3 ?></dd>
        <dt>Utilisation</dt>
        <dd><img src="rrdtool/graph/network-sis3-1h.png" /><img src="rrdtool/graph/network-sis3-1d.png" /><img src="rrdtool/graph/network-sis3-1w.png" /></dd>
    </dl>

    <h5>sis4</h5>

    <dl class="dl-horizontal">
        <dt>Adresse MAC</dt>
        <dd><?php echo $infoifmacsis4 ?></dd>
        <dt>IP</dt>
        <dd><?php echo $infoifipsis4 ?></dd>
        <dt>Utilisation</dt>
        <dd><img src="rrdtool/graph/network-sis4-1h.png" /><img src="rrdtool/graph/network-sis4-1d.png" /><img src="rrdtool/graph/network-sis4-1w.png" /></dd>
    </dl>
    <!-- footer -->
    <?php
    include __DIR__."/../../global/view/footer.php"
    ?>
</div>
</body>
</html>