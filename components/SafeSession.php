<?php

namespace app\components;

use yii\web\Session;


class SafeSession extends Session
{
    public function regenerateID($deleteOldSession = false)
    {
        if (interface_exists('\Throwable')) {
            try {
                session_regenerate_id($deleteOldSession);
            } catch (\Throwable $t) { /* Check error content here */ }
        } else {
            @session_regenerate_id($deleteOldSession);
        }
    }
}