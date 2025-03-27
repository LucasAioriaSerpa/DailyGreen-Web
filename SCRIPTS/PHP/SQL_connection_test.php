
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    body {
        font-family: Arial, sans-serif;
        background-color: #121212;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 10vh 10vw;
    }
    input[type="submit"] {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        background-color: #4CAF50;
        color: white;
        cursor: pointer;
        transition: background-color 0.3s ease-in-out;
    } input[type="submit"]:hover {
        background-color:hsl(105, 6.10%, 12.90%);
        transition: background-color 0.3s ease-in-out;
    }
</style>
<body>
    <form action="" method="post">
        <input type="submit" value="Test SQL connection">
    </form>
</body>
</html>
