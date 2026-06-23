<?php

namespace App\Helpers;

use JsonSchema\Validator;
use stdClass;

class SchemaValidator
{
    public static function validate($data, $schemaPath): array
    {
        $schema = json_decode(file_get_contents($schemaPath));
        
        // Create a validator instance and validate the data against schema
        $validator = new Validator();
        $validator->validate($data, $schema);
        
        $errors = [];
        if (!$validator->isValid()) {
            foreach ($validator->getErrors() as $error) {
                $errors[] = $error['message'];
            }
        }
        
        return $errors;
    }
}