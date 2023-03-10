<?php

namespace Brightfish\DcpToolkit\Helpers;

class CplTime
{
    //   <IssueDate>2022-10-04T13:44:52.450+02:00</IssueDate>
    public static function now(): string
    {
        return date("Y-m-d\TH:i:s.vP");
    }

    public static function date(int $timestamp): string
    {
        return date("Y-m-d\TH:i:s.vP", $timestamp);
    }

    public static function format(string $date_text): string
    {
        return date("Y-m-d\TH:i:s.vP", strtotime($date_text));
    }
}
