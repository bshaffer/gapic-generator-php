<?php
/*
 * Copyright 2021 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     https://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/*
 * GENERATED CODE WARNING
 * This file was generated from the file
 * https://github.com/google/googleapis/blob/master/google/cloud/redis/v1/cloud_redis.proto
 * and updates to that file get reflected here through a refresh process.
 */

namespace Google\Cloud\Redis\V1\Gapic;

use Google\ApiCore\ApiException;
use Google\ApiCore\CredentialsWrapper;
use Google\ApiCore\GapicClientTrait;

use Google\ApiCore\LongRunning\OperationsClient;
use Google\ApiCore\OperationResponse;

use Google\ApiCore\PathTemplate;
use Google\ApiCore\RequestParamsHeaderDescriptor;
use Google\ApiCore\RetrySettings;
use Google\ApiCore\Transport\TransportInterface;
use Google\ApiCore\ValidationException;
use Google\Auth\FetchAuthTokenInterface;
use Google\Cloud\Redis\V1\CreateInstanceRequest;
use Google\Cloud\Redis\V1\DeleteInstanceRequest;
use Google\Cloud\Redis\V1\ExportInstanceRequest;
use Google\Cloud\Redis\V1\FailoverInstanceRequest;
use Google\Cloud\Redis\V1\GetInstanceRequest;
use Google\Cloud\Redis\V1\ImportInstanceRequest;
use Google\Cloud\Redis\V1\InputConfig;
use Google\Cloud\Redis\V1\Instance;
use Google\Cloud\Redis\V1\ListInstancesRequest;
use Google\Cloud\Redis\V1\ListInstancesResponse;
use Google\Cloud\Redis\V1\OutputConfig;
use Google\Cloud\Redis\V1\UpdateInstanceRequest;

use Google\Cloud\Redis\V1\UpgradeInstanceRequest;
use Google\LongRunning\Operation;
use Google\Protobuf\FieldMask;

/**
 * Service Description: Configures and manages Cloud Memorystore for Redis instances
 *
 * Google Cloud Memorystore for Redis v1
 *
 * The `redis.googleapis.com` service implements the Google Cloud Memorystore
 * for Redis API and defines the following resource model for managing Redis
 * instances:
 * * The service works with a collection of cloud projects, named: `/projects/*`
 * * Each project has a collection of available locations, named: `/locations/*`
 * * Each location has a collection of Redis instances, named: `/instances/*`
 * * As such, Redis instances are resources of the form:
 * `/projects/{project_id}/locations/{location_id}/instances/{instance_id}`
 *
 * Note that location_id must be referring to a GCP `region`; for example:
 * * `projects/redpepper-1290/locations/us-central1/instances/my-redis`
 *
 * This class provides the ability to make remote calls to the backing service through method
 * calls that map to API methods. Sample code to get started:
 *
 * ```
 * $cloudRedisClient = new CloudRedisClient();
 * try {
 *     $formattedParent = $cloudRedisClient->locationName('[PROJECT]', '[LOCATION]');
 *     $instanceId = 'instance_id';
 *     $instance = new Instance();
 *     $operationResponse = $cloudRedisClient->createInstance($formattedParent, $instanceId, $instance);
 *     $operationResponse->pollUntilComplete();
 *     if ($operationResponse->operationSucceeded()) {
 *         $result = $operationResponse->getResult();
 *     // doSomethingWith($result)
 *     } else {
 *         $error = $operationResponse->getError();
 *         // handleError($error)
 *     }
 *     // Alternatively:
 *     // start the operation, keep the operation name, and resume later
 *     $operationResponse = $cloudRedisClient->createInstance($formattedParent, $instanceId, $instance);
 *     $operationName = $operationResponse->getName();
 *     // ... do other work
 *     $newOperationResponse = $cloudRedisClient->resumeOperation($operationName, 'createInstance');
 *     while (!$newOperationResponse->isDone()) {
 *         // ... do other work
 *         $newOperationResponse->reload();
 *     }
 *     if ($newOperationResponse->operationSucceeded()) {
 *         $result = $newOperationResponse->getResult();
 *     // doSomethingWith($result)
 *     } else {
 *         $error = $newOperationResponse->getError();
 *         // handleError($error)
 *     }
 * } finally {
 *     $cloudRedisClient->close();
 * }
 * ```
 *
 * Many parameters require resource names to be formatted in a particular way. To
 * assistwith these names, this class includes a format method for each type of
 * name, and additionallya parseName method to extract the individual identifiers
 * contained within formatted namesthat are returned by the API.
 */
class CloudRedisGapicClient
{
    use GapicClientTrait;

    /**
     * The name of the service.
     */
    const SERVICE_NAME = 'google.cloud.redis.v1.CloudRedis';

    /**
     * The default address of the service.
     */
    const SERVICE_ADDRESS = 'redis.googleapis.com';

    /**
     * The default port of the service.
     */
    const DEFAULT_SERVICE_PORT = 443;

    /**
     * The name of the code generator, to be included in the agent header.
     */
    const CODEGEN_NAME = 'gapic';

    /**
     * The default scopes required by the service.
     */
    public static $serviceScopes = [
        'https://www.googleapis.com/auth/cloud-platform',
    ];

    private static $instanceNameTemplate;

    private static $locationNameTemplate;

    private static $pathTemplateMap;

    private $operationsClient;

    private static function getClientDefaults()
    {
        return [
            'serviceName' => self::SERVICE_NAME,
            'serviceAddress' => self::SERVICE_ADDRESS . ':' . self::DEFAULT_SERVICE_PORT,
            'clientConfig' => __DIR__ . '/../resources/cloud_redis_client_config.json',
            'descriptorsConfigPath' => __DIR__ . '/../resources/cloud_redis_descriptor_config.php',
            'gcpApiConfigPath' => __DIR__ . '/../resources/cloud_redis_grpc_config.json',
            'credentialsConfig' => [
                'defaultScopes' => self::$serviceScopes,
            ],
            'transportConfig' => [
                'rest' => [
                    'restClientConfigPath' => __DIR__ . '/../resources/cloud_redis_rest_client_config.php',
                ],
            ],
        ];
    }

    private static function getInstanceNameTemplate()
    {
        if (self::$instanceNameTemplate == null) {
            self::$instanceNameTemplate = new PathTemplate('projects/{project}/locations/{location}/instances/{instance}');
        }

        return self::$instanceNameTemplate;
    }

    private static function getLocationNameTemplate()
    {
        if (self::$locationNameTemplate == null) {
            self::$locationNameTemplate = new PathTemplate('projects/{project}/locations/{location}');
        }

        return self::$locationNameTemplate;
    }

    private static function getPathTemplateMap()
    {
        if (self::$pathTemplateMap == null) {
            self::$pathTemplateMap = [
                'instance' => self::getInstanceNameTemplate(),
                'location' => self::getLocationNameTemplate(),
            ];
        }

        return self::$pathTemplateMap;
    }

    /**
     * Formats a string containing the fully-qualified path to represent a instance
     * resource.
     *
     * @param string $project
     * @param string $location
     * @param string $instance
     *
     * @return string The formatted instance resource.
     */
    public static function instanceName($project, $location, $instance)
    {
        return self::getInstanceNameTemplate()->render([
            'project' => $project,
            'location' => $location,
            'instance' => $instance,
        ]);
    }

    /**
     * Formats a string containing the fully-qualified path to represent a location
     * resource.
     *
     * @param string $project
     * @param string $location
     *
     * @return string The formatted location resource.
     */
    public static function locationName($project, $location)
    {
        return self::getLocationNameTemplate()->render([
            'project' => $project,
            'location' => $location,
        ]);
    }

    /**
     * Parses a formatted name string and returns an associative array of the components in the name.
     * The following name formats are supported:
     * Template: Pattern
     * - instance: projects/{project}/locations/{location}/instances/{instance}
     * - location: projects/{project}/locations/{location}
     *
     * The optional $template argument can be supplied to specify a particular pattern,
     * and must match one of the templates listed above. If no $template argument is
     * provided, or if the $template argument does not match one of the templates
     * listed, then parseName will check each of the supported templates, and return
     * the first match.
     *
     * @param string $formattedName The formatted name string
     * @param string $template      Optional name of template to match
     *
     * @return array An associative array from name component IDs to component values.
     *
     * @throws ValidationException If $formattedName could not be matched.
     */
    public static function parseName($formattedName, $template = null)
    {
        $templateMap = self::getPathTemplateMap();
        if ($template) {
            if (!isset($templateMap[$template])) {
                throw new ValidationException("Template name $template does not exist");
            }

            return $templateMap[$template]->match($formattedName);
        }

        foreach ($templateMap as $templateName => $pathTemplate) {
            try {
                return $pathTemplate->match($formattedName);
            } catch (ValidationException $ex) {
                // Swallow the exception to continue trying other path templates
            }
        }

        throw new ValidationException("Input did not match any known format. Input: $formattedName");
    }

    /**
     * Return an OperationsClient object with the same endpoint as $this.
     *
     * @return OperationsClient
     */
    public function getOperationsClient()
    {
        return $this->operationsClient;
    }

    /**
     * Resume an existing long running operation that was previously started by a long
     * running API method. If $methodName is not provided, or does not match a long
     * running API method, then the operation can still be resumed, but the
     * OperationResponse object will not deserialize the final response.
     *
     * @param string $operationName The name of the long running operation
     * @param string $methodName    The name of the method used to start the operation
     *
     * @return OperationResponse
     */
    public function resumeOperation($operationName, $methodName = null)
    {
        $options = isset($this->descriptors[$methodName]['longRunning']) ? $this->descriptors[$methodName]['longRunning'] : [];
        $operation = new OperationResponse($operationName, $this->getOperationsClient(), $options);
        $operation->reload();
        return $operation;
    }

    /**
     * Constructor.
     *
     * @param array $options {
     *     Optional. Options for configuring the service API wrapper.
     *
     *     @type string $serviceAddress
     *           The address of the API remote host. May optionally include the port, formatted
     *           as "<uri>:<port>". Default 'redis.googleapis.com:443'.
     *     @type string|array|FetchAuthTokenInterface|CredentialsWrapper $credentials
     *           The credentials to be used by the client to authorize API calls. This option
     *           accepts either a path to a credentials file, or a decoded credentials file as a
     *           PHP array.
     *           *Advanced usage*: In addition, this option can also accept a pre-constructed
     *           {@see \Google\Auth\FetchAuthTokenInterface} object or
     *           {@see \Google\ApiCore\CredentialsWrapper} object. Note that when one of these
     *           objects are provided, any settings in $credentialsConfig will be ignored.
     *     @type array $credentialsConfig
     *           Options used to configure credentials, including auth token caching, for the
     *           client. For a full list of supporting configuration options, see
     *           {@see \Google\ApiCore\CredentialsWrapper::build()} .
     *     @type bool $disableRetries
     *           Determines whether or not retries defined by the client configuration should be
     *           disabled. Defaults to `false`.
     *     @type string|array $clientConfig
     *           Client method configuration, including retry settings. This option can be either
     *           a path to a JSON file, or a PHP array containing the decoded JSON data. By
     *           default this settings points to the default client config file, which is
     *           provided in the resources folder.
     *     @type string|TransportInterface $transport
     *           The transport used for executing network requests. May be either the string
     *           `rest` or `grpc`. Defaults to `grpc` if gRPC support is detected on the system.
     *           *Advanced usage*: Additionally, it is possible to pass in an already
     *           instantiated {@see \Google\ApiCore\Transport\TransportInterface} object. Note
     *           that when this object is provided, any settings in $transportConfig, and any
     *           $serviceAddress setting, will be ignored.
     *     @type array $transportConfig
     *           Configuration options that will be used to construct the transport. Options for
     *           each supported transport type should be passed in a key for that transport. For
     *           example:
     *           $transportConfig = [
     *               'grpc' => [...],
     *               'rest' => [...],
     *           ];
     *           See the {@see \Google\ApiCore\Transport\GrpcTransport::build()} and
     *           {@see \Google\ApiCore\Transport\RestTransport::build()} methods for the
     *           supported options.
     * }
     *
     * @throws ValidationException
     */
    public function __construct(array $options = [])
    {
        $clientOptions = $this->buildClientOptions($options);
        $this->setClientOptions($clientOptions);
        $this->operationsClient = $this->createOperationsClient($clientOptions);
    }

    /**
     * Creates a Redis instance based on the specified tier and memory size.
     *
     * By default, the instance is accessible from the project's
     * [default network](https://cloud.google.com/vpc/docs/vpc).
     *
     * The creation is executed asynchronously and callers may check the returned
     * operation to track its progress. Once the operation is completed the Redis
     * instance will be fully functional. Completed longrunning.Operation will
     * contain the new instance object in the response field.
     *
     * The returned operation is automatically deleted after a few hours, so there
     * is no need to call DeleteOperation.
     *
     * Sample code:
     * ```
     * $cloudRedisClient = new CloudRedisClient();
     * try {
     *     $formattedParent = $cloudRedisClient->locationName('[PROJECT]', '[LOCATION]');
     *     $instanceId = 'instance_id';
     *     $instance = new Instance();
     *     $operationResponse = $cloudRedisClient->createInstance($formattedParent, $instanceId, $instance);
     *     $operationResponse->pollUntilComplete();
     *     if ($operationResponse->operationSucceeded()) {
     *         $result = $operationResponse->getResult();
     *     // doSomethingWith($result)
     *     } else {
     *         $error = $operationResponse->getError();
     *         // handleError($error)
     *     }
     *     // Alternatively:
     *     // start the operation, keep the operation name, and resume later
     *     $operationResponse = $cloudRedisClient->createInstance($formattedParent, $instanceId, $instance);
     *     $operationName = $operationResponse->getName();
     *     // ... do other work
     *     $newOperationResponse = $cloudRedisClient->resumeOperation($operationName, 'createInstance');
     *     while (!$newOperationResponse->isDone()) {
     *         // ... do other work
     *         $newOperationResponse->reload();
     *     }
     *     if ($newOperationResponse->operationSucceeded()) {
     *         $result = $newOperationResponse->getResult();
     *     // doSomethingWith($result)
     *     } else {
     *         $error = $newOperationResponse->getError();
     *         // handleError($error)
     *     }
     * } finally {
     *     $cloudRedisClient->close();
     * }
     * ```
     *
     * @param string   $parent       Required. The resource name of the instance location using the form:
     *                               `projects/{project_id}/locations/{location_id}`
     *                               where `location_id` refers to a GCP region.
     * @param string   $instanceId   Required. The logical name of the Redis instance in the customer project
     *                               with the following restrictions:
     *
     *                               * Must contain only lowercase letters, numbers, and hyphens.
     *                               * Must start with a letter.
     *                               * Must be between 1-40 characters.
     *                               * Must end with a number or a letter.
     *                               * Must be unique within the customer project / location
     * @param Instance $instance     Required. A Redis [Instance] resource
     * @param array    $optionalArgs {
     *     Optional.
     *
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\ApiCore\OperationResponse
     *
     * @throws ApiException if the remote call fails
     */
    public function createInstance($parent, $instanceId, $instance, array $optionalArgs = [])
    {
        $request = new CreateInstanceRequest();
        $requestParamHeaders = [];
        $request->setParent($parent);
        $request->setInstanceId($instanceId);
        $request->setInstance($instance);
        $requestParamHeaders['parent'] = $parent;
        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startOperationsCall('CreateInstance', $optionalArgs, $request, $this->getOperationsClient())->wait();
    }

    /**
     * Deletes a specific Redis instance.  Instance stops serving and data is
     * deleted.
     *
     * Sample code:
     * ```
     * $cloudRedisClient = new CloudRedisClient();
     * try {
     *     $formattedName = $cloudRedisClient->instanceName('[PROJECT]', '[LOCATION]', '[INSTANCE]');
     *     $operationResponse = $cloudRedisClient->deleteInstance($formattedName);
     *     $operationResponse->pollUntilComplete();
     *     if ($operationResponse->operationSucceeded()) {
     *         // operation succeeded and returns no value
     *     } else {
     *         $error = $operationResponse->getError();
     *         // handleError($error)
     *     }
     *     // Alternatively:
     *     // start the operation, keep the operation name, and resume later
     *     $operationResponse = $cloudRedisClient->deleteInstance($formattedName);
     *     $operationName = $operationResponse->getName();
     *     // ... do other work
     *     $newOperationResponse = $cloudRedisClient->resumeOperation($operationName, 'deleteInstance');
     *     while (!$newOperationResponse->isDone()) {
     *         // ... do other work
     *         $newOperationResponse->reload();
     *     }
     *     if ($newOperationResponse->operationSucceeded()) {
     *         // operation succeeded and returns no value
     *     } else {
     *         $error = $newOperationResponse->getError();
     *         // handleError($error)
     *     }
     * } finally {
     *     $cloudRedisClient->close();
     * }
     * ```
     *
     * @param string $name         Required. Redis instance resource name using the form:
     *                             `projects/{project_id}/locations/{location_id}/instances/{instance_id}`
     *                             where `location_id` refers to a GCP region.
     * @param array  $optionalArgs {
     *     Optional.
     *
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\ApiCore\OperationResponse
     *
     * @throws ApiException if the remote call fails
     */
    public function deleteInstance($name, array $optionalArgs = [])
    {
        $request = new DeleteInstanceRequest();
        $requestParamHeaders = [];
        $request->setName($name);
        $requestParamHeaders['name'] = $name;
        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startOperationsCall('DeleteInstance', $optionalArgs, $request, $this->getOperationsClient())->wait();
    }

    /**
     * Export Redis instance data into a Redis RDB format file in Cloud Storage.
     *
     * Redis will continue serving during this operation.
     *
     * The returned operation is automatically deleted after a few hours, so
     * there is no need to call DeleteOperation.
     *
     * Sample code:
     * ```
     * $cloudRedisClient = new CloudRedisClient();
     * try {
     *     $name = 'name';
     *     $outputConfig = new OutputConfig();
     *     $operationResponse = $cloudRedisClient->exportInstance($name, $outputConfig);
     *     $operationResponse->pollUntilComplete();
     *     if ($operationResponse->operationSucceeded()) {
     *         $result = $operationResponse->getResult();
     *     // doSomethingWith($result)
     *     } else {
     *         $error = $operationResponse->getError();
     *         // handleError($error)
     *     }
     *     // Alternatively:
     *     // start the operation, keep the operation name, and resume later
     *     $operationResponse = $cloudRedisClient->exportInstance($name, $outputConfig);
     *     $operationName = $operationResponse->getName();
     *     // ... do other work
     *     $newOperationResponse = $cloudRedisClient->resumeOperation($operationName, 'exportInstance');
     *     while (!$newOperationResponse->isDone()) {
     *         // ... do other work
     *         $newOperationResponse->reload();
     *     }
     *     if ($newOperationResponse->operationSucceeded()) {
     *         $result = $newOperationResponse->getResult();
     *     // doSomethingWith($result)
     *     } else {
     *         $error = $newOperationResponse->getError();
     *         // handleError($error)
     *     }
     * } finally {
     *     $cloudRedisClient->close();
     * }
     * ```
     *
     * @param string       $name         Required. Redis instance resource name using the form:
     *                                   `projects/{project_id}/locations/{location_id}/instances/{instance_id}`
     *                                   where `location_id` refers to a GCP region.
     * @param OutputConfig $outputConfig Required. Specify data to be exported.
     * @param array        $optionalArgs {
     *     Optional.
     *
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\ApiCore\OperationResponse
     *
     * @throws ApiException if the remote call fails
     */
    public function exportInstance($name, $outputConfig, array $optionalArgs = [])
    {
        $request = new ExportInstanceRequest();
        $requestParamHeaders = [];
        $request->setName($name);
        $request->setOutputConfig($outputConfig);
        $requestParamHeaders['name'] = $name;
        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startOperationsCall('ExportInstance', $optionalArgs, $request, $this->getOperationsClient())->wait();
    }

    /**
     * Initiates a failover of the master node to current replica node for a
     * specific STANDARD tier Cloud Memorystore for Redis instance.
     *
     * Sample code:
     * ```
     * $cloudRedisClient = new CloudRedisClient();
     * try {
     *     $formattedName = $cloudRedisClient->instanceName('[PROJECT]', '[LOCATION]', '[INSTANCE]');
     *     $operationResponse = $cloudRedisClient->failoverInstance($formattedName);
     *     $operationResponse->pollUntilComplete();
     *     if ($operationResponse->operationSucceeded()) {
     *         $result = $operationResponse->getResult();
     *     // doSomethingWith($result)
     *     } else {
     *         $error = $operationResponse->getError();
     *         // handleError($error)
     *     }
     *     // Alternatively:
     *     // start the operation, keep the operation name, and resume later
     *     $operationResponse = $cloudRedisClient->failoverInstance($formattedName);
     *     $operationName = $operationResponse->getName();
     *     // ... do other work
     *     $newOperationResponse = $cloudRedisClient->resumeOperation($operationName, 'failoverInstance');
     *     while (!$newOperationResponse->isDone()) {
     *         // ... do other work
     *         $newOperationResponse->reload();
     *     }
     *     if ($newOperationResponse->operationSucceeded()) {
     *         $result = $newOperationResponse->getResult();
     *     // doSomethingWith($result)
     *     } else {
     *         $error = $newOperationResponse->getError();
     *         // handleError($error)
     *     }
     * } finally {
     *     $cloudRedisClient->close();
     * }
     * ```
     *
     * @param string $name         Required. Redis instance resource name using the form:
     *                             `projects/{project_id}/locations/{location_id}/instances/{instance_id}`
     *                             where `location_id` refers to a GCP region.
     * @param array  $optionalArgs {
     *     Optional.
     *
     *     @type int $dataProtectionMode
     *           Optional. Available data protection modes that the user can choose. If it's
     *           unspecified, data protection mode will be LIMITED_DATA_LOSS by default.
     *           For allowed values, use constants defined on {@see \Google\Cloud\Redis\V1\FailoverInstanceRequest\DataProtectionMode}
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\ApiCore\OperationResponse
     *
     * @throws ApiException if the remote call fails
     */
    public function failoverInstance($name, array $optionalArgs = [])
    {
        $request = new FailoverInstanceRequest();
        $requestParamHeaders = [];
        $request->setName($name);
        $requestParamHeaders['name'] = $name;
        if (isset($optionalArgs['dataProtectionMode'])) {
            $request->setDataProtectionMode($optionalArgs['dataProtectionMode']);
        }

        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startOperationsCall('FailoverInstance', $optionalArgs, $request, $this->getOperationsClient())->wait();
    }

    /**
     * Gets the details of a specific Redis instance.
     *
     * Sample code:
     * ```
     * $cloudRedisClient = new CloudRedisClient();
     * try {
     *     $formattedName = $cloudRedisClient->instanceName('[PROJECT]', '[LOCATION]', '[INSTANCE]');
     *     $response = $cloudRedisClient->getInstance($formattedName);
     * } finally {
     *     $cloudRedisClient->close();
     * }
     * ```
     *
     * @param string $name         Required. Redis instance resource name using the form:
     *                             `projects/{project_id}/locations/{location_id}/instances/{instance_id}`
     *                             where `location_id` refers to a GCP region.
     * @param array  $optionalArgs {
     *     Optional.
     *
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\Cloud\Redis\V1\Instance
     *
     * @throws ApiException if the remote call fails
     */
    public function getInstance($name, array $optionalArgs = [])
    {
        $request = new GetInstanceRequest();
        $requestParamHeaders = [];
        $request->setName($name);
        $requestParamHeaders['name'] = $name;
        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('GetInstance', Instance::class, $optionalArgs, $request)->wait();
    }

    /**
     * Import a Redis RDB snapshot file from Cloud Storage into a Redis instance.
     *
     * Redis may stop serving during this operation. Instance state will be
     * IMPORTING for entire operation. When complete, the instance will contain
     * only data from the imported file.
     *
     * The returned operation is automatically deleted after a few hours, so
     * there is no need to call DeleteOperation.
     *
     * Sample code:
     * ```
     * $cloudRedisClient = new CloudRedisClient();
     * try {
     *     $name = 'name';
     *     $inputConfig = new InputConfig();
     *     $operationResponse = $cloudRedisClient->importInstance($name, $inputConfig);
     *     $operationResponse->pollUntilComplete();
     *     if ($operationResponse->operationSucceeded()) {
     *         $result = $operationResponse->getResult();
     *     // doSomethingWith($result)
     *     } else {
     *         $error = $operationResponse->getError();
     *         // handleError($error)
     *     }
     *     // Alternatively:
     *     // start the operation, keep the operation name, and resume later
     *     $operationResponse = $cloudRedisClient->importInstance($name, $inputConfig);
     *     $operationName = $operationResponse->getName();
     *     // ... do other work
     *     $newOperationResponse = $cloudRedisClient->resumeOperation($operationName, 'importInstance');
     *     while (!$newOperationResponse->isDone()) {
     *         // ... do other work
     *         $newOperationResponse->reload();
     *     }
     *     if ($newOperationResponse->operationSucceeded()) {
     *         $result = $newOperationResponse->getResult();
     *     // doSomethingWith($result)
     *     } else {
     *         $error = $newOperationResponse->getError();
     *         // handleError($error)
     *     }
     * } finally {
     *     $cloudRedisClient->close();
     * }
     * ```
     *
     * @param string      $name         Required. Redis instance resource name using the form:
     *                                  `projects/{project_id}/locations/{location_id}/instances/{instance_id}`
     *                                  where `location_id` refers to a GCP region.
     * @param InputConfig $inputConfig  Required. Specify data to be imported.
     * @param array       $optionalArgs {
     *     Optional.
     *
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\ApiCore\OperationResponse
     *
     * @throws ApiException if the remote call fails
     */
    public function importInstance($name, $inputConfig, array $optionalArgs = [])
    {
        $request = new ImportInstanceRequest();
        $requestParamHeaders = [];
        $request->setName($name);
        $request->setInputConfig($inputConfig);
        $requestParamHeaders['name'] = $name;
        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startOperationsCall('ImportInstance', $optionalArgs, $request, $this->getOperationsClient())->wait();
    }

    /**
     * Lists all Redis instances owned by a project in either the specified
     * location (region) or all locations.
     *
     * The location should have the following format:
     *
     * * `projects/{project_id}/locations/{location_id}`
     *
     * If `location_id` is specified as `-` (wildcard), then all regions
     * available to the project are queried, and the results are aggregated.
     *
     * Sample code:
     * ```
     * $cloudRedisClient = new CloudRedisClient();
     * try {
     *     $formattedParent = $cloudRedisClient->locationName('[PROJECT]', '[LOCATION]');
     *     // Iterate over pages of elements
     *     $pagedResponse = $cloudRedisClient->listInstances($formattedParent);
     *     foreach ($pagedResponse->iteratePages() as $page) {
     *         foreach ($page as $element) {
     *             // doSomethingWith($element);
     *         }
     *     }
     *     // Alternatively:
     *     // Iterate through all elements
     *     $pagedResponse = $cloudRedisClient->listInstances($formattedParent);
     *     foreach ($pagedResponse->iterateAllElements() as $element) {
     *         // doSomethingWith($element);
     *     }
     * } finally {
     *     $cloudRedisClient->close();
     * }
     * ```
     *
     * @param string $parent       Required. The resource name of the instance location using the form:
     *                             `projects/{project_id}/locations/{location_id}`
     *                             where `location_id` refers to a GCP region.
     * @param array  $optionalArgs {
     *     Optional.
     *
     *     @type int $pageSize
     *           The maximum number of resources contained in the underlying API
     *           response. The API may return fewer values in a page, even if
     *           there are additional values to be retrieved.
     *     @type string $pageToken
     *           A page token is used to specify a page of values to be returned.
     *           If no page token is specified (the default), the first page
     *           of values will be returned. Any page token used here must have
     *           been generated by a previous call to the API.
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\ApiCore\PagedListResponse
     *
     * @throws ApiException if the remote call fails
     */
    public function listInstances($parent, array $optionalArgs = [])
    {
        $request = new ListInstancesRequest();
        $requestParamHeaders = [];
        $request->setParent($parent);
        $requestParamHeaders['parent'] = $parent;
        if (isset($optionalArgs['pageSize'])) {
            $request->setPageSize($optionalArgs['pageSize']);
        }

        if (isset($optionalArgs['pageToken'])) {
            $request->setPageToken($optionalArgs['pageToken']);
        }

        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->getPagedListResponse('ListInstances', $optionalArgs, ListInstancesResponse::class, $request);
    }

    /**
     * Updates the metadata and configuration of a specific Redis instance.
     *
     * Completed longrunning.Operation will contain the new instance object
     * in the response field. The returned operation is automatically deleted
     * after a few hours, so there is no need to call DeleteOperation.
     *
     * Sample code:
     * ```
     * $cloudRedisClient = new CloudRedisClient();
     * try {
     *     $updateMask = new FieldMask();
     *     $instance = new Instance();
     *     $operationResponse = $cloudRedisClient->updateInstance($updateMask, $instance);
     *     $operationResponse->pollUntilComplete();
     *     if ($operationResponse->operationSucceeded()) {
     *         $result = $operationResponse->getResult();
     *     // doSomethingWith($result)
     *     } else {
     *         $error = $operationResponse->getError();
     *         // handleError($error)
     *     }
     *     // Alternatively:
     *     // start the operation, keep the operation name, and resume later
     *     $operationResponse = $cloudRedisClient->updateInstance($updateMask, $instance);
     *     $operationName = $operationResponse->getName();
     *     // ... do other work
     *     $newOperationResponse = $cloudRedisClient->resumeOperation($operationName, 'updateInstance');
     *     while (!$newOperationResponse->isDone()) {
     *         // ... do other work
     *         $newOperationResponse->reload();
     *     }
     *     if ($newOperationResponse->operationSucceeded()) {
     *         $result = $newOperationResponse->getResult();
     *     // doSomethingWith($result)
     *     } else {
     *         $error = $newOperationResponse->getError();
     *         // handleError($error)
     *     }
     * } finally {
     *     $cloudRedisClient->close();
     * }
     * ```
     *
     * @param FieldMask $updateMask   Required. Mask of fields to update. At least one path must be supplied in
     *                                this field. The elements of the repeated paths field may only include these
     *                                fields from [Instance][google.cloud.redis.v1.Instance]:
     *
     *                                *   `displayName`
     *                                *   `labels`
     *                                *   `memorySizeGb`
     *                                *   `redisConfig`
     * @param Instance  $instance     Required. Update description.
     *                                Only fields specified in update_mask are updated.
     * @param array     $optionalArgs {
     *     Optional.
     *
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\ApiCore\OperationResponse
     *
     * @throws ApiException if the remote call fails
     */
    public function updateInstance($updateMask, $instance, array $optionalArgs = [])
    {
        $request = new UpdateInstanceRequest();
        $requestParamHeaders = [];
        $request->setUpdateMask($updateMask);
        $request->setInstance($instance);
        $requestParamHeaders['instance.name'] = $instance->getName();
        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startOperationsCall('UpdateInstance', $optionalArgs, $request, $this->getOperationsClient())->wait();
    }

    /**
     * Upgrades Redis instance to the newer Redis version specified in the
     * request.
     *
     * Sample code:
     * ```
     * $cloudRedisClient = new CloudRedisClient();
     * try {
     *     $formattedName = $cloudRedisClient->instanceName('[PROJECT]', '[LOCATION]', '[INSTANCE]');
     *     $redisVersion = 'redis_version';
     *     $operationResponse = $cloudRedisClient->upgradeInstance($formattedName, $redisVersion);
     *     $operationResponse->pollUntilComplete();
     *     if ($operationResponse->operationSucceeded()) {
     *         $result = $operationResponse->getResult();
     *     // doSomethingWith($result)
     *     } else {
     *         $error = $operationResponse->getError();
     *         // handleError($error)
     *     }
     *     // Alternatively:
     *     // start the operation, keep the operation name, and resume later
     *     $operationResponse = $cloudRedisClient->upgradeInstance($formattedName, $redisVersion);
     *     $operationName = $operationResponse->getName();
     *     // ... do other work
     *     $newOperationResponse = $cloudRedisClient->resumeOperation($operationName, 'upgradeInstance');
     *     while (!$newOperationResponse->isDone()) {
     *         // ... do other work
     *         $newOperationResponse->reload();
     *     }
     *     if ($newOperationResponse->operationSucceeded()) {
     *         $result = $newOperationResponse->getResult();
     *     // doSomethingWith($result)
     *     } else {
     *         $error = $newOperationResponse->getError();
     *         // handleError($error)
     *     }
     * } finally {
     *     $cloudRedisClient->close();
     * }
     * ```
     *
     * @param string $name         Required. Redis instance resource name using the form:
     *                             `projects/{project_id}/locations/{location_id}/instances/{instance_id}`
     *                             where `location_id` refers to a GCP region.
     * @param string $redisVersion Required. Specifies the target version of Redis software to upgrade to.
     * @param array  $optionalArgs {
     *     Optional.
     *
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\ApiCore\OperationResponse
     *
     * @throws ApiException if the remote call fails
     */
    public function upgradeInstance($name, $redisVersion, array $optionalArgs = [])
    {
        $request = new UpgradeInstanceRequest();
        $requestParamHeaders = [];
        $request->setName($name);
        $request->setRedisVersion($redisVersion);
        $requestParamHeaders['name'] = $name;
        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startOperationsCall('UpgradeInstance', $optionalArgs, $request, $this->getOperationsClient())->wait();
    }
}
