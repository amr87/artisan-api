<?php

namespace App\Modules\users\Contracts;
 
interface AccessInterface {
    
public static function findByName($item);

public static function findByLabel($item);

}