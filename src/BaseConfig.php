<?php
/*
 *  Author: Aaron Sollman
 *  Email:  unclepong@gmail.com
 *  Date:   12/02/25
 *  Time:   9:45
*/


namespace Foamycastle\Config;

abstract class BaseConfig
{
    public const NAME = 'config';
    private array $config;
    private string $name;
    protected function __construct(string $name)
    {
        $this->name = $name;
        $this->config = [];
    }

    protected function set($key, $value): static
    {
        $this->config[$key] = $value;
        return $this;
    }

    protected function get($key): mixed
    {
        return ($this->config[$key] ?? null);
    }
    public function getName(): string
    {
        return $this->name;
    }

    static function fromConfigFile(string $path): static
    {
        if(!file_exists($path)){
            return new static(static::NAME);
        }
        $configFunction=\Closure::fromCallable(include($path));
        $config=new static(static::NAME);
        $configFunction($config);
        return $config;
    }
    abstract public static function fromArray(array $path):static;
}