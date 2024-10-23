<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1166520fa8c910b88425dd44fb2a7325
{
    public static $prefixLengthsPsr4 = array (
        'H' => 
        array (
            'Hammadj\\HelpIcons\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Hammadj\\HelpIcons\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit1166520fa8c910b88425dd44fb2a7325::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1166520fa8c910b88425dd44fb2a7325::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit1166520fa8c910b88425dd44fb2a7325::$classMap;

        }, null, ClassLoader::class);
    }
}
