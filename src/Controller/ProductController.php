<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/get_product_data', name: 'productData', methods: ['POST'])]
    public function productData(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        if (!isset($data['marketplace']) || !in_array($data['marketplace'],['ebay', 'amazon'])) {
            return $this->json(['error' => 'Correct marketplace id should be set'], Response::HTTP_BAD_REQUEST);
        }

        if (!isset($data['item_id']) || !is_numeric($data['item_id'])) {
            return $this->json(['error' => 'Item ID should be set and be numeric'], Response::HTTP_BAD_REQUEST);
        }



        return $this->json(
            [
                'data' => [
                    'id' => $data['item_id'],
                    'name' => 'name',
                    'price' => [
                        'amount' => 10,
                        'currency' => 'EUR',
                    ],
                ],
            ]
        );
    }
}
