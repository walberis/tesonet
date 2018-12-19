<?php

namespace  App\Helpers;

use Carbon\Carbon;
use DateTimeInterface;
use DateTime;
class IssueHelper
{
    public static function getTimeDiff($createdAt)
    {
        $DateTimeNow = Carbon::now();

        $from = Carbon::createFromFormat(DateTime::ISO8601, $createdAt);

        return $from->diffForHumans($DateTimeNow, null, false);

    }
}