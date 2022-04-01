<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0c7b23ee4c7d4c7def085a0c97f27591
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Statickidz\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Statickidz\\' => 
        array (
            0 => __DIR__ . '/..' . '/statickidz/php-google-translate-free/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit0c7b23ee4c7d4c7def085a0c97f27591::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0c7b23ee4c7d4c7def085a0c97f27591::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}