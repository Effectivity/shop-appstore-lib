<?php

namespace DreamCommerce\ShopAppstoreLib;

use DreamCommerce\ShopAppstoreLib\Client\Exception\Exception;
use DreamCommerce\ShopAppstoreLib\Exception\HttpException;
use DreamCommerce\ShopAppstoreLib\Resource\Exception\CommunicationException;
use DreamCommerce\ShopAppstoreLib\Resource\Exception\MethodUnsupportedException;
use DreamCommerce\ShopAppstoreLib\Resource\Exception\NotFoundException;
use DreamCommerce\ShopAppstoreLib\Resource\Exception\ObjectLockedException;
use DreamCommerce\ShopAppstoreLib\Resource\Exception\PermissionsException;
use DreamCommerce\ShopAppstoreLib\Resource\Exception\ResourceException;
use DreamCommerce\ShopAppstoreLib\Resource\Exception\ValidationException;
use DreamCommerce\ShopAppstoreLib\ResourceList;

class BulkResource
{
    /**
     * @var ClientInterface|null
     */
    public $client = null;

    /**
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }


    /**
     * @param Resource[] $resources
     *
     * @return mixed
     */
    public function get($resources)
    {
        $calls = [];
        foreach ($resources as $key => $resource) {
            $query = $resource->getCriteria();
            $call = [
                'id'   => $key,
                'name' => $resource->getName(),
            ];
            if (!empty($query)) {
                $call['params'] = $query;
            }
            $calls[] = $call;
        }

        $response = '';

        try {
            $response = $this->client->bulkRequest($calls);
        } catch (Exception $ex) {
            $this->dispatchException($ex);
        }

        return $this->transformResponse($response);
    }

    /**
     * @param      $response
     *
     * @return ResourceList[]
     * @throws ResourceException
     */
    protected function transformResponse($response)
    {
        $code = null;
        if (isset($response['headers']['Code'])) {
            $code = $response['headers']['Code'];
        }

        try {
            if ($code  < 200 && $code >= 300) {
                throw new Exception();
            }
            $objects = [];

            foreach ($response['data']['items'] as $key => $item) {
                $itemCode = $item['code'];
                if ($itemCode  < 200 && $itemCode >= 300) {
                    throw new Exception();
                }
                $body = $item['body'];
                if (isset($body['list'])) {
                    $objectList = new ResourceList($body['list']);
                } else {
                    $objectList = new ResourceList();
                }

                // add meta properties (eg. count, page, etc) as a ArrayObject properties
                if (isset($body['page'])) {
                    $objectList->setPage($body['page']);
                }

                if (isset($body['count'])) {
                    $objectList->setCount($body['count']);
                }

                if (isset($body['pages'])) {
                    $objectList->setPageCount($body['pages']);
                }

                $objects[$item['id']] = $objectList;
            }

            return $objects;

        } catch (Exception $exception) {
            if (isset($response['data']['error'])) {
                $msg = $response['data']['error'];
            } else {
                $msg = $response;
            }

            throw new ResourceException($msg, $code);
        }
    }

    protected function dispatchException(Exception $ex)
    {

        /**
         * @var $httpException HttpException
         */
        $httpException = $ex->getPrevious();

        if (!$httpException) {
            throw $ex;
        }

        switch ($httpException->getCode()) {
            case 400:
                throw new ValidationException($httpException->getResponse(), 0, $httpException);
            case 404:
                throw new NotFoundException($httpException->getResponse(), 0, $httpException);
            case 405:
                throw new MethodUnsupportedException($httpException->getResponse(), 0, $httpException);
            case 409:
                throw new ObjectLockedException($httpException->getResponse(), 0, $httpException);
            case 401:
                throw new PermissionsException($httpException->getResponse(), 0, $httpException);
        }

        $exception = new CommunicationException($httpException->getMessage(), $httpException->getCode(), $httpException);

        $logger = $this->client->getLogger();
        // log error if no custom logger is configured
        if ($logger && $logger instanceof Logger) {
            $logger->error((string)$httpException, [(string)$httpException]);
        }

        throw $exception;

    }
}
