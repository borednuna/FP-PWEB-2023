<?php

namespace App\Repositories;

class BulanEnum
{
    const JANUARI = 1;
    const FEBRUARI = 2;
    const MARET = 3;
    const APRIL = 4;
    const MEI = 5;
    const JUNI = 6;
    const JULI = 7;
    const AGUSTUS = 8;
    const SEPTEMBER = 9;
    const OKTOBER = 10;
    const NOVEMBER = 11;
    const DESEMBER = 12;

    public static function getConstantByMonthName(string $namaBulan)
    {
        $namaBulan = strtoupper($namaBulan);

        switch ($namaBulan) {
            case 'JANUARI':
                return self::JANUARI;
            case 'FEBRUARI':
                return self::FEBRUARI;
            case 'MARET':
                return self::MARET;
            case 'APRIL':
                return self::APRIL;
            case 'MEI':
                return self::MEI;
            case 'JUNI':
                return self::JUNI;
            case 'JULI':
                return self::JULI;
            case 'AGUSTUS':
                return self::AGUSTUS;
            case 'SEPTEMBER':
                return self::SEPTEMBER;
            case 'OKTOBER':
                return self::OKTOBER;
            case 'NOVEMBER':
                return self::NOVEMBER;
            case 'DESEMBER':
                return self::DESEMBER;
            default:
                return null;
        }
    }

    public static function getBulan(int $bulan)
    {
        switch ($bulan) {
            case self::JANUARI:
                return 'januari';
            case self::FEBRUARI:
                return 'februari';
            case self::MARET:
                return 'maret';
            case self::APRIL:
                return 'april';
            case self::MEI:
                return 'mei';
            case self::JUNI:
                return 'juni';
            case self::JULI:
                return 'juli';
            case self::AGUSTUS:
                return 'agustus';
            case self::SEPTEMBER:
                return 'september';
            case self::OKTOBER:
                return 'oktober';
            case self::NOVEMBER:
                return 'november';
            case self::DESEMBER:
                return 'desember';
            default:
                return null;
        }
    }
}
