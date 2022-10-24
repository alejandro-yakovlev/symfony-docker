<?php

declare(strict_types=1);

namespace App\Core\Api\REST;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class BaseRequest
{
    public function __construct(
        private readonly ValidatorInterface $validator,
        private readonly DenormalizerInterface $denormalizer
    ) {
        $this->populate();

        if ($this->autoValidateRequest()) {
            $this->validate();
        }
    }

    public function validate(): void
    {
        $errors = $this->validator->validate($this);

        $messages = [];
        foreach ($errors as $message) {
            $messages[] = [
                'property' => $message->getPropertyPath(),
                'value' => $message->getInvalidValue(),
                'message' => $message->getMessage(),
            ];
        }

        if (count($messages) > 0) {
            $response = ResponseHelper::errors($messages, 'Validation failed');
            $response->send();

            exit;
        }
    }

    public function getRequest(): Request
    {
        return Request::createFromGlobals();
    }

    protected function populate(): void
    {
        $requestData = $this->toArray();
        $this->denormalizer->denormalize(
            $requestData,
            self::class,
            null,
            [
                AbstractNormalizer::OBJECT_TO_POPULATE => $this,
                AbstractObjectNormalizer::DISABLE_TYPE_ENFORCEMENT => true,
            ]
        );
    }

    protected function toArray(): array
    {
        $bodyProperties = [];
        if (in_array($this->getRequest()->getMethod(), ['PUT', 'POST'])) {
            $bodyProperties = $this->getRequest()->toArray();
        }
        $queryParameters = $this->getRequest()->query->all();

        return [...$bodyProperties, ...$queryParameters];
    }

    protected function autoValidateRequest(): bool
    {
        return true;
    }
}
