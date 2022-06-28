<?php include "conn.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Lab3</title>
    <script>
        var ajax = new XMLHttpRequest();

        function f1() {
            ajax.onreadystatechange = function() {
                if (ajax.readyState === 4) {
                    if (ajax.status === 200) {
                        console.dir(ajax.responseText);
                        document.getElementById("res").innerHTML = ajax.response;
                    }
                }
            }
            var genre = document.getElementById("genre").value;
            ajax.open("get", "1.php?genre=" + genre);
            ajax.send();
        }

        function f2() {
            ajax.onreadystatechange = function() {
                if (ajax.readyState === 4) {
                    if (ajax.status === 200) {

                        console.dir(ajax);
                        let rows = ajax.responseXML.firstChild.children;
                        let result = "<table border ='1'><tr><th>Актер</th><th>Фильм</th><th>Дата выпуска</th><th>Страна</th><th>Качество</th><th>Расширение</th><th>Кодек</th><th>Продюсер</th><th>Директор</th><th>Карьер</th></tr>";
                        console.dir(rows.length);
                        for (var i = 0; i < rows.length; i++) {
                            result += "<tr>";
                            result += "<td>" + rows[i].children[0].firstChild.nodeValue + "</td>";
                            result += "<td>" + rows[i].children[1].firstChild.nodeValue + "</td>";
                            result += "<td>" + rows[i].children[2].firstChild.nodeValue + "</td>";
                            result += "<td>" + rows[i].children[3].firstChild.nodeValue + "</td>";
                            result += "<td>" + rows[i].children[4].firstChild.nodeValue + "</td>";
                            result += "<td>" + rows[i].children[5].firstChild.nodeValue + "</td>";
                            result += "<td>" + rows[i].children[6].firstChild.nodeValue + "</td>";
                            result += "<td>" + rows[i].children[7].firstChild.nodeValue + "</td>";
                            result += "<td>" + rows[i].children[8].firstChild.nodeValue + "</td>";
                            result += "<td>" + rows[i].children[9].firstChild.nodeValue + "</td>";
                            result += "</tr>";
                        }
                        document.getElementById("res").innerHTML = result;
                    }
                }
            }
            var actor = document.getElementById("actor").value;
            ajax.open("get", "2.php?actor=" + actor);
            ajax.send();
        }

        function f3() {
            ajax.onreadystatechange = function() {
                let rows = JSON.parse(ajax.responseText);
                console.dir(rows);
                if (ajax.readyState === 4) {
                    if (ajax.status === 200) {
                        console.dir(ajax);

                        let result =  "<table border ='1'><tr><th>Фильм</th><th>Дата</th><th>Страна</th><th>Качество</th><th>Расширение</th><th>Кодек</th><th>Продюсер</th><th>Директор</th><th>Карьер</th></tr>";
                        for (var i = 0; i < rows.length; i++) {
                            result += "<tr>";
                            result += "<td>" + rows[i].name + "</td>";
                            result += "<td>" + rows[i].date + "</td>";
                            result += "<td>" + rows[i].country + "</td>";
                            result += "<td>" + rows[i].quality + "</td>";
                            result += "<td>" + rows[i].resolution + "</td>";
                            result += "<td>" + rows[i].codec + "</td>";
                            result += "<td>" + rows[i].producer + "</td>";
                            result += "<td>" + rows[i].director + "</td>";
                            result += "<td>" + rows[i].carrier + "</td>";
                            result += "</tr>";
                        }
                        document.getElementById("res").innerHTML = result;
                    }
                }
            };
            var date_1 = document.getElementById("date_1").value;
            var date_2 = document.getElementById("date_2").value;
            ajax.open("get", "3.php?date_1=" + date_1 + "&date_2=" + date_2);
            ajax.send();
        }
    </script>
</head>

<body>
    <h3>Задорожний Віктор. КІУКІу-20-1</h3>
    <p>Фильмы по жанру <select name="genre" id="genre">
            <?php
            include 'conn.php';
            $sqlSelect = "SELECT DISTINCT title FROM $db.genre";
            foreach ($dbh->query($sqlSelect) as $cell) {
                echo "<option>";
                print($cell[0]);
                echo "</option>";
            }
            ?>
        </select>
        <button onclick="f1()"> ОК </button>
    </p>


    <p>Фильмы по актеру<select name="actor" id="actor">
            <?php
            include 'conn.php';
            $sqlSelect = "SELECT DISTINCT name FROM $db.actor";
            foreach ($dbh->query($sqlSelect) as $cell) {
                echo "<option>";
                print($cell[0]);
                echo "</option>";
            }
            ?>
        </select>
        <button onclick="f2()"> ОК </button>
    </p>



    <p>Фильмы по дате
        <select name="date_1" id="date_1">
            <?php
            include 'conn.php';
            $sqlSelect = "SELECT DISTINCT date FROM $db.FILM";
            foreach ($dbh->query($sqlSelect) as $cell) {
                echo "<option>";
                print($cell[0]);
                echo "</option>";
            }
            ?>
        </select>
        <select name="date_2" id="date_2">
            <?php
            include 'conn.php';
            $sqlSelect = "SELECT DISTINCT date FROM $db.FILM";
            foreach ($dbh->query($sqlSelect) as $cell) {
                echo "<option>";
                print($cell[0]);
                echo "</option>";
            }
            ?>
    </p>
    </select>
    <button onclick="f3()"> ОК </button>
<p id="res"></p>
</body>

</html>