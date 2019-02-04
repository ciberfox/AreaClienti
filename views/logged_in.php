<section id="content">
    	<div class="boxed">

	<legend><?php echo WORDING_EDIT_USER_DATA; ?></legend>
	<p><?php echo WORDING_YOU_ARE_LOGGED_IN_AS . '<b>' . $_SESSION['user_name']; ?></b></p><hr/>
<?php
$db_host ="localhost";
$db_user = "root";
$db_pass = "toor"; 
$db_name = "DBname";
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);    
$go = "select * from tabella_fat, users where users.user_name = '".$_SESSION['user_name']."' and users.codice_contabile = tabella_fat.codice_contabile;";
$query = mysqli_query($conn, $go);
if (!$query) {
	die ('SQL Error: ' . mysqli_error($conn));
}
    ?>
    <table class="data-table">
		<caption class="title">Fatture e pagamenti <br />Gentile cliente di seguito potrà verificare lo stato dei suoi pagamenti</caption>
 <br />
    <br />
		<thead>
			<tr>
                <th>Numero Fattura</th>
				<th>Data Emissione Fattura</th>
                <th>Stato Pagamento</th>
    <th>Importo Fattura</th>
				<th>Download Fattura</th>
			</tr>
		</thead>
		<tbody>
		<?php
    $nessun_pagamento = "Pagamento non pervenuto";
$pagamento = "Pagamento pervenuto";
		while ($row = mysqli_fetch_array($query))
		{
        if ($row['pagamento'] == "nessun pagamento"){
			$caso= '<tr class = "bam">
                    <td>'.$row['n_fat'].'</td>
            		<td>'.date('d/m/Y', strtotime($row['data_emissione'])) . '</td>
                    <td>'.$nessun_pagamento.'</td>
                    <td>'.$row['importo'].' €</td>
					<td><a href="download.php/?file='.$row['n_fat'].'.pdf" target = "_self">'.$row['n_fat'].'</a></td>
				</tr>
                ';
        echo $caso;
        }
        else {
         $caso2= '<tr>
                    <td>'.$row['n_fat'].'</td>
            		<td>'.date('d/m/Y', strtotime($row['data_emissione'])) . '</td>
                    <td>'.$pagamento.'</td>
                    <td>'.$row['importo'].' €</td>
					<td><a href="download.php/?file='.$row['n_fat'].'.pdf" target = "_parent">'.$row['n_fat'].'</a></td>
				</tr>
                ';
        echo $caso2;
                
        }
		}
mysqli_free_result($query);
mysqli_close($conn);
?>
</tbody>
	</table>
<br />
<br />
<br/>
<a href="?logout"><?php echo WORDING_LOGOUT; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="?edit"><?php echo WORDING_EDIT_USER_DATA; ?></a>
<?php echo (ALLOW_ADMIN_TO_REGISTER_NEW_USER && $_SESSION['user_access_level'] == 255 ? '<br/><a href="?register">'. WORDING_REGISTER_NEW_ACCOUNT .'</a>' : ''); ?>

</div>
</section>