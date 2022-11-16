<?php

namespace App\Service;

use App\Entity\Project;
use App\Entity\VariantValue;
use App\Repository\CriteryRepository;
use App\Repository\ProjectRepository;
use App\Repository\VariantRepository;
use App\Repository\VariantValueRepository;
use Doctrine\Common\Collections\ArrayCollection;

class CriteryVariantService
{

    private $criteryRepository;
    private $variantRepository;
    private $variantValueRepository;

    public function __construct(ProjectRepository      $projectRepository,
                                CriteryRepository      $criteryRepository,
                                VariantRepository      $variantRepository,
                                VariantValueRepository $variantValueRepository,)
    {

        $this->projectRepository = $projectRepository;
        $this->criteryRepository =$criteryRepository;
        $this->variantRepository = $variantRepository;
        $this->variantValueRepository = $variantValueRepository;
    }

    public function updateCriteriesVariants(Project $project,
                                                    $criteries,
                                                    $variants)
    {

        $criteriesCounter = count($criteries);
        $variantsCouter = count($variants);

        foreach ($criteries as $critery)
        {

            if (count($critery->getVariantValue()) < $variantsCouter){

                foreach ($variants as $variant)
                {

                    if (count($variant->getVariantValue()) < $criteriesCounter)
                    {

                        $variantValue = new VariantValue();
                        $variantValue->setCritery($critery);
                        $variantValue->setVariant($variant);
                        $this->variantValueRepository->save($variantValue, false);

                        $critery->addVariantValue($variantValue);
                        $variant->addVariantValue($variantValue);
                    }
                }

            }
        }

        foreach ($variants as $variant)
        {

            $variant->setProject($project);
            $this->variantRepository->save($variant, false);
            $project->addVariant($variant);
        }

        foreach ($criteries as $critery)
        {

            $critery->setProject($project);
            $this->criteryRepository->save($critery, false);
            $project->addCritery($critery);
        }

        $now = new \DateTime();
        $project->setUpdateTime($now);
        $this->projectRepository->save($project, true);
    }

    public function updateVariantsValues(Project $project,
                                         ArrayCollection $variantsValues)
    {

        foreach ($variantsValues as $variantValue)
        {

            $this->variantValueRepository->save($variantValue, false);
        }

        $now = new \DateTime();
        $project->setUpdateTime($now);
        $this->projectRepository->save($project, true);
    }
}