<?php

namespace App\Entity;

use App\Repository\EmpresasRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmpresasRepository::class)]
class Empresas
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'text', length: 100, name: 'nome_empresa')]
    private ?string $nomeEmpresa;

    #[ORM\Column(type: 'date', name: 'data')]
    private ?\DateTimeInterface $data;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nomeEmpresa;
    }

    public function setNome(?string $nome): self
    {
        $this->nomeEmpresa = $nome;
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
