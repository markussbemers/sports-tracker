<!DOCTYPE html>
<html>
<head>
 <title>Komandas</title>
</head>
<body>
   
		
 <table style= "border: 1px solid black">
    <tr>
        <td> Team ID </td>
        <td> Team Name </td>
        <td> Organization ID </td>
        <td> Coach ID </td>
        <td> </td>
    </tr>
    @foreach ($teams as $team)
    <tr>
        <td> {{ $team->id }} </td>
        <td> {{ $team->organizations_id }} </td>
        <td> {{ $team->coaches_id }} </td>
    </tr>
    @endforeach
 </table>
</body>
</html>