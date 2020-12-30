<?php
    $conn = new mysqli("10.103.2.61","root","LPRkrn71810","pm_data");
    $stmt = "SELECT *  FROM pmdata ORDER BY id DESC";
    $result = $conn->query($stmt);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.12/css/jquery.dataTables.css">
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script type="text/javascript" charset="utf8" src="http://cdn.datatables.net/1.10.12/js/jquery.dataTables.js"></script>

		<script type="text/javascript">
			
            function getDataFromDb() {
                $.ajax({
                    url: "getData.php",
                    type: "POST",
                    data: "",
                    success: ((result) => {
                    var obj = jQuery.parseJSON(result);
                    var i = 1;
                    if (obj != '') {
                        $("#table-body").empty();
                        $.each(obj, (key, val) => {
                            var tr = "<tr>";
                            tr += "<td>" + i + "</td>";
                            tr += "<td>" + val["s_data"] + "</td>";
                            tr += "<td>" + val["date"] + "</td>";
                            tr += "</tr>";
                            $("#example > tbody:last").append(tr);
                            i++;
                        })
                    }

                    })
                })
            }
            setInterval(getDataFromDb, 1000);
		</script>
  </head>
  <body>
      <div class="container">

          <table class="table table-bordered" id="example" style="margin-top:20px">
                  <thead>
                      <tr>
                          <th>Number</th>
                          <th>s_data</th>
                          <th>date</th>
                          
                      </tr>
                  </thead>
                  
                  <tbody id="table-body">
                      
                  </tbody>
              </table>
      </div>
		
  </body>
</html>