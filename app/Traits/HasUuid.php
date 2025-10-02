<?php

namespace App\Traits;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasUuid
{
    public static function bootHasUUID()
    {
        static::creating(function (Model $model) {

            /** @phpstan-ignore-next-line */
            $uuidField = $model->getUUIDFieldName();

            if (empty($model->{$uuidField})) {
                $model->{$uuidField} = static::generateUUID();
            }
        });
    }

    public function getUUIDFieldName(): string
    {
        return 'uuid';
    }

    public static function findByUuid(string $uuid): ?Model
    {
        try {
            return static::byUUID($uuid)->first();
        } catch (Exception $e) {
            return null;
        }
    }

    public static function generateUUID()
    {
        return Str::uuid()->toString();
    }

    public function scopeByUUID($query, $uuid)
    {
        return $query->where($this->getUUIDFieldName(), $uuid);
    }
}
