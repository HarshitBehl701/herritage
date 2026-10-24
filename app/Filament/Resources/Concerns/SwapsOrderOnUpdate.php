<?php

namespace App\Filament\Resources\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

trait SwapsOrderOnUpdate
{
    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $targetOrder = (int) $data['order'];

        return DB::transaction(function () use ($record, $data, $targetOrder): Model {
            $lockedRecords = $record->newQueryWithoutScopes()
                ->where(function (Builder $query) use ($record, $targetOrder): void {
                    $query->whereKey($record->getKey())
                        ->orWhere('order', $targetOrder);
                })
                ->orderBy($record->getKeyName())
                ->lockForUpdate()
                ->get();

            $recordKey = $record->getKey();
            $lockedRecord = $lockedRecords->first(
                fn (Model $candidate): bool => (string) $candidate->getKey() === (string) $recordKey
            );

            if (! $lockedRecord) {
                throw (new ModelNotFoundException)->setModel($record::class, [$recordKey]);
            }

            $previousOrder = $lockedRecord->getAttribute('order');
            $conflictingRecord = $lockedRecords->first(
                fn (Model $candidate): bool => (string) $candidate->getKey() !== (string) $recordKey
                    && (int) $candidate->getAttribute('order') === $targetOrder
            );

            if ($conflictingRecord) {
                $conflictingRecord->setAttribute('order', null);
                $conflictingRecord->saveQuietly();
            }

            $updatedRecord = parent::handleRecordUpdate($lockedRecord, $data);

            if ($conflictingRecord) {
                $conflictingRecord->setAttribute('order', $previousOrder);
                $conflictingRecord->saveQuietly();
            }

            return $updatedRecord;
        });
    }
}
