<?php

namespace DreamCommerce\ShopAppstoreLib\Resource;

use DreamCommerce\ShopAppstoreLib\Resource;

/**
 * Resource Webhook
 *
 * @package DreamCommerce\ShopAppstoreLib\Resource
 * @link https://developers.shoper.pl/developers/api/resources/webhooks
 */
class Webhook extends Resource
{
    /**
     * webhook data encoded using JSON
     */
    const FORMAT_JSON = 0;
    /**
     * webhook data encoded using XML
     */
    const FORMAT_XML = 1;

    /**
     * webhook bound to order create event
     */
    const EVENT_ORDER_CREATE = 'order.create';
    /**
     * webhook bound to order edit event
     */
    const EVENT_ORDER_EDIT = 'order.edit';
    /**
     * webhook bound to order is paid event
     */
    const EVENT_ORDER_PAID = 'order.paid';
    /**
     * webhook bound to order status change
     */
    const EVENT_ORDER_STATUS = 'order.status';
    /**
     * webhook bound to order delete
     */
    const EVENT_ORDER_DELETE = 'order.delete';
    /**
     * webhook bound to client create event
     */
    const EVENT_CLIENT_CREATE = 'client.create';
    /**
     * webhook bound to client edit event
     */
    const EVENT_CLIENT_EDIT = 'client.edit';
    /**
     * webhook bound to client delete event
     */
    const EVENT_CLIENT_DELETE = 'client.delete';
    /**
     * webhook bound to product create event
     */
    const EVENT_PRODUCT_CREATE = 'product.create';
    /**
     * webhook bound to product edit event
     */
    const EVENT_PRODUCT_EDIT = 'product.edit';
    /**
     * webhook bound to product delete event
     */
    const EVENT_PRODUCT_DELETE = 'product.delete';
    /**
     * webhook bound to parcel create event
     */
    const EVENT_PARCEL_CREATE = 'parcel.create';
    /**
     * webhook bound to parcel dispatch event
     */
    const EVENT_PARCEL_DISPATCH = 'parcel.dispatch';
    /**
     * webhook bound to parcel delete event
     */
    const EVENT_PARCEL_DELETE = 'parcel.delete';

    protected $name = 'webhooks';
}
