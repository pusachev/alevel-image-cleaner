<?php
/**
 * Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2019, Pavel Usachev
 */

namespace ALevel\ImageCleaner\Provider\Directory;

use ALevel\ImageCleaner\Api\Provider\Directory\ProductImageProviderInterface;
use Magento\Framework\Filesystem\Driver\File;
use Magento\Framework\App\Filesystem\DirectoryList;

class ProductImageProvider implements ProductImageProviderInterface
{
    /** @var File  */
    private $file;

    /** @var DirectoryList */
    private $directoryList;

    public function __construct(
        File $file,
        DirectoryList $directoryList
    ) {
        $this->file          = $file;
        $this->directoryList = $directoryList;
    }

    /**
     * @return array
     */
    public function getImageList(): array
    {

        $files = [];

        $path = $this->directoryList->getPath(DirectoryList::MEDIA);

        $path = $path . DIRECTORY_SEPARATOR . 'catalog' . DIRECTORY_SEPARATOR . 'product';

        $flags = \FilesystemIterator::SKIP_DOTS | \FilesystemIterator::UNIX_PATHS;

        $directoryIterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($path, $flags)
        );

        $imageListIterator = new\RegexIterator($directoryIterator, "/\.jpg|\.jpeg|\.png|\.gif/");

        foreach ($imageListIterator as $image) {
            if (strstr($image->getRealPath(), '/cache/')) {
                continue;
            }

            $paths = explode(DIRECTORY_SEPARATOR, $image->getRealPath());

            $files[] = end($paths);
        }

        return $files;
    }
}
