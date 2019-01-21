<?php

namespace Kazin8\Elopage\Dto\Webhook;

use Kazin8\Elopage\Dto\AbstractDto;

class PricingPlanDto extends AbstractDto
{
    protected $name;

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

}