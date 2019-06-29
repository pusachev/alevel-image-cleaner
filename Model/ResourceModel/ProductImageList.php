<?php
/**
 * Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2019, Pavel Usachev
 */

namespace ALevel\ImageCleaner\Model\ResourceModel;

use Magento\Catalog\Model\ResourceModel\Product\Gallery;

class ProductImageList extends Gallery
{
    public function getAllImages()
    {
        $select = $this->getConnection()->select();

        $select->from(
            $this->getConnection()
                 ->getTableName(self::GALLERY_TABLE),
            'value'
        );

        return $this->getConnection()->fetchAll($select);
    }
}