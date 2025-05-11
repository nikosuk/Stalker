# IPTV PHP Portal

This repository contains a self-contained IPTV portal using plain PHP and MySQL, featuring:

- User registration & login (session-based, bcrypt)
- Channel management (add, list, categorize)
- M3U playlist import
- Stream proxy with access logging
- Admin-only HTML interface with Bootstrap styling
- JSON API for channels, categories, logs, and more

## Project Structure

```
iptv_php_plain/
├── includes/
│   ├── auth.php
│   ├── category.php
│   ├── channel.php
│   ├── db.php
│   ├── import.php
│   ├── logs.php
│   └── stream.php
├── public/
│   ├── add_channel.php
│   ├── admin.php
│   ├── import.php
│   ├── login.php
│   ├── logout.php
│   └── logs.php
├── schema.sql
├── index.php
├── .gitignore
└── README.md
```

## Setup

1. **Clone the repository:**
   ```bash
   git clone https://github.com/<your-username>/iptv_php_plain.git
   cd iptv_php_plain
   ```

2. **Database:**
   - Create MySQL database:
     ```sql
     CREATE DATABASE iptv;
     USE iptv;
     SOURCE schema.sql;
     ```
   - Update database credentials in `includes/db.php`.

3. **Deploy:**
   - Copy files to your web server root (e.g., `/var/www/html/iptv`).
   - Ensure PHP sessions are enabled and `file_get_contents`/`readfile` functions permitted.
   - Set proper permissions for sessions and logs.

4. **Access:**
   - Visit `/public/login.php` to log in as admin.
   - Use the HTML interface or JSON API endpoints:
     - `POST /register`
     - `POST /login`
     - `GET /channels`, `POST /channels`
     - `GET /categories`, `POST /categories`
     - `POST /import-m3u` (file upload)
     - `GET /play/{id}`
     - `GET /logs`

## Contributing

1. Fork the repository.
2. Create a feature branch and make changes.
3. Submit a pull request with detailed description.

## License

This project is licensed under the MIT License.