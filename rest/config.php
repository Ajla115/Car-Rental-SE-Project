<?php
<<<<<<< HEAD


define("EMAIL", "ajla.korman@stu.ibu.edu.ba");
define("PASSWORD", "amvu4B");
define("EMAIL2", "korman.ajla115@gmail.com");
=======
//AJLINA KONFIGURACIJA
/*
>>>>>>> d6ba5fb11244fb95de8b65d767e56ed0fdd1aac8
class Config
{
    // $host = 'localhost' might not work, use '127.0.0.1' if that is the case

    // public static $host = '127.0.0.1';
    // public static $schema = 'rentacar';
    // public static $username = 'root';
    // public static $password = 'a1b2c3d4e5';
    // public static $port = '3306';



    //This part below will be used when deploying the whole project with digital ocean
   public static function DB_HOST(){
        return Config::get_env("DB_HOST", "127.0.0.1");
    }

    public static function DB_USERNAME(){
        return Config::get_env("DB_USERNAME", "root");
    }

    public static function DB_PASSWORD(){
        return Config::get_env("DB_PASSWORD", "a1b2c3d4e5");
    }

    public static function DB_SCHEME(){
        return Config::get_env("DB_SCHEME", "rentacar");
    }

    public static function DB_PORT(){
        return Config::get_env("DB_PORT", "3306");
    }
    public static function JWT_SECRET(){
        return Config::get_env("JWT_SECRET", "web");
    }

    public static function get_env($name, $default){
        return isset($_ENV[$name]) && trim($_ENV[$name]) != ' ' ? $_ENV[$name] : $default;
    }

}
*/
//ILMINA KONFIGURACIJA
class Config
{
    //This part below will be used when deploying the whole project with digital ocean
   public static function DB_HOST(){
        return Config::get_env("DB_HOST", "localhost"); //127.0.0.1
    }

    public static function DB_USERNAME(){
        return Config::get_env("DB_USERNAME", "root");
    }

    public static function DB_PASSWORD(){
        return Config::get_env("DB_PASSWORD", "maliprinc");
    }

    public static function DB_SCHEME(){
        return Config::get_env("DB_SCHEME", "rentacar");
    }

    public static function DB_PORT(){
        return Config::get_env("DB_PORT", "3307");
    }
    public static function JWT_SECRET(){
        return Config::get_env("JWT_SECRET", "web");
    }

    public static function get_env($name, $default){
        return isset($_ENV[$name]) && trim($_ENV[$name]) != ' ' ? $_ENV[$name] : $default;
    }

}

?>
