<?php

namespace App\Service;

use App\Entity\Profil;
use App\Entity\ProfilValue;
use App\Entity\Project;
use App\Repository\CriteryRepository;
use App\Repository\KlasRepository;
use App\Repository\ProfilRepository;
use App\Repository\ProfilValueRepository;
use App\Repository\ProjectRepository;
use App\Repository\UserRepository;
use App\Repository\VariantRepository;
use App\Repository\VariantValueRepository;
use Doctrine\Common\Collections\ArrayCollection;

class KlasService
{

    private $projectRepository;
    private $klasRepository;
    private $profilRepository;
    private $profilValueRepository;

    public function __construct(ProjectRepository      $projectRepository,
                                KlasRepository         $klasRepository,
                                ProfilRepository       $profilRepository,
                                ProfilValueRepository  $profilValueRepository)
    {
        $this->projectRepository = $projectRepository;
        $this->klasRepository = $klasRepository;
        $this->profilRepository = $profilRepository;
        $this->profilValueRepository = $profilValueRepository;
    }

    public function updateKlas(Project $project,
                                       $klass)
    {

        foreach ($klass as $klas)
        {
            $klas->setProject($project);
            $this->klasRepository->save($klas, false);
            $project->addKlas($klas);
        }

        $now = new \DateTime();
        $project->setUpdateTime($now);
        $this->projectRepository->save($project, true);
    }

    public function addProfiles(Project $project,
                                        $klass)
    {

        $klassCounter = count($klass);
        $profilesCouter = count($project->getProfil());


        if ($profilesCouter < $klassCounter - 1)
        {

            for($i = 0; $i < $klassCounter - 1; $i++)
            {

                $profil = new Profil();
                $profil->setProject($project);
                $this->profilRepository->save($profil, false);
                $project->addProfil($profil);
            }

            $profiles = $project->getProfil();
            $criteries = $project->getCritery();

            $criteriesCounter = count($criteries);
            $profilesCouter = count($profiles);

            foreach ($criteries as $critery)
            {

                if (count($critery->getProfilValue()) < $profilesCouter){

                    foreach ($profiles as $profil)
                    {

                        if (count($profil->getProfilValue()) < $criteriesCounter)
                        {

                            $profilValue = new ProfilValue();
                            $profilValue->setCritery($critery);
                            $profilValue->setProfil($profil);
                            $this->profilValueRepository->save($profilValue, false);

                            $critery->addProfilValue($profilValue);
                            $profil->addProfilValue($profilValue);
                        }
                    }
                }
            }
        }

        $now = new \DateTime();
        $project->setUpdateTime($now);
        $this->projectRepository->save($project, true);
    }

    public function updateProfilesValues(Project $project,
                                         ArrayCollection $profilesValues)
    {
        foreach ($profilesValues as $profilValue)
        {

            $this->profilValueRepository->save($profilValue, false);
        }

        $now = new \DateTime();
        $project->setUpdateTime($now);
        $this->projectRepository->save($project, true);
    }
}