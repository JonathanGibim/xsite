<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1498029d1d1284e90a32b0de685f805c
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit1498029d1d1284e90a32b0de685f805c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1498029d1d1284e90a32b0de685f805c::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit1498029d1d1284e90a32b0de685f805c::$classMap;

        }, null, ClassLoader::class);
    }
}
