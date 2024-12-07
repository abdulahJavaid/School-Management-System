<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slide Navbar with Animation</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            height: 2000px; /* For scroll effect */
            background-color: #f4f4f4;
        }

        /* Navbar Styling */
        .navbar {
            position: fixed;
            top: 0;
            left: -250px; 
            width: 150px;
            height: 100%;
            background-color: #2193B0;
            color: white;
            display: flex;
            flex-direction: column;
            align-items: start;
            padding: 20px;
            transition: left 0.5s ease;
            z-index: 1000;
            padding-top: 100px;
        }
        

        .navbar.show {
            left: 0; /* Slide-in from left */
        }

        .navbar div {
            margin: 15px 0;
            opacity: 0;
            transform: translateX(-50px); /* Slide from left */
            animation: slideIn 0.5s forwards;
        }

        .navbar div:nth-child(1) { animation-delay: 0.1s; }
        .navbar div:nth-child(2) { animation-delay: 0.2s; }
        .navbar div:nth-child(3) { animation-delay: 0.3s; }
        .navbar div:nth-child(4) { animation-delay: 0.4s; }

        @keyframes slideIn {
            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .navbar a {
            color: white;
            text-decoration: none;
            font-size: 20px;
        }

        .navbar a:hover {
            background-color: black;
            border-radius: 5px;
            padding: 5px;
        }

        /* Toggle Button */
        .toggle-btn {
            position: fixed;
            top: 20px;
            left: 20px;
            font-size: 30px;
            cursor: pointer;
            color: black;
            z-index: 1001;
        }

        .toggle-btn.show {
            left: 120px; /* Shift icon when navbar opens */
        }

        .toggle-btn i {
            transition: color 0.3s ease;
        }

        .toggle-btn:hover i {
            color: #6DD5ED;
        }
    </style>
</head>
<body>

    <!-- Toggle Button -->
    <div class="toggle-btn" id="toggleBtn">
        <i class="fas fa-bars"></i>
    </div>

    <!-- Navbar -->
    <div class="navbar" id="navbar">
        <div><a href="#home">Home</a></div>
        <div><a href="#feature">Features</a></div>
        <div><a href="#contact">Contact</a></div>
        <div><a href="#login">Login</a></div>
    </div>

    <script>
        let navbar = document.getElementById('navbar');
        let toggleBtn = document.getElementById('toggleBtn');
        let toggleIcon = toggleBtn.querySelector('i'); // Get the icon inside the toggle button

        // Toggle Navbar and Icon on Click
        toggleBtn.onclick = function () {
            navbar.classList.toggle('show');
            toggleBtn.classList.toggle('show'); // Shift icon position when navbar opens

            // Toggle between hamburger and close icon
            if (navbar.classList.contains('show')) {
                toggleIcon.classList.replace('fa-bars', 'fa-times'); 
            } else {
                toggleIcon.classList.replace('fa-times', 'fa-bars'); 
            }
        };

        // Close Navbar on Scroll Down
        let prevScrollPos = window.pageYOffset;
        window.onscroll = function () {
            let currentScrollPos = window.pageYOffset;
            if (prevScrollPos < currentScrollPos) {
                navbar.classList.remove('show'); // Hide navbar
                toggleBtn.classList.remove('show'); // Reset toggle button position
                toggleIcon.classList.replace('fa-times', 'fa-bars'); 
            }
            prevScrollPos = currentScrollPos;
        };
    </script>

</body>
</html>
