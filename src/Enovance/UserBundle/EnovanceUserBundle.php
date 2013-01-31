<?php

namespace Enovance\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class EnovanceUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
