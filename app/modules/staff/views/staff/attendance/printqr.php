<!DOCTYPE html>
<html lang="en">
<?php
    
    $OfficeID = base64_decode($_GET['OfficeId']);
    $mode = base64_decode($_GET['mode']); // 1 staff, 2 intern
    $param =  array(
        "OfficeID" => $OfficeID,
        "Mode" => $mode
    );
    $officeinfo = (new \app\modules\settings\classes\Office())->getOfficeByID($param);
    $officeinfo = $officeinfo["return_data"];

?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print QR</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<body>
    <div class="container" style="margin:30px; margin-top:100px;">
        <div class="row">
            <div class="col-md-8 mx-auto text-center">
            <div style=" padding: 20px;">
                <h1 id="OfficeName" style="font-weight:bold;"><?php  echo strtoupper($officeinfo["OfficeName"]);  ?></h1>
                <h3> <?php  echo $officeinfo["Landmark"];  ?>, <?php  echo $officeinfo["CityName"];  ?></h3>
                <h3> <?php  echo $officeinfo["DistrictName"];  ?>, <?php  echo $officeinfo["StateName"];  ?></h3>
                <h4 id="dateofprint"></h4>
                <hr>
                <br>
            </div>
                <img  src="file?type=qr&name=<?php echo $officeinfo["QRCode"]; ?>" id="QR" class="img-fluid" alt="">
                <br>  <br> <br>  <br>  
                <hr />
                <div id="info" class="text-left" style="padding-left: 40px;"  >
                    <h3> Instructions for Attendance</h3>
                    <ol>
                        <li>Open your PrayagEdu App</li>
                        <li>Login using your username and Password provided by the Institution  (<i>Ignore if already logged-in</i>) </li>
                        <li>Navigate to My Attendance</li>
                        <li>Click on "Scan QR Icon" on the top right and scan the above QR Code for your attendance entry. </li>
                        <li>For ending the day, click on "Scan QR Icon" option again.</li>
                    </ol>
                    <div style="bottom:20px; position: fixed; margin-left:10%;"> ***** Thank you for using PrayagEdu Staff Attendance **** <br /> </div>

                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

<script>
    $(function() { 
        var d = new Date();
        $("#dateofprint").text( d.toLocaleDateString() + ", " + d.toLocaleTimeString() );
        window.print();
    });
</script>

</html>