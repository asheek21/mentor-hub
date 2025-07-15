<?php

namespace App\Traits;

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
        return property_exists($this, 'uuidFieldName') && ! empty($this->uuidFieldName)
            ? $this->uuidFieldName
            : 'uuid';
    }

    public static function findByUuid(string $uuid): ?Model
    {
        return static::byUUID($uuid)->first();
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
