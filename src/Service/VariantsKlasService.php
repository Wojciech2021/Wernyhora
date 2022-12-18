<?php

namespace App\Service;

use App\Service\Model\variantKlas;
use Doctrine\Common\Collections\ArrayCollection;

class VariantsKlasService
{
    private $variantsKlas;
    private $variants;
    private $variantsProfilsCredibilityIndexRelation;
    private $klas;

    public function __construct($variants, $variantsProfilsCredibilityIndexRelation, $klas)
    {
        $this->variantsKlas = new ArrayCollection();
        $this->variants = $variants;
        $this->variantsProfilsCredibilityIndexRelation = $variantsProfilsCredibilityIndexRelation;
        $this->klas = $klas;
    }

    /**
     * @return ArrayCollection
     */
    public function getVariantsKlas(): ArrayCollection
    {
        $this->assignVariantsKlas();
        return $this->variantsKlas;
    }

    private function assignVariantsKlas()
    {
        foreach ($this->variants as $variant)
        {
            $variantKlas = new variantKlas($variant);
            $this->assignVariantKlas($variantKlas);
            $this->variantsKlas->add($variantKlas);
        }
    }

    private function orderByProfilOrderASC(ArrayCollection $collection)
    {
        $iterator = $collection->getIterator();
        $arrayCollection = new ArrayCollection();

        $iterator->uasort(function ($first, $second)
        {
            return (int) $first->getProfil()->getProfilOrder() > (int) $second->getProfil()->getProfilOrder() ? 1 : -1;
        });

        $array = iterator_to_array($iterator);

        foreach ($array as $item)
        {
            $arrayCollection->add($item);
        }

        return $arrayCollection;
    }

    private function orderByProfilOrderDESC(ArrayCollection $collection)
    {
        $iterator = $collection->getIterator();
        $arrayCollection = new ArrayCollection();

        $iterator->uasort(function ($first, $second)
        {
            return (int) $first->getProfil()->getProfilOrder() > (int) $second->getProfil()->getProfilOrder() ? -1 : 1;
        });

        $array = iterator_to_array($iterator);

        foreach ($array as $item)
        {
            $arrayCollection->add($item);
        }

        return $arrayCollection;
    }

    private function orderByKlasOrderASC($collection)
    {
        $iterator = $collection->getIterator();
        $arrayCollection = new ArrayCollection();

        $iterator->uasort(function ($first, $second)
        {
            return (int) $first->getKlasOrder() > (int) $second->getKlasOrder() ? 1 : -1;
        });

        $array = iterator_to_array($iterator);

        foreach ($array as $item)
        {
            $arrayCollection->add($item);
        }

        return $arrayCollection;
    }

    private function assignVariantKlas(variantKlas $variantKlas)
    {
        $klas = $this->klas;
        $filteredVariantsProfilsCredibilityIndexRelation = $this->variantsProfilsCredibilityIndexRelation->filter(function ($element) use ($variantKlas)
        {
            return $element->getVariant() == $variantKlas->getVariant();
        });

        $orderedVariantsProfilsCredibilityIndexRelationASC = $this->orderByProfilOrderASC($filteredVariantsProfilsCredibilityIndexRelation);
        $orderedVariantsProfilsCredibilityIndexRelationDESC = $this->orderByProfilOrderDESC($filteredVariantsProfilsCredibilityIndexRelation);
        $klasASC = $this->orderByKlasOrderASC($klas);
        $profilCounter =  count($orderedVariantsProfilsCredibilityIndexRelationDESC);

        foreach ($orderedVariantsProfilsCredibilityIndexRelationASC as $key=>$variantProfilCredibilityIndexRelation)
        {
            if ($variantProfilCredibilityIndexRelation->getRelation() == '<')
            {
                $optimisticAssignedKlas = $klasASC[$key];
            }
            else
            {
                $optimisticAssignedKlas = $klasASC[$key+1];
            }
        }

        foreach ($orderedVariantsProfilsCredibilityIndexRelationDESC as $key=>$variantProfilCredibilityIndexRelation)
        {

            if ($variantProfilCredibilityIndexRelation->getRelation() == '>'
                || $variantProfilCredibilityIndexRelation->getRelation() == 'I')
            {
                $pessimisticAssignedKlas = $klasASC[$profilCounter - $key];
                break;
            }
            elseif ($variantProfilCredibilityIndexRelation->getRelation() == '<')
            {
                $pessimisticAssignedKlas = $klasASC[$key];
            }
            else
            {
                $pessimisticAssignedKlas = $klasASC[0];
            }
        }

        $variantKlas->setOptimisticAssignedKlas($optimisticAssignedKlas);
        $variantKlas->setPessimisticAssignedKlas($pessimisticAssignedKlas);
    }
}