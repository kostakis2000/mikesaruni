<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body class="bodyindex">
    <header class="driverheader">
        <div class="main">
            <div class="logo">
                <img src="images/lokos.jpg">
            </div>
            <ul>
                <li><a href="index.html"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="about.html"><i class="fa fa-question-circle"></i> Aboutus</a></li>
                <li class="active"><a href="contact.php"><i class="fa fa-volume-control-phone"></i> Contact</a></li>
                <li><a href="login.php"><i class="fa fa-user"></i> Login</a></li>
            </ul>
        </div>
    </header>
    <div class="contact-container">
  <h1 class="contact-title">Contact Us</h1>

  <div class="contact-info">
    <h2> Our Address</h2>
    <p>mikesaruni@gmail.com,Strathmore Nairobi, Kenya</p>

    <h2> Phone</h2>
    <p> +254 769639067 or +254 791388117</p>

    <h2>Email</h2>
    <p>mikesaruni@gmail.com</p>
  </div>

  <div class="contact-form">
    <h2>Send Us a Message</h2>
    <form action="submit_contact.php" method="POST">
      <label for="name">Full Name:</label>
      <input type="text" id="name" name="name" required>

      <label for="email">Email Address:</label>
      <input type="email" id="email" name="email" required>

      <label for="subject">Subject:</label>
      <input type="text" id="subject" name="subject">

      <label for="message">Message:</label>
      <textarea id="message" name="message" rows="5" required></textarea>

      <button type="submit">Send Message</button>
    </form>
  </div>
</div>

</body>
</html>

</body>
</html>