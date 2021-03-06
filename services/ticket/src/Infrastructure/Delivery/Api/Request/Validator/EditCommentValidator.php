<?php
declare(strict_types=1);

namespace Ticket\Infrastructure\Delivery\Api\Request\Validator;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;

class EditCommentValidator extends Validator
{
    protected function validate(Request $request): void
    {
        $data = $request->request->all();
        $constraints = new Assert\Collection([
            'content' => [
                new Assert\NotBlank(),
                new Assert\Length(['min' => 1])
            ]
        ]);

        $listOfErrors = Validation::createValidator()->validate($data, $constraints);
        $this->mapErrors($listOfErrors);
    }
}