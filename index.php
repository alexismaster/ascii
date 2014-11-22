<!DOCTYPE html>
<html>
  <head>
    <title>ASCII</title>

    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <link rel="shortcut icon" href="assets/img/compass.ico" type="image/x-icon">
    <link rel="icon" href="assets/img/compass.ico" type="image/x-icon">

    <link href='http://fonts.googleapis.com/css?family=Lora:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="assets/css/main.min.css">
  </head>
  <body>
    <div id="main-container">
      <main class="wrapper clearfix">
        <h1 id="title">
          <img src="assets/img/compass.png" alt="ASCII" title="ASCII">
        </h1>
        <p>To convert a picture, choose a file from your computer and click the button "generate". Optionally you can customize the output by pressing the parameter button and changing the configuration.</p>
        <form action="/generate" method="post" enctype="multipart/form-data">
          <input type="file" name="file">
          <button type="submit" name="submit">Generate</button>
        </form>
      </main>
    </div>
  </body>
</html>
