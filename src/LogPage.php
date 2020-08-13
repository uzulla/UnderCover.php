<?php

declare(strict_types=1);

namespace UnderCover;

class LogPage
{
    public float $timeStampMicroSec;
    public string $stackTraceStr="";
    public array $stackTrace=[];
    /** @var mixed */
    public $key;
    /** @var mixed */
    public $value;

    public string $type;

    public function __construct($type, $key = null, $value = null)
    {
        $this->timeStampMicroSec = microtime(true);
        $this->stackTrace = debug_backtrace();
        foreach (debug_backtrace() as $line) {
            if(
                !isset($line['class']) ||
                $line['class'] === 'UnderCover\LogPage' ||
                $line['class'] === 'UnderCover\LogBook'
            ) continue;
            $this->stackTraceStr .= $line['file'] .":".
                $line['line'] . " " .
                $line['class'] ?? '-' . "::" .
                $line['function'];
            $this->stackTraceStr .="(";
            foreach($line['args'] as $arg){
                $this->stackTraceStr .= var_export($arg,true) . ",";
            }
            $this->stackTraceStr .=")";
            $this->stackTraceStr .= PHP_EOL;
        }
        $this->key = $key;
        $this->value = $value;
        $this->type = $type;
    }
}