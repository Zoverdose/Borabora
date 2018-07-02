<?php 
  $racine = $_SERVER['DOCUMENT_ROOT'];
  require_once $racine .'/borabora/include/connexion.php';

?>
<!DOCTYPE html>

<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Calendrier - Le Bora-Bora</title>
  <?php include_once $racine .'/borabora/include/head.php' ?>
  <script src="./js/jquery-1.9.1.min.js" type="text/javascript"></script>
  <script src="./js/daypilot/daypilot-all-2.min.js" type="text/javascript"></script>
  <script src="./js/moment.js" type="text/javascript"></script>
  <link type="text/css" rel="stylesheet" href="themes/calendar_green.css" />  
  <script type="text/javascript">
  var dp = new DayPilot.Calendar("dp");
  dp.viewType = "Week";
  dp.init();
</script>
</head>
<body>
  <?php include_once $racine .'/borabora/include/header.php' ?>
  
  <!--==============================content================================-->

        <div class="main">

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
  
  <!--==============================footer=================================-->
  <?php include_once $racine .'/borabora/include/footer.php' ?>
</body>
</html>