## Pet 💜 Match WebApp ##
**Find the perfect paw‑tnership for pets who need a loving home.**

![Screenshot of the main user page](/images/Screenshot%202025-06-25%20at%2018.04.15.png)
> Live **▶︎** [https://iliana.codefactory.live/pet\_match/](https://iliana.codefactory.live/pet_match/)

---

## 📚 Table of Contents

1. [Features](#-features)
2. [Tech Stack](#-tech-stack)
3. [Getting Started](#-getting-started)
4. [Project Structure](#-project-structure)
5. [Security Notes](#-security-notes)
6. [Some visuals of this webapp](#-some-visuals-of-this-webapp)
7. [Road‑map & Future Work](#-road‑map--future-work)
8. [Contributing](#-contributing)
9. [License & Credits](#-license--credits)

---

## 🐾 Features

| Category               | Highlights                                                                                                                              |
| ---------------------- | --------------------------------------------------------------------------------------------------------------------------------------- |
| **User & Admin Roles** | • Self‑service sign‑up / log‑in / log‑out • Bcrypt‑hashed passwords & secure sessions• Admin dashboard to manage pets, users & adoptions |
| **Pet Catalogue CRUD** | • Create, read, update, delete pets via friendly forms • Photo upload with size/type validation• Rich cards with photo, age, breed & bio |
| **Adoption Workflow**  | • Visitors request adoption in one click • Requests stored in DB and listed for admins• Confirmation feedback        |
| **Responsive UI**      | • Mobile‑first vanilla HTML & CSS • Hero banner & intuitive navigation• No heavy front‑end frameworks = lightning load times             |
| **One‑Click Deploy**   | • Works out‑of‑the‑box on any LAMP/cPanel host • SQL schema included (`EBEWD2_CR5_animal_adoption_IlianaMarquez.sql`)                    |

> **Note:** The “matching” in *Pet 💜 Match* is currently a catchy name. Geo‑matching & smart recommendations will be developed in the future.

---

## 🛠️ Tech Stack

| Layer     | What we use      | Why                                             |
| --------- | ---------------- | ----------------------------------------------- |
| Front‑End | HTML5, CSS3      | Lightweight, fast, easy to extend               |
| Back‑End  | PHP 8.x          | Familiar LAMP environment, wide hosting support |
| Database  | MySQL 8.x        | Relational model fits pets ↔ adoptions ↔ users  |
| Hosting   | Apache on cPanel | Zero‑config deploy via FTP/File Manager         |

---

## 🚀 Getting Started

### Prerequisites

- PHP 8.x
- MySQL 8.x
- Apache/Nginx (LAMP, XAMPP, MAMP…)

### Installation

```bash
# 1. Clone the repo
$ git clone https://github.com/iliana-marquez/petmatch-webapp.git
$ cd petmatch-webapp

# 2. Create the database
$ mysql -u <user> -p < schema/EBEWD2_CR5_animal_adoption_IlianaMarquez.sql

# 3. Configure connection
#    Update /components/db_connect.php with your DB creds

# 4. Point your local vhost or localhost to the repo root
#    and you’re good to go 🎉
```

### Default Roles

| Email                  | Password | Role      |
| ---------------------- | -------- | --------- |
| `jo@jo.com` | `123123`  | **Admin** |
| *(register your own)*  | *chosen* | **User**  |

---

## 🌟 Core Highlights

| Feature Area                  | Key Files & Functionality                                                                     | Value & Impact
|------------------------|----------------------------------------------------------------------------------------------------|--------------------------------------------------------------------------------|
| **User onboarding & auth** | `register.php`, `login.php`, `logout.php`, profile-editing flow                                    | Smooth sign-up, session-based authentication, personal dashboard for each user |
| **Pet CRUD**           | `create_pet.php`, `edit_pet.php`, `delete.php`, image uploads via `file_upload.php`                | Admins/shelters can manage listings easily without DB access                   |
| **Rich pet catalogue** | `pets.php`, `pet_details.php` with hero photo + bio                                                 | Users browse by photo, age, breed, and pet personality                         |
| **Smart search**       | `search.php` + the “Find me!” CTA on the homepage                                                  | Filters by species, age, size. A more intuitive discovery                         |
| **Adoption workflow**  | `adoption.php`, `adoptions.php`, email trigger in `email.php`                                      | One-click adoption with admin approval flow & confirmation email               |
| **Admin dashboard**    | `dashboard.php`, `users.php`                                                                       | Central place for user/pet/adoption management; role-based access control      |
| **MySQL schema provided** | `EBEWD2_CR5_animal_adoption_IlianaMarquez.sql`                                                       | Instant DB setup makes it easy for others to deploy                            |
| **Responsive UI**      | `style.css` + hero layout                                                                          | Mobile-friendly with no external frameworks                            |
| **Easy deployment**    | Deployed on cPanel (PHP + MySQL)                                                                  | Works without Docker—ideal for shared hosting or FTP workflows                 |

---

## 🔐 Security Notes

- **Password hashing:** `password_hash()` with default bcrypt cost.
- **Session management:** Regenerated IDs on log‑in, secure cookies.
- **File uploads:** MIME/type & size checks; files stored outside web‑root.
- **SQL safety:** Prepared statements (`mysqli_stmt`) throughout.

---

## 🖼️ Some visuals of this webapp

**Login Page**
![Login Page](/images/login_page.png)  

**Pets display for Users**
![Show pets Page](/images/pet_display.png)

**Admin Dashboard** 
![Admin dashboard](/images/admin_dashboard.png)

**Admin Adoptions Display**
![Admin adoptions display](/images/admin_adoptions_display.png)

---

## 🛣️ Road‑map & Future Work

- **Smart Matching:** location & preference‑based recommendations.
- **My Adoptions:** dedicated page listing a user’s adoption history.
- **CI & Tests:** PHPUnit + GitHub Actions for automatic builds.
- **Email Overhaul:** switch to PHPMailer & SMTP with `.env` secrets.
- **Donations & Stripe Checkout** to support shelters.

Have another idea? [Open an issue](https://github.com/iliana-marquez/petmatch-webapp/issues/new) or reach out!

---

## 🤝 Contributing

1. Fork the project
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'feat: add amazing feature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request 🐕

---

## 📝 License & Credits

Built with love by **Iliana Márquez** – full-stack developer and UI/UX designer of this project  - connect on [LinkedIn](https://www.linkedin.com/in/iliana-marquez-3b6795339/) 💜

