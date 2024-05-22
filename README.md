# Native-Blog

Blog CMS build with Native PHP, SQL, HTML, CSS, JavaScript, and TinyMCE


## Installation

To run this cms, firstly you need to have `PHP version 8.3` and `MySql`

- Create new folder named "Native-Blog" and clone this repository
- Now open up `Database.php` and set according to your database
- Run this sql code

> CREATE TABLE `admin` (
>   `id` int(11) NOT NULL,
>   `username` varchar(16) NOT NULL,
>   `password` varchar(60) NOT NULL
> ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
> 
> INSERT INTO `admin` (`id`, `username`, `password`) VALUES
> (1, 'user', '$2y$10$Owvq7X2ELbUZAKrvhc9LJuxANygKrNijtRZClZnosM.1hClhZ3/tO');
> 
> CREATE TABLE `posts` (
>   `id` int(11) NOT NULL,
>   `admin_id` int(11) NOT NULL,
>   `title` varchar(255) NOT NULL,
>   `content` text NOT NULL,
>   `date` timestamp NULL DEFAULT current_timestamp()
> ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

- By default, you can run this cms and log on to admin page with password 'user'

Don't forget to change 'id' for table posts, and admin to auto increment

## Feature

1. Create Update Delete POST
2. Multiple Author or just One Author
3. Rich Text Editor for posts with TinyMCE


Thanks to [MalasNgoding](https://www.malasngoding.com/membuat-crud-dengan-oop-php-dan-mysql-part-2/), and [ChatGPT](https://chatgpt.com/)