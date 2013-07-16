<?php

namespace Ps\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class PsUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
