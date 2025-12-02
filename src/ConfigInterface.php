<?php
/*
 *  Author: Aaron Sollman
 *  Email:  unclepong@gmail.com
 *  Date:   12/02/25
 *  Time:   9:46
*/


namespace Foamycastle\Config;

interface ConfigInterface
{
    function set($key, $value):static;
    function get($key):mixed;
}