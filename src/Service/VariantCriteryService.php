<?php

namespace App\Service;

class VariantCriteryService
{
    public function filterVariantCritery($collection, array $array)
    {
        $collection = $collection->filter(function ($element) use ($array) {
            foreach ($array as $item)
            {
                if ($element->getId() == $item->getId())
                {
                    return $element;
                }
            }
        });

        return $collection;
    }
}