<?php

namespace App\Service;

use App\Entity\ComputerLog;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;

class ComputerLogContainer
{

    private ArrayCollection $computerLogList;

    public function __construct()
    {
        $this->computerLogList = new ArrayCollection();
    }

    public function createComputerLogCollection( array $items)
    {
        //dd($items);

        foreach ($items['items'] as $item)
        {
            //dd($item);
            //$time = date_create();
            //date_timestamp_set($time, $item['created']);
            //dd($time);
            $time = DateTime::createFromFormat( 'U',$item['created']);
            $computer = $item['computer'];
            $domain = $item['domain'];
            $ip = $item['ip'];
            $mac = $item['mac'];
            $cpu = $item['cpu'];
            $ram = $item['ram'];
            $freq = $item['freq'];
            $gpu = $item['gpu'];
            $freq_val = $item['freq_val'];

            $computerLog = new ComputerLog();

            $computerLog->setTime($time);
            $computerLog->setComputer($computer);
            $computerLog->setDomain($domain);
            $computerLog->setIp($ip);
            $computerLog->setMac($mac);
            $computerLog->setCpu($cpu);
            $computerLog->setRam($ram);
            $computerLog->setFreq($freq);
            $computerLog->setGpu($gpu);
            $computerLog->setFreqVal($freq_val);
            $this->add($computerLog);
            //dd($computerLog);
        }
    }

    public function add (ComputerLog $computerLog)
    {
        $this->computerLogList->add($computerLog);
    }

    public function getItemList(): ArrayCollection
    {
        return $this->computerLogList;
    }

    public function getArrayOfElements()
    {

        if(!is_null($this->computerLogList))
        {
            $arrayOfElements = [];
            foreach ($this->computerLogList as $key=>$element)
            {
                $arrayOfElements['index'][] = $key;
                $arrayOfElements['date'][] = $element->getTime()->format('d H:i:s');
                $arrayOfElements['cpu'][] = $element->getCpu();
                $arrayOfElements['ram'][] = $element->getRam();
                $arrayOfElements['freq'][] = $element->getFreq();
                $arrayOfElements['gpu'][] = $element->getGpu();
                $arrayOfElements['freq_val'][] = $element->getFreqVal();
            }

            return $arrayOfElements;
        }
        else
        {

            return null;
        }
    }
}