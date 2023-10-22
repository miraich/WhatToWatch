<?php

namespace App\Enums;
enum StatusEnum: string
{
    case PENDING = 'pending';
    case ON_MODERATION = 'on moderation';
    case READY = 'ready';
}
