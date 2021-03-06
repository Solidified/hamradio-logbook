<script language="JavaScript">
<!--
function worldClock(){
var time = new Date()
var gmtMS = time.getTime() + (time.getTimezoneOffset() * 60000)
var gmtTime = new Date(gmtMS)
var day = gmtTime.getDate();
// Correct display of MONTH (0 = January)
var month = gmtTime.getMonth()+1;
var year = gmtTime.getYear();
var hr = gmtTime.getHours();
var min = gmtTime.getMinutes();
var sec = gmtTime.getSeconds();

if(year < 1000){
year += 1900;
}

// Correct to display two digits
if (hr < 10){
hr = "0" + hr;
}
if (min < 10){
min = "0" + min;
}
if (sec < 10){
sec = "0" + sec;
}
if (month < 10) {
	month = "0" + month;
}
if (day < 10) {
	day = "0" + day;
}

return year + "-" + month + "-" + day + " " + hr + ":" + min;
}

function worldClockZone(){
var dstr = worldClock();
var gmt_date = dstr.substring(0, 10);
var gmt_time = dstr.substring(10, dstr.length);

document.getElementById("GMTD").value = gmt_date
document.getElementById("GMT").value = gmt_time

setTimeout("worldClockZone()", 1000)
}
window.onload=worldClockZone;

//-->
</script>


<?php

$stime = date("H:i");

echo "
<fieldset>
    <legend>Add QSO</legend>
<form action=\"main.php?mode=add\" method=\"post\">
<table border=\"0\">
    <tr class=\"header\">
        <th rowspan=\"2\">
            Date<br />
			(YYYY-MM-DD)
        </th>
        <th  colspan=\"2\">
            Time UTC
        </th>
        <th rowspan=\"2\">
            Band
        </th>
        <th rowspan=\"2\">
            Frequency<br />
        </th>
        <th rowspan=\"2\">
            Mode
        </th>
        <th rowspan=\"2\">
            Power<br />
        </th>
        <th rowspan=\"2\">
            Country/Territory
        </th>
        <th rowspan=\"2\">
            Callsign
        </th>
        <th rowspan=\"2\">
            Operator Name
        </th>
        <th  colspan=\"2\">
            Report
        </th>
    </tr>
    <tr class=\"header\">
        <th colspan=\"2\">
            Start
        </th>
        <th>
            Sent
        </th>
        <th>
            Rec'd
        </th>
    </tr>
    <tr style=\"background-color:#EDF4F8\">
        <td>
            <input name=\"date\" type=\"text\" size=\"10\" id=\"GMTD\" />
        </td>
        <td colspan=\"2\">
			<input name=\"timeStart\" type=\"text\" size=\"8\" style=\"text-align: center;\" id=\"GMT\" />
        </td>
         <td>
            <select name=\"band\" id=\"bandSelect\" onchange=\"setFreq(this.value)\" >";
$cb = loadComboBands();
while ($data = mysql_fetch_array($cb)) {
    echo "<option value=\"$data[band]\">$data[band]</option>";
}
//
echo "</select>
         </td>
         <td>
            <input name=\"freq\" type=\"text\" size=\"6\" id=\"txtFreq\" value=\"28300\" style=\"text-align:right;\" maxlength=\"10\" />KHz
        </td>
        <td>
            <select name=\"mode\">";
$ci = loadCombo("modes", "mode");
while ($data = mysql_fetch_array($ci)) {
    echo "<option value=\"$data[mode]\">$data[mode]</option>";
}
echo "</select>
        </td>
        <td>
            <input name=\"power\" type=\"text\" size=\"4\" value=\"100\" style=\"text-align:right;\" maxlength=\"4\"/>
        </td>
        <td>
            <input name=\"location\" type=\"text\" id=\"countryTerritory\" maxlength=\"15\"/>
        </td>
        <td>
            <input name=\"station\" type=\"text\" size=\"10\" maxlength=\"8\"/>
        </td>
        <td>
            <input name=\"operator\" type=\"text\" maxlength=\"15\" />
        </td>
        <td>
            <input name=\"rst_rx\" type=\"text\" maxlength=\"3\" size=\"3\" value=\"59\" />
        </td>
        <td>
            <input name=\"rst_tx\" type=\"text\" maxlength=\"3\" size=\"3\" value=\"59\" />
        </td>
</tr>
</table>
<br />
<table>
    <tr class=\"header\">
        <th  colspan=\"3\">
            QSL
        </th>
        <th rowspan=\"2\">
            Remarks
        </th>
    </tr>
    <tr class=\"header\">
        <th>
            Sent
        </th>
        <th>
            Rec'd
        </th>
        <th>
            Info
        </th>
    </tr>
    <tr style=\"background-color:#EDF4F8\">
        <td valign=\"top\">
            <select name=\"qsl_snt\">
                <option value=\"1\">Yes</option>
                <option value=\"0\" selected>No</option>
            </select>
        </td>
        <td valign=\"top\">
            <select name=\"qsl_rec\">
                <option value=\"1\">Yes</option>
                <option value=\"0\" selected>No</option>
            </select>
        </td>
        <td>
            <textarea name=\"qsl_info\" cols=30 rows=5></textarea>
        </td>
        <td>
            <textarea name=\"remarks\" cols=69 rows=5></textarea>
        </td>
    </tr>
</table>
<br />
<input type=\"submit\" name=\"submit\" value=\"Save to DB\" class=\"icon\" title=\"SAVE\" />
</form>
</fieldset>
"
?>
