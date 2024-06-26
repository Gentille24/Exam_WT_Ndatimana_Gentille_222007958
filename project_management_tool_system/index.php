<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>project_management_tool_system</title>
<style>
  body{
   background-image: url('./images/fff.jpeg');
   background-repeat: no-repeat;
   background-size: cover;
  }
  .overlay {
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    position: relative;
    z-index: 1;
  }

  .container {
    position: relative;
    z-index: 2;
  }

  h1 {
    font-size: 3rem;
    margin-bottom: 20px;
  }

  p {
    font-size: 1.2rem;
    margin-bottom: 30px;
  }

  .btn {
    display: inline-block;
    padding: 30px 75px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1.2rem;
    text-decoration: none;
    color: white; 
    background-color: gray; 
    transition: background-color 0.3s ease;
  }

  .btn-login:hover {
    background-color: LightSeaGreen; 
    box-shadow: 2px;

  }

  .btn-register {
    background-color: gray; 
    margin-left: 20px;
  }

  .btn-register:hover {
    background-color:LightSeaGreen; 
  }
</style>
</head>
<body bgcolor="darkblue">
   <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;">
    <img src="./Images/ww.jpeg" width="200" height="120" alt="Logo">
  </li>
<div class="overlay">
  <div class="container">
    <h1 style="color: #FF00FF;">project_management_tool_system</h1>
    <p style="font-family:century; font-size: 25px; color: white;"><b><h2>WELCOME</h2></b></p>

    <a href="login.html" class="btn btn-login">LOGIN</a>
    <a href="register.html" class="btn btn-register">REGISTER</a>
  </div>
</div>

</body>
</html>