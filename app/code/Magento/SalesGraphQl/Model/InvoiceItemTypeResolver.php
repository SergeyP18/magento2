<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento\SalesGraphQl\Model;

use Magento\Framework\GraphQl\Query\Resolver\TypeResolverInterface;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;

/**
 * Resolve concrete type for InvoiceItemInterface
 */
class InvoiceItemTypeResolver implements TypeResolverInterface
{
    /**
     * @var array
     */
    private $productTypeMap;

    public function __construct($productTypeMap = [])
    {
        $this->productTypeMap = $productTypeMap;
    }

    /**
     * @inheritDoc
     */
    public function resolveType(array $data): string
    {
        if (!isset($data['product_type'])) {
            throw new GraphQlInputException(
                __('Missing key %1 in sales item data', ['product_type'])
            );
        }
        if (isset($this->productTypeMap[$data['product_type']])) {
            return $this->productTypeMap[$data['product_type']];
        }
        return $this->productTypeMap['default'];
    }
}
