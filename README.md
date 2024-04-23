# Admin Panel

This project is made for ecommerce business 
aspirants who wants a website with high
performance and control over the site.

For people made by A H Sabit.
Contact me to make a website for you at ahsabit6@gmail.com

## Table of Contents

- [Installation](#installation)
- [Usage](#usage)
- [Database](#database)

## Installation

Connect the database to front-end and the site is ready to go.
To code it further and add notification and to avoid Javascript 
error uncomment things in header.inc.php and slider.inc.php

## Usage

This project is only for personal use of any individual. Not for commercial use.
This project can't be sold or bought.

## Database

Change the credentials in the file db_login.inc.php <br>
Then create this tables in your MySQL database:

1. Table admin_user :<br>
    +----------+------------------+------+-----+---------+----------------+<br>
    | Field    | Type             | Null | Key | Default | Extra          |<br>
    +----------+------------------+------+-----+---------+----------------+<br>
    | id       | int(10) unsigned | NO   | PRI | NULL    | auto_increment |<br>
    | username | varchar(64)      | YES  |     | NULL    |                |<br>
    | password | varchar(64)      | YES  |     | NULL    |                |<br>
    +----------+------------------+------+-----+---------+----------------+
2. Table analytics :<br>
    +------------+----------------------+------+-----+---------+-------+<br>
    | Field      | Type                 | Null | Key | Default | Extra |<br>
    +------------+----------------------+------+-----+---------+-------+<br>
    | month      | varchar(5)           | YES  |     | NULL    |       |<br>
    | user_num   | int(10) unsigned     | YES  |     | 0       |       |<br>
    | visits     | int(10) unsigned     | YES  |     | 0       |       |<br>
    | visits_dur | smallint(5) unsigned | YES  |     | 0       |       |<br>
    | bounces    | int(10) unsigned     | YES  |     | 0       |       |<br>
    +------------+----------------------+------+-----+---------+-------+
3. Table balance_overview :<br>
    +----------+------------------+------+-----+---------+-------+<br>
    | Field    | Type             | Null | Key | Default | Extra |<br>
    +----------+------------------+------+-----+---------+-------+<br>
    | month    | varchar(5)       | YES  |     | NULL    |       |<br>
    | revenue  | int(10) unsigned | YES  |     | 0       |       |<br>
    | expenses | int(10) unsigned | YES  |     | 0       |       |<br>
    +----------+------------------+------+-----+---------+-------+

4. Table campaigns :<br>
    +-------+------------------+------+-----+---------+----------------+<br>
    | Field | Type             | Null | Key | Default | Extra          |<br>
    +-------+------------------+------+-----+---------+----------------+<br>
    | id    | int(10) unsigned | NO   | PRI | NULL    | auto_increment |<br>
    | total | int(10) unsigned | YES  |     | 0       |                |<br>
    +-------+------------------+------+-----+---------+----------------+

5. Table categories :<br>
    +--------+---------------------+------+-----+---------+----------------+<br>
    | Field  | Type                | Null | Key | Default | Extra          |<br>
    +--------+---------------------+------+-----+---------+----------------+<br>
    | id     | int(10) unsigned    | NO   | PRI | NULL    | auto_increment |<br>
    | name   | varchar(256)        | YES  |     | NULL    |                |<br>
    | sale   | int(10) unsigned    | YES  |     | NULL    |                |<br>
    | status | tinyint(3) unsigned | YES  |     | NULL    |                |<br>
    +--------+---------------------+------+-----+---------+----------------+

6. Table devices :<br>
    +-------------+------------------+------+-----+---------+-------+<br>
    | Field       | Type             | Null | Key | Default | Extra |<br>
    +-------------+------------------+------+-----+---------+-------+<br>
    | month       | varchar(5)       | YES  |     | NULL    |       |<br>
    | desktop     | int(10) unsigned | YES  |     | 0       |       |<br>
    | laptop      | int(10) unsigned | YES  |     | 0       |       |<br>
    | tablet      | int(10) unsigned | YES  |     | 0       |       |<br>
    | smart_phone | int(10) unsigned | YES  |     | 0       |       |<br>
    +-------------+------------------+------+-----+---------+-------+

7. Table jobs: <br>
    +-------------+---------------------+------+-----+---------+----------------+<br>
    | Field       | Type                | Null | Key | Default | Extra          |<br>
    +-------------+---------------------+------+-----+---------+----------------+<br>
    | id          | int(10) unsigned    | NO   | PRI | NULL    | auto_increment |<br>
    | title       | varchar(156)        | YES  |     | NULL    |                |<br>
    | type        | varchar(56)         | YES  |     | NULL    |                |<br>
    | pay         | int(10) unsigned    | YES  |     | NULL    |                |<br>
    | experience  | tinyint(3) unsigned | YES  |     | NULL    |                |<br>
    | location    | varchar(156)        | YES  |     | NULL    |                |<br>
    | status      | tinyint(3) unsigned | YES  |     | NULL    |                |<br>
    | description | text                | YES  |     | NULL    |                |<br>
    +-------------+---------------------+------+-----+---------+----------------+

8. Table orders:<br>
    +---------------+---------------------+------+-----+---------+----------------+<br>
    | Field         | Type                | Null | Key | Default | Extra          |<br>
    +---------------+---------------------+------+-----+---------+----------------+<br>
    | id            | int(10) unsigned    | NO   | PRI | NULL    | auto_increment |<br>
    | product_id    | int(10) unsigned    | YES  |     | NULL    |                |<br>
    | customer_name | varchar(156)        | YES  |     | NULL    |                |<br>
    | address       | varchar(600)        | YES  |     | NULL    |                |<br>
    | progress      | tinyint(3) unsigned | YES  |     | NULL    |                |<br>
    | status        | tinyint(3) unsigned | YES  |     | NULL    |                |<br>
    | price         | int(10) unsigned    | YES  |     | NULL    |                |<br>
    +---------------+---------------------+------+-----+---------+----------------+

9. Table products :<br>
    +--------------+---------------------+------+-----+---------+----------------+<br>
    | Field        | Type                | Null | Key | Default | Extra          |<br>
    +--------------+---------------------+------+-----+---------+----------------+<br>
    | id           | int(10) unsigned    | NO   | PRI | NULL    | auto_increment |<br>
    | product_name | varchar(256)        | YES  |     | NULL    |                |<br>
    | category_id  | int(10) unsigned    | YES  |     | NULL    |                |<br>
    | price        | int(10) unsigned    | YES  |     | NULL    |                |<br>
    | quantity     | int(10) unsigned    | YES  |     | NULL    |                |<br>
    | sale         | int(10) unsigned    | YES  |     | NULL    |                |<br>
    | status       | tinyint(3) unsigned | YES  |     | NULL    |                |<br>
    | image_1      | varchar(256)        | YES  |     | NULL    |                |<br>
    | image_2      | varchar(256)        | YES  |     | NULL    |                |<br>
    | image_3      | varchar(256)        | YES  |     | NULL    |                |<br>
    | image_4      | varchar(256)        | YES  |     | NULL    |                |<br>
    | image_5      | varchar(256)        | YES  |     | NULL    |                |<br>
    | image_6      | varchar(256)        | YES  |     | NULL    |                |<br>
    | gender       | tinyint(3) unsigned | YES  |     | NULL    |                |<br>
    | brand        | varchar(56)         | YES  |     | NULL    |                |<br>
    | meta_keys    | varchar(256)        | YES  |     | NULL    |                |<br>
    | meta_desc    | text                | YES  |     | NULL    |                |<br>
    | description  | text                | YES  |     | NULL    |                |<br>
    +--------------+---------------------+------+-----+---------+----------------+

10. Table visits_per_hour :<br>
    +--------+----------------------+------+-----+---------+-------+<br>
    | Field  | Type                 | Null | Key | Default | Extra |<br>
    +--------+----------------------+------+-----+---------+-------+<br>
    | hour   | smallint(5) unsigned | YES  |     | NULL    |       |<br>
    | visits | int(10) unsigned     | YES  |     | 0       |       |<br>
    +--------+----------------------+------+-----+---------+-------+
