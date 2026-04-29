# Attack Scenarios – AuthLab Pentest Walkthrough

## Overview

This document provides a structured walkthrough of identified vulnerabilities in the **AuthLab (Vulnerable Version)**. Each scenario demonstrates how an attacker can exploit weaknesses in authentication and authorization mechanisms.

---

## Disclaimer⚠️

This project is intentionally vulnerable and designed for **educational purposes only**. Do not deploy this code in a production environment.

---

# Scenario 1: Insecure Direct Object Reference (IDOR)
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
## Objective

Access another user's profile without authorization.

## Target Endpoint

```
/pages/profile.php?id=1
```

## Steps to Reproduce

1. Login as a normal user:

   ```
   Username: user1
   Password: password123
   ```

2. Navigate to:

   ```
   /pages/profile.php?id=1
   ```

3. Modify the `id` parameter:

   ```
   /pages/profile.php?id=2
   ```

## Result💥

* The application returns another user's profile.
* No access control check is performed.
* Sensitive data exposure occurs.

## Root Cause

* Direct use of user-controlled input (`$_GET['id']`)
* No verification that the requested resource belongs to the authenticated user

## Remediation

* Derive user identity from session:

  ```php
  $user_id = $_SESSION['user']['id'];
  ```
* Avoid exposing direct object references
* Enforce authorization checks on every request

---

# Scenario 2: Broken Access Control (Admin Panel Access)
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
## Objective

Access admin functionality as a non-admin user.

## Target Endpoint

```
/pages/admin.php
```

## Steps to Reproduce

1. Login as a normal user:

   ```
   user1 / password123
   ```

2. Directly visit:

   ```
   /pages/admin.php
   ```

## Result💥

* Admin panel loads successfully
* No role validation is enforced

## Root Cause

* Missing authorization checks
* Authentication is implemented, but **authorization is not**

## Remediation🛡️

* Implement role-based access control:

  ```php
  require_role('admin');
  ```
* Enforce least privilege principle

---

# Scenario 3: Privilege Escalation via Role Manipulation
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
## Objective

Escalate privileges from user to admin.

## Target Endpoint

```
/pages/update_role.php?id=1&role=admin
```

## Steps to Reproduce

1. Login as a normal user

2. Access:

   ```
   /pages/update_role.php?id=1&role=admin
   ```

3. Reload session or revisit dashboard

## Result💥 

* User role is updated to admin
* Attacker gains full administrative privileges

## Root Cause

* No authorization check on sensitive action
* Trusting user input (`role` parameter)
* No role validation or restriction

## Remediation🛡️

* Restrict endpoint to admin users only:

  ```php
  require_role('admin');
  ```
* Validate allowed roles:

  ```php
  $allowed_roles = ['user', 'admin'];
  ```
* Log role changes for auditing

---

# Scenario 4: SQL Injection in Login
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
## Objective

Bypass authentication using SQL injection.

## Target Endpoint

```
/pages/login.php
```

## Steps to Reproduce

1. Enter the following credentials:

   ```
   Username: ' OR 1=1 --
   Password: anything
   ```

2. Submit the form

## Result💥

* Login is successful without valid credentials
* Authentication bypass achieved

## Root Cause

* Unsanitized input directly concatenated into SQL query:

  ```php
  SELECT * FROM users WHERE username='$u' AND password='$p'
  ```

## Remediation🛡️

* Use prepared statements:

  ```php
  $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
  ```
* Never trust user input
* Apply input validation

---

# Scenario 5: Weak Password Storage
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
## Objective

Demonstrate risk of plaintext password storage.

## Observation

* Passwords are stored in plaintext in the database

## Impact💥

* If database is compromised:

  * All user credentials are exposed
  * Credential reuse attacks become possible

## Root Cause

* No password hashing implemented

## Remediation🛡️

* Use secure hashing:

  ```php
  password_hash($password, PASSWORD_DEFAULT);
  ```
* Verify with:

  ```php
  password_verify($input, $hash);
  ```

---

# Scenario 6: Session Fixation Risk
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
## Objective

Demonstrate session hijacking potential.

## Observation

* Session ID is not regenerated after login

## Impact💥

* Attacker can fix a session ID and hijack user session

## Root Cause

* Missing session regeneration after authentication

## Remediation🛡️

```php
session_regenerate_id(true);
```

---

# Risk Summary
------------------------------------
| Vulnerability         | Severity |
| --------------------- | -------- |
| IDOR                  | High     |
| Broken Access Control | Critical |
| Privilege Escalation  | Critical |
| SQL Injection         | Critical |
| Weak Password Storage | High     |
| Session Fixation      | Medium   |
------------------------------------
---

# Key Takeaways
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
* Authentication ≠ Authorization
* Never trust client-side input
* Always enforce server-side access control
* Use secure coding practices by default

---

# Conclusion
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
This lab demonstrates how multiple small security flaws can combine into a **full system compromise**.

The secure version of this application mitigates all identified issues through:

* Strong authentication
* Proper authorization
* Secure coding practices

---
