<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit402b38cbad3b1a6496f261b6189e3694
{
    public static $files = array (
        '6e3fae29631ef280660b3cdad06f25a8' => __DIR__ . '/..' . '/symfony/deprecation-contracts/function.php',
    );

    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Tnaw\\Site\\' => 10,
        ),
        'P' => 
        array (
            'Psr\\Container\\' => 14,
        ),
        'F' => 
        array (
            'Faker\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Tnaw\\Site\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'Psr\\Container\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/container/src',
        ),
        'Faker\\' => 
        array (
            0 => __DIR__ . '/..' . '/fakerphp/faker/src/Faker',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit402b38cbad3b1a6496f261b6189e3694::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit402b38cbad3b1a6496f261b6189e3694::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit402b38cbad3b1a6496f261b6189e3694::$classMap;

        }, null, ClassLoader::class);
    }
}