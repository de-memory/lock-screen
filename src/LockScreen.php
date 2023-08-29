<?php

namespace DeMemory\LockScreen;

use Dcat\Admin\Form\Field;

class LockScreen extends Field
{
    const LOCK_KEY = 'de-memory.lock-screen.lock';

    public static function link(): string
    {
        $url = admin_route(self::LOCK_KEY);

        return <<<HTML
<ul class="nav navbar-nav float-right">
    <li class=" nav-item">
        <a class="dropdown-toggle nav-link" href="$url">
                <i class="fa fa-lock fa-lg"></i>
        </a>
    </li>
</ul>

HTML;

    }
}
