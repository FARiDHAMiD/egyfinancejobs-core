<?php

namespace App\MediaLibrary\PathGenerator;

use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CustomPathGenerator implements PathGenerator
{
    /**
     * Get the base path for the media.
     */
    public function getPath(Media $media): string
    {
        if ($media->collection_name === 'company_logo') {
            return 'company-logos/' . $media->id . '/';
        }

        if ($media->collection_name === 'company_banner') {
            return 'company-banners/' . $media->id . '/';
        }
        if ($media->collection_name === 'education_certificate') {
            return 'education-certificates/' . $media->id . '/';
        }
        if ($media->collection_name === 'employee_profile') {
            return 'employee-profiles/' . $media->id . '/';
        }
        if ($media->collection_name === 'employee_certificates') {
            return 'employee-certificates/' . $media->id . '/';
        }
        if ($media->collection_name === 'employee_cv') {
            return 'employee-cvs/' . $media->id . '/';
        }

        // Default path
        return 'media/' . $media->id . '/';
    }

    /**
     * Get the path for the conversions of the media.
     */
    public function getPathForConversions(Media $media): string
    {
        return $this->getPath($media) . 'conversions/';
    }

    /**
     * Get the path for responsive images of the media.
     */
    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getPath($media) . 'responsive-images/';
    }
}
