<?php

namespace Axmit\Image\Service;

use Illuminate\Contracts\Filesystem\Filesystem;
use Intervention\Image\ImageManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class ImageFactory
 *
 * @package Axmit\Image\Service
 */
abstract class ImageFactory
{
    /**
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * @var ImageManager
     */
    protected $imageManager;

    /**
     * ImageFactory constructor.
     *
     * @param Filesystem   $filesystem
     * @param ImageManager $imageManager
     */
    public function __construct(Filesystem $filesystem, ImageManager $imageManager)
    {
        $this->filesystem   = $filesystem;
        $this->imageManager = $imageManager;
    }

    /**
     * @return string
     */
    abstract protected function getPath(): string;

    /**
     * @param mixed $input
     *
     * @return Thumbnail
     */
    public function makeThumbnail($input)
    {
        $image = $this->imageManager->make($input);

        if (!$image->extension && $input instanceof UploadedFile) {
            $image->extension = $input->guessExtension();
        }

        return new Thumbnail(
            $this->filesystem,
            $image,
            $this->getPath()
        );
    }
}
