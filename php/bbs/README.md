<h1 align="center">BBS</h1>

```zsh
$ git clone https://github.com/ogty/school
$ cd ./school/php/bbs
```

```zsh
$ make docker-start
```

```zsh
$ make docker-stop
```

- 🔐 [`.env`](https://github.com/ogty/school/blob/main/php/bbs/.env)
- :octocat: [`.gitignore`](https://github.com/ogty/school/blob/main/php/bbs/.gitignore)
- 📄 [`Makefile`](https://github.com/ogty/school/blob/main/php/bbs/Makefile)
- 📝 [`README.md`](https://github.com/ogty/school/blob/main/php/bbs/README.md)
- 📦 [`database`](https://github.com/ogty/school/blob/main/php/bbs/database)
  - 🐬 [`mysql`](https://github.com/ogty/school/blob/main/php/bbs/database/mysql)
    - 📦 [`data`](https://github.com/ogty/school/blob/main/php/bbs/database/mysql/data)
      - :octocat: [`.gitkeep`](https://github.com/ogty/school/blob/main/php/bbs/database/mysql/data/.gitkeep)
    - 📂 [`scripts`](https://github.com/ogty/school/blob/main/php/bbs/database/mysql/scripts)
      - 🐬 [`create_database.sql`](https://github.com/ogty/school/blob/main/php/bbs/database/mysql/scripts/create_database.sql)
      - 🐬 [`create_table.sql`](https://github.com/ogty/school/blob/main/php/bbs/database/mysql/scripts/create_table.sql)
- 🐳 [`docker-compose.yml`](https://github.com/ogty/school/blob/main/php/bbs/docker-compose.yml)
- 📂 [`etc`](https://github.com/ogty/school/blob/main/php/bbs/etc)
  - 📂 [`nginx`](https://github.com/ogty/school/blob/main/php/bbs/etc/nginx)
    - ⚙️ [`default.conf`](https://github.com/ogty/school/blob/main/php/bbs/etc/nginx/default.conf)
    - ⚙️ [`default.template.conf`](https://github.com/ogty/school/blob/main/php/bbs/etc/nginx/default.template.conf)
  - 🐘 [`php`](https://github.com/ogty/school/blob/main/php/bbs/etc/php)
    - ⚙️ [`php.ini`](https://github.com/ogty/school/blob/main/php/bbs/etc/php/php.ini)
- 🌐 [`web`](https://github.com/ogty/school/blob/main/php/bbs/web)
  - 📂 [`app`](https://github.com/ogty/school/blob/main/php/bbs/web/app)
    - 🔐 [`.env`](https://github.com/ogty/school/blob/main/php/bbs/web/app/.env)
    - 📄 [`composer.json`](https://github.com/ogty/school/blob/main/php/bbs/web/app/composer.json)
    - 📂 [`src`](https://github.com/ogty/school/blob/main/php/bbs/web/app/src)
      - 🐘 [`app.php`](https://github.com/ogty/school/blob/main/php/bbs/web/app/src/app.php)
      - 📂 [`libs`](https://github.com/ogty/school/blob/main/php/bbs/web/app/src/libs)
        - 🐘 [`Bbs.php`](https://github.com/ogty/school/blob/main/php/bbs/web/app/src/libs/Bbs.php)
        - 🐘 [`Db.php`](https://github.com/ogty/school/blob/main/php/bbs/web/app/src/libs/Db.php)
      - 📂 [`templates`](https://github.com/ogty/school/blob/main/php/bbs/web/app/src/templates)
        - 🌿 [`bbses.twig`](https://github.com/ogty/school/blob/main/php/bbs/web/app/src/templates/bbses.twig)
        - 🌿 [`form.twig`](https://github.com/ogty/school/blob/main/php/bbs/web/app/src/templates/form.twig)
        - 🌿 [`index.twig`](https://github.com/ogty/school/blob/main/php/bbs/web/app/src/templates/index.twig)
        - 🌿 [`message.twig`](https://github.com/ogty/school/blob/main/php/bbs/web/app/src/templates/message.twig)
        - 🌿 [`pagination.twig`](https://github.com/ogty/school/blob/main/php/bbs/web/app/src/templates/pagination.twig)
  - 🌐 [`public`](https://github.com/ogty/school/blob/main/php/bbs/web/public)
    - 🐘 [`delete.php`](https://github.com/ogty/school/blob/main/php/bbs/web/public/delete.php)
    - 🐘 [`index.php`](https://github.com/ogty/school/blob/main/php/bbs/web/public/index.php)
    - 🐘 [`online_comment.php`](https://github.com/ogty/school/blob/main/php/bbs/web/public/online_comment.php)
    - 🐘 [`write.php`](https://github.com/ogty/school/blob/main/php/bbs/web/public/write.php)
