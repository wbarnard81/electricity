<?php

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Electricity Monitor</title>
        
        <link rel="stylesheet" href="css/bulma.min.css">
    </head>
    <body>
        <navbar>
            <h2 class="is-size-1-widescreen has-text-centered">Electricity Monitor</h2>
        </navbar>
        
        <div class="container">
            <section class="section py-2 px-2">
                <div class="chart-container" style="position: relative; width:40vw">
                    <canvas id="myChart"></canvas>
                </div>
                <div class="px-2 py-2">
                    <form action="add.php" method="post">
                        <!-- <div class="field is-horizontal">
                            <div class="field-label is-normal">
                                <label class="label" for="meter">Meter Reading:</label>
                            </div>
                            <div class="field-body">
                                <div class="field">
                                    <p class="control">
                                        <input class="input is-rounded" type="text" name="meter">
                                    </p>
                                </div>
                            </div>
                        </div> -->
                        <div class="field is-horizontal">
                            <div class="field-label is-normal">
                                <label class="label" for="dbMeter">DB Meter Reading:</label>
                            </div>
                            <div class="field-body">
                                <div class="field">
                                    <p class="control">
                                        <input class="input is-rounded" type="text" name="dbMeter">
                                    </p>
                                </div>
                            </div>
                        </div>
                        <button class="button is-link is-light" type="submit">Submit</button>
                    </form>
                </div>
            </section>
            <section class="section py-2 px-2">
                <div class="table-container">
                    <table id="meterTable" class="table is-striped is-bordered">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Previou Meter Reading</th>
                                <th>DB Meter Reading</th>
                                <th>Units used</th>
                            </tr>
                        </thead>
                        <tbody id="meterTableBody"></tbody>
                        <div id="output"></div>
                    </table>
                </div>
            </section>
        </div>
        <footer class="footer">
            <div class="content has-text-centered">
                <h5>Designed by Werner Barnard</h5>
            </div>
        </footer>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js" integrity="sha512-vBmx0N/uQOXznm/Nbkp7h0P1RfLSj0HQrFSzV8m7rOGyj30fYAOKHYvCNez+yM8IrfnW0TCodDEjRqf6fodf/Q==" crossorigin="anonymous"></script>
        <script src="js/moment.js"></script>
        <script src="js/app.js"></script>
    </body>
</html>
