<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9a26a0b441a8bb2f793d0b50eab4a6f4
{
    public static $prefixLengthsPsr4 = array (
        'G' => 
        array (
            'Grav\\Plugin\\EmailSubscribe\\' => 27,
        ),
        'D' => 
        array (
            'DrewM\\MailChimp\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Grav\\Plugin\\EmailSubscribe\\' => 
        array (
            0 => __DIR__ . '/../..' . '/classes',
        ),
        'DrewM\\MailChimp\\' => 
        array (
            0 => __DIR__ . '/..' . '/drewm/mailchimp-api/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit9a26a0b441a8bb2f793d0b50eab4a6f4::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9a26a0b441a8bb2f793d0b50eab4a6f4::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}