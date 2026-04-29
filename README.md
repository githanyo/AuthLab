# AuthLab: Vulnerable vs Secure Web Application (Authorization Testing Lab)

## Overview
=============================================
AuthLab is a hands-on cybersecurity lab designed to demonstrate and fix critical web application vulnerabilities related to **authentication and authorization**.

This project contains two versions of the same application:

*  **Vulnerable Version** — intentionally insecure
*  **Secure Version** — hardened using best practices

It is built to help learners, students, and aspiring penetration testers understand how real-world vulnerabilities are exploited and mitigated.

---

## Objectives
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
* Demonstrate common web vulnerabilities:

  * IDOR (Insecure Direct Object Reference)
  * Broken Access Control
  * Privilege Escalation
  * SQL Injection
  * Weak Authentication

* Show how to **securely implement**:

  * Authentication
  * Role-Based Access Control (RBAC)
  * Secure session management
  * Input validation & sanitization

---

## Vulnerabilities Demonstrated

### Vulnerable Version
-----------------------------------------------------------------------------------
| Vulnerability         | Description                                             |
| --------------------- | ------------------------------------------------------- |
| IDOR                  | Users can access other profiles via `?id=` manipulation |
| Broken Access Control | Any user can access admin functionality                 |
| Privilege Escalation  | Users can promote themselves to admin                   |
| SQL Injection         | Unsanitized SQL queries                                 |
| Plaintext Passwords   | No hashing                                              |
-----------------------------------------------------------------------------------
---

### Secure Version
------------------------------------------------------------------------
| Fix                      | Implementation                            |
| ------------------------ | ----------------------------------------- |
| IDOR Prevention          | User identity derived from session        |
| Access Control           | Role-based authorization checks           |
| Privilege Control        | Admin-only endpoints                      |
| SQL Injection Prevention | Prepared statements                       |
| Password Security        | `password_hash()` and `password_verify()` |
| Session Security         | Session regeneration                      |
------------------------------------------------------------------------
---

## ⚙️ Setup Instructions
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
### 1. Clone Repository

```bash
git clone https://github.com/githanyo/AuthLab.git
cd AuthLab
```

---

### 2. Setup Environment

* Install XAMPP / LAMP / WAMP
* Place project inside:

```
htdocs/
```

---

### 3. Create Database

* Open phpMyAdmin
* Create database:

```
authlab
```

* Import:

```
database/authlab.sql
```

---

### 4. Run Application

Access in browser:

```
http://localhost/AuthLab/vulnerable/pages/login.php
```

or

```
http://localhost/AuthLab/secure/pages/login.php
```

---

## Default Test Credentials
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
| Role  | Username | Password    |
| ----- | -------- | ----------- |
| User  | user1    | password123 |
| Admin | admin    | admin123    |

---

## Learning Scenarios
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

### 1. IDOR Attack

* Modify:

```
/profile.php?id=2
```

* Observe unauthorized data access

---

### 2. Privilege Escalation

* Visit:

```
/update_role.php?id=1&role=admin
```

---

### 3. Broken Access Control

* Access:

```
/admin.php
```

as a normal user

---

## Defensive Techniques Applied
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
* Input validation (`filter_input`)
* Output escaping (`htmlspecialchars`)
* Prepared statements (MySQLi)
* Role-based authorization middleware
* Secure session handling

---

## 📂 Documentation

* `docs/attack-scenarios.md` → Step-by-step exploitation
* `docs/mitigation-strategies.md` → Secure coding techniques

---

## Screenshots

(Add screenshots in `/docs/screenshots/`)

---

## Future Improvements

* CSRF Protection
* Rate Limiting (Login)
* Audit Logging
* JWT Authentication
* API Version

---

## Author

**OYO JONATHAN**

* Cybersecurity Student
* Focus: Web Security & Ethical Hacking

---

## License
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
This project is for **educational purposes only**. Do not deploy vulnerable code in production.

---
