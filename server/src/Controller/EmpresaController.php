<?php

namespace App\Controller;

use App\Entity\Empresas;
use App\Entity\Socios;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class EmpresaController extends AbstractController
{
    /**
     * @Route("/cadastrar-empresas", name="empresa_create", methods={"POST"})
     */
    public function create(Request $request, EntityManagerInterface $entityManager)
    {
        $requestData = json_decode($request->getContent(), true);

        if (!isset($requestData['nome_empresa'])) {
            return new Response('O campo "nome_empresa" é obrigatório.', Response::HTTP_BAD_REQUEST);
        }

        $nomeEmpresa = $requestData['nome_empresa'];
        $data = new \DateTime();

        $empresa = new Empresas();
        $empresa->setNome($nomeEmpresa); 
        $empresa->setData($data);

        $entityManager->persist($empresa);

        $entityManager->flush();

        $responseData = [
            'status' => 'success',
            'message' => 'Empresa criada com sucesso',
            'empresa_id' => $empresa->getId(),
            'empresa' => $empresa->getNome()
        ];

        return new Response(json_encode($responseData), Response::HTTP_CREATED, ['Content-Type' => 'application/json']);
    }
   
    /**
     * @Route("/listar-empresas", name="empresa_read", methods={"GET"})
     */
    public function read(EntityManagerInterface $entityManager)
    {
        $empresasRepository = $entityManager->getRepository(Empresas::class);
        $empresas = $empresasRepository->findAll();

        $responseData = [];

        foreach ($empresas as $empresa) {
            $responseData[] = [
                'empresa_id' => $empresa->getId(),
                'nome_empresa' => $empresa->getNome(),
                'data_criacao' => $empresa->getData()->format('Y-m-d H:i:s')
            ];
        }

        return new Response(json_encode($responseData), Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    /**
     * @Route("/atualizar-empresa/{id}", name="empresa_update", methods={"PUT"})
     */
    public function update(Request $request, EntityManagerInterface $entityManager, $id)
    {
        $empresa = $entityManager->getRepository(Empresas::class)->find($id);

        if (!$empresa) {
            return new Response('Empresa não encontrada.', Response::HTTP_NOT_FOUND);
        }

        $requestData = json_decode($request->getContent(), true);

        if (!isset($requestData['nome_empresa'])) {
            return new Response('O campo "nome_empresa" é obrigatório.', Response::HTTP_BAD_REQUEST);
        }

        $nomeEmpresa = $requestData['nome_empresa'];

        $empresa->setNome($nomeEmpresa);

        $entityManager->flush();

        $responseData = [
            'status' => 'success',
            'message' => 'Empresa atualizada com sucesso',
            'empresa_id' => $empresa->getId(),
            'empresa' => $empresa->getNome()
        ];

        return new Response(json_encode($responseData), Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    /**
     * @Route("/deletar-empresa/{id}", name="empresa_delete", methods={"DELETE"})
     */
    public function delete(EntityManagerInterface $entityManager, $id)
    {
        $empresa = $entityManager->getRepository(Empresas::class)->find($id);

        if (!$empresa) {
            return new Response('Empresa não encontrada.', Response::HTTP_NOT_FOUND);
        }

        $sociosRepository = $entityManager->getRepository(Socios::class);
        $socios = $sociosRepository->findBy(['idEmpresa' => $id]);

        foreach ($socios as $socio) {
            $entityManager->remove($socio);
        }

        $entityManager->remove($empresa);
        $entityManager->flush();

        $responseData = [
            'status' => 'success',
            'message' => 'Empresa excluída com sucesso'
        ];

        return new Response(json_encode($responseData), Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }
}