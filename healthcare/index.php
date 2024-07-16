<!DOCTYPE HTML>
<html>
<head>
    <title>Healthcare Management System</title>
    <link href="https://fonts.googleapis.com/css?family=Ropa+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/responsiveslides.css">
    <style>
        body {
            font-family: 'Ropa Sans', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        .header, .footer {
            background-color: #333;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        .wrap {
            width: 80%;
            margin: 0 auto;
        }

        .logo {
            font-size: 24px;
            text-decoration: none;
            color: white;
            text-align: left;
            font-weight: bold;
        }

        .top-nav {
            text-align: right;
        }

        .top-nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: flex-end;
        }

        .top-nav ul li {
            margin-left: 20px;
        }

        .top-nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            padding: 10px 20px;
            transition: background-color 0.3s ease;
        }

        .top-nav ul li a:hover {
            background-color: #555;
            border-radius: 5px;
        }

        .content-grids {
            padding: 20px 0;
            text-align: center;
        }

        .section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .listview_1_of_3 {
            flex: 1;
            margin: 10px;
            background-color: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .listview_1_of_3:hover {
            transform: translateY(-10px);
        }

        .text {
            padding: 10px 0;
        }

        .text h3 {
            margin: 0 0 10px 0;
            font-size: 24px;
        }

        .button {
            text-align: center;
            margin-top: 10px;
        }

        .button a {
            text-decoration: none;
            background-color: #333;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            display: inline-block;
            transition: background-color 0.3s ease;
        }

        .button a:hover {
            background-color: #555;
        }

        .footer ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
        }

        .footer ul li {
            margin-right: 20px;
        }

        .footer ul li a {
            color: white;
            text-decoration: none;
        }

        .footer ul li a:hover {
            text-decoration: underline;
        }

        .clear {
            clear: both;
        }

        .listimg img {
            width: 100px;
            height: 100px;
            display: block;
            margin: 0 auto;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="js/responsiveslides.min.js"></script>
    <script>
        $(function () {
            $("#slider1").responsiveSlides({
                maxwidth: 1600,
                speed: 600
            });
        });
    </script>
</head>
<body>
    <div class="header">
        <div class="wrap">
            <div class="logo">
                <a href="index.html">Healthcare Management System</a>
            </div>
            <div class="top-nav">
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="about.html">About Us</a></li>
                    <li><a href="contact.html">Contact Us</a></li>
                </ul>
            </div>
            <div class="clear"></div>
        </div>
    </div>

    <div class="content-grids">
        <div class="wrap">
            <div class="section">
                <div class="listview_1_of_3">
                    <div class="listimg">
                        <img src="images/grid-img4.png" alt="Patients">
                    </div>
                    <div class="text">
                        <h3>Patients</h3>
                        <div class="button"><span><a href="hms/user-login.php">Click Here</a></span></div>
                    </div>
                </div>

                <div class="listview_1_of_3">
                    <div class="listimg">
                        <img src="images/grid-img1.png" alt="Doctors">
                    </div>
                    <div class="text">
                        <h3>Doctors</h3>
                        <div class="button"><span><a href="hms/doctor/">Click Here</a></span></div>
                    </div>
                </div>

                <div class="listview_1_of_3">
                    <div class="listimg">
                        <img src="images/grid-img5.png" alt="Admin">
                    </div>
                    <div class="text">
                        <h3>Admin</h3>
                        <div class="button"><span><a href="hms/admin">Click Here</a></span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <div class="wrap">
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="about.html">About Us</a></li>
                <li><a href="contact.html">Contact Us</a></li>
            </ul>
            <p>&copy; 2024 Healthcare Management System. All Rights Reserved.</p>
        </div>
    </div>
</body>
</html>
