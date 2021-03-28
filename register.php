<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>database assignment</title>
</head>
    <link rel="stylesheet" href="form.css">
<body>
    
<?php

    $conn = mysqli_connect("localhost", "root", "", "KayoolaBusCompany");


    if (!$conn) {
        echo "not created";
    }
    else {
        // echo "connected successfully <br>";
            $routeTable = "CREATE TABLE IF NOT EXISTS Route(
                routeId INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                routeName VARCHAR(30) NOT NULL, 
                averageNoPassangers INT NOT NULL)";
             
            $townTable = "CREATE TABLE IF NOT EXISTS Town(
                townId INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                townName INT NOT NULL, 
                routeId INT NOT NULL, 
                garage VARCHAR(20) NOT NULL,
                FOREIGN KEY(routeId) REFERENCES Route(routeId))";
            
            $stageTable = "CREATE TABLE IF NOT EXISTS Stage(
                stageId INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                stageName INT NOT NULL, 
                townId INT NOT NULL,
                FOREIGN KEY(townId) REFERENCES Town(townId))";

            $driverTable = "CREATE TABLE IF NOT EXISTS Driver(
                empNo INT PRIMARY KEY NOT NULL AUTO_INCREMENT, 
                empName VARCHAR(30) NOT NULL, 
                empAddress VARCHAR(30) NOT NULL, 
                telephoneNo INT NOT NULL, 
                stageId INT NOT NULL, 
                FOREIGN KEY(stageId) REFERENCES Stage(stageId))";

            $busTable = "CREATE TABLE IF NOT EXISTS Bus(
                plateNo VARCHAR(8) PRIMARY KEY NOT NULL,
                noDecks INT NOT NULL, 
                noPassangers INT NOT NULL, 
                routeId INT NOT NULL, 
                empNo INT NOT NULL, 
                FOREIGN KEY(routeId) REFERENCES Route(routeId),
                FOREIGN KEY(empNo) REFERENCES Driver(empNo))";

            $drivesTable = "CREATE TABLE IF NOT EXISTS Drives(
                emplNo INT,
                platesNo VARCHAR(8),
                FOREIGN KEY(emplNo) REFERENCES Driver(empNo),
                FOREIGN KEY(platesNo) REFERENCES Bus(plateNo))";

            $belongsToTable = "CREATE TABLE IF NOT EXISTS BelongsTo(
                stagedId INT,
                townsId INT,
                FOREIGN KEY(stagedId) REFERENCES Stage(stageId),
                FOREIGN KEY(townsId) REFERENCES Town(townId))";

            $isPassedThroughTable = "CREATE TABLE IF NOT EXISTS isPassedThrough(
                routedId INT,
                towneId INT,
                FOREIGN KEY(routedId) REFERENCES Route(routeId),
                FOREIGN KEY(towneId) REFERENCES Town(townId))";

            $usesTable = "CREATE TABLE IF NOT EXISTS Uses(
                plateeNo VARCHAR(8),
                routeedId INT,
                FOREIGN KEY(plateeNo) REFERENCES Bus(plateNo),
                FOREIGN KEY(routeedId) REFERENCES Route(routeId))";

            
            $resultRoute = mysqli_query($conn, $routeTable);
            $resultTown = mysqli_query($conn, $townTable);
            $resultStage = mysqli_query($conn, $stageTable);
            $resultDriver = mysqli_query($conn, $driverTable);
            $resultBus = mysqli_query($conn, $busTable);
            $resultDrives = mysqli_query($conn, $drivesTable);
            $resultBelongsTo = mysqli_query($conn, $belongsToTable);
            $resultIsPassedThroughTable = mysqli_query($conn, $isPassedThroughTable);
            $resultUse = mysqli_query($conn, $usesTable);

                if (isset($_POST['fName']) || isset($_POST['sName']) || isset($_POST['driverID']) || isset($_POST['telNo']) || isset($_POST['rName'])
                    || isset($_POST['driverAddress']) || isset($_POST['routeID']) || isset($_POST['avNoPassangers']) || isset($_POST['townID']) || 
                    isset($_POST['tName']) || isset($_POST['garage']) || isset($_POST['stageID']) || isset($_POST['stageName']) || 
                    isset($_POST['noPlate']) || isset($_POST['noDecks']) || isset($_POST['noPassangers'])) {
                    echo "welcome";

                $fname = $_POST['fName'];
                $sname = $_POST['sName'];
                $dID = $_POST['driverID'];
                $tele = $_POST['telNo'];
                $routeName = $_POST['rName'];
                $driverAddress = $_POST['driverAddress'];
                $rID = $_POST['routeID'];
                $avPassanger = $_POST['avNoPassangers'];
                $tID = $_POST['townID'];
                $tNa = $_POST['tName'];
                $garage = $_POST['garage'];
                $stgID = $_POST['stageID'];
                $stgNa = $_POST['stageName'];
                $nPlat = $_POST['noPlate'];
                $nDeck = $_POST['noDecks'];
                $noPasge = $_POST['noPassangers'];

           $sqlrot = "INSERT INTO Route (routeId, routeName, averageNoPassangers) VALUES ('$rID', '$routeName', '$avPassanger')";
           $sqltow = "INSERT INTO Town (townId, townName, routeId, garage) VALUES ('$tID', '$tNa', '$rID', '$garage')";
           $sqlstg = "INSERT INTO Stage (stageId, stageName, townId) VALUES ('$stgID', '$stgNa', '$tID')";
           $sqldrv = "INSERT INTO Driver (empNo, empName, empAddress, telephoneNo, stageId) VALUES ('$dID', '$fname+$sname', '$driverAddress', '$tele ', '$stgID')";
           $sqlbs = "INSERT INTO Bus (plateNo, noDecks, noPassangers, routeId, empNo) VALUES ('$nPlat', '$nDeck', '$noPasge', '$rID', '$dID')";
           $sqldrs = "INSERT INTO Drives (emplNo, platesNo) VALUES ('$dID', '$nPlat')";
           $sqlbto = "INSERT INTO BelongsTo (stagedId, townsId) VALUES ('$nPlat', '$tID')";
           $sqlipt = "INSERT INTO isPassedThrough (routedId, towneId) VALUES ('$rID', '$tID')";
           $sqluss = "INSERT INTO Uses (plateeNo, routeedId) VALUES ('$nPlat', '$rID')";

           mysqli_query($conn, $sqlrot);
           mysqli_query($conn, $sqltow);
           mysqli_query($conn, $sqlstg);
           mysqli_query($conn, $sqldrv);
           mysqli_query($conn, $sqlbs);
           mysqli_query($conn, $sqldrs);
           mysqli_query($conn, $sqlbto);
           mysqli_query($conn, $sqlipt);
           mysqli_query($conn, $sqluss);
        }else {
            echo "data not inserted";
        }
    }
?>
    <form action="form.html" action="POST">
        <div class="inputs">
                
            <div class="driver">
            <label id="fna">First name</label>
                <input type="text" name="fName">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <label  id="sna">Second name</label>
                <input type="text"  id="sna" name="sName"><br><br>
            <label>Driver ID</label>
                <input type="text" name="driverID">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <label>Driver address</label>
                <input type="text" name="driverAddress"><br><br>
            <label>Telephone number</label>
                <input type="text" name="telNo"><br><br>
            </div>

            <div class="route">
            <label>Route Name</label>
                <input type="text" name="rName">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <label>Route ID</label>
                <input type="text" name="routeID"><br><br>
            <label>Average number of passangers</label>
                <input type="text" name="avNoPassangers">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </div><br>

            <div class="town">
            <label>Town ID</label>
                <input type="text" name="townID"><br><br>
            <label>Town Name</label>
                <input type="text" name="tName">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <label>Garage</label>
                <input type="text" name="garage"><br><br>
            </div>

            <div class="stage">
            <label>Stage ID</label>
                <input type="text" name="stageID">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <label>Stage name</label>
                <input type="text" name="stageName"><br><br>
            <label>Number plate</label>
                <input type="text" name="noPlate">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <label>Number of decks</label>
                <input type="text" name="noDecks"><br><br>
            <label>Number of passengers</label>
                <input type="text" name="noPassangers">
            </div>

                <input type="submit" name="Register">

        </div>
    </form>
</body>

</html>