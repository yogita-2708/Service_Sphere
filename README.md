# Service Sphere - A Seamless Access to Expertise Anywhere

## Overview

Service Sphere is a web-based platform designed to streamline the booking process for local services such as cleaning, beauty treatments, and repairs. The platform ensures efficiency, security, and high-quality service delivery through its user-friendly interface and robust feature set.

## Features

- **Intuitive User Interface:** Built with HTML, CSS, JavaScript, Bootstrap, AJAX, and jQuery for a seamless user experience.
- **Dual OTP Authentication:** Enhances security by requiring users to confirm both the start and end of services.
- **Independent Service Providers:** Allows direct service offerings from verified providers.
- **In-App Chat System:** Facilitates seamless communication between users and service providers.
- **Real-Time Scheduling:** Includes a slot interface for easy and efficient booking.

## Technologies Used

- **Frontend:** HTML, CSS, JavaScript, Bootstrap, AJAX, jQuery
- **Backend:** PHP
- **Database:** MySQL
- **Tools:** VS Code, XAMPP

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/yogita-2708/service-sphere.git
   ```
2. Navigate to the project directory:
   ```bash
   cd service-sphere
   ```
3. Set up the database:
   - Create a MySQL database named `servicesphere`.
   - Import the provided SQL file into the database:
     ```bash
     mysql -u yogita-2708 -p service_sphere < database/servicesphere.sql
     ```
4. Configure the backend:
   - Open `dbconnect.php` and update the database credentials to match your setup.
5. Start the server using XAMPP:
   - Move the project directory to the `htdocs` folder in your XAMPP installation directory.
   - Start Apache and MySQL from the XAMPP control panel.

## Usage

1. Open your web browser and navigate to `http://localhost/Service_Sphere`.
2. Register as a new user or log in with existing credentials.
3. Browse through available services and make bookings as needed.
4. Use the in-app chat to communicate with service providers.
5. Confirm services with the dual OTP authentication system.

## Screenshots

![Home Page](screenshots/homepage.jpg)
![Login Page](screenshots/login.jpg)
![SignUp Page](screenshots/signup.jpg)
![After Login](screenshots/afterlogin.jpg)
![Search Page](screenshots/search.jpg)
![Book Appointment Page](screenshots/bookapp.jpg)
![Booking Page](screenshots/booking.jpg)
![Logout Page](screenshots/logout.jpg)
![Admin Dashboard](screenshots/dashboard.jpg)
![Database Tables](screenshots/database.jpg)

## Project Video

Watch the full project video on LinkedIn: [Service Sphere Project Video](https://www.linkedin.com/posts/k-yogita_siliconuniversity-finalyearproject-webdevelopment-activity-7212766074868490240-WGGf?utm_source=share&utm_medium=member_desktop)

## Contributors

- **Kanreddy Yogita** - [@yogita-2708](https://github.com/yogita-2708)
- **Bikash Swain** - [@bikashswain009](https://github.com/bikashswain009)
- **Stuti Biswal** - [@stutibiswal01](https://github.com/stutibiswal01)

