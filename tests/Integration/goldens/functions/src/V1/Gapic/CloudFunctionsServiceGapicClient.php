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
 * https://github.com/google/googleapis/blob/master/google/cloud/functions/v1/functions.proto
 * and updates to that file get reflected here through a refresh process.
 */

namespace Google\Cloud\Functions\V1\Gapic;

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
use Google\Cloud\Functions\V1\CallFunctionRequest;
use Google\Cloud\Functions\V1\CallFunctionResponse;
use Google\Cloud\Functions\V1\CloudFunction;
use Google\Cloud\Functions\V1\CreateFunctionRequest;
use Google\Cloud\Functions\V1\DeleteFunctionRequest;
use Google\Cloud\Functions\V1\GenerateDownloadUrlRequest;
use Google\Cloud\Functions\V1\GenerateDownloadUrlResponse;
use Google\Cloud\Functions\V1\GenerateUploadUrlRequest;
use Google\Cloud\Functions\V1\GenerateUploadUrlResponse;
use Google\Cloud\Functions\V1\GetFunctionRequest;
use Google\Cloud\Functions\V1\ListFunctionsRequest;
use Google\Cloud\Functions\V1\ListFunctionsResponse;
use Google\Cloud\Functions\V1\UpdateFunctionRequest;
use Google\Cloud\Iam\V1\GetIamPolicyRequest;
use Google\Cloud\Iam\V1\GetPolicyOptions;
use Google\Cloud\Iam\V1\Policy;
use Google\Cloud\Iam\V1\SetIamPolicyRequest;
use Google\Cloud\Iam\V1\TestIamPermissionsRequest;
use Google\Cloud\Iam\V1\TestIamPermissionsResponse;
use Google\LongRunning\Operation;
use Google\Protobuf\FieldMask;

/**
 * Service Description: A service that application uses to manipulate triggers and functions.
 *
 * This class provides the ability to make remote calls to the backing service through method
 * calls that map to API methods. Sample code to get started:
 *
 * ```
 * $cloudFunctionsServiceClient = new CloudFunctionsServiceClient();
 * try {
 *     $formattedName = $cloudFunctionsServiceClient->cloudFunctionName('[PROJECT]', '[LOCATION]', '[FUNCTION]');
 *     $data = 'data';
 *     $response = $cloudFunctionsServiceClient->callFunction($formattedName, $data);
 * } finally {
 *     $cloudFunctionsServiceClient->close();
 * }
 * ```
 *
 * Many parameters require resource names to be formatted in a particular way. To
 * assistwith these names, this class includes a format method for each type of
 * name, and additionallya parseName method to extract the individual identifiers
 * contained within formatted namesthat are returned by the API.
 */
class CloudFunctionsServiceGapicClient
{
    use GapicClientTrait;

    /**
     * The name of the service.
     */
    const SERVICE_NAME = 'google.cloud.functions.v1.CloudFunctionsService';

    /**
     * The default address of the service.
     */
    const SERVICE_ADDRESS = 'cloudfunctions.googleapis.com';

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

    private static $cloudFunctionNameTemplate;

    private static $locationNameTemplate;

    private static $pathTemplateMap;

    private $operationsClient;

    private static function getClientDefaults()
    {
        return [
            'serviceName' => self::SERVICE_NAME,
            'serviceAddress' => self::SERVICE_ADDRESS . ':' . self::DEFAULT_SERVICE_PORT,
            'clientConfig' => __DIR__ . '/../resources/cloud_functions_service_client_config.json',
            'descriptorsConfigPath' => __DIR__ . '/../resources/cloud_functions_service_descriptor_config.php',
            'gcpApiConfigPath' => __DIR__ . '/../resources/cloud_functions_service_grpc_config.json',
            'credentialsConfig' => [
                'defaultScopes' => self::$serviceScopes,
            ],
            'transportConfig' => [
                'rest' => [
                    'restClientConfigPath' => __DIR__ . '/../resources/cloud_functions_service_rest_client_config.php',
                ],
            ],
        ];
    }

    private static function getCloudFunctionNameTemplate()
    {
        if (self::$cloudFunctionNameTemplate == null) {
            self::$cloudFunctionNameTemplate = new PathTemplate('projects/{project}/locations/{location}/functions/{function}');
        }

        return self::$cloudFunctionNameTemplate;
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
                'cloudFunction' => self::getCloudFunctionNameTemplate(),
                'location' => self::getLocationNameTemplate(),
            ];
        }

        return self::$pathTemplateMap;
    }

    /**
     * Formats a string containing the fully-qualified path to represent a
     * cloud_function resource.
     *
     * @param string $project
     * @param string $location
     * @param string $function
     *
     * @return string The formatted cloud_function resource.
     */
    public static function cloudFunctionName($project, $location, $function)
    {
        return self::getCloudFunctionNameTemplate()->render([
            'project' => $project,
            'location' => $location,
            'function' => $function,
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
     * - cloudFunction: projects/{project}/locations/{location}/functions/{function}
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
     *           as "<uri>:<port>". Default 'cloudfunctions.googleapis.com:443'.
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
     * Synchronously invokes a deployed Cloud Function. To be used for testing
     * purposes as very limited traffic is allowed. For more information on
     * the actual limits, refer to
     * [Rate Limits](https://cloud.google.com/functions/quotas#rate_limits).
     *
     * Sample code:
     * ```
     * $cloudFunctionsServiceClient = new CloudFunctionsServiceClient();
     * try {
     *     $formattedName = $cloudFunctionsServiceClient->cloudFunctionName('[PROJECT]', '[LOCATION]', '[FUNCTION]');
     *     $data = 'data';
     *     $response = $cloudFunctionsServiceClient->callFunction($formattedName, $data);
     * } finally {
     *     $cloudFunctionsServiceClient->close();
     * }
     * ```
     *
     * @param string $name         Required. The name of the function to be called.
     * @param string $data         Required. Input to be passed to the function.
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
     * @return \Google\Cloud\Functions\V1\CallFunctionResponse
     *
     * @throws ApiException if the remote call fails
     */
    public function callFunction($name, $data, array $optionalArgs = [])
    {
        $request = new CallFunctionRequest();
        $requestParamHeaders = [];
        $request->setName($name);
        $request->setData($data);
        $requestParamHeaders['name'] = $name;
        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('CallFunction', CallFunctionResponse::class, $optionalArgs, $request)->wait();
    }

    /**
     * Creates a new function. If a function with the given name already exists in
     * the specified project, the long running operation will return
     * `ALREADY_EXISTS` error.
     *
     * Sample code:
     * ```
     * $cloudFunctionsServiceClient = new CloudFunctionsServiceClient();
     * try {
     *     $formattedLocation = $cloudFunctionsServiceClient->locationName('[PROJECT]', '[LOCATION]');
     *     $function = new CloudFunction();
     *     $operationResponse = $cloudFunctionsServiceClient->createFunction($formattedLocation, $function);
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
     *     $operationResponse = $cloudFunctionsServiceClient->createFunction($formattedLocation, $function);
     *     $operationName = $operationResponse->getName();
     *     // ... do other work
     *     $newOperationResponse = $cloudFunctionsServiceClient->resumeOperation($operationName, 'createFunction');
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
     *     $cloudFunctionsServiceClient->close();
     * }
     * ```
     *
     * @param string        $location     Required. The project and location in which the function should be created, specified
     *                                    in the format `projects/&#42;/locations/*`
     * @param CloudFunction $function     Required. Function to be created.
     * @param array         $optionalArgs {
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
    public function createFunction($location, $function, array $optionalArgs = [])
    {
        $request = new CreateFunctionRequest();
        $requestParamHeaders = [];
        $request->setLocation($location);
        $request->setFunction($function);
        $requestParamHeaders['location'] = $location;
        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startOperationsCall('CreateFunction', $optionalArgs, $request, $this->getOperationsClient())->wait();
    }

    /**
     * Deletes a function with the given name from the specified project. If the
     * given function is used by some trigger, the trigger will be updated to
     * remove this function.
     *
     * Sample code:
     * ```
     * $cloudFunctionsServiceClient = new CloudFunctionsServiceClient();
     * try {
     *     $formattedName = $cloudFunctionsServiceClient->cloudFunctionName('[PROJECT]', '[LOCATION]', '[FUNCTION]');
     *     $operationResponse = $cloudFunctionsServiceClient->deleteFunction($formattedName);
     *     $operationResponse->pollUntilComplete();
     *     if ($operationResponse->operationSucceeded()) {
     *         // operation succeeded and returns no value
     *     } else {
     *         $error = $operationResponse->getError();
     *         // handleError($error)
     *     }
     *     // Alternatively:
     *     // start the operation, keep the operation name, and resume later
     *     $operationResponse = $cloudFunctionsServiceClient->deleteFunction($formattedName);
     *     $operationName = $operationResponse->getName();
     *     // ... do other work
     *     $newOperationResponse = $cloudFunctionsServiceClient->resumeOperation($operationName, 'deleteFunction');
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
     *     $cloudFunctionsServiceClient->close();
     * }
     * ```
     *
     * @param string $name         Required. The name of the function which should be deleted.
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
    public function deleteFunction($name, array $optionalArgs = [])
    {
        $request = new DeleteFunctionRequest();
        $requestParamHeaders = [];
        $request->setName($name);
        $requestParamHeaders['name'] = $name;
        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startOperationsCall('DeleteFunction', $optionalArgs, $request, $this->getOperationsClient())->wait();
    }

    /**
     * Returns a signed URL for downloading deployed function source code.
     * The URL is only valid for a limited period and should be used within
     * minutes after generation.
     * For more information about the signed URL usage see:
     * https://cloud.google.com/storage/docs/access-control/signed-urls
     *
     * Sample code:
     * ```
     * $cloudFunctionsServiceClient = new CloudFunctionsServiceClient();
     * try {
     *     $response = $cloudFunctionsServiceClient->generateDownloadUrl();
     * } finally {
     *     $cloudFunctionsServiceClient->close();
     * }
     * ```
     *
     * @param array $optionalArgs {
     *     Optional.
     *
     *     @type string $name
     *           The name of function for which source code Google Cloud Storage signed
     *           URL should be generated.
     *     @type int $versionId
     *           The optional version of function. If not set, default, current version
     *           is used.
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\Cloud\Functions\V1\GenerateDownloadUrlResponse
     *
     * @throws ApiException if the remote call fails
     */
    public function generateDownloadUrl(array $optionalArgs = [])
    {
        $request = new GenerateDownloadUrlRequest();
        $requestParamHeaders = [];
        if (isset($optionalArgs['name'])) {
            $request->setName($optionalArgs['name']);
            $requestParamHeaders['name'] = $optionalArgs['name'];
        }

        if (isset($optionalArgs['versionId'])) {
            $request->setVersionId($optionalArgs['versionId']);
        }

        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('GenerateDownloadUrl', GenerateDownloadUrlResponse::class, $optionalArgs, $request)->wait();
    }

    /**
     * Returns a signed URL for uploading a function source code.
     * For more information about the signed URL usage see:
     * https://cloud.google.com/storage/docs/access-control/signed-urls.
     * Once the function source code upload is complete, the used signed
     * URL should be provided in CreateFunction or UpdateFunction request
     * as a reference to the function source code.
     *
     * When uploading source code to the generated signed URL, please follow
     * these restrictions:
     *
     * * Source file type should be a zip file.
     * * Source file size should not exceed 100MB limit.
     * * No credentials should be attached - the signed URLs provide access to the
     * target bucket using internal service identity; if credentials were
     * attached, the identity from the credentials would be used, but that
     * identity does not have permissions to upload files to the URL.
     *
     * When making a HTTP PUT request, these two headers need to be specified:
     *
     * * `content-type: application/zip`
     * * `x-goog-content-length-range: 0,104857600`
     *
     * And this header SHOULD NOT be specified:
     *
     * * `Authorization: Bearer YOUR_TOKEN`
     *
     * Sample code:
     * ```
     * $cloudFunctionsServiceClient = new CloudFunctionsServiceClient();
     * try {
     *     $response = $cloudFunctionsServiceClient->generateUploadUrl();
     * } finally {
     *     $cloudFunctionsServiceClient->close();
     * }
     * ```
     *
     * @param array $optionalArgs {
     *     Optional.
     *
     *     @type string $parent
     *           The project and location in which the Google Cloud Storage signed URL
     *           should be generated, specified in the format `projects/&#42;/locations/*`.
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\Cloud\Functions\V1\GenerateUploadUrlResponse
     *
     * @throws ApiException if the remote call fails
     */
    public function generateUploadUrl(array $optionalArgs = [])
    {
        $request = new GenerateUploadUrlRequest();
        $requestParamHeaders = [];
        if (isset($optionalArgs['parent'])) {
            $request->setParent($optionalArgs['parent']);
            $requestParamHeaders['parent'] = $optionalArgs['parent'];
        }

        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('GenerateUploadUrl', GenerateUploadUrlResponse::class, $optionalArgs, $request)->wait();
    }

    /**
     * Returns a function with the given name from the requested project.
     *
     * Sample code:
     * ```
     * $cloudFunctionsServiceClient = new CloudFunctionsServiceClient();
     * try {
     *     $formattedName = $cloudFunctionsServiceClient->cloudFunctionName('[PROJECT]', '[LOCATION]', '[FUNCTION]');
     *     $response = $cloudFunctionsServiceClient->getFunction($formattedName);
     * } finally {
     *     $cloudFunctionsServiceClient->close();
     * }
     * ```
     *
     * @param string $name         Required. The name of the function which details should be obtained.
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
     * @return \Google\Cloud\Functions\V1\CloudFunction
     *
     * @throws ApiException if the remote call fails
     */
    public function getFunction($name, array $optionalArgs = [])
    {
        $request = new GetFunctionRequest();
        $requestParamHeaders = [];
        $request->setName($name);
        $requestParamHeaders['name'] = $name;
        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('GetFunction', CloudFunction::class, $optionalArgs, $request)->wait();
    }

    /**
     * Gets the IAM access control policy for a function.
     * Returns an empty policy if the function exists and does not have a policy
     * set.
     *
     * Sample code:
     * ```
     * $cloudFunctionsServiceClient = new CloudFunctionsServiceClient();
     * try {
     *     $resource = 'resource';
     *     $response = $cloudFunctionsServiceClient->getIamPolicy($resource);
     * } finally {
     *     $cloudFunctionsServiceClient->close();
     * }
     * ```
     *
     * @param string $resource     REQUIRED: The resource for which the policy is being requested.
     *                             See the operation documentation for the appropriate value for this field.
     * @param array  $optionalArgs {
     *     Optional.
     *
     *     @type GetPolicyOptions $options
     *           OPTIONAL: A `GetPolicyOptions` object for specifying options to
     *           `GetIamPolicy`. This field is only used by Cloud IAM.
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\Cloud\Iam\V1\Policy
     *
     * @throws ApiException if the remote call fails
     */
    public function getIamPolicy($resource, array $optionalArgs = [])
    {
        $request = new GetIamPolicyRequest();
        $requestParamHeaders = [];
        $request->setResource($resource);
        $requestParamHeaders['resource'] = $resource;
        if (isset($optionalArgs['options'])) {
            $request->setOptions($optionalArgs['options']);
        }

        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('GetIamPolicy', Policy::class, $optionalArgs, $request)->wait();
    }

    /**
     * Returns a list of functions that belong to the requested project.
     *
     * Sample code:
     * ```
     * $cloudFunctionsServiceClient = new CloudFunctionsServiceClient();
     * try {
     *     // Iterate over pages of elements
     *     $pagedResponse = $cloudFunctionsServiceClient->listFunctions();
     *     foreach ($pagedResponse->iteratePages() as $page) {
     *         foreach ($page as $element) {
     *             // doSomethingWith($element);
     *         }
     *     }
     *     // Alternatively:
     *     // Iterate through all elements
     *     $pagedResponse = $cloudFunctionsServiceClient->listFunctions();
     *     foreach ($pagedResponse->iterateAllElements() as $element) {
     *         // doSomethingWith($element);
     *     }
     * } finally {
     *     $cloudFunctionsServiceClient->close();
     * }
     * ```
     *
     * @param array $optionalArgs {
     *     Optional.
     *
     *     @type string $parent
     *           The project and location from which the function should be listed,
     *           specified in the format `projects/&#42;/locations/*`
     *           If you want to list functions in all locations, use "-" in place of a
     *           location. When listing functions in all locations, if one or more
     *           location(s) are unreachable, the response will contain functions from all
     *           reachable locations along with the names of any unreachable locations.
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
    public function listFunctions(array $optionalArgs = [])
    {
        $request = new ListFunctionsRequest();
        $requestParamHeaders = [];
        if (isset($optionalArgs['parent'])) {
            $request->setParent($optionalArgs['parent']);
            $requestParamHeaders['parent'] = $optionalArgs['parent'];
        }

        if (isset($optionalArgs['pageSize'])) {
            $request->setPageSize($optionalArgs['pageSize']);
        }

        if (isset($optionalArgs['pageToken'])) {
            $request->setPageToken($optionalArgs['pageToken']);
        }

        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->getPagedListResponse('ListFunctions', $optionalArgs, ListFunctionsResponse::class, $request);
    }

    /**
     * Sets the IAM access control policy on the specified function.
     * Replaces any existing policy.
     *
     * Sample code:
     * ```
     * $cloudFunctionsServiceClient = new CloudFunctionsServiceClient();
     * try {
     *     $resource = 'resource';
     *     $policy = new Policy();
     *     $response = $cloudFunctionsServiceClient->setIamPolicy($resource, $policy);
     * } finally {
     *     $cloudFunctionsServiceClient->close();
     * }
     * ```
     *
     * @param string $resource     REQUIRED: The resource for which the policy is being specified.
     *                             See the operation documentation for the appropriate value for this field.
     * @param Policy $policy       REQUIRED: The complete policy to be applied to the `resource`. The size of
     *                             the policy is limited to a few 10s of KB. An empty policy is a
     *                             valid policy but certain Cloud Platform services (such as Projects)
     *                             might reject them.
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
     * @return \Google\Cloud\Iam\V1\Policy
     *
     * @throws ApiException if the remote call fails
     */
    public function setIamPolicy($resource, $policy, array $optionalArgs = [])
    {
        $request = new SetIamPolicyRequest();
        $requestParamHeaders = [];
        $request->setResource($resource);
        $request->setPolicy($policy);
        $requestParamHeaders['resource'] = $resource;
        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('SetIamPolicy', Policy::class, $optionalArgs, $request)->wait();
    }

    /**
     * Tests the specified permissions against the IAM access control policy
     * for a function.
     * If the function does not exist, this will return an empty set of
     * permissions, not a NOT_FOUND error.
     *
     * Sample code:
     * ```
     * $cloudFunctionsServiceClient = new CloudFunctionsServiceClient();
     * try {
     *     $resource = 'resource';
     *     $permissions = [];
     *     $response = $cloudFunctionsServiceClient->testIamPermissions($resource, $permissions);
     * } finally {
     *     $cloudFunctionsServiceClient->close();
     * }
     * ```
     *
     * @param string   $resource     REQUIRED: The resource for which the policy detail is being requested.
     *                               See the operation documentation for the appropriate value for this field.
     * @param string[] $permissions  The set of permissions to check for the `resource`. Permissions with
     *                               wildcards (such as '*' or 'storage.*') are not allowed. For more
     *                               information see
     *                               [IAM Overview](https://cloud.google.com/iam/docs/overview#permissions).
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
     * @return \Google\Cloud\Iam\V1\TestIamPermissionsResponse
     *
     * @throws ApiException if the remote call fails
     */
    public function testIamPermissions($resource, $permissions, array $optionalArgs = [])
    {
        $request = new TestIamPermissionsRequest();
        $requestParamHeaders = [];
        $request->setResource($resource);
        $request->setPermissions($permissions);
        $requestParamHeaders['resource'] = $resource;
        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('TestIamPermissions', TestIamPermissionsResponse::class, $optionalArgs, $request)->wait();
    }

    /**
     * Updates existing function.
     *
     * Sample code:
     * ```
     * $cloudFunctionsServiceClient = new CloudFunctionsServiceClient();
     * try {
     *     $function = new CloudFunction();
     *     $operationResponse = $cloudFunctionsServiceClient->updateFunction($function);
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
     *     $operationResponse = $cloudFunctionsServiceClient->updateFunction($function);
     *     $operationName = $operationResponse->getName();
     *     // ... do other work
     *     $newOperationResponse = $cloudFunctionsServiceClient->resumeOperation($operationName, 'updateFunction');
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
     *     $cloudFunctionsServiceClient->close();
     * }
     * ```
     *
     * @param CloudFunction $function     Required. New version of the function.
     * @param array         $optionalArgs {
     *     Optional.
     *
     *     @type FieldMask $updateMask
     *           Required list of fields to be updated in this request.
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
    public function updateFunction($function, array $optionalArgs = [])
    {
        $request = new UpdateFunctionRequest();
        $requestParamHeaders = [];
        $request->setFunction($function);
        $requestParamHeaders['function.name'] = $function->getName();
        if (isset($optionalArgs['updateMask'])) {
            $request->setUpdateMask($optionalArgs['updateMask']);
        }

        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startOperationsCall('UpdateFunction', $optionalArgs, $request, $this->getOperationsClient())->wait();
    }
}
