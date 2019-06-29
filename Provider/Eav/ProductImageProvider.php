<?php
/**
 * Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2019, Pavel Usachev
 */

namespace ALevel\ImageCleaner\Provider\Eav;

use ALevel\ImageCleaner\Api\Provider\Eav\ProductImageProviderInterface;
use ALevel\ImageCleaner\Model\ResourceModel\ProductImageList;

class ProductImageProvider implements ProductImageProviderInterface
{
    /** @var ProductImageList  */
    private $resource;

    /**
     * ProductImageProvider constructor.
     * @param ProductImageList $productImageList
     */
    public function __construct(ProductImageList $productImageList)
    {
        $this->resource = $productImageList;
    }


    /** {@inheritDoc} */
    public function getImageList(): array
    {
        $images = [];

        foreach ($this->resource->getAllImages() as $row) {
            $paths = explode(DIRECTORY_SEPARATOR, $row['value']);

            $images[] = end($paths);
        }

        return $images;
    }
}