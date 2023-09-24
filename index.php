<?php
    if (!isset($_SESSION)) {
        session_start(); 
    }
    
    if (isset($_SESSION["result"]) & isset($_POST["choice"]) & isset($_POST["rolledValue"])) {
        if ($_POST["choice"] == "add") {
            $_SESSION["result"] = $_SESSION["result"] + $_POST["rolledValue"];
        }
        else if ($_POST["choice"] == "subtract") {
            $_SESSION["result"] = $_SESSION["result"] - $_POST["rolledValue"];
        }
        
        $result = $_SESSION["result"];
    }
    else {
        $result = 0;
        $_SESSION["result"] = $result;
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Dice game</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <h1>DICE GAME</h1>
    <h2>The goal of the game is to get a result of 20. Add or subtract from the roll you get until you reach it.</h2>
    <form action="/index.php" name="rollForm" method="POST">
        <p <?php if ($result == 20) echo "style='color: green'" ?>>Result: <?php echo $result?></p>
        <p>Roll: <a id="rolledValueText">0</a></p>
        <input type="text" id="rolledValue" name="rolledValue" hidden>
        <input type="text" id="choice" name="choice" hidden>
        <input type="button" href="#" onclick="roll()" value="ROLL" <?php if ($result == 20) echo "disabled" ?>>
        <input type="button" href="#" onclick="addResult()" id="addButton" value="ADD" disabled>
        <input type="button" href="#" onclick="subtractResult()" id="subtractButton" value="SUBTRACT" disabled>
    </form> 

    <form action="/destroySession.php" method="POST">
        <input type="submit" value="Reset"/>
    </form> 
  </body>

</html>

<script>
    let rolledValue = 0;

    function roll() {
        let max = 6;
        let min = 1;
        document.getElementById("addButton").disabled = false; 
        document.getElementById("subtractButton").disabled = false; 

        rolledValue = Math.floor(Math.random() * (max - min + 1) + min);

        document.getElementById("rolledValueText").innerText = rolledValue; 

        console.log(rolledValue);
    }

    function addResult() {
        document.rollForm.choice.value = "add";
        document.rollForm.rolledValue.value = rolledValue;
        document.forms["rollForm"].submit();
    }

    function subtractResult() {
        document.rollForm.choice.value = "subtract";
        document.rollForm.rolledValue.value = rolledValue;
        document.forms["rollForm"].submit();
    }
</script>
