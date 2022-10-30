<?php

namespace Tii\WowApi\Data;

use function Tii\WowApi\strtocamel;

class Data
{

    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            $key = strtocamel($key);
            $tryProperties = [$key, "_$key"];

            foreach ($tryProperties as $property) {
                if (! property_exists($this, $property)) {
                    continue;
                }

                $reflectionProperty = new \ReflectionProperty($this, $property);
                $type = $reflectionProperty->getType();

                // Builtin types
                if ($type->isBuiltin()) {
                    $this->$property = $value;
                    break;
                }

                // Data object
                $typeName = $type->getName();
                if (is_a($typeName, Data::class, true) && is_array($value)) {
                    $this->$property = new $typeName($value);
                    break;
                }

                // Some other objects...
                $this->$property = new $typeName($value);
                break;
            }

        }
    }

}