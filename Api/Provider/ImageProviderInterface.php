<?php
/**
 * Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2019, Pavel Usachev
 */

namespace ALevel\ImageCleaner\Api\Provider;


interface ImageProviderInterface
{
    /**
     * @return array
     */
    public function getImageList() : array;
}