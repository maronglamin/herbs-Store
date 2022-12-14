<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7a322a72bc920151c03081e690dcc1bb
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Stripe\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Stripe\\' => 
        array (
            0 => __DIR__ . '/..' . '/stripe/stripe-php/lib',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7a322a72bc920151c03081e690dcc1bb::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7a322a72bc920151c03081e690dcc1bb::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit7a322a72bc920151c03081e690dcc1bb::$classMap;

        }, null, ClassLoader::class);
    }
}
