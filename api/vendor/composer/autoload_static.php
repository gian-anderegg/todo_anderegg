<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit21f8b75694b2cbc4cf44d1ca611df153
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit21f8b75694b2cbc4cf44d1ca611df153::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit21f8b75694b2cbc4cf44d1ca611df153::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit21f8b75694b2cbc4cf44d1ca611df153::$classMap;

        }, null, ClassLoader::class);
    }
}
