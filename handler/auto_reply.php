<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" />
</head>
<body>
    <form action="auto_reply_handler.php" method="post" target="setting_iframe">
        title:<br>
        <input type="text" name="title" value=""><br>
        description: <br>
        <input type="text" name="description" value=""><br>
        picurl: <br>
        <input type="text" name="picurl" value=""><br>
        url: <br>
        <input type="text" name="url" value=""><br><br>
    <input type = "submit" onclick="alert('are u sure?');">
    </form>
    <iframe id="setting_iframe" name="setting_iframe" stype=""></iframe>
</body>
</html>
