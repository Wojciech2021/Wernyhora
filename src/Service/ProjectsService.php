<?php

namespace App\Service;

use App\Entity\Critery;
use App\Entity\Project;
use App\Entity\User;
use App\Entity\VariantValue;
use App\Repository\CriteryRepository;
use App\Repository\KlasNameRepository;
use App\Repository\ProjectRepository;
use App\Repository\UserRepository;
use App\Repository\VariantRepository;
use App\Repository\VariantValueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManagerInterface;

class ProjectsService
{

    private $userRepository;
    private $projectRepository;
    private $criteryRepository;
    private $variantRepository;
    private $variantValueRepository;
    private $klasNameRepository;
    private $user;

    public function __construct(UserRepository $userRepository,
                                ProjectRepository $projectRepository,
                                CriteryRepository $criteryRepository,
                                VariantRepository $variantRepository,
                                VariantValueRepository $variantValueRepository,
                                KlasNameRepository $klasNameRepository)
    {
        $this->userRepository = $userRepository;
        $this->projectRepository = $projectRepository;
        $this->criteryRepository =$criteryRepository;
        $this->variantRepository = $variantRepository;
        $this->variantValueRepository = $variantValueRepository;
        $this->klasNameRepository = $klasNameRepository;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }

    public function addNewProject(Project $project)
    {
        $now = new \DateTime();
        $project->setUser($this->user);
        $project->setCreationTime($now);
        $project->setUpdateTime($now);
        $this->projectRepository->save($project, true);
    }

    public function gettAllProjects()
    {
        if ($this->user)
        {
            $projectsArray = $this->user->getProjects();

            return $projectsArray;
        }
        else
        {
            return null;
        }
    }

    public function getProject(int $id)
    {
        return $this->projectRepository->find($id);
    }

//    public function updateProject(Project $project,
//                                  $criteries,
//                                  $variants,
//                                  $variantsValues)
//    {
//        //dd($criteries, $variants, $variantsValues);
//        foreach ($criteries as $keyCritery => $critery)
//        {
//
//
//            foreach ($variants as $variant)
//            {
//
//
//                foreach ($variantsValues as $variantValue)
//                {
//
//                    if (!$variantValue->getVariant() &&  !$variantValue->getCritery())
//                    {
//                        $index = strval(array_search($variantValue, $variantsValues));
//                        $variantValue->setCritery($criteries->get($index[0]-1));
//                        $variantValue->setVariant($variants->get($index[1]-1));
//                        $this->variantValueRepository->save($variantValue, false);
//
//                        $variants->get($index[1]-1)->addVariantValue($variantValue);
//                        $criteries->get($index[0]-1)->addVariantValue($variantValue);
//                    }
//
//                    $this->variantValueRepository->save($variantValue, false);
//                    $variant->setProject($project);
//                    $this->variantRepository->save($variant, false);
//                }
//
//
//
//                $project->addVariant($variant);
//
//            }
//
//            $critery->setProject($project);
//            $this->criteryRepository->save($critery, false);
//            $project->addCritery($critery);
//        }
//
//        $now = new \DateTime();
//        $project->setUpdateTime($now);
//        $this->projectRepository->save($project, true);
//    }

    public function updateCriteriesVariants(Project $project,
                                            $criteries,
                                            $variants)
    {
        //$variantValuesCounterNew = count($criteries) * count($variants);
        $criteriesCounter = count($criteries);
        $variantsCouter = count($variants);
        //$varinatValuesCounter = 0;

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
            //$varinatValuesCounter += count($variant->getVariantValue());
        }

        foreach ($criteries as $critery)
        {
            $critery->setProject($project);
            $this->criteryRepository->save($critery, false);
            $project->addCritery($critery);
        }
        //dd($variantValuesCounterNew, $varinatValuesCounter);
        //$variantValuesCounterNew -= $varinatValuesCounter;




//        for ($i = 0; $i < $variantValuesCounterNew; $i++)
//        {
//            $variantValue = new VariantValue();
//            $this->variantValueRepository->save($variantValue, false);
//            foreach ($criteries as $critery)
//            {
//                $variantValue->setCritery($critery);
//                $critery->addVariantValue($variantValue);
//            }
//
//            foreach ($variants as $variant)
//            {
//                $variantValue->setVariant($variant);
//                $variant->addVariantValue($variantValue);
//            }
//        }

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

    public function updateKlasNames(Project $project,
                                    $klasNames)
    {
        dd($project, $klasNames);
        foreach ($klasNames as $klasName)
        {
            $klasName->setProject($project);
            $this->klasNameRepository->save($klasName, false);
            $project->addKlasName($klasName);
        }

        $now = new \DateTime();
        $project->setUpdateTime($now);
        $this->projectRepository->save($project, true);
    }



    public function changeToArrayCollection($collection)
    {
        $arrayCollection =  new ArrayCollection();

        foreach ($collection as $item)
        {
            $arrayCollection->add($item);
        }

        return $arrayCollection;
    }

    public function deleteProject(Project $project)
    {
        $this->user->removeProject($project);
        $this->userRepository->save($this->user, true);
    }
}