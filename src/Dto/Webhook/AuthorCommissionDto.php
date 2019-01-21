<?php

namespace Kazin8\Elopage\Dto\Webhook;

use Kazin8\Elopage\Dto\AbstractDto;

class AuthorCommissionDto extends AbstractDto
{
    protected $id;
    protected $rate;
    protected $amount;
    protected $paymentId;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return self
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * @param mixed $rate
     *
     * @return self
     */
    public function setRate($rate): self
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     *
     * @return self
     */
    public function setAmount($amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPaymentId()
    {
        return $this->paymentId;
    }

    /**
     * @param mixed $paymentId
     *
     * @return self
     */
    public function setPaymentId($paymentId): self
    {
        $this->paymentId = $paymentId;

        return $this;
    }



}