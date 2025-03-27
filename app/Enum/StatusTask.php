<?php

namespace App\Enum;

enum StatusTask :string
{
    case DONE='done';
    case PROGRESS='progress';
    case TODO='todo';
}
