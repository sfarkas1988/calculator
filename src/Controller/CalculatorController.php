<?php

namespace App\Controller;

use App\Form\CalculatorType;
use App\Model\Calculator;
use App\Model\CalculatorResult;
use App\Service\CalculatorFactory;
use App\Service\FormErrors;
use Exception;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalculatorController extends AbstractController
{
    /**
     * @Route("/api/calculator", methods={"POST"})
     * @OA\RequestBody(
     *      description="Creates user and profile at the same time",
     *      @OA\JsonContent(
     *          @OA\Property(type="float", property="number1"),
     *          @OA\Property(type="float", property="number2"),
     *          @OA\Property(type="string", property="operator")
     *      )
     * )
     *
     * @OA\Response(
     *     response=200,
     *     description="Returns the result of a valid calculation",
     *     @OA\JsonContent(ref=@Model(type=CalculatorResult::class))
     * )
     *
     * @OA\Response(
     *     response=400,
     *     description="Array containg all error messages",
     * )
     * @OA\Response(
     *     response=500,
     *     description="Array containg a system messge",
     * )
     */
    public function index(FormErrors $formErrors, CalculatorFactory $calculatorFactory, Request $request): Response
    {
        try {
            $data = json_decode($request->getContent(), true);
            $calculator = new Calculator();
            $form = $this->createForm(CalculatorType::class, $calculator);
            $form->submit($data);

            if ($form->isValid()) {
                return $this->json($calculatorFactory->calculate($calculator)->toArray());
            }

            return $this->json(
                    ['validation_errors' => $formErrors->getErrorsFromForm($form)],
                    Response::HTTP_BAD_REQUEST
                );
        } catch (Exception $e) {
            return $this->json(
                ['message' => $e->getMessage()],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
