<?php

namespace  App\Helpers;

use Carbon\Carbon;
use DateTimeInterface;

class IssueHelper
{
    public static function getTimeDiff($issue = null)
    {
        if(!$issue){
            return;
        }
        $DateTimeNow = Carbon::now();

        $from = Carbon::createFromFormat(DateTimeInterface::ISO8601, $issue->created_at);

        return $from->diffForHumans($DateTimeNow, null, false);

    }
}