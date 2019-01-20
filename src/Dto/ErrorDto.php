<?php

namespace Kazin8\Elopage\Dto;

class ErrorDto
{
    protected $message;
    protected $code;
    protected $httpCode;

    public function __construct(array $params)
    {
        $has = get_object_vars($this);
        foreach ($has as $key => $value) {
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method(isset($params[$key]) ? $params[$key] : null);
            }
        }
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     *
     * @return self
     */
    public function setMessage($message): self
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     *
     * @return self
     */
    public function setCode($code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getHttpCode()
    {
        return $this->httpCode;
    }

    /**
     * @param mixed $httpCode
     *
     * @return self
     */
    public function setHttpCode($httpCode): self
    {
        $this->httpCode = $httpCode;

        return $this;
    }


}