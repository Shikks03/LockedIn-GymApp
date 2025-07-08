# 🏋️‍♂️ LOFIT: Developer Guide & Project Roadmap

> ⚙️ *Final Project for Application Development Class*

Lofit is a **gamified gym tracker** where users gain **levels** as they log workouts and hit fitness milestones. The goal is to help users stay consistent and engaged with their health goals.

This document is intended for **internal use** by the dev team (us). It outlines how we're building Lofit and what to keep in mind during development.

---

## 👥 Team Members & Roles

| Name      | Role |
|-----------|------|
| **Shikkari** | 🎯 Project Leader / 💻 Back-End Developer (PHP + backend lead) |
| **Bea**       | 🎨 Front-End Developer (UI layout and styling using CSS) |
| **Jas**       | 🧩 Database Integrations Specialist (SQL-PHP connectivity & query handling) |
| **Russel**    | 🏋️ Workout Content Manager (compiling structured workouts + SQL entry) |
| **Jobe**      | 📄 Research & Technical Writer (handles research documentation and paper writing) |

> 🗒 *Feel free to update this list if roles evolve during development.*

---

## 🧠 Project Vision

"Make working out feel like a game."

Users don’t just log their workouts — they **level up**, track progress, and set goals. Our unique touch is blending fitness tracking with **game-like motivation**.

---

## 🛠 Tech Stack

| Tech | Purpose |
|------|---------|
| `PHP` | Backend / Server logic |
| `CSS` | Styling the UI |
| `MySQL` | Database (users, logs, workouts, goals) |

---

## 📂 Suggested Folder Structure
/lof-it/
│
├── /assets/ # Images, icons, fonts
├── /css/ # Stylesheets
├── /php/ # Server-side scripts
├── /js/ # Optional: Scripts if needed
├── /sql/ # SQL setup files / backups
├── /pages/ # Page views like home.php, goals.php
├── index.php # Landing / routing file
└── README.md

---

## 🚀 Features Overview

| Feature | Description |
|--------|-------------|
| 🏠 Home Tab | Dashboard with weight goal tracker, quick logs, monthly workout goal tracker |
| 🏋️ Workouts Tab | Card-based UI for selecting workouts |
| 🎯 Goals Tab | Add/Edit/Delete personal fitness goals |
| 🍽️ Macro Calculator | Calculates macros for bulking or cutting based on user data |
| 👤 User Tab | (To Be Defined) User settings/options |
| 🔓 Logout | End session and return to login |

---

## 🔖 Development Milestones (Roadmap)

### ✅ MVP Tasks (Minimum Viable Product)
- [ ] ✅ Design static layout for all tabs/pages
- [ ] ✅ Implement buttons and User Interface
- [ ] ✅ Set up database (users, workouts, goals, logs)
- [ ] 🔄 Link forms to database (e.g., goal creation)
- [ ] 🔄 Implement login/logout and session handling

### 🧪 Bonus Ideas
- [ ] XP system for leveling up
- [ ] Personalized workout routines
- [ ] Weight/goal progress visualizations (bar or circle meters)
- [ ] Simple animations
- [ ] User Achievements

---

## 🧾 To-Do Notes (as of now)

- [ ] Define what goes inside **User Tab**
- [ ] Decide how XP system will be computed
- [ ] Set default goals for new users?
- [ ] Build dummy user accounts for demo

---

## 🧙 Developer Tips & Reminders

- Write **modular PHP** files (separate logic from display as much as possible)
- Create reusable **form components**
- Sanitize input — especially weight, macros, etc.
- Keep table/column names **consistent and descriptive**
- Use `git pull` frequently when working in teams
- Comment your SQL queries if they get long

---

## 🚫 Not Publicly Released

This project is **confidential** and intended for **academic purposes** only. No license is included as of now.

---
