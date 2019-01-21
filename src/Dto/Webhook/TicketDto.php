<?php

namespace Kazin8\Elopage\Dto\Webhook;

use Kazin8\Elopage\Dto\AbstractDto;

class TicketDto extends AbstractDto
{
    protected $count;
    protected $codes = [];

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->setCodes($data['codes']);
    }

    /**
     * @return mixed
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param mixed $count
     *
     * @return self
     */
    public function setCount($count): self
    {
        $this->count = $count;

        return $this;
    }

    /**
     * @return array
     */
    public function getCodes(): array
    {
        return $this->codes;
    }

    /**
     * @param array $codes
     *
     * @return self
     */
    public function setCodes(array $codes): self
    {
        $this->codes = $codes;

        return $this;
    }



}