
<style>

    .content {
        max-width: 500px;
        margin: auto;
        text-align: center;
        border: 4px solid cornflowerblue;
        font-family: Arial;
    }

</style>

<body>

<div class="content">

<h1>Meeting</h1>

<form method="post">
    <label for="title">Meeting title:</label>
    <input type="text" id="title" name="title"><br>

    <label for="from">From (date and time):</label>
    <input type="datetime-local" id="from" name="from"><br>

    <label for="to">To (date and time):</label>
    <input type="datetime-local" id="to" name="to"><br>

    <label for="description">Description:</label>
    <input type="text" id="description" name="description"><br>

    <label for="address">Address:</label>
    <input type="text" id="address" name="address"><br>

    <label for="meeting_site">Choose one:</label>
    <select id="meeting_site" name="meeting_site">
        <option value="google">Google Calendar</option>
        <option value="yahoo">YaHoo</option>
        <option value="webOutlook">Outlook</option>
        <option value="ics">ICS</option>
    </select><br><br>

    <input type="submit" name="submit" value="Submit">
</form>

</div>

</body>


<?php

require_once 'vendor/autoload.php';
date_default_timezone_set('Europe/Riga');

use Spatie\CalendarLinks\Link;

if (isset($_POST['submit'])) {
    if (!isset($_POST['title']) || trim($_POST['title']) == '') {
        echo "<div align='center'>Enter MEETING TITLE.</div>";
    } elseif (!isset($_POST['from']) || trim($_POST['from']) == '') {
        echo "<div align='center'>Enter FROM date and time.</div>";
    } elseif (!isset($_POST['to']) || trim($_POST['to']) == '') {
        echo "<div align='center'>Enter TO date and time.</div>";
    } else {

        $from = DateTime::createFromFormat('Y-m-d H:i', str_replace('T', ' ', $_POST['from']));
        $to = DateTime::createFromFormat('Y-m-d H:i', str_replace('T', ' ', $_POST['to']));

        $link = Link::create($_POST['title'], $from, $to)
            ->description($_POST['description'])
            ->address($_POST['address']);

        $meetingSite = $_POST['meeting_site'];

        echo "<br><div align='center'><a href='" . $link->{$meetingSite}() . "' target='_blank''>-> GO TO CALENDAR <-</a></div>";

//        switch ($_POST['meeting_site']) {
//            case 'google':
//                echo "<div align='center'><a href='" . $link->google() . "' target='_blank''>-> GO TO GOOGLE CALENDAR <-</a></div>";
//                break;
//            case 'yahoo':
//                echo "<div align='center'><a href='" . $link->yahoo() . "' target='_blank''>-> GO TO YAHOO <-</a></div>";
//                break;
//            case 'webOutlook':
//                echo "<div align='center'><a href='" . $link->webOutlook() . "' target='_blank''>-> GO TO OUTLOOK <-</a></div>";
//                break;
//            case 'ics':
//                echo "<div align='center'><a href='" . $link->ics() . "' target='_blank''>-> GO TO ICS <-</a></div>";
//                break;
//        }
    }
}

?>