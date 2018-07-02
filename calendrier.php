

<?php 
  $racine = $_SERVER['DOCUMENT_ROOT'];
  require_once $racine .'/borabora/include/connexion.php';
    header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>

<html lang="fr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Calendrier - Le Bora-Bora</title>
  <?php include_once $racine .'/borabora/include/head.php'?>
  <script src="./js/jquery-1.9.1.min.js" type="text/javascript"></script>
  <script src="./js/daypilot/daypilot-all.min.js" type="text/javascript"></script>
  <script src="./js/moment.js" type="text/javascript"></script>
  <link type="text/css" rel="stylesheet" href="./css/style.css" />  
  <script type="text/javascript">
  var dp = new DayPilot.Calendar("dp");
  dp.viewType = "Week";
  dp.init();
  </script>
</head>
<body>
  <?php include_once $racine .'/borabora/include/header.php' ?>
  
  <!--==============================content================================-->
  <?php 
  if (isset($_SESSION['login']))
  { ?>
        <div class="main">
            <!-- Liste déroulante des soins -->
            <FORM NAME="Choix" method="POST">
                    <SELECT name="Liste" id="soin" onChange="test()">
                        <OPTION VALUE="">Choisir un soin...
                        <?php 
                            $query = "SELECT lib_spa, num_spa FROM spa";
                            $result = $db->query($query);
                            
                            while ($temp = $result->fetch(PDO::FETCH_ASSOC)) {
                                echo '<option value="'.$temp['lib_spa'].'">'.$temp['lib_spa'].'</option>';
                            }
                            
                        ?>
                    </SELECT>
                </FORM>
                <!-- Liste déroulante des soins -->
            <div style="float:left; width: 160px;">
                <div id="nav"></div>
            </div>
            
            <div style="margin-left: 160px;">
                <div id="dp"></div>
            </div>
            

            <script type="text/javascript">
                
                var nav = new DayPilot.Navigator("nav");
                nav.showMonths = 3;
                nav.skipMonths = 3;
                nav.selectMode = "week";
                nav.onTimeRangeSelected = function(args) {
                    dp.startDate = args.day;
                    dp.update();
                    loadEvents();
                };
                nav.init();

                var dp = new DayPilot.Calendar("dp");
                dp.viewType = "Week";

                dp.onEventMoved = function (args) {
                    $.post("calendar/backend_move.php",
                            {
                                id: args.e.id(),
                                newStart: args.newStart.toString(),
                                newEnd: args.newEnd.toString()
                            },
                            function() {
                                location.reload();
                                console.log("Moved.");
                            });
                };

                //Ajax permet de récupérer la valeur dans la base de donnée sans recharger la page
                var duree = null;
                function test() {
                    var soin = document.getElementById('soin').value;
                    $.ajax({
                        type:"POST",
                        url:"getDuree.php",
                        data:"soin=" + soin,
                        success: function(resultat) {
                            duree = resultat;
                        }
                    });
                }
                //Fin
                
                dp.onTimeRangeSelected = function (args) {
                    
                    var name = prompt("Nom du client : ", "");
                    var soin = document.getElementById('soin').value;

                    //Ajout du temps par rapport au soin
                    var hour = moment(duree, "HH:mm").format("HH");
                    var minute = moment(duree, "HH:mm").format("mm");
                    var date_start = moment(args.start.toString()).format("YYYY-MM-DD HH:mm:ss");
                    var add = moment(date_start).add(hour, 'h').add(minute, 'm').format("YYYY-MM-DD HH:mm:ss");
                    //Fin

                
                    if (!name || !soin) {
                        alert("La personne ou le soin n'est pas renseigné !");
                        return;
                    };
                    
                    var e = new DayPilot.Event({
                        start: args.start,
                        end: args.end,
                        id: DayPilot.guid(),
                        resource: args.resource,
                        text: "Client : " + name + " <br> Soin : " + soin
                    });
                    
                    dp.events.add(e);
                    
                    $.post("calendar/backend_create.php",
                            {
                                start: args.start.toString(),
                                end: add,
                                name: name,
                                descr: soin
                            },
                            function() {
                                location.reload();
                                var popUpList = $('<div><input type="radio">A<br><input type="radio">B<br><input type="radio">C</div>');
                                
                                showPopUpButton.click(function() {
                                    popUpList.dialog();
                                });
                            });
                            
                };

                dp.onEventClick = function(args) {
                    //Suppression de la réservation
                    var name = prompt("Voulez-vous supprimer cette reservation? (oui/non)", "");
                    if (name == 'oui') {
                        $.post("calendar/backend_delete.php",
                            {
                                id: args.e.id()
                            }
                        );
                    location.reload();
                        }
                    else if (name == 'non') {
                        
                    };
                    
                };
                
                dp.init();
                loadEvents();

                function loadEvents() {
                    var start = dp.visibleStart();
                    var end = dp.visibleEnd();

                    $.post("calendar/backend_events.php",
                    {
                        start: start.toString(),
                        end: end.toString()
                    },
                    function(data) {
                        //console.log(data);
                        dp.events.list = data;
                        dp.update();
                    });
                }
                
            </script>

            <script type="text/javascript">
            $(document).ready(function() {
                $("#theme").change(function(e) {
                    dp.theme = this.value;
                    dp.update();
                });
            });
            </script>

        </div>
        <div class="clear">
        </div>
        
  <?php
    } 
    else{
        header("Location: coemplo.php?erreur=0");
    } 
    ?>
  <!--==============================footer=================================-->
  <?php include_once $racine .'/borabora/include/footer.php' ?>
</body>
</html>