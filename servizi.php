<html>
    <head>
    <title>Servizi - Banca Generica</title>
    <meta charset="utf-8" />
    <link rel="icon" href="https://cdn1.iconfinder.com/data/icons/business-and-finance-20/200/vector_65_09-128.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat"> 
	<style>
		body {
            margin: 0px;
			padding: 0px;
			height: 100%;
			display: flex;
			display: -webkit-flex;
			justify-content: center;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
		}

		#contenitore {
			width: 100%;
			height: 100%;
			display: flex;
			display: -webkit-flex;
			flex-direction: column;
            font-family: 'Montserrat', sans-serif;
		}
        
        #a {
            background-color: Teal;
            color: white;
			width: 100%;
			height: 10%;
            display: flex;
			display: -webkit-flex;
			flex-direction: row;
        }

        #a1 {       
            width: 10%;
			height: 100%;
        }

        #a2 {
            width: 80%;
			height: 100%;
            text-align: center;
        }

        #a3 {
            width: 10%;
			height: 100%;
        }

        #b {
            
			width: 100%;
			height: 90%;
            display: flex;
			display: -webkit-flex;
			flex-direction: row;
        }

        #b1 {
            
			width: 20%;
			height: 100%;
            display: flex;
			display: -webkit-flex;
			flex-direction: column;
            background-color: rgb(230, 255, 255);
        }

        #b1-void {
            
            width: 100%;
			height: 95%;
        }

        #b1-ancor {
            
            width: 100%;
			height: 5%;
            text-align: center;
        }

        #indietro {
            text-decoration: none;
            color: DarkBlue;
        }

        #indietro:hover {
            color: Teal;
        }

        #b2 {
            
			width: 60%;
			height: 100%;
            display: flex;
			display: -webkit-flex;
			flex-direction: column;
        }

        #b2-h1 {
            margin-left: 15%;
        }

        #b2-cerca {
            border-bottom: 1px solid black;
            width: 70%;
            margin-left: 15%;
            margin-right: 15%;
        }

        #b2-testo {
            margin-top: 10px;
            margin-left: 15%;
            margin-right: 15%;
            text-align: justify;
        }

        #b3 {
			width: 20%;
			height: 100%;
            background-color: rgb(230, 255, 255);
        }

        #home {
            color: white;
            font-size: 30px;
            font-weight: bold;
        }
        
        #tabella {
            margin-left: 15%;
            margin-top: 5%;
        }
        
        th {
            color: white;
            background-color: teal;
            padding: 10px;
        }
    </style>
    </head>
    <body>
        <div id="contenitore">
		    <div id="a">
                <div id="a1">
                    <table border="0" width="100%" height="100%">
		                <tr align="left">
                            <td valign="middle">
                                <a href="index.html"><img src="https://cdn1.iconfinder.com/data/icons/business-and-finance-20/200/vector_65_09-64.png"></a>
                            </td>
                        </tr>
		            </table>
                </div>
                <div id="a2">
                    <table border="0" width="100%" height="100%">
		                <tr align="center">
                            <td valign="middle">
                                <p id="home">BANCA GENERICA</p>
                            </td>
                        </tr>
		            </table>
                </div>
                <div id="a3"></div>
            </div>
            <div id="b">
                <div id="b1">
                    <div id="b1-void"></div>
                    <div id="b1-ancor"><a id="indietro" href="index.html">Torna indietro</a></div>
                </div>
                <div id="b2">
                    <div id="b2-h1"><h1>Servizi</h1></div>
                    <div id="b2-cerca">
                        <form method="post" action="servizi.php" name="cerca_servizi">
                            <input id="textbox_cerca" type="search" name="stringa_ricerca" size="50" required>&nbsp;&nbsp;<input type="submit" value="Cerca">
                        </form>                    
                    </div>
                    <div id="tabella">
                        <?php
                            // Elimino il caching del browser.
                            header("Expires: on, 01 Jan 1970 00:00:00 GMT");
                            header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
                            header("Cache-Control: no-store, no-cache, must-revalidate");
                            header("Cache-Control: post-check=0, pre-check=0", false);
                            header("Pragma: no-cache");
                            
                            // Catturo la stringa di ricerca.
                            $ricerca = $_POST["stringa_ricerca"];
                            
                            // Definisco le variabili necessarie per la connessione.
                            $db_host = "sql302.epizy.com";
                            $db_username = "epiz_22087628";
                            $db_password = "";
                            $db_name = "epiz_22087628_BANCA";
                            
                            // Apro la connessione con il database.
                            $connection = new mysqli($db_host, $db_username, $dbpassword, $db_name);
                            
                            // Controllo che non ci siano problemi con la connessione.
                            if ($connection->connect_errno) {
                                echo "Connessione fallita: " . $connection->connect_error . ".";
                                exit();
                            }
                            
                            // Creo la query e la eseguo nel database.
                            $str_sql = "SELECT * FROM SERVIZIO WHERE NOME LIKE '%" . $ricerca . "%'";
                            $result1 = $connection->query($str_sql);
                            
                            // Verifico che ci siano servizi corrispondenti alla stringa di ricerca e li mostro a schermo. Nel caso in cui non ci siano mostro il massaggio di errore.
                            if ($result1->num_rows > 0) {
                                echo "<table><tr><th>Servizio</th><th>Disponibilit&agrave;</th></tr>";
                                while($row = $result1->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td align='center'>" . $row["NOME"] . "</td>";
                                    echo "<td align='center'>" . $row["DISPONIBILITA"] . "</td>";
                                    echo "</tr>";
                                }        
                                echo "</table>";
                                $connection->close();
                            } else {
                                $connection->close();
                                echo "Nessun servizio presente corrisponde al campo di ricerca '" . $ricerca . "'";
                                exit();
                            }
                        ?>
                    </div>
                </div>
                <div id="b3"></div>
            </div>
		</div>
    </body>
</html>
