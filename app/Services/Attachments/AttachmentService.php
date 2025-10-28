<?php

namespace App\Services\Attachments;

use App\Models\Attachment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AttachmentService
{
    /**
     * Store a new attachment for the given model.
     */
    public function store(Model $attachable, UploadedFile $file, string $collection = 'default', ?int $uploadedBy = null): Attachment
    {
        $disk = config('filesystems.attachments_disk', config('filesystems.default'));
        $prefix = $this->buildPathPrefix($attachable, $collection);
        $filename = $file->hashName();

        $path = $file->storePubliclyAs($prefix, $filename, $disk);

        return $attachable->attachments()->create([
            'collection' => $collection,
            'disk' => $disk,
            'path' => $path,
            'filename' => $file->getClientOriginalName(),
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize(),
            'uploaded_by' => $uploadedBy,
        ]);
    }

    /**
     * Replace an existing attachment in a collection with a new upload.
     */
    public function replace(Model $attachable, UploadedFile $file, string $collection = 'default', ?int $uploadedBy = null): Attachment
    {
        $this->delete($attachable, $collection);

        return $this->store($attachable, $file, $collection, $uploadedBy);
    }

    /**
     * Delete all attachments within a collection for the given model.
     */
    public function delete(Model $attachable, string $collection = 'default'): void
    {
        $attachable->attachments()
            ->where('collection', $collection)
            ->each(function (Attachment $attachment) {
                Storage::disk($attachment->disk)->delete($attachment->path);
                $attachment->delete();
            });
    }

    /**
     * Determine the storage path prefix for the attachment.
     */
    protected function buildPathPrefix(Model $attachable, string $collection): string
    {
        $modelName = Str::kebab(class_basename($attachable));

        return trim("attachments/{$modelName}/{$attachable->getKey()}/{$collection}", '/');
    }
}
