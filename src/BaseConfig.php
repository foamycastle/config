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
    protected string $tempPath;
    private array $config;
    protected $configFile;
    protected function __construct(string $name)
    {
        $this->tempPath = sys_get_temp_dir().DIRECTORY_SEPARATOR.$name;
        if(!file_exists($this->tempPath)){
            touch($this->tempPath);
            $this->config=[];
        }else{
            $this->config = json_decode(file_get_contents($this->tempPath), true);
        }
    }
    public function __destruct()
    {
        try {
            $this->configFile = @fopen($this->tempPath, 'w');
            @fwrite($this->configFile, json_encode($this->config));
            @fclose($this->configFile);
        }catch (\Exception|\Error $e){
            fputs(STDERR, $e->getMessage());
        }
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

    abstract static function fromConfigFile(string $path):static;
}