﻿<div id="sidebar-wrapper">
	<ul class="sidebar-nav">
		<?php
			$chapters = array("Drehbuch", "Auflösung", "Kamera: Einstellung", "Kamera: HD und 4K", "Kamera: Belichtung", "Kamera: Belichtung Teil 2", "Licht", "Ton", "Klappe", "Maske", "Schauspiel", "Schnitt", "Postproduktion", "Finanzierung");
			for($i = 0; $i < count($chapters); $i++){
				echo "<li>";
				echo "<a";
				if(!empty($_GET) && $_GET["kap"] == ($i+1)){
					echo " class='selected'";
				}
				echo " href='index.php?loc=kapitel&kap=" . ($i+1) . "'>" . ($i+1) . ". " . $chapters[$i] . " </a>";
				echo "</li>";
			}
		?>
	</ul>
</div>
