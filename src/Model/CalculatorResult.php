<?php

namespace App\Model;

use OpenApi\Annotations as OA;

class CalculatorResult
{
    /*
     * @OA\Property(type="float", description="The calculated result")
     */
    private float $result;

    public function __construct(float $result)
    {
        $this->result = $result;
    }

    public function getResult(): float
    {
        return $this->result;
    }

    public function toArray(): array
    {
        return [
            'result' => $this->result,
        ];
    }
}
