# Play and Learn – Python 101 v2.0 & Java 101 v2.0
**Yohannis Alem · Group 15 · ICS 499 Capstone**

An interactive course and quiz website. Students learn by reading short lessons, playing games and taking quizzes. The site tracks each student's progress and gives feedback based on how they do. Parents can see their child's progress. Admins manage all the content and users.

The whole website works in **English and Spanish (Español)**: the menus, buttons, messages, feedback, and all the course content.

Built with **HTML, CSS, JavaScript, jQuery, Bootstrap 5, Chart.js, PHP 8 and MySQL**.

---

## 1. How to run it (XAMPP)

1. Install **XAMPP**. Start **Apache** and **MySQL** in the XAMPP Control Panel.
2. Copy the `play-and-learn` folder into `C:\xampp\htdocs\`.
3. Open http://localhost/play-and-learn/install.php and click **Install / Reset database**.
   (Or import `db/schema.sql` and then `db/seed.sql` in phpMyAdmin.)
4. Open http://localhost/play-and-learn/ and log in.

If your MySQL user or password is not `root` with no password, change them in `config.php`.
All libraries are inside `assets/vendor`, so the site works **without internet** during the demo.

## 2. Demo accounts

| Role    | Email                    | Password   | Language |
|---------|--------------------------|------------|----------|
| Admin   | admin@playlearn.com      | admin123   | English  |
| Student | student@playlearn.com    | student123 | English (Alex Lopez, has progress) |
| Student | jordan@playlearn.com     | student123 | English (Jordan Lee, strong in Java) |
| Student | sam@playlearn.com        | student123 | English (Sam Rivera, just started) |
| Parent  | parent@playlearn.com     | parent123  | English (Maria Lopez, parent of Alex) |
| Parent  | david@playlearn.com      | parent123  | English (David Lee, parent of Jordan) |
| Student | estudiante@playlearn.com | student123 | Español (Sofía García) |
| Parent  | padre@playlearn.com      | parent123  | Español (Carlos García, parent of Sofía) |

The login page has buttons that fill these in for you.

## 3. English / Spanish

- Click **EN** or **ES** in the menu (or at the top of the login page) to change the language at any time.
- The choice is **saved for each user**. Next time they log in, the site opens in their language.
- On the first visit, the site uses Spanish automatically if the browser is set to Spanish.
- The admin can set a user's language on the **Users** page.
- Translated: every page, button, message, feedback tip, chart, date, and all **16 lessons, 16 games and 80 quiz questions**.
- Code examples stay the same in both languages, because code is written in English.
- In the admin pages, lessons, games and quiz questions have an **English** tab and an **Español** tab. If a Spanish field is empty, Spanish speakers see the English text.

How it works in the code:
- `includes/lang.php` picks the language and has the helper functions: `t('Log in')` translates interface text, and `loc($row, 'title')` picks the Spanish column (`title_es`) when the site is in Spanish.
- `includes/lang_es.php` holds all the Spanish interface words (about 300).
- The database has a Spanish column next to each text, for example `lessons.title_es`, `lessons.content_es` and `questions.explanation_es`.
- The Spanish course content is in `db/content/python101_es.php` and `db/content/java101_es.php`.

## 4. What each user can do

**Student**
- Dashboard: XP, stats, both courses with progress rings, a **Continue** button, feedback, and recent activity
- Every lesson has 3 steps: **Read → Play → Quiz**
- **3 game types:** Matching (code → output), Fill in the blank, Put the code in order (drag and drop or arrows)
- **Quizzes:** one question at a time, instant right/wrong with an explanation, final score, pass/fail, and topics to review
- **My Progress:** quiz scores over time, best score per lesson, topics that need practice, and feedback

**Parent**
- Sees only their own child's progress (same charts, tables and feedback, written for parents)
- Can switch between children if they have more than one

**Admin**
- Dashboard: totals, pass rate per course, **hardest questions**, latest quiz attempts
- **Add / edit / delete** courses, lessons (with live preview), games and their items, quizzes and questions, in English and Spanish
- Reorder lessons
- **Add / edit / delete** users, set the role and language, link a student to a parent, reset passwords
- Reports for every student, plus a full report page for each one

## 5. Course content

| # | Python 101 v2.0 | Java 101 v2.0 |
|---|-----------------|---------------|
| 1 | Hello, Python! / ¡Hola, Python! | Hello, Java! / ¡Hola, Java! |
| 2 | Variables and Data Types | Variables and Data Types |
| 3 | Operators and Math | Operators and Math |
| 4 | Working with Strings | Working with Strings |
| 5 | Making Decisions (if / elif / else) | Making Decisions (if / else / switch) |
| 6 | Loops (for and while) | Loops (for, while, do-while) |
| 7 | Lists | Arrays |
| 8 | Functions | Methods |

Every lesson has 1 game and a 5-question quiz: **16 lessons, 16 games, 80 quiz questions**, in both languages.

## 6. How progress and feedback work

- Reading a lesson, every game, and every quiz attempt is saved in the database.
- Each quiz question has a **topic** (like "division" or "slicing"). The site looks at the **latest try** of each quiz to find the topics the student missed, and links back to that lesson.
- Feedback is based on: the average quiz score (below 70 / 70–89 / 90 and up), improvement between the first and latest try, quizzes below the passing score, the next lesson to do, and days since the last activity.
- Games give 1–3 stars and remember the personal best.

## 7. Security

- Passwords are stored with `password_hash()`.
- All SQL uses **prepared statements** (no SQL injection).
- All output is escaped with `htmlspecialchars()` (no XSS).
- Every form and API call has a **CSRF token**.
- Each page checks the user's role. Parents can only see their own children.
- Quiz answers are **checked on the server**. The correct answers are never sent to the browser before the student answers.

## 8. Files

```
play-and-learn/
├── index.php, login.php, logout.php   one login for all 3 roles
├── config.php                         database settings + languages
├── install.php                        one-click database setup
├── includes/
│   ├── db.php                         database connection
│   ├── auth.php                       login, roles, CSRF
│   ├── lang.php, lang_es.php          English / Spanish
│   ├── progress.php                   score tracking + feedback
│   ├── progress_view.php              progress report (charts, tables)
│   └── header.php, footer.php         shared layout, menu, language switch
├── student/                           dashboard, course, lesson, game, quiz, progress
├── parent/index.php                   parent's view of their child
├── admin/                             content + users + reports
├── api/                               quiz.php, save_game.php, complete_lesson.php
├── assets/css/style.css               design
├── assets/js/                         app.js, games.js, quiz.js
├── assets/vendor/                     Bootstrap, jQuery, Chart.js, icons
└── db/
    ├── schema.sql                     11 tables
    ├── seed.sql                       courses (EN + ES), demo users, sample scores
    ├── content/                       Python 101 and Java 101, English and Spanish
    └── build_seed.php                 rebuilds seed.sql from the content files
```

## 9. Database tables

`users` (role, `parent_id`, `language`) · `courses` · `lessons` · `games` · `game_items` · `quizzes` · `questions` (with `topic`) · `lesson_progress` · `game_scores` · `quiz_attempts` · `attempt_answers`

## 10. Suggested final demo (about 7 minutes)

1. **Login page:** one form for all 3 roles. Click **ES** to show the Spanish version, then **EN**.
2. **Student (Alex):** dashboard → Python 101 → a lesson → play the game → take the quiz and get one wrong on purpose → final score → My Progress charts and "topics to review".
3. **Spanish student (Sofía):** log in, and the site opens in Spanish by itself. Show a lesson, a game and the quiz feedback in Spanish.
4. **Parent (Maria or Carlos):** sees only their child's progress and feedback.
5. **Admin:** dashboard "hardest questions" → add a quiz question with the English and Español tabs → add a student, choose Spanish, and link a parent → Reports.

To reset all demo data before presenting, open `install.php` again.
