<?php

include 'functions.php';

// Query che mi estrae il dettaglio della stanza

$sql = "SELECT * FROM stanze WHERE id = " . $_GET['id_stanza'];
$result = esegui_query($sql);
// visualizzo i dettagli della stanza



// Query per estrarre le prenotazioni relative ad una stanza compreso la configurazione della stanza

$sql_join = "SELECT prenotazioni.id AS numero_prenotazione, prenotazioni.created_at as data_creazione, prenotazioni.updated_at as data_prenotazione_aggiornata, configurazioni.title as configurazione_stanza FROM `stanze` JOIN prenotazioni ON stanze.id = prenotazioni.stanza_id JOIN configurazioni ON prenotazioni.configurazione_id = configurazioni.id WHERE stanze.id = " . $_GET['id_stanza'];
$result_join = esegui_query($sql_join);


include 'layout/head.php';
?>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h1>Dettaglio stanza</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a id="torna-in-home" class="btn btn-success" href="index.php">
                        Torna in homepage
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">

                    <?php
                    if ($result && $result->num_rows > 0) {

                        // output data of each row
                        $row = $result->fetch_assoc(); ?>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Dettagli stanza <?php echo $row['id']; ?></h3>
                            </div>
                            <div class="panel-body">
                                <ul>
                                    <li>Numero stanza: <?php echo $row['room_number']; ?></li>
                                    <li>Piano: <?php echo $row['floor']; ?></li>
                                    <li>Numero letti: <?php echo $row['beds']; ?></li>
                                    <li>Data creazione: <?php echo $row['created_at']; ?></li>
                                    <li>Data ultima modifica: <?php echo $row['updated_at']; ?></li>
                                </ul>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Dettagli prenotazioni stanza <?php echo $row['id']; ?></h3>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Numero prenotazione</th>
                                                    <th>Data Prenotazione</th>
                                                    <th>Data Aggiornamento Prenotazione</th>
                                                    <th>Configurazione Stanza</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if ($result_join && $result_join->num_rows > 0) {

                                                    // output data of each row
                                                    while($row_join = $result_join->fetch_assoc()) { ?>
                                                        <tr>
                                                            <td><?php echo $row_join['numero_prenotazione']; ?></td>
                                                            <td><?php echo $row_join['data_creazione']; ?></td>
                                                            <td><?php echo $row_join['data_prenotazione_aggiornata']; ?></td>
                                                            <td><?php echo $row_join['configurazione_stanza']; ?></td>
                                                        </tr>
                                                        <?php
                                                	}
                                                } elseif ($result_join) { ?>
                                                    <tr>
                                                        <td colspan="3">Non ci sono prenotazioni per questa stanza</td>
                                                    </tr>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <tr>
                                                        <td colspan="3">Si è verificato un errore</td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                    } elseif ($result) { ?>
                        <p>Nessuna stanza presente</p>
                        <?php
                    } else {
                        ?>
                        <p>Si è verificato un errore</p>
                        <?php
                    }
                    ?>
                </div>
            </div>

        </div>
    </main>
<?php

include 'layout/footer.php'

?>
