<?php

namespace App\Controller;

use App\Entity\Socios;
use App\Entity\Empresas;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class SocioController extends AbstractController
{
    /**
     * @Route("/cadastrar-socios", name="socios_create", methods={"POST"})
     */
    public function create(Request $request, EntityManagerInterface $entityManager)
    {
        $requestData = json_decode($request->getContent(), true);

        if (!isset($requestData['nome_socio']) || !isset($requestData['id_empresa'])) {
            return new Response('O campo "nome_socio" e "id_empresa" são obrigatório.', Response::HTTP_BAD_REQUEST);
        }     

        $nomeSocio = $requestData['nome_socio'];
        $idEmpresa = $requestData['id_empresa'];
        $data = new \DateTime();

        $empresa = $entityManager->getRepository(Empresas::class)->find($idEmpresa);

        if (!$empresa) {
            return new Response('A empresa correspondente não foi encontrada.', Response::HTTP_BAD_REQUEST);
        }

        $socio = new Socios();

        $socio->setNomeSocio($nomeSocio); 
        $socio->setData($data);
        $socio->setIdEmpresa($empresa);

        $entityManager->persist($socio);
        $entityManager->flush();

        $responseData = [
            'socio_id' => $socio->getId(),
            'empresa_id' => $idEmpresa,
            'status' => 'success',
            'message' => 'Socio criado com sucesso'
        ];

        return new Response(json_encode($responseData), Response::HTTP_CREATED, ['Content-Type' => 'application/json']);
    }

    /**
     * @Route("/listar-socios/{id}", name="socios_read", methods={"GET"})
     */
    public function read(EntityManagerInterface $entityManager, $id)
    {
        $sociosRepository = $entityManager->getRepository(Socios::class);
        $socios = $sociosRepository->findBy(['idEmpresa' => $id]);

        $responseData = [];

        foreach ($socios as $socio) {
            $responseData[] = [
                'socio_id' => $socio->getId(),
                'id_empresa' => $socio->getIdEmpresa()->getId(), 
                'nome_socio' => $socio->getNomeSocio(), 
                'data_criacao' => $socio->getData()->format('Y-m-d H:i:s') 
            ];
        }

        return new Response(json_encode($responseData), Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    /**
     * @Route("/atualizar-socio/{id}", name="socios_update", methods={"PUT"})
     */
    public function update(Request $request, EntityManagerInterface $entityManager, $id)
    {
        $data = json_decode($request->getContent(), true);

        $sociosRepository = $entityManager->getRepository(Socios::class);
        $socio = $sociosRepository->find($id);

        if (!$socio) {
            return new Response(json_encode(['message' => 'Sócio não encontrado']), Response::HTTP_NOT_FOUND, ['Content-Type' => 'application/json']);
        }

        if (isset($data['nome_socio'])) {
            $socio->setNomeSocio($data['nome_socio']);
        }

        $entityManager->flush();

        return new Response(json_encode(['message' => 'Sócio atualizado com sucesso']), Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    /**
     * @Route("/deletar-socio/{id}", name="socios_delete", methods={"DELETE"})
     */
    public function delete(EntityManagerInterface $entityManager, $id)
    {
        $sociosRepository = $entityManager->getRepository(Socios::class);
        $socio = $sociosRepository->find($id);

        if (!$socio) {
            return new Response(json_encode(['message' => 'Sócio não encontrado']), Response::HTTP_NOT_FOUND, ['Content-Type' => 'application/json']);
        }

        $entityManager->remove($socio);
        $entityManager->flush();

        return new Response(json_encode(['message' => 'Sócio deletado com sucesso']), Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }
}
