<?php

namespace App\Utils;

use JMS\Serializer\DeserializationContext;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RequestDtoValidator
{
    private $serializer;
    private $validator;

    public function __construct(SerializerInterface $serializer, ValidatorInterface $validator)
    {
        $this->serializer = $serializer;
        $this->validator = $validator;
    }

    public function deserializeToDto(string $json, array $groups = [], string $class)
    {

        $deserializationContext = DeserializationContext::create(); // ->setSerializeNull(true)

        if (!empty($groups)) {
            $deserializationContext->setGroups($groups);
        }

        return $this->serializer->deserialize(
            $json, $class, 'json', $deserializationContext
        );
    }

    public function serializeToArray($dto)
    {
        return json_decode($this->serializer->serialize(
            $dto, 'json'
        ), true);
    }

    public function validate($dto, array $groups = []) : ConstraintViolationListInterface
    {
        return $this->validator->validate($dto, null, $groups);
    }


}