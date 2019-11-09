<?php

class test_asserttrue
{
    public static function assertTrue($var1)
    {
        if($var1){
            return 'true';
        } else {
            return 'false';
        }
    }
}
