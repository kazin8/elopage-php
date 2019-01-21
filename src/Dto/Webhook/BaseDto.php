<?php

namespace Kazin8\Elopage\Dto\Webhook;

class BaseDto
{
    public function __construct(array $data = [])
    {
        if ($data) {
            foreach ($data as $key => $value) {
                $method = "set{$this->snakeToCamel($key)}";
                if (method_exists($this, $method)) {
                    $this->$method($value);
                }
            }
        }
    }

    protected function snakeToCamel(string $string)
    {
        return lcfirst(str_replace('_', '', ucwords($string, '_')));
    }
}