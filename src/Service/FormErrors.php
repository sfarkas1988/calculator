<?php

namespace App\Service;

use Symfony\Component\Form\FormInterface;

class FormErrors
{
    /**
     * will return Form errors as array, since $form->getErrors(true, false)->getMessages() is creating an infinite loop.
     */
    public function getErrorsFromForm(FormInterface $form): array
    {
        $errors = [];
        foreach ($form->getErrors() as $error) {
            $errors[] = $error->getMessage();
        }
        foreach ($form->all() as $childForm) {
            if ($childForm instanceof FormInterface) {
                if ($childErrors = $this->getErrorsFromForm($childForm)) {
                    $errors[$childForm->getName()] = $childErrors;
                }
            }
        }

        return $errors;
    }
}
