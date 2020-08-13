<?php

declare(strict_types=1);

namespace UnderCover;

class LogBook
{
    public array $logPages=[];
    public float $spawnTimeStampMicroSec;
    public string $spawnStackTrace= "";

    public function push($type, $key=null, $val=null){
        $this->logPages[] = new LogPage(
            $type,
            $key,
            $val
        );
        $this->spawnTimeStampMicroSec = microtime(true);
        foreach (debug_backtrace() as $line) {
            $this->spawnStackTrace .= $line['file'] .
                $line['line'] .
                ($line['class'] ?? '-') .
                $line['function'] ;
            foreach($line['args'] as $arg){
                $this->spawnStackTrace .= $arg;
            }
        }
    }

    public function dumpStr(){
        $str = "";
        foreach($this->logPages as $page){
            $str.= $page->stackTraceStr;
        }
        return $str;
    }
}