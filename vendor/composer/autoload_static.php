<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8d1dda2585246dc8ea0900146eec52b6
{
    public static $prefixLengthsPsr4 = array (
        'K' => 
        array (
            'Kazin8\\Elopage\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Kazin8\\Elopage\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit8d1dda2585246dc8ea0900146eec52b6::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8d1dda2585246dc8ea0900146eec52b6::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}