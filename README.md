### CPS 475/575 Secure Application Development

# Final Report Template

Names: Jacob Scheetz, Johnathan Henry
Instructor: Dr. Phung
ID #'s: 1015372081, 1014656801 
Course: CPS 475, Secure Application Development
Team emails: scheetzj2@udayton.edu, henryj14@udayton.edu

# Sprint 1

* designed the database so that a users: username, password, email, phone number and fullname is stored. Additionally, the capability to login, change a password of an existing user and register a user was implemented.  


# 1. Introduction

_Overview of your project design, development, and your achievement. Remember to **push all your code to your private repository** and provide the link in this section._

# 2. Design

_Describe your design of:_


*   Database
*   The user interface, e.g., the Web interface and CSS
*   Functionalities of your application, e.g., _How do you separate the roles of regular users (with registration) and the super users?_

# 3. Implementation & security analysis

_Include a brief explanation of your implementation and the security aspects based on the following questions:_

*   How did you apply the security programming principles in your project?
*   Have you used defense in depth and defense in breath principles in your project?
*   What database security principles you have used in your project?
*   Is your code robust and defensive? How?
*   How did you defend your code against known attacks such as including XSS, SQL Injection, CSRF, Session Hijacking
*   How do you separate the roles of super users and regular users?

You can reuse the work and report from 6.



# 4. Demo (screenshots)

_You need to capture screenshots to demonstrate how your web application works. The screenshots must be accompanied by a short description of its functionalities following the implementation as below:_

*   Everyone can register a new account and then login
*   Superuser can disable an account
    *   The disabled account cannot log in
    *   Superuser can enable the disabled account
    *   The enabled user can log in
*   A regular logged-in user can delete her own existing posts, but cannot delete the posts of others
*   CSRF attack to delete a post should be detected and prevented
*   A regular logged-in user cannot access the link for superusers
*   A logged-in user can have realtime chat with other logged-in users

# Appendix

Include the content (in text) of the README.md file, database.sql and all source code of your PHP files (with the file name).
If you organize your project in sub-folders, include the files in the sub folders as well.
