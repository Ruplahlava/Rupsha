#Rupsha

Opensource picture sharing tool for single user.

With Rupsha you can create your own place to share pictures with your friends, while all your data are under your controll.
Rupsha provides mobile friendly front end and administration, using Twitter Bootstrap, Dropzone.js and nanoGallery - each is  highly customizable.
Whole project is built using Codeigniter 3.

####Requirements:
- Your server
- PHP 5.4 (short tags) + GD
- SQL server (mysql is default)

####Installation:
- Download latest release
- Put all data in desired server folder.
- Edit files `/application/config/database.php` and `/application/config/config.php` - set connection to your db and `base_url` of your project.
- Run `/sql/install.sql` on your database.
- Create admin user in table `user`, password uses sha1 function to store data.
- Log in and have fun! `www.examplerupsha.com/admin`

#####Version
- 0.1.9 Download zip generator
- 0.1.8 Watermark enable/disable
- 0.1.7 Added datatables for album management
- 0.1.6 Added switchable mainpage, password protection. Codeigniter updated to 3.0.
- 0.0.5 Added sorting
- 0.0.4 New db version, visual upgrades
- 0.0.3 Added some settings for page, creating users, changing password.
- 0.0.2 First runnable version. Offers file uploading, and showing it in gallery.
- 0.0.1 Transfer from private Bitbucket to OS Github
