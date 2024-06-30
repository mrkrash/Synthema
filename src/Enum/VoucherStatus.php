<?php

declare(strict_types=1);

namespace App\Enum;

enum VoucherStatus: string
{
    case REQUIRED = 'required';
    case ELABORATION = 'elaboration';
    case READY = 'ready';
    case USED = 'used';
    case EXPIRED = 'expired';
}
