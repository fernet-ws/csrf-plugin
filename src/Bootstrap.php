<?php

declare(strict_types=1);

namespace CsrfFernet;

use Fernet\Core\PluginBootstrap;
use Fernet\Framework;
use ParagonIE\AntiCSRF\AntiCSRF;

class Bootstrap extends PluginBootstrap
{
    public function setUp(Framework $framework): void
    {
        $antiServer = $_SERVER;
        // This is the only way to prevent path validation
        $antiServer['REQUEST_URI'] = '/';
        $antiCsrf = new AntiCSRF($_POST, $_SESSION, $antiServer);
        $framework->getContainer()->add(AntiCSRF::class, $antiCsrf);
        $this->addComponentNamespace(__DIR__);
    }
}
