<?php

namespace Kazin8\Elopage\Dto;

class ResponseDto
{
    protected $data;
    protected $success = false;
    protected $error;

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     *
     * @return self
     */
    public function setData($data): self
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getSuccess()
    {
        return $this->success;
    }

    /**
     * @param mixed $success
     *
     * @return self
     */
    public function setSuccess($success): self
    {
        $this->success = $success;

        return $this;
    }

    /**
     * @return mixed
     *
     * @return ErrorDto|null
     */
    public function getError() : ?ErrorDto
    {
        return $this->error;
    }

    /**
     * @param mixed $error
     *
     * @return self
     */
    public function setError($error): self
    {
        if (is_array($error)) {
            $error = new ErrorDto($error);
        }

        if ($error instanceof ErrorDto) {
            $this->error = $error;
        }

        return $this;
    }


}