<?php
/**
 * Created by PhpStorm.
 * User: toque
 * Date: 06/05/2018
 * Time: 19:19
 */

namespace BGKT\CoreBundle\Enum;


abstract class ClasseEnum
{
    const CLASSE_L3 = "L3  Classique";
    const CLASSE_L3_APP = "L3 Apprentissage";
    const CLASSE_M1 = "M1  Classique";
    const CLASSE_M1_APP = "M1  Apprentissage";
    const CLASSE_M2 = "M2  Classique";
    const CLASSE_M2_APP = "M2  Apprentissage";

    protected static $classeName = [
        self::CLASSE_L3 => "L3  Classique",
        self::CLASSE_L3_APP => "L3  Apprentissage",
        self::CLASSE_M1 => "M1  Classique",
        self::CLASSE_M1_APP => "M1  Apprentissage",
        self::CLASSE_M2 => "M2  Classique",
        self::CLASSE_M2_APP => "M2  Apprentissage"
    ];

    /**
     * @param $promo
     * @return mixed|string
     */
    public static function getClasseName($promo)
    {
        if (!isset(static::$classeName[$promo])) {
            return "Promotion inconnue (" . $promo . ")";
        }
        return static::$classeName[$promo];
    }

    public static function getAvailableClasses()
    {
        return [
            self::CLASSE_L3,
            self::CLASSE_L3_APP,
            self::CLASSE_M1,
            self::CLASSE_M1_APP,
            self::CLASSE_M2,
            self::CLASSE_M2_APP
        ];
    }

}