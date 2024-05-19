<?php
?>
<!DOCTYPE html>
<html lang="ru" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>DB Parser</title>
    <style media="screen">
      .form-upload {
        background-color: #262626;
        color: white;
        display: inline-grid;
        padding: 20px;
        border: 1px solid;
        border-radius: 20px;
      }

      .form-upload > input{
        margin: 10px;
      }
    </style>
  </head>
  <body>
    <h1>Форма для загрузки файла</h1>
    <form class="form-upload" action="/parser/parser.php" method="post" enctype="multipart/form-data">
      <h2>Выберите файл для работы</h2>
      <input type="file" id="upload_file" name="upload_file" accept=".txt"/>
      <input type="submit" value="Подтвердить"/>
    </form>

  </body>
</html>
