<?php
/*
 * Copyright 2020 Google LLC
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
 * https://github.com/google/googleapis/blob/master/google/cloud/talent/v4/tenant_service.proto
 * and updates to that file get reflected here through a refresh process.
 *
 * @experimental
 */

namespace Google\Cloud\Talent\V4\Gapic;

use Google\ApiCore\ApiException;
use Google\ApiCore\CredentialsWrapper;
use Google\ApiCore\GapicClientTrait;
use Google\ApiCore\PathTemplate;
use Google\ApiCore\RequestParamsHeaderDescriptor;
use Google\ApiCore\RetrySettings;
use Google\ApiCore\Transport\TransportInterface;
use Google\ApiCore\ValidationException;
use Google\Auth\FetchAuthTokenInterface;
use Google\Cloud\Talent\V4\CreateTenantRequest;
use Google\Cloud\Talent\V4\DeleteTenantRequest;
use Google\Cloud\Talent\V4\GetTenantRequest;
use Google\Cloud\Talent\V4\ListTenantsRequest;
use Google\Cloud\Talent\V4\ListTenantsResponse;
use Google\Cloud\Talent\V4\Tenant;
use Google\Cloud\Talent\V4\TenantServiceGrpcClient;
use Google\Cloud\Talent\V4\UpdateTenantRequest;
use Google\Protobuf\FieldMask;
use Google\Protobuf\GPBEmpty;

/**
 * Service Description: A service that handles tenant management, including CRUD and enumeration.
 *
 * This class provides the ability to make remote calls to the backing service through method
 * calls that map to API methods. Sample code to get started:
 *
 * ```
 * $tenantServiceClient = new TenantServiceClient();
 * try {
 *     $formattedParent = $tenantServiceClient->projectName('[PROJECT]');
 *     $tenant = new Tenant();
 *     $response = $tenantServiceClient->createTenant($formattedParent, $tenant);
 * } finally {
 *     $tenantServiceClient->close();
 * }
 * ```
 *
 * Many parameters require resource names to be formatted in a particular way. To
 * assistwith these names, this class includes a format method for each type of
 * name, and additionallya parseName method to extract the individual identifiers
 * contained within formatted namesthat are returned by the API.
 *
 * @experimental
 */
class TenantServiceGapicClient
{
    use GapicClientTrait;

    /** The name of the service. */
    const SERVICE_NAME = 'google.cloud.talent.v4.TenantService';

    /** The default address of the service. */
    const SERVICE_ADDRESS = 'jobs.googleapis.com';

    /** The default port of the service. */
    const DEFAULT_SERVICE_PORT = 443;

    /** The name of the code generator, to be included in the agent header. */
    const CODEGEN_NAME = 'gapic';

    /** The default scopes required by the service. */
    public static $serviceScopes = [
        'https://www.googleapis.com/auth/cloud-platform',
        'https://www.googleapis.com/auth/jobs',
    ];

    private static $projectNameTemplate;

    private static $tenantNameTemplate;

    private static $pathTemplateMap;

    private static function getClientDefaults()
    {
        return [
            'serviceName' => self::SERVICE_NAME,
            'serviceAddress' => self::SERVICE_ADDRESS . ':' . self::DEFAULT_SERVICE_PORT,
            'clientConfig' => __DIR__ . '/../resources/tenant_service_client_config.json',
            'descriptorsConfigPath' => __DIR__ . '/../resources/tenant_service_descriptor_config.php',
            'gcpApiConfigPath' => __DIR__ . '/../resources/tenant_service_grpc_config.json',
            'credentialsConfig' => [
                'defaultScopes' => self::$serviceScopes,
            ],
            'transportConfig' => [
                'rest' => [
                    'restClientConfigPath' => __DIR__ . '/../resources/tenant_service_rest_client_config.php',
                ],
            ],
        ];
    }

    private static function getProjectNameTemplate()
    {
        if (self::$projectNameTemplate == null) {
            self::$projectNameTemplate = new PathTemplate('projects/{project}');
        }

        return self::$projectNameTemplate;
    }

    private static function getTenantNameTemplate()
    {
        if (self::$tenantNameTemplate == null) {
            self::$tenantNameTemplate = new PathTemplate('projects/{project}/tenants/{tenant}');
        }

        return self::$tenantNameTemplate;
    }

    private static function getPathTemplateMap()
    {
        if (self::$pathTemplateMap == null) {
            self::$pathTemplateMap = [
                'project' => self::getProjectNameTemplate(),
                'tenant' => self::getTenantNameTemplate(),
            ];
        }

        return self::$pathTemplateMap;
    }

    /**
     * Formats a string containing the fully-qualified path to represent a project
     * resource.
     *
     * @param string $project
     *
     * @return string The formatted project resource.
     *
     * @experimental
     */
    public static function projectName($project)
    {
        return self::getProjectNameTemplate()->render([
            'project' => $project,
        ]);
    }

    /**
     * Formats a string containing the fully-qualified path to represent a tenant
     * resource.
     *
     * @param string $project
     * @param string $tenant
     *
     * @return string The formatted tenant resource.
     *
     * @experimental
     */
    public static function tenantName($project, $tenant)
    {
        return self::getTenantNameTemplate()->render([
            'project' => $project,
            'tenant' => $tenant,
        ]);
    }

    /**
     * Parses a formatted name string and returns an associative array of the components in the name.
     * The following name formats are supported:
     * Template: Pattern
     * - project: projects/{project}
     * - tenant: projects/{project}/tenants/{tenant}
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
     *
     * @experimental
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
     * Constructor.
     *
     * @param array $options {
     *     Optional. Options for configuring the service API wrapper.
     *
     *     @type string $serviceAddress
     *           The address of the API remote host. May optionally include the port, formatted
     *           as "<uri>:<port>". Default 'jobs.googleapis.com:443'.
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
     *
     * @experimental
     */
    public function __construct(array $options = [])
    {
        $clientOptions = $this->buildClientOptions($options);
        $this->setClientOptions($clientOptions);
    }

    /**
     * Creates a new tenant entity.
     *
     * Sample code:
     * ```
     * $tenantServiceClient = new TenantServiceClient();
     * try {
     *     $formattedParent = $tenantServiceClient->projectName('[PROJECT]');
     *     $tenant = new Tenant();
     *     $response = $tenantServiceClient->createTenant($formattedParent, $tenant);
     * } finally {
     *     $tenantServiceClient->close();
     * }
     * ```
     *
     * @param string $parent       Required. Resource name of the project under which the tenant is created.
     *
     *                             The format is "projects/{project_id}", for example,
     *                             "projects/foo".
     * @param Tenant $tenant       Required. The tenant to be created.
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
     * @return \Google\Cloud\Talent\V4\Tenant
     *
     * @throws ApiException if the remote call fails
     *
     * @experimental
     */
    public function createTenant($parent, $tenant, array $optionalArgs = [])
    {
        $request = new CreateTenantRequest();
        $request->setParent($parent);
        $request->setTenant($tenant);
        $requestParams = new RequestParamsHeaderDescriptor([
            'parent' => $request->getParent(),
        ]);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('CreateTenant', Tenant::class, $optionalArgs, $request)->wait();
    }

    /**
     * Retrieves specified tenant.
     *
     * Sample code:
     * ```
     * $tenantServiceClient = new TenantServiceClient();
     * try {
     *     $formattedName = $tenantServiceClient->tenantName('[PROJECT]', '[TENANT]');
     *     $response = $tenantServiceClient->getTenant($formattedName);
     * } finally {
     *     $tenantServiceClient->close();
     * }
     * ```
     *
     * @param string $name         Required. The resource name of the tenant to be retrieved.
     *
     *                             The format is "projects/{project_id}/tenants/{tenant_id}", for example,
     *                             "projects/foo/tenants/bar".
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
     * @return \Google\Cloud\Talent\V4\Tenant
     *
     * @throws ApiException if the remote call fails
     *
     * @experimental
     */
    public function getTenant($name, array $optionalArgs = [])
    {
        $request = new GetTenantRequest();
        $request->setName($name);
        $requestParams = new RequestParamsHeaderDescriptor([
            'name' => $request->getName(),
        ]);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('GetTenant', Tenant::class, $optionalArgs, $request)->wait();
    }

    /**
     * Updates specified tenant.
     *
     * Sample code:
     * ```
     * $tenantServiceClient = new TenantServiceClient();
     * try {
     *     $tenant = new Tenant();
     *     $response = $tenantServiceClient->updateTenant($tenant);
     * } finally {
     *     $tenantServiceClient->close();
     * }
     * ```
     *
     * @param Tenant $tenant       Required. The tenant resource to replace the current resource in the system.
     * @param array  $optionalArgs {
     *     Optional.
     *
     *     @type FieldMask $updateMask
     *           Strongly recommended for the best service experience.
     *
     *           If [update_mask][google.cloud.talent.v4.UpdateTenantRequest.update_mask] is provided, only the specified fields in
     *           [tenant][google.cloud.talent.v4.UpdateTenantRequest.tenant] are updated. Otherwise all the fields are updated.
     *
     *           A field mask to specify the tenant fields to be updated. Only
     *           top level fields of [Tenant][google.cloud.talent.v4.Tenant] are supported.
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\Cloud\Talent\V4\Tenant
     *
     * @throws ApiException if the remote call fails
     *
     * @experimental
     */
    public function updateTenant($tenant, array $optionalArgs = [])
    {
        $request = new UpdateTenantRequest();
        $request->setTenant($tenant);
        if (isset($optionalArgs['updateMask'])) {
            $request->setUpdateMask($optionalArgs['updateMask']);
        }

        $requestParams = new RequestParamsHeaderDescriptor([
            'tenant.name' => $request->getTenant()->getName(),
        ]);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('UpdateTenant', Tenant::class, $optionalArgs, $request)->wait();
    }

    /**
     * Deletes specified tenant.
     *
     * Sample code:
     * ```
     * $tenantServiceClient = new TenantServiceClient();
     * try {
     *     $formattedName = $tenantServiceClient->tenantName('[PROJECT]', '[TENANT]');
     *     $tenantServiceClient->deleteTenant($formattedName);
     * } finally {
     *     $tenantServiceClient->close();
     * }
     * ```
     *
     * @param string $name         Required. The resource name of the tenant to be deleted.
     *
     *                             The format is "projects/{project_id}/tenants/{tenant_id}", for example,
     *                             "projects/foo/tenants/bar".
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
     * @throws ApiException if the remote call fails
     *
     * @experimental
     */
    public function deleteTenant($name, array $optionalArgs = [])
    {
        $request = new DeleteTenantRequest();
        $request->setName($name);
        $requestParams = new RequestParamsHeaderDescriptor([
            'name' => $request->getName(),
        ]);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('DeleteTenant', GPBEmpty::class, $optionalArgs, $request)->wait();
    }

    /**
     * Lists all tenants associated with the project.
     *
     * Sample code:
     * ```
     * $tenantServiceClient = new TenantServiceClient();
     * try {
     *     $formattedParent = $tenantServiceClient->projectName('[PROJECT]');
     *     // Iterate over pages of elements
     *     $pagedResponse = $tenantServiceClient->listTenants($formattedParent);
     *     foreach ($pagedResponse->iteratePages() as $page) {
     *         foreach ($page as $element) {
     *             // doSomethingWith($element);
     *         }
     *     }
     *     // Alternatively:
     *     // Iterate through all elements
     *     $pagedResponse = $tenantServiceClient->listTenants($formattedParent);
     *     foreach ($pagedResponse->iterateAllElements() as $element) {
     *         // doSomethingWith($element);
     *     }
     * } finally {
     *     $tenantServiceClient->close();
     * }
     * ```
     *
     * @param string $parent       Required. Resource name of the project under which the tenant is created.
     *
     *                             The format is "projects/{project_id}", for example,
     *                             "projects/foo".
     * @param array  $optionalArgs {
     *     Optional.
     *
     *     @type string $pageToken
     *           A page token is used to specify a page of values to be returned.
     *           If no page token is specified (the default), the first page
     *           of values will be returned. Any page token used here must have
     *           been generated by a previous call to the API.
     *     @type int $pageSize
     *           The maximum number of resources contained in the underlying API
     *           response. The API may return fewer values in a page, even if
     *           there are additional values to be retrieved.
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
     *
     * @experimental
     */
    public function listTenants($parent, array $optionalArgs = [])
    {
        $request = new ListTenantsRequest();
        $request->setParent($parent);
        if (isset($optionalArgs['pageToken'])) {
            $request->setPageToken($optionalArgs['pageToken']);
        }

        if (isset($optionalArgs['pageSize'])) {
            $request->setPageSize($optionalArgs['pageSize']);
        }

        $requestParams = new RequestParamsHeaderDescriptor([
            'parent' => $request->getParent(),
        ]);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->getPagedListResponse('ListTenants', $optionalArgs, ListTenantsResponse::class, $request);
    }
}
