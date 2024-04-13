<?php

namespace App\Entity;

use App\Repository\SociosRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SociosRepository::class)]
class Socios
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\ManyToOne(targetEntity: "Empresas", inversedBy: "socios")]
    #[ORM\JoinColumn(name: "id_empresa", referencedColumnName: "id", onDelete: "CASCADE")]
    private $idEmpresa;

    #[ORM\Column(type: 'text', length: 100, name: 'nome_socio')]
    private ?string $nomeSocio;

    #[ORM\Column(type: 'date', name: 'data')]
    private ?\DateTimeInterface $data;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getIdEmpresa() 
    {
        return $this->idEmpresa;
    }

    public function setIdEmpresa($idEmpresa): self
    {
        $this->idEmpresa = $idEmpresa;

        return $this;
    }

    public function getNomeSocio(): ?string
    {
        return $this->nomeSocio;
    }

    public function setNomeSocio(?string $nomeSocio): self
    {
        $this->nomeSocio = $nomeSocio;

        return $this;
    }

    public function getData(): ?\DateTimeInterface
    {
        return $this->data;
    }

    public function setData(?\DateTimeInterface $data): self
    {
        $this->data = $data;

        return $this;
    }
}
