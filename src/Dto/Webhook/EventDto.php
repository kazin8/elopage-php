<?php

namespace Kazin8\Elopage\Dto\Webhook;

class EventDto extends BaseDto
{
    protected $id;
    protected $name;
    protected $price;
    protected $locationShort;
    protected $locationLong;
    protected $currentCode;
    protected $codePrefix;
    protected $date;
    protected $dateId;

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     *
     * @return self
     */
    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     *
     * @return self
     */
    public function setPrice($price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLocationShort()
    {
        return $this->locationShort;
    }

    /**
     * @param mixed $locationShort
     *
     * @return self
     */
    public function setLocationShort($locationShort): self
    {
        $this->locationShort = $locationShort;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLocationLong()
    {
        return $this->locationLong;
    }

    /**
     * @param mixed $locationLong
     *
     * @return self
     */
    public function setLocationLong($locationLong): self
    {
        $this->locationLong = $locationLong;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCurrentCode()
    {
        return $this->currentCode;
    }

    /**
     * @param mixed $currentCode
     *
     * @return self
     */
    public function setCurrentCode($currentCode): self
    {
        $this->currentCode = $currentCode;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCodePrefix()
    {
        return $this->codePrefix;
    }

    /**
     * @param mixed $codePrefix
     *
     * @return self
     */
    public function setCodePrefix($codePrefix): self
    {
        $this->codePrefix = $codePrefix;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     *
     * @return self
     */
    public function setDate($date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateId()
    {
        return $this->dateId;
    }

    /**
     * @param mixed $dateId
     *
     * @return self
     */
    public function setDateId($dateId): self
    {
        $this->dateId = $dateId;

        return $this;
    }

}