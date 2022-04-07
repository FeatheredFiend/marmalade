<?php

namespace App\Controller;

use App\Repository\AgeRatingRepository;
use App\Repository\PostcodeRatingRepository;
use App\Repository\AbiCodeRepository;
use App\Form\QuotationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class QuotationController extends AbstractController
{
    public $basePremium;
    
    #[Route('/quotation', name: 'app_quotation')]
    public function getApi(ValidatorInterface $validator, Request $request, ManagerRegistry $doctrine, AgeRatingRepository $ageratingRepository, PostcodeRatingRepository $postcoderatingRepository, AbiCodeRepository $abicodeRepository): Response
    { 
        $form = $this->createForm(QuotationType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $basePremium = 500;

            $age = $form->get('age')->getData();
            $postcode = $form->get('postcode')->getData();
            $vehicleReg = $form->get('vehicleregistration')->getData();

            $ageRating = $ageratingRepository->findByAge($age); 
            if ($ageRating == NULL) {
                $ageRating = 1;
            }

            $postcodeRating = $postcoderatingRepository->findByPostcode($postcode); 
            if ($postcodeRating == NULL) {
                $postcodeRating = 1;
            }

            //Mock API Call for getting ABI
            // $ch = curl_init();
            // curl_setopt($ch, CURLOPT_URL, 'www.someapi.com?param1=A&param2=B');
            // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json')); // Assuming you're requesting JSON
            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            
            // $response = curl_exec($ch);
            
            // // If using JSON...
            // $data = json_decode($response);

            $abiRating = $abicodeRepository->findByABI($postcode); 
            if ($abiRating == NULL) {
                $abiRating = 1;
            }

            $basePremium = $basePremium * $ageRating["rating_factor"];
            $basePremium = $basePremium * $postcodeRating["rating_factor"];
            $basePremium = $basePremium * $abiRating["rating_factor"];
 
            $data = [];
    
            $data[] = [
                'premium' => $basePremium,
                'vehicle registration' => $vehicleReg
            ];

            return $this->json($data);

        }

        return $this->render('quotation/index.html.twig',['form' => $form->createView()]);
    }
}
