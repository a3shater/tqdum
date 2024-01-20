# tqdum
tqdum web application

## Getting Started

These instructions will guide you through setting up and running the project on your local machine.

### Prerequisites

Make sure you have the following installed:

- [Git](https://git-scm.com/downloads)
- [XAMPP](https://www.apachefriends.org/index.html) (or any other Apache server and MySQL)
- [Visual Studio Code](https://code.visualstudio.com/download)
- [Composer](https://getcomposer.org/download/)

### Installation

1. **Clone the Project:**

```
git clone https://github.com/a3shater/tqdum.git
```

3. **Install and Run Apache and MySQL (XAMPP):**

* Install XAMPP and start the Apache and MySQL services.
* Ensure both Apache and MySQL are "Running" in the XAMPP control panel.

4. **Open Project in Code Editor (VS Code):**
```
code .
```

5. **Create .env File:**

* Copy the contents from .env.example.
* Create a new file named .env in the project root.
* Paste the copied contents into .env.
* Setup your .env file to custimize with your enviroment

6. **Generate App Key:**

```
php artisan key:generate
```

7. **Migrate Database:**

```
php artisan migrate
```

### Or for quick access you can use sql and import it

tqdum (1).sql

### The user for tqdum (1).sql is:
* Admin
  email: ahmed@gmail.com
  password: 123456123456
* Reviewer
  email: reviewer1@gmail.com
  password: 12345678
* Interviewer
  email: interviewer1@gmail.com
  password: 12345678
* Applicant
  email: a3shater.dev@gmail.com
  password: 123456123456

#### Running the App

To start the development server, run the following command:

```
php artisan serve
```

The application will be accessible at http://localhost:8000 in your web browser.

#### Note

If you want to send emails, provide your Gmail account details in the .env file. Update the MAIL_USERNAME and MAIL_PASSWORD with your Gmail account credentials.

## Enjoy!

Visit http://localhost:8000 in your web browser and enjoy using the app!
