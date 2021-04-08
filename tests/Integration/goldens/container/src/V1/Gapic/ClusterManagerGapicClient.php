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
 * https://github.com/google/googleapis/blob/master/google/container/v1/cluster_service.proto
 * and updates to that file get reflected here through a refresh process.
 */

declare(strict_types=1);

namespace Google\Cloud\Container\V1\Gapic;

use Google\ApiCore\ApiException;
use Google\ApiCore\CredentialsWrapper;

use Google\ApiCore\GapicClientTrait;
use Google\ApiCore\RequestParamsHeaderDescriptor;
use Google\ApiCore\RetrySettings;
use Google\ApiCore\Transport\TransportInterface;
use Google\ApiCore\ValidationException;
use Google\Auth\FetchAuthTokenInterface;
use Google\Cloud\Container\V1\AddonsConfig;
use Google\Cloud\Container\V1\CancelOperationRequest;
use Google\Cloud\Container\V1\Cluster;
use Google\Cloud\Container\V1\ClusterUpdate;
use Google\Cloud\Container\V1\CompleteIPRotationRequest;
use Google\Cloud\Container\V1\CreateClusterRequest;
use Google\Cloud\Container\V1\CreateNodePoolRequest;
use Google\Cloud\Container\V1\DeleteClusterRequest;
use Google\Cloud\Container\V1\DeleteNodePoolRequest;
use Google\Cloud\Container\V1\GetClusterRequest;
use Google\Cloud\Container\V1\GetJSONWebKeysRequest;
use Google\Cloud\Container\V1\GetJSONWebKeysResponse;

use Google\Cloud\Container\V1\GetNodePoolRequest;
use Google\Cloud\Container\V1\GetOperationRequest;
use Google\Cloud\Container\V1\GetServerConfigRequest;
use Google\Cloud\Container\V1\ListClustersRequest;
use Google\Cloud\Container\V1\ListClustersResponse;
use Google\Cloud\Container\V1\ListNodePoolsRequest;
use Google\Cloud\Container\V1\ListNodePoolsResponse;
use Google\Cloud\Container\V1\ListOperationsRequest;
use Google\Cloud\Container\V1\ListOperationsResponse;
use Google\Cloud\Container\V1\ListUsableSubnetworksRequest;
use Google\Cloud\Container\V1\ListUsableSubnetworksResponse;
use Google\Cloud\Container\V1\MaintenancePolicy;
use Google\Cloud\Container\V1\MasterAuth;
use Google\Cloud\Container\V1\NetworkPolicy;
use Google\Cloud\Container\V1\NodeManagement;
use Google\Cloud\Container\V1\NodePool;
use Google\Cloud\Container\V1\NodePool\UpgradeSettings;
use Google\Cloud\Container\V1\NodePoolAutoscaling;
use Google\Cloud\Container\V1\Operation;
use Google\Cloud\Container\V1\RollbackNodePoolUpgradeRequest;
use Google\Cloud\Container\V1\ServerConfig;
use Google\Cloud\Container\V1\SetAddonsConfigRequest;
use Google\Cloud\Container\V1\SetLabelsRequest;
use Google\Cloud\Container\V1\SetLegacyAbacRequest;
use Google\Cloud\Container\V1\SetLocationsRequest;
use Google\Cloud\Container\V1\SetLoggingServiceRequest;
use Google\Cloud\Container\V1\SetMaintenancePolicyRequest;
use Google\Cloud\Container\V1\SetMasterAuthRequest;
use Google\Cloud\Container\V1\SetMasterAuthRequest\Action;
use Google\Cloud\Container\V1\SetMonitoringServiceRequest;
use Google\Cloud\Container\V1\SetNetworkPolicyRequest;
use Google\Cloud\Container\V1\SetNodePoolAutoscalingRequest;
use Google\Cloud\Container\V1\SetNodePoolManagementRequest;
use Google\Cloud\Container\V1\SetNodePoolSizeRequest;
use Google\Cloud\Container\V1\StartIPRotationRequest;
use Google\Cloud\Container\V1\UpdateClusterRequest;
use Google\Cloud\Container\V1\UpdateMasterRequest;
use Google\Cloud\Container\V1\UpdateNodePoolRequest;
use Google\Cloud\Container\V1\WorkloadMetadataConfig;
use Google\Protobuf\GPBEmpty;

/**
 * Service Description: Google Kubernetes Engine Cluster Manager v1
 *
 * This class provides the ability to make remote calls to the backing service through method
 * calls that map to API methods. Sample code to get started:
 *
 * ```
 * $clusterManagerClient = new ClusterManagerClient();
 * try {
 *     $clusterManagerClient->cancelOperation();
 * } finally {
 *     $clusterManagerClient->close();
 * }
 * ```
 */
class ClusterManagerGapicClient
{
    use GapicClientTrait;

    /**
     * The name of the service.
     */
    const SERVICE_NAME = 'google.container.v1.ClusterManager';

    /**
     * The default address of the service.
     */
    const SERVICE_ADDRESS = 'container.googleapis.com';

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

    private static function getClientDefaults()
    {
        return [
            'serviceName' => self::SERVICE_NAME,
            'serviceAddress' => self::SERVICE_ADDRESS . ':' . self::DEFAULT_SERVICE_PORT,
            'clientConfig' => __DIR__ . '/../resources/cluster_manager_client_config.json',
            'descriptorsConfigPath' => __DIR__ . '/../resources/cluster_manager_descriptor_config.php',
            'gcpApiConfigPath' => __DIR__ . '/../resources/cluster_manager_grpc_config.json',
            'credentialsConfig' => [
                'defaultScopes' => self::$serviceScopes,
            ],
            'transportConfig' => [
                'rest' => [
                    'restClientConfigPath' => __DIR__ . '/../resources/cluster_manager_rest_client_config.php',
                ],
            ],
        ];
    }

    /**
     * Constructor.
     *
     * @param array $options {
     *     Optional. Options for configuring the service API wrapper.
     *
     *     @type string $serviceAddress
     *           The address of the API remote host. May optionally include the port, formatted
     *           as "<uri>:<port>". Default 'container.googleapis.com:443'.
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
    }

    /**
     * Cancels the specified operation.
     *
     * Sample code:
     * ```
     * $clusterManagerClient = new ClusterManagerClient();
     * try {
     *     $clusterManagerClient->cancelOperation();
     * } finally {
     *     $clusterManagerClient->close();
     * }
     * ```
     *
     * @param array $optionalArgs {
     *     Optional.
     *
     *     @type string $projectId
     *           Deprecated. The Google Developers Console [project ID or project
     *           number](https://support.google.com/cloud/answer/6158840).
     *           This field has been deprecated and replaced by the name field.
     *     @type string $zone
     *           Deprecated. The name of the Google Compute Engine
     *           [zone](https://cloud.google.com/compute/docs/zones#available) in which the
     *           operation resides. This field has been deprecated and replaced by the name
     *           field.
     *     @type string $operationId
     *           Deprecated. The server-assigned `name` of the operation.
     *           This field has been deprecated and replaced by the name field.
     *     @type string $name
     *           The name (project, location, operation id) of the operation to cancel.
     *           Specified in the format `projects/&#42;/locations/&#42;/operations/*`.
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @throws ApiException if the remote call fails
     */
    public function cancelOperation(array $optionalArgs = [])
    {
        $request = new CancelOperationRequest();
        $requestParamHeaders = [];
        if (isset($optionalArgs['projectId'])) {
            $request->setProjectId($optionalArgs['projectId']);
            $requestParamHeaders['project_id'] = $optionalArgs['projectId'];
        }

        if (isset($optionalArgs['zone'])) {
            $request->setZone($optionalArgs['zone']);
            $requestParamHeaders['zone'] = $optionalArgs['zone'];
        }

        if (isset($optionalArgs['operationId'])) {
            $request->setOperationId($optionalArgs['operationId']);
            $requestParamHeaders['operation_id'] = $optionalArgs['operationId'];
        }

        if (isset($optionalArgs['name'])) {
            $request->setName($optionalArgs['name']);
            $requestParamHeaders['name'] = $optionalArgs['name'];
        }

        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('CancelOperation', GPBEmpty::class, $optionalArgs, $request)->wait();
    }

    /**
     * Completes master IP rotation.
     *
     * Sample code:
     * ```
     * $clusterManagerClient = new ClusterManagerClient();
     * try {
     *     $response = $clusterManagerClient->completeIPRotation();
     * } finally {
     *     $clusterManagerClient->close();
     * }
     * ```
     *
     * @param array $optionalArgs {
     *     Optional.
     *
     *     @type string $projectId
     *           Deprecated. The Google Developers Console [project ID or project
     *           number](https://developers.google.com/console/help/new/#projectnumber).
     *           This field has been deprecated and replaced by the name field.
     *     @type string $zone
     *           Deprecated. The name of the Google Compute Engine
     *           [zone](https://cloud.google.com/compute/docs/zones#available) in which the
     *           cluster resides. This field has been deprecated and replaced by the name
     *           field.
     *     @type string $clusterId
     *           Deprecated. The name of the cluster.
     *           This field has been deprecated and replaced by the name field.
     *     @type string $name
     *           The name (project, location, cluster id) of the cluster to complete IP
     *           rotation. Specified in the format `projects/&#42;/locations/&#42;/clusters/*`.
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\Cloud\Container\V1\Operation
     *
     * @throws ApiException if the remote call fails
     */
    public function completeIPRotation(array $optionalArgs = [])
    {
        $request = new CompleteIPRotationRequest();
        $requestParamHeaders = [];
        if (isset($optionalArgs['projectId'])) {
            $request->setProjectId($optionalArgs['projectId']);
            $requestParamHeaders['project_id'] = $optionalArgs['projectId'];
        }

        if (isset($optionalArgs['zone'])) {
            $request->setZone($optionalArgs['zone']);
            $requestParamHeaders['zone'] = $optionalArgs['zone'];
        }

        if (isset($optionalArgs['clusterId'])) {
            $request->setClusterId($optionalArgs['clusterId']);
            $requestParamHeaders['cluster_id'] = $optionalArgs['clusterId'];
        }

        if (isset($optionalArgs['name'])) {
            $request->setName($optionalArgs['name']);
            $requestParamHeaders['name'] = $optionalArgs['name'];
        }

        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('CompleteIPRotation', Operation::class, $optionalArgs, $request)->wait();
    }

    /**
     * Creates a cluster, consisting of the specified number and type of Google
     * Compute Engine instances.
     *
     * By default, the cluster is created in the project's
     * [default
     * network](https://cloud.google.com/compute/docs/networks-and-firewalls#networks).
     *
     * One firewall is added for the cluster. After cluster creation,
     * the Kubelet creates routes for each node to allow the containers
     * on that node to communicate with all other instances in the
     * cluster.
     *
     * Finally, an entry is added to the project's global metadata indicating
     * which CIDR range the cluster is using.
     *
     * Sample code:
     * ```
     * $clusterManagerClient = new ClusterManagerClient();
     * try {
     *     $cluster = new Cluster();
     *     $response = $clusterManagerClient->createCluster($cluster);
     * } finally {
     *     $clusterManagerClient->close();
     * }
     * ```
     *
     * @param Cluster $cluster      Required. A [cluster
     *                              resource](https://cloud.google.com/container-engine/reference/rest/v1/projects.locations.clusters)
     * @param array   $optionalArgs {
     *     Optional.
     *
     *     @type string $projectId
     *           Deprecated. The Google Developers Console [project ID or project
     *           number](https://support.google.com/cloud/answer/6158840).
     *           This field has been deprecated and replaced by the parent field.
     *     @type string $zone
     *           Deprecated. The name of the Google Compute Engine
     *           [zone](https://cloud.google.com/compute/docs/zones#available) in which the
     *           cluster resides. This field has been deprecated and replaced by the parent
     *           field.
     *     @type string $parent
     *           The parent (project and location) where the cluster will be created.
     *           Specified in the format `projects/&#42;/locations/*`.
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\Cloud\Container\V1\Operation
     *
     * @throws ApiException if the remote call fails
     */
    public function createCluster($cluster, array $optionalArgs = [])
    {
        $request = new CreateClusterRequest();
        $requestParamHeaders = [];
        $request->setCluster($cluster);
        if (isset($optionalArgs['projectId'])) {
            $request->setProjectId($optionalArgs['projectId']);
            $requestParamHeaders['project_id'] = $optionalArgs['projectId'];
        }

        if (isset($optionalArgs['zone'])) {
            $request->setZone($optionalArgs['zone']);
            $requestParamHeaders['zone'] = $optionalArgs['zone'];
        }

        if (isset($optionalArgs['parent'])) {
            $request->setParent($optionalArgs['parent']);
            $requestParamHeaders['parent'] = $optionalArgs['parent'];
        }

        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('CreateCluster', Operation::class, $optionalArgs, $request)->wait();
    }

    /**
     * Creates a node pool for a cluster.
     *
     * Sample code:
     * ```
     * $clusterManagerClient = new ClusterManagerClient();
     * try {
     *     $nodePool = new NodePool();
     *     $response = $clusterManagerClient->createNodePool($nodePool);
     * } finally {
     *     $clusterManagerClient->close();
     * }
     * ```
     *
     * @param NodePool $nodePool     Required. The node pool to create.
     * @param array    $optionalArgs {
     *     Optional.
     *
     *     @type string $projectId
     *           Deprecated. The Google Developers Console [project ID or project
     *           number](https://developers.google.com/console/help/new/#projectnumber).
     *           This field has been deprecated and replaced by the parent field.
     *     @type string $zone
     *           Deprecated. The name of the Google Compute Engine
     *           [zone](https://cloud.google.com/compute/docs/zones#available) in which the
     *           cluster resides. This field has been deprecated and replaced by the parent
     *           field.
     *     @type string $clusterId
     *           Deprecated. The name of the cluster.
     *           This field has been deprecated and replaced by the parent field.
     *     @type string $parent
     *           The parent (project, location, cluster id) where the node pool will be
     *           created. Specified in the format
     *           `projects/&#42;/locations/&#42;/clusters/*`.
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\Cloud\Container\V1\Operation
     *
     * @throws ApiException if the remote call fails
     */
    public function createNodePool($nodePool, array $optionalArgs = [])
    {
        $request = new CreateNodePoolRequest();
        $requestParamHeaders = [];
        $request->setNodePool($nodePool);
        if (isset($optionalArgs['projectId'])) {
            $request->setProjectId($optionalArgs['projectId']);
            $requestParamHeaders['project_id'] = $optionalArgs['projectId'];
        }

        if (isset($optionalArgs['zone'])) {
            $request->setZone($optionalArgs['zone']);
            $requestParamHeaders['zone'] = $optionalArgs['zone'];
        }

        if (isset($optionalArgs['clusterId'])) {
            $request->setClusterId($optionalArgs['clusterId']);
            $requestParamHeaders['cluster_id'] = $optionalArgs['clusterId'];
        }

        if (isset($optionalArgs['parent'])) {
            $request->setParent($optionalArgs['parent']);
            $requestParamHeaders['parent'] = $optionalArgs['parent'];
        }

        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('CreateNodePool', Operation::class, $optionalArgs, $request)->wait();
    }

    /**
     * Deletes the cluster, including the Kubernetes endpoint and all worker
     * nodes.
     *
     * Firewalls and routes that were configured during cluster creation
     * are also deleted.
     *
     * Other Google Compute Engine resources that might be in use by the cluster,
     * such as load balancer resources, are not deleted if they weren't present
     * when the cluster was initially created.
     *
     * Sample code:
     * ```
     * $clusterManagerClient = new ClusterManagerClient();
     * try {
     *     $response = $clusterManagerClient->deleteCluster();
     * } finally {
     *     $clusterManagerClient->close();
     * }
     * ```
     *
     * @param array $optionalArgs {
     *     Optional.
     *
     *     @type string $projectId
     *           Deprecated. The Google Developers Console [project ID or project
     *           number](https://support.google.com/cloud/answer/6158840).
     *           This field has been deprecated and replaced by the name field.
     *     @type string $zone
     *           Deprecated. The name of the Google Compute Engine
     *           [zone](https://cloud.google.com/compute/docs/zones#available) in which the
     *           cluster resides. This field has been deprecated and replaced by the name
     *           field.
     *     @type string $clusterId
     *           Deprecated. The name of the cluster to delete.
     *           This field has been deprecated and replaced by the name field.
     *     @type string $name
     *           The name (project, location, cluster) of the cluster to delete.
     *           Specified in the format `projects/&#42;/locations/&#42;/clusters/*`.
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\Cloud\Container\V1\Operation
     *
     * @throws ApiException if the remote call fails
     */
    public function deleteCluster(array $optionalArgs = [])
    {
        $request = new DeleteClusterRequest();
        $requestParamHeaders = [];
        if (isset($optionalArgs['projectId'])) {
            $request->setProjectId($optionalArgs['projectId']);
            $requestParamHeaders['project_id'] = $optionalArgs['projectId'];
        }

        if (isset($optionalArgs['zone'])) {
            $request->setZone($optionalArgs['zone']);
            $requestParamHeaders['zone'] = $optionalArgs['zone'];
        }

        if (isset($optionalArgs['clusterId'])) {
            $request->setClusterId($optionalArgs['clusterId']);
            $requestParamHeaders['cluster_id'] = $optionalArgs['clusterId'];
        }

        if (isset($optionalArgs['name'])) {
            $request->setName($optionalArgs['name']);
            $requestParamHeaders['name'] = $optionalArgs['name'];
        }

        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('DeleteCluster', Operation::class, $optionalArgs, $request)->wait();
    }

    /**
     * Deletes a node pool from a cluster.
     *
     * Sample code:
     * ```
     * $clusterManagerClient = new ClusterManagerClient();
     * try {
     *     $response = $clusterManagerClient->deleteNodePool();
     * } finally {
     *     $clusterManagerClient->close();
     * }
     * ```
     *
     * @param array $optionalArgs {
     *     Optional.
     *
     *     @type string $projectId
     *           Deprecated. The Google Developers Console [project ID or project
     *           number](https://developers.google.com/console/help/new/#projectnumber).
     *           This field has been deprecated and replaced by the name field.
     *     @type string $zone
     *           Deprecated. The name of the Google Compute Engine
     *           [zone](https://cloud.google.com/compute/docs/zones#available) in which the
     *           cluster resides. This field has been deprecated and replaced by the name
     *           field.
     *     @type string $clusterId
     *           Deprecated. The name of the cluster.
     *           This field has been deprecated and replaced by the name field.
     *     @type string $nodePoolId
     *           Deprecated. The name of the node pool to delete.
     *           This field has been deprecated and replaced by the name field.
     *     @type string $name
     *           The name (project, location, cluster, node pool id) of the node pool to
     *           delete. Specified in the format
     *           `projects/&#42;/locations/&#42;/clusters/&#42;/nodePools/*`.
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\Cloud\Container\V1\Operation
     *
     * @throws ApiException if the remote call fails
     */
    public function deleteNodePool(array $optionalArgs = [])
    {
        $request = new DeleteNodePoolRequest();
        $requestParamHeaders = [];
        if (isset($optionalArgs['projectId'])) {
            $request->setProjectId($optionalArgs['projectId']);
            $requestParamHeaders['project_id'] = $optionalArgs['projectId'];
        }

        if (isset($optionalArgs['zone'])) {
            $request->setZone($optionalArgs['zone']);
            $requestParamHeaders['zone'] = $optionalArgs['zone'];
        }

        if (isset($optionalArgs['clusterId'])) {
            $request->setClusterId($optionalArgs['clusterId']);
            $requestParamHeaders['cluster_id'] = $optionalArgs['clusterId'];
        }

        if (isset($optionalArgs['nodePoolId'])) {
            $request->setNodePoolId($optionalArgs['nodePoolId']);
            $requestParamHeaders['node_pool_id'] = $optionalArgs['nodePoolId'];
        }

        if (isset($optionalArgs['name'])) {
            $request->setName($optionalArgs['name']);
            $requestParamHeaders['name'] = $optionalArgs['name'];
        }

        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('DeleteNodePool', Operation::class, $optionalArgs, $request)->wait();
    }

    /**
     * Gets the details of a specific cluster.
     *
     * Sample code:
     * ```
     * $clusterManagerClient = new ClusterManagerClient();
     * try {
     *     $response = $clusterManagerClient->getCluster();
     * } finally {
     *     $clusterManagerClient->close();
     * }
     * ```
     *
     * @param array $optionalArgs {
     *     Optional.
     *
     *     @type string $projectId
     *           Deprecated. The Google Developers Console [project ID or project
     *           number](https://support.google.com/cloud/answer/6158840).
     *           This field has been deprecated and replaced by the name field.
     *     @type string $zone
     *           Deprecated. The name of the Google Compute Engine
     *           [zone](https://cloud.google.com/compute/docs/zones#available) in which the
     *           cluster resides. This field has been deprecated and replaced by the name
     *           field.
     *     @type string $clusterId
     *           Deprecated. The name of the cluster to retrieve.
     *           This field has been deprecated and replaced by the name field.
     *     @type string $name
     *           The name (project, location, cluster) of the cluster to retrieve.
     *           Specified in the format `projects/&#42;/locations/&#42;/clusters/*`.
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\Cloud\Container\V1\Cluster
     *
     * @throws ApiException if the remote call fails
     */
    public function getCluster(array $optionalArgs = [])
    {
        $request = new GetClusterRequest();
        $requestParamHeaders = [];
        if (isset($optionalArgs['projectId'])) {
            $request->setProjectId($optionalArgs['projectId']);
            $requestParamHeaders['project_id'] = $optionalArgs['projectId'];
        }

        if (isset($optionalArgs['zone'])) {
            $request->setZone($optionalArgs['zone']);
            $requestParamHeaders['zone'] = $optionalArgs['zone'];
        }

        if (isset($optionalArgs['clusterId'])) {
            $request->setClusterId($optionalArgs['clusterId']);
            $requestParamHeaders['cluster_id'] = $optionalArgs['clusterId'];
        }

        if (isset($optionalArgs['name'])) {
            $request->setName($optionalArgs['name']);
            $requestParamHeaders['name'] = $optionalArgs['name'];
        }

        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('GetCluster', Cluster::class, $optionalArgs, $request)->wait();
    }

    /**
     * Gets the public component of the cluster signing keys in
     * JSON Web Key format.
     * This API is not yet intended for general use, and is not available for all
     * clusters.
     *
     * Sample code:
     * ```
     * $clusterManagerClient = new ClusterManagerClient();
     * try {
     *     $response = $clusterManagerClient->getJSONWebKeys();
     * } finally {
     *     $clusterManagerClient->close();
     * }
     * ```
     *
     * @param array $optionalArgs {
     *     Optional.
     *
     *     @type string $parent
     *           The cluster (project, location, cluster id) to get keys for. Specified in
     *           the format `projects/&#42;/locations/&#42;/clusters/*`.
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\Cloud\Container\V1\GetJSONWebKeysResponse
     *
     * @throws ApiException if the remote call fails
     */
    public function getJSONWebKeys(array $optionalArgs = [])
    {
        $request = new GetJSONWebKeysRequest();
        $requestParamHeaders = [];
        if (isset($optionalArgs['parent'])) {
            $request->setParent($optionalArgs['parent']);
            $requestParamHeaders['parent'] = $optionalArgs['parent'];
        }

        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('GetJSONWebKeys', GetJSONWebKeysResponse::class, $optionalArgs, $request)->wait();
    }

    /**
     * Retrieves the requested node pool.
     *
     * Sample code:
     * ```
     * $clusterManagerClient = new ClusterManagerClient();
     * try {
     *     $response = $clusterManagerClient->getNodePool();
     * } finally {
     *     $clusterManagerClient->close();
     * }
     * ```
     *
     * @param array $optionalArgs {
     *     Optional.
     *
     *     @type string $projectId
     *           Deprecated. The Google Developers Console [project ID or project
     *           number](https://developers.google.com/console/help/new/#projectnumber).
     *           This field has been deprecated and replaced by the name field.
     *     @type string $zone
     *           Deprecated. The name of the Google Compute Engine
     *           [zone](https://cloud.google.com/compute/docs/zones#available) in which the
     *           cluster resides. This field has been deprecated and replaced by the name
     *           field.
     *     @type string $clusterId
     *           Deprecated. The name of the cluster.
     *           This field has been deprecated and replaced by the name field.
     *     @type string $nodePoolId
     *           Deprecated. The name of the node pool.
     *           This field has been deprecated and replaced by the name field.
     *     @type string $name
     *           The name (project, location, cluster, node pool id) of the node pool to
     *           get. Specified in the format
     *           `projects/&#42;/locations/&#42;/clusters/&#42;/nodePools/*`.
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\Cloud\Container\V1\NodePool
     *
     * @throws ApiException if the remote call fails
     */
    public function getNodePool(array $optionalArgs = [])
    {
        $request = new GetNodePoolRequest();
        $requestParamHeaders = [];
        if (isset($optionalArgs['projectId'])) {
            $request->setProjectId($optionalArgs['projectId']);
            $requestParamHeaders['project_id'] = $optionalArgs['projectId'];
        }

        if (isset($optionalArgs['zone'])) {
            $request->setZone($optionalArgs['zone']);
            $requestParamHeaders['zone'] = $optionalArgs['zone'];
        }

        if (isset($optionalArgs['clusterId'])) {
            $request->setClusterId($optionalArgs['clusterId']);
            $requestParamHeaders['cluster_id'] = $optionalArgs['clusterId'];
        }

        if (isset($optionalArgs['nodePoolId'])) {
            $request->setNodePoolId($optionalArgs['nodePoolId']);
            $requestParamHeaders['node_pool_id'] = $optionalArgs['nodePoolId'];
        }

        if (isset($optionalArgs['name'])) {
            $request->setName($optionalArgs['name']);
            $requestParamHeaders['name'] = $optionalArgs['name'];
        }

        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('GetNodePool', NodePool::class, $optionalArgs, $request)->wait();
    }

    /**
     * Gets the specified operation.
     *
     * Sample code:
     * ```
     * $clusterManagerClient = new ClusterManagerClient();
     * try {
     *     $response = $clusterManagerClient->getOperation();
     * } finally {
     *     $clusterManagerClient->close();
     * }
     * ```
     *
     * @param array $optionalArgs {
     *     Optional.
     *
     *     @type string $projectId
     *           Deprecated. The Google Developers Console [project ID or project
     *           number](https://support.google.com/cloud/answer/6158840).
     *           This field has been deprecated and replaced by the name field.
     *     @type string $zone
     *           Deprecated. The name of the Google Compute Engine
     *           [zone](https://cloud.google.com/compute/docs/zones#available) in which the
     *           cluster resides. This field has been deprecated and replaced by the name
     *           field.
     *     @type string $operationId
     *           Deprecated. The server-assigned `name` of the operation.
     *           This field has been deprecated and replaced by the name field.
     *     @type string $name
     *           The name (project, location, operation id) of the operation to get.
     *           Specified in the format `projects/&#42;/locations/&#42;/operations/*`.
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\Cloud\Container\V1\Operation
     *
     * @throws ApiException if the remote call fails
     */
    public function getOperation(array $optionalArgs = [])
    {
        $request = new GetOperationRequest();
        $requestParamHeaders = [];
        if (isset($optionalArgs['projectId'])) {
            $request->setProjectId($optionalArgs['projectId']);
            $requestParamHeaders['project_id'] = $optionalArgs['projectId'];
        }

        if (isset($optionalArgs['zone'])) {
            $request->setZone($optionalArgs['zone']);
            $requestParamHeaders['zone'] = $optionalArgs['zone'];
        }

        if (isset($optionalArgs['operationId'])) {
            $request->setOperationId($optionalArgs['operationId']);
            $requestParamHeaders['operation_id'] = $optionalArgs['operationId'];
        }

        if (isset($optionalArgs['name'])) {
            $request->setName($optionalArgs['name']);
            $requestParamHeaders['name'] = $optionalArgs['name'];
        }

        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('GetOperation', Operation::class, $optionalArgs, $request)->wait();
    }

    /**
     * Returns configuration info about the Google Kubernetes Engine service.
     *
     * Sample code:
     * ```
     * $clusterManagerClient = new ClusterManagerClient();
     * try {
     *     $response = $clusterManagerClient->getServerConfig();
     * } finally {
     *     $clusterManagerClient->close();
     * }
     * ```
     *
     * @param array $optionalArgs {
     *     Optional.
     *
     *     @type string $projectId
     *           Deprecated. The Google Developers Console [project ID or project
     *           number](https://support.google.com/cloud/answer/6158840).
     *           This field has been deprecated and replaced by the name field.
     *     @type string $zone
     *           Deprecated. The name of the Google Compute Engine
     *           [zone](https://cloud.google.com/compute/docs/zones#available) to return
     *           operations for. This field has been deprecated and replaced by the name
     *           field.
     *     @type string $name
     *           The name (project and location) of the server config to get,
     *           specified in the format `projects/&#42;/locations/*`.
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\Cloud\Container\V1\ServerConfig
     *
     * @throws ApiException if the remote call fails
     */
    public function getServerConfig(array $optionalArgs = [])
    {
        $request = new GetServerConfigRequest();
        $requestParamHeaders = [];
        if (isset($optionalArgs['projectId'])) {
            $request->setProjectId($optionalArgs['projectId']);
            $requestParamHeaders['project_id'] = $optionalArgs['projectId'];
        }

        if (isset($optionalArgs['zone'])) {
            $request->setZone($optionalArgs['zone']);
            $requestParamHeaders['zone'] = $optionalArgs['zone'];
        }

        if (isset($optionalArgs['name'])) {
            $request->setName($optionalArgs['name']);
            $requestParamHeaders['name'] = $optionalArgs['name'];
        }

        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('GetServerConfig', ServerConfig::class, $optionalArgs, $request)->wait();
    }

    /**
     * Lists all clusters owned by a project in either the specified zone or all
     * zones.
     *
     * Sample code:
     * ```
     * $clusterManagerClient = new ClusterManagerClient();
     * try {
     *     $response = $clusterManagerClient->listClusters();
     * } finally {
     *     $clusterManagerClient->close();
     * }
     * ```
     *
     * @param array $optionalArgs {
     *     Optional.
     *
     *     @type string $projectId
     *           Deprecated. The Google Developers Console [project ID or project
     *           number](https://support.google.com/cloud/answer/6158840).
     *           This field has been deprecated and replaced by the parent field.
     *     @type string $zone
     *           Deprecated. The name of the Google Compute Engine
     *           [zone](https://cloud.google.com/compute/docs/zones#available) in which the
     *           cluster resides, or "-" for all zones. This field has been deprecated and
     *           replaced by the parent field.
     *     @type string $parent
     *           The parent (project and location) where the clusters will be listed.
     *           Specified in the format `projects/&#42;/locations/*`.
     *           Location "-" matches all zones and all regions.
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\Cloud\Container\V1\ListClustersResponse
     *
     * @throws ApiException if the remote call fails
     */
    public function listClusters(array $optionalArgs = [])
    {
        $request = new ListClustersRequest();
        $requestParamHeaders = [];
        if (isset($optionalArgs['projectId'])) {
            $request->setProjectId($optionalArgs['projectId']);
            $requestParamHeaders['project_id'] = $optionalArgs['projectId'];
        }

        if (isset($optionalArgs['zone'])) {
            $request->setZone($optionalArgs['zone']);
            $requestParamHeaders['zone'] = $optionalArgs['zone'];
        }

        if (isset($optionalArgs['parent'])) {
            $request->setParent($optionalArgs['parent']);
            $requestParamHeaders['parent'] = $optionalArgs['parent'];
        }

        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('ListClusters', ListClustersResponse::class, $optionalArgs, $request)->wait();
    }

    /**
     * Lists the node pools for a cluster.
     *
     * Sample code:
     * ```
     * $clusterManagerClient = new ClusterManagerClient();
     * try {
     *     $response = $clusterManagerClient->listNodePools();
     * } finally {
     *     $clusterManagerClient->close();
     * }
     * ```
     *
     * @param array $optionalArgs {
     *     Optional.
     *
     *     @type string $projectId
     *           Deprecated. The Google Developers Console [project ID or project
     *           number](https://developers.google.com/console/help/new/#projectnumber).
     *           This field has been deprecated and replaced by the parent field.
     *     @type string $zone
     *           Deprecated. The name of the Google Compute Engine
     *           [zone](https://cloud.google.com/compute/docs/zones#available) in which the
     *           cluster resides. This field has been deprecated and replaced by the parent
     *           field.
     *     @type string $clusterId
     *           Deprecated. The name of the cluster.
     *           This field has been deprecated and replaced by the parent field.
     *     @type string $parent
     *           The parent (project, location, cluster id) where the node pools will be
     *           listed. Specified in the format `projects/&#42;/locations/&#42;/clusters/*`.
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\Cloud\Container\V1\ListNodePoolsResponse
     *
     * @throws ApiException if the remote call fails
     */
    public function listNodePools(array $optionalArgs = [])
    {
        $request = new ListNodePoolsRequest();
        $requestParamHeaders = [];
        if (isset($optionalArgs['projectId'])) {
            $request->setProjectId($optionalArgs['projectId']);
            $requestParamHeaders['project_id'] = $optionalArgs['projectId'];
        }

        if (isset($optionalArgs['zone'])) {
            $request->setZone($optionalArgs['zone']);
            $requestParamHeaders['zone'] = $optionalArgs['zone'];
        }

        if (isset($optionalArgs['clusterId'])) {
            $request->setClusterId($optionalArgs['clusterId']);
            $requestParamHeaders['cluster_id'] = $optionalArgs['clusterId'];
        }

        if (isset($optionalArgs['parent'])) {
            $request->setParent($optionalArgs['parent']);
            $requestParamHeaders['parent'] = $optionalArgs['parent'];
        }

        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('ListNodePools', ListNodePoolsResponse::class, $optionalArgs, $request)->wait();
    }

    /**
     * Lists all operations in a project in a specific zone or all zones.
     *
     * Sample code:
     * ```
     * $clusterManagerClient = new ClusterManagerClient();
     * try {
     *     $response = $clusterManagerClient->listOperations();
     * } finally {
     *     $clusterManagerClient->close();
     * }
     * ```
     *
     * @param array $optionalArgs {
     *     Optional.
     *
     *     @type string $projectId
     *           Deprecated. The Google Developers Console [project ID or project
     *           number](https://support.google.com/cloud/answer/6158840).
     *           This field has been deprecated and replaced by the parent field.
     *     @type string $zone
     *           Deprecated. The name of the Google Compute Engine
     *           [zone](https://cloud.google.com/compute/docs/zones#available) to return
     *           operations for, or `-` for all zones. This field has been deprecated and
     *           replaced by the parent field.
     *     @type string $parent
     *           The parent (project and location) where the operations will be listed.
     *           Specified in the format `projects/&#42;/locations/*`.
     *           Location "-" matches all zones and all regions.
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\Cloud\Container\V1\ListOperationsResponse
     *
     * @throws ApiException if the remote call fails
     */
    public function listOperations(array $optionalArgs = [])
    {
        $request = new ListOperationsRequest();
        $requestParamHeaders = [];
        if (isset($optionalArgs['projectId'])) {
            $request->setProjectId($optionalArgs['projectId']);
            $requestParamHeaders['project_id'] = $optionalArgs['projectId'];
        }

        if (isset($optionalArgs['zone'])) {
            $request->setZone($optionalArgs['zone']);
            $requestParamHeaders['zone'] = $optionalArgs['zone'];
        }

        if (isset($optionalArgs['parent'])) {
            $request->setParent($optionalArgs['parent']);
            $requestParamHeaders['parent'] = $optionalArgs['parent'];
        }

        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('ListOperations', ListOperationsResponse::class, $optionalArgs, $request)->wait();
    }

    /**
     * Lists subnetworks that are usable for creating clusters in a project.
     *
     * Sample code:
     * ```
     * $clusterManagerClient = new ClusterManagerClient();
     * try {
     *     // Iterate over pages of elements
     *     $pagedResponse = $clusterManagerClient->listUsableSubnetworks();
     *     foreach ($pagedResponse->iteratePages() as $page) {
     *         foreach ($page as $element) {
     *             // doSomethingWith($element);
     *         }
     *     }
     *     // Alternatively:
     *     // Iterate through all elements
     *     $pagedResponse = $clusterManagerClient->listUsableSubnetworks();
     *     foreach ($pagedResponse->iterateAllElements() as $element) {
     *         // doSomethingWith($element);
     *     }
     * } finally {
     *     $clusterManagerClient->close();
     * }
     * ```
     *
     * @param array $optionalArgs {
     *     Optional.
     *
     *     @type string $parent
     *           The parent project where subnetworks are usable.
     *           Specified in the format `projects/*`.
     *     @type string $filter
     *           Filtering currently only supports equality on the networkProjectId and must
     *           be in the form: "networkProjectId=[PROJECTID]", where `networkProjectId`
     *           is the project which owns the listed subnetworks. This defaults to the
     *           parent project ID.
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
    public function listUsableSubnetworks(array $optionalArgs = [])
    {
        $request = new ListUsableSubnetworksRequest();
        $requestParamHeaders = [];
        if (isset($optionalArgs['parent'])) {
            $request->setParent($optionalArgs['parent']);
            $requestParamHeaders['parent'] = $optionalArgs['parent'];
        }

        if (isset($optionalArgs['filter'])) {
            $request->setFilter($optionalArgs['filter']);
        }

        if (isset($optionalArgs['pageSize'])) {
            $request->setPageSize($optionalArgs['pageSize']);
        }

        if (isset($optionalArgs['pageToken'])) {
            $request->setPageToken($optionalArgs['pageToken']);
        }

        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->getPagedListResponse('ListUsableSubnetworks', $optionalArgs, ListUsableSubnetworksResponse::class, $request);
    }

    /**
     * Rolls back a previously Aborted or Failed NodePool upgrade.
     * This makes no changes if the last upgrade successfully completed.
     *
     * Sample code:
     * ```
     * $clusterManagerClient = new ClusterManagerClient();
     * try {
     *     $response = $clusterManagerClient->rollbackNodePoolUpgrade();
     * } finally {
     *     $clusterManagerClient->close();
     * }
     * ```
     *
     * @param array $optionalArgs {
     *     Optional.
     *
     *     @type string $projectId
     *           Deprecated. The Google Developers Console [project ID or project
     *           number](https://support.google.com/cloud/answer/6158840).
     *           This field has been deprecated and replaced by the name field.
     *     @type string $zone
     *           Deprecated. The name of the Google Compute Engine
     *           [zone](https://cloud.google.com/compute/docs/zones#available) in which the
     *           cluster resides. This field has been deprecated and replaced by the name
     *           field.
     *     @type string $clusterId
     *           Deprecated. The name of the cluster to rollback.
     *           This field has been deprecated and replaced by the name field.
     *     @type string $nodePoolId
     *           Deprecated. The name of the node pool to rollback.
     *           This field has been deprecated and replaced by the name field.
     *     @type string $name
     *           The name (project, location, cluster, node pool id) of the node poll to
     *           rollback upgrade.
     *           Specified in the format `projects/&#42;/locations/&#42;/clusters/&#42;/nodePools/*`.
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\Cloud\Container\V1\Operation
     *
     * @throws ApiException if the remote call fails
     */
    public function rollbackNodePoolUpgrade(array $optionalArgs = [])
    {
        $request = new RollbackNodePoolUpgradeRequest();
        $requestParamHeaders = [];
        if (isset($optionalArgs['projectId'])) {
            $request->setProjectId($optionalArgs['projectId']);
            $requestParamHeaders['project_id'] = $optionalArgs['projectId'];
        }

        if (isset($optionalArgs['zone'])) {
            $request->setZone($optionalArgs['zone']);
            $requestParamHeaders['zone'] = $optionalArgs['zone'];
        }

        if (isset($optionalArgs['clusterId'])) {
            $request->setClusterId($optionalArgs['clusterId']);
            $requestParamHeaders['cluster_id'] = $optionalArgs['clusterId'];
        }

        if (isset($optionalArgs['nodePoolId'])) {
            $request->setNodePoolId($optionalArgs['nodePoolId']);
            $requestParamHeaders['node_pool_id'] = $optionalArgs['nodePoolId'];
        }

        if (isset($optionalArgs['name'])) {
            $request->setName($optionalArgs['name']);
            $requestParamHeaders['name'] = $optionalArgs['name'];
        }

        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('RollbackNodePoolUpgrade', Operation::class, $optionalArgs, $request)->wait();
    }

    /**
     * Sets the addons for a specific cluster.
     *
     * Sample code:
     * ```
     * $clusterManagerClient = new ClusterManagerClient();
     * try {
     *     $addonsConfig = new AddonsConfig();
     *     $response = $clusterManagerClient->setAddonsConfig($addonsConfig);
     * } finally {
     *     $clusterManagerClient->close();
     * }
     * ```
     *
     * @param AddonsConfig $addonsConfig Required. The desired configurations for the various addons available to run in the
     *                                   cluster.
     * @param array        $optionalArgs {
     *     Optional.
     *
     *     @type string $projectId
     *           Deprecated. The Google Developers Console [project ID or project
     *           number](https://support.google.com/cloud/answer/6158840).
     *           This field has been deprecated and replaced by the name field.
     *     @type string $zone
     *           Deprecated. The name of the Google Compute Engine
     *           [zone](https://cloud.google.com/compute/docs/zones#available) in which the
     *           cluster resides. This field has been deprecated and replaced by the name
     *           field.
     *     @type string $clusterId
     *           Deprecated. The name of the cluster to upgrade.
     *           This field has been deprecated and replaced by the name field.
     *     @type string $name
     *           The name (project, location, cluster) of the cluster to set addons.
     *           Specified in the format `projects/&#42;/locations/&#42;/clusters/*`.
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\Cloud\Container\V1\Operation
     *
     * @throws ApiException if the remote call fails
     */
    public function setAddonsConfig($addonsConfig, array $optionalArgs = [])
    {
        $request = new SetAddonsConfigRequest();
        $requestParamHeaders = [];
        $request->setAddonsConfig($addonsConfig);
        if (isset($optionalArgs['projectId'])) {
            $request->setProjectId($optionalArgs['projectId']);
            $requestParamHeaders['project_id'] = $optionalArgs['projectId'];
        }

        if (isset($optionalArgs['zone'])) {
            $request->setZone($optionalArgs['zone']);
            $requestParamHeaders['zone'] = $optionalArgs['zone'];
        }

        if (isset($optionalArgs['clusterId'])) {
            $request->setClusterId($optionalArgs['clusterId']);
            $requestParamHeaders['cluster_id'] = $optionalArgs['clusterId'];
        }

        if (isset($optionalArgs['name'])) {
            $request->setName($optionalArgs['name']);
            $requestParamHeaders['name'] = $optionalArgs['name'];
        }

        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('SetAddonsConfig', Operation::class, $optionalArgs, $request)->wait();
    }

    /**
     * Sets labels on a cluster.
     *
     * Sample code:
     * ```
     * $clusterManagerClient = new ClusterManagerClient();
     * try {
     *     $resourceLabels = [];
     *     $labelFingerprint = 'label_fingerprint';
     *     $response = $clusterManagerClient->setLabels($resourceLabels, $labelFingerprint);
     * } finally {
     *     $clusterManagerClient->close();
     * }
     * ```
     *
     * @param array  $resourceLabels   Required. The labels to set for that cluster.
     * @param string $labelFingerprint Required. The fingerprint of the previous set of labels for this resource,
     *                                 used to detect conflicts. The fingerprint is initially generated by
     *                                 Kubernetes Engine and changes after every request to modify or update
     *                                 labels. You must always provide an up-to-date fingerprint hash when
     *                                 updating or changing labels. Make a `get()` request to the
     *                                 resource to get the latest fingerprint.
     * @param array  $optionalArgs     {
     *     Optional.
     *
     *     @type string $projectId
     *           Deprecated. The Google Developers Console [project ID or project
     *           number](https://developers.google.com/console/help/new/#projectnumber).
     *           This field has been deprecated and replaced by the name field.
     *     @type string $zone
     *           Deprecated. The name of the Google Compute Engine
     *           [zone](https://cloud.google.com/compute/docs/zones#available) in which the
     *           cluster resides. This field has been deprecated and replaced by the name
     *           field.
     *     @type string $clusterId
     *           Deprecated. The name of the cluster.
     *           This field has been deprecated and replaced by the name field.
     *     @type string $name
     *           The name (project, location, cluster id) of the cluster to set labels.
     *           Specified in the format `projects/&#42;/locations/&#42;/clusters/*`.
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\Cloud\Container\V1\Operation
     *
     * @throws ApiException if the remote call fails
     */
    public function setLabels($resourceLabels, $labelFingerprint, array $optionalArgs = [])
    {
        $request = new SetLabelsRequest();
        $requestParamHeaders = [];
        $request->setResourceLabels($resourceLabels);
        $request->setLabelFingerprint($labelFingerprint);
        if (isset($optionalArgs['projectId'])) {
            $request->setProjectId($optionalArgs['projectId']);
            $requestParamHeaders['project_id'] = $optionalArgs['projectId'];
        }

        if (isset($optionalArgs['zone'])) {
            $request->setZone($optionalArgs['zone']);
            $requestParamHeaders['zone'] = $optionalArgs['zone'];
        }

        if (isset($optionalArgs['clusterId'])) {
            $request->setClusterId($optionalArgs['clusterId']);
            $requestParamHeaders['cluster_id'] = $optionalArgs['clusterId'];
        }

        if (isset($optionalArgs['name'])) {
            $request->setName($optionalArgs['name']);
            $requestParamHeaders['name'] = $optionalArgs['name'];
        }

        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('SetLabels', Operation::class, $optionalArgs, $request)->wait();
    }

    /**
     * Enables or disables the ABAC authorization mechanism on a cluster.
     *
     * Sample code:
     * ```
     * $clusterManagerClient = new ClusterManagerClient();
     * try {
     *     $enabled = false;
     *     $response = $clusterManagerClient->setLegacyAbac($enabled);
     * } finally {
     *     $clusterManagerClient->close();
     * }
     * ```
     *
     * @param bool  $enabled      Required. Whether ABAC authorization will be enabled in the cluster.
     * @param array $optionalArgs {
     *     Optional.
     *
     *     @type string $projectId
     *           Deprecated. The Google Developers Console [project ID or project
     *           number](https://support.google.com/cloud/answer/6158840).
     *           This field has been deprecated and replaced by the name field.
     *     @type string $zone
     *           Deprecated. The name of the Google Compute Engine
     *           [zone](https://cloud.google.com/compute/docs/zones#available) in which the
     *           cluster resides. This field has been deprecated and replaced by the name
     *           field.
     *     @type string $clusterId
     *           Deprecated. The name of the cluster to update.
     *           This field has been deprecated and replaced by the name field.
     *     @type string $name
     *           The name (project, location, cluster id) of the cluster to set legacy abac.
     *           Specified in the format `projects/&#42;/locations/&#42;/clusters/*`.
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\Cloud\Container\V1\Operation
     *
     * @throws ApiException if the remote call fails
     */
    public function setLegacyAbac($enabled, array $optionalArgs = [])
    {
        $request = new SetLegacyAbacRequest();
        $requestParamHeaders = [];
        $request->setEnabled($enabled);
        if (isset($optionalArgs['projectId'])) {
            $request->setProjectId($optionalArgs['projectId']);
            $requestParamHeaders['project_id'] = $optionalArgs['projectId'];
        }

        if (isset($optionalArgs['zone'])) {
            $request->setZone($optionalArgs['zone']);
            $requestParamHeaders['zone'] = $optionalArgs['zone'];
        }

        if (isset($optionalArgs['clusterId'])) {
            $request->setClusterId($optionalArgs['clusterId']);
            $requestParamHeaders['cluster_id'] = $optionalArgs['clusterId'];
        }

        if (isset($optionalArgs['name'])) {
            $request->setName($optionalArgs['name']);
            $requestParamHeaders['name'] = $optionalArgs['name'];
        }

        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('SetLegacyAbac', Operation::class, $optionalArgs, $request)->wait();
    }

    /**
     * Sets the locations for a specific cluster.
     * Deprecated. Use
     * [projects.locations.clusters.update](https://cloud.google.com/kubernetes-engine/docs/reference/rest/v1/projects.locations.clusters/update)
     * instead.
     *
     * Sample code:
     * ```
     * $clusterManagerClient = new ClusterManagerClient();
     * try {
     *     $locations = [];
     *     $response = $clusterManagerClient->setLocations($locations);
     * } finally {
     *     $clusterManagerClient->close();
     * }
     * ```
     *
     * @param string[] $locations    Required. The desired list of Google Compute Engine
     *                               [zones](https://cloud.google.com/compute/docs/zones#available) in which the
     *                               cluster's nodes should be located. Changing the locations a cluster is in
     *                               will result in nodes being either created or removed from the cluster,
     *                               depending on whether locations are being added or removed.
     *
     *                               This list must always include the cluster's primary zone.
     * @param array    $optionalArgs {
     *     Optional.
     *
     *     @type string $projectId
     *           Deprecated. The Google Developers Console [project ID or project
     *           number](https://support.google.com/cloud/answer/6158840).
     *           This field has been deprecated and replaced by the name field.
     *     @type string $zone
     *           Deprecated. The name of the Google Compute Engine
     *           [zone](https://cloud.google.com/compute/docs/zones#available) in which the
     *           cluster resides. This field has been deprecated and replaced by the name
     *           field.
     *     @type string $clusterId
     *           Deprecated. The name of the cluster to upgrade.
     *           This field has been deprecated and replaced by the name field.
     *     @type string $name
     *           The name (project, location, cluster) of the cluster to set locations.
     *           Specified in the format `projects/&#42;/locations/&#42;/clusters/*`.
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\Cloud\Container\V1\Operation
     *
     * @throws ApiException if the remote call fails
     */
    public function setLocations($locations, array $optionalArgs = [])
    {
        $request = new SetLocationsRequest();
        $requestParamHeaders = [];
        $request->setLocations($locations);
        if (isset($optionalArgs['projectId'])) {
            $request->setProjectId($optionalArgs['projectId']);
            $requestParamHeaders['project_id'] = $optionalArgs['projectId'];
        }

        if (isset($optionalArgs['zone'])) {
            $request->setZone($optionalArgs['zone']);
            $requestParamHeaders['zone'] = $optionalArgs['zone'];
        }

        if (isset($optionalArgs['clusterId'])) {
            $request->setClusterId($optionalArgs['clusterId']);
            $requestParamHeaders['cluster_id'] = $optionalArgs['clusterId'];
        }

        if (isset($optionalArgs['name'])) {
            $request->setName($optionalArgs['name']);
            $requestParamHeaders['name'] = $optionalArgs['name'];
        }

        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('SetLocations', Operation::class, $optionalArgs, $request)->wait();
    }

    /**
     * Sets the logging service for a specific cluster.
     *
     * Sample code:
     * ```
     * $clusterManagerClient = new ClusterManagerClient();
     * try {
     *     $loggingService = 'logging_service';
     *     $response = $clusterManagerClient->setLoggingService($loggingService);
     * } finally {
     *     $clusterManagerClient->close();
     * }
     * ```
     *
     * @param string $loggingService Required. The logging service the cluster should use to write logs.
     *                               Currently available options:
     *
     *                               * `logging.googleapis.com/kubernetes` - The Cloud Logging
     *                               service with a Kubernetes-native resource model
     *                               * `logging.googleapis.com` - The legacy Cloud Logging service (no longer
     *                               available as of GKE 1.15).
     *                               * `none` - no logs will be exported from the cluster.
     *
     *                               If left as an empty string,`logging.googleapis.com/kubernetes` will be
     *                               used for GKE 1.14+ or `logging.googleapis.com` for earlier versions.
     * @param array  $optionalArgs   {
     *     Optional.
     *
     *     @type string $projectId
     *           Deprecated. The Google Developers Console [project ID or project
     *           number](https://support.google.com/cloud/answer/6158840).
     *           This field has been deprecated and replaced by the name field.
     *     @type string $zone
     *           Deprecated. The name of the Google Compute Engine
     *           [zone](https://cloud.google.com/compute/docs/zones#available) in which the
     *           cluster resides. This field has been deprecated and replaced by the name
     *           field.
     *     @type string $clusterId
     *           Deprecated. The name of the cluster to upgrade.
     *           This field has been deprecated and replaced by the name field.
     *     @type string $name
     *           The name (project, location, cluster) of the cluster to set logging.
     *           Specified in the format `projects/&#42;/locations/&#42;/clusters/*`.
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\Cloud\Container\V1\Operation
     *
     * @throws ApiException if the remote call fails
     */
    public function setLoggingService($loggingService, array $optionalArgs = [])
    {
        $request = new SetLoggingServiceRequest();
        $requestParamHeaders = [];
        $request->setLoggingService($loggingService);
        if (isset($optionalArgs['projectId'])) {
            $request->setProjectId($optionalArgs['projectId']);
            $requestParamHeaders['project_id'] = $optionalArgs['projectId'];
        }

        if (isset($optionalArgs['zone'])) {
            $request->setZone($optionalArgs['zone']);
            $requestParamHeaders['zone'] = $optionalArgs['zone'];
        }

        if (isset($optionalArgs['clusterId'])) {
            $request->setClusterId($optionalArgs['clusterId']);
            $requestParamHeaders['cluster_id'] = $optionalArgs['clusterId'];
        }

        if (isset($optionalArgs['name'])) {
            $request->setName($optionalArgs['name']);
            $requestParamHeaders['name'] = $optionalArgs['name'];
        }

        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('SetLoggingService', Operation::class, $optionalArgs, $request)->wait();
    }

    /**
     * Sets the maintenance policy for a cluster.
     *
     * Sample code:
     * ```
     * $clusterManagerClient = new ClusterManagerClient();
     * try {
     *     $projectId = 'project_id';
     *     $zone = 'zone';
     *     $clusterId = 'cluster_id';
     *     $maintenancePolicy = new MaintenancePolicy();
     *     $response = $clusterManagerClient->setMaintenancePolicy($projectId, $zone, $clusterId, $maintenancePolicy);
     * } finally {
     *     $clusterManagerClient->close();
     * }
     * ```
     *
     * @param string            $projectId         Required. The Google Developers Console [project ID or project
     *                                             number](https://support.google.com/cloud/answer/6158840).
     * @param string            $zone              Required. The name of the Google Compute Engine
     *                                             [zone](https://cloud.google.com/compute/docs/zones#available) in which the
     *                                             cluster resides.
     * @param string            $clusterId         Required. The name of the cluster to update.
     * @param MaintenancePolicy $maintenancePolicy Required. The maintenance policy to be set for the cluster. An empty field
     *                                             clears the existing maintenance policy.
     * @param array             $optionalArgs      {
     *     Optional.
     *
     *     @type string $name
     *           The name (project, location, cluster id) of the cluster to set maintenance
     *           policy.
     *           Specified in the format `projects/&#42;/locations/&#42;/clusters/*`.
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\Cloud\Container\V1\Operation
     *
     * @throws ApiException if the remote call fails
     */
    public function setMaintenancePolicy($projectId, $zone, $clusterId, $maintenancePolicy, array $optionalArgs = [])
    {
        $request = new SetMaintenancePolicyRequest();
        $requestParamHeaders = [];
        $request->setProjectId($projectId);
        $request->setZone($zone);
        $request->setClusterId($clusterId);
        $request->setMaintenancePolicy($maintenancePolicy);
        $requestParamHeaders['project_id'] = $projectId;
        $requestParamHeaders['zone'] = $zone;
        $requestParamHeaders['cluster_id'] = $clusterId;
        if (isset($optionalArgs['name'])) {
            $request->setName($optionalArgs['name']);
            $requestParamHeaders['name'] = $optionalArgs['name'];
        }

        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('SetMaintenancePolicy', Operation::class, $optionalArgs, $request)->wait();
    }

    /**
     * Sets master auth materials. Currently supports changing the admin password
     * or a specific cluster, either via password generation or explicitly setting
     * the password.
     *
     * Sample code:
     * ```
     * $clusterManagerClient = new ClusterManagerClient();
     * try {
     *     $action = Action::UNKNOWN;
     *     $update = new MasterAuth();
     *     $response = $clusterManagerClient->setMasterAuth($action, $update);
     * } finally {
     *     $clusterManagerClient->close();
     * }
     * ```
     *
     * @param int        $action       Required. The exact form of action to be taken on the master auth.
     *                                 For allowed values, use constants defined on {@see \Google\Cloud\Container\V1\SetMasterAuthRequest\Action}
     * @param MasterAuth $update       Required. A description of the update.
     * @param array      $optionalArgs {
     *     Optional.
     *
     *     @type string $projectId
     *           Deprecated. The Google Developers Console [project ID or project
     *           number](https://support.google.com/cloud/answer/6158840).
     *           This field has been deprecated and replaced by the name field.
     *     @type string $zone
     *           Deprecated. The name of the Google Compute Engine
     *           [zone](https://cloud.google.com/compute/docs/zones#available) in which the
     *           cluster resides. This field has been deprecated and replaced by the name
     *           field.
     *     @type string $clusterId
     *           Deprecated. The name of the cluster to upgrade.
     *           This field has been deprecated and replaced by the name field.
     *     @type string $name
     *           The name (project, location, cluster) of the cluster to set auth.
     *           Specified in the format `projects/&#42;/locations/&#42;/clusters/*`.
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\Cloud\Container\V1\Operation
     *
     * @throws ApiException if the remote call fails
     */
    public function setMasterAuth($action, $update, array $optionalArgs = [])
    {
        $request = new SetMasterAuthRequest();
        $requestParamHeaders = [];
        $request->setAction($action);
        $request->setUpdate($update);
        if (isset($optionalArgs['projectId'])) {
            $request->setProjectId($optionalArgs['projectId']);
            $requestParamHeaders['project_id'] = $optionalArgs['projectId'];
        }

        if (isset($optionalArgs['zone'])) {
            $request->setZone($optionalArgs['zone']);
            $requestParamHeaders['zone'] = $optionalArgs['zone'];
        }

        if (isset($optionalArgs['clusterId'])) {
            $request->setClusterId($optionalArgs['clusterId']);
            $requestParamHeaders['cluster_id'] = $optionalArgs['clusterId'];
        }

        if (isset($optionalArgs['name'])) {
            $request->setName($optionalArgs['name']);
            $requestParamHeaders['name'] = $optionalArgs['name'];
        }

        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('SetMasterAuth', Operation::class, $optionalArgs, $request)->wait();
    }

    /**
     * Sets the monitoring service for a specific cluster.
     *
     * Sample code:
     * ```
     * $clusterManagerClient = new ClusterManagerClient();
     * try {
     *     $monitoringService = 'monitoring_service';
     *     $response = $clusterManagerClient->setMonitoringService($monitoringService);
     * } finally {
     *     $clusterManagerClient->close();
     * }
     * ```
     *
     * @param string $monitoringService Required. The monitoring service the cluster should use to write metrics.
     *                                  Currently available options:
     *
     *                                  * "monitoring.googleapis.com/kubernetes" - The Cloud Monitoring
     *                                  service with a Kubernetes-native resource model
     *                                  * `monitoring.googleapis.com` - The legacy Cloud Monitoring service (no
     *                                  longer available as of GKE 1.15).
     *                                  * `none` - No metrics will be exported from the cluster.
     *
     *                                  If left as an empty string,`monitoring.googleapis.com/kubernetes` will be
     *                                  used for GKE 1.14+ or `monitoring.googleapis.com` for earlier versions.
     * @param array  $optionalArgs      {
     *     Optional.
     *
     *     @type string $projectId
     *           Deprecated. The Google Developers Console [project ID or project
     *           number](https://support.google.com/cloud/answer/6158840).
     *           This field has been deprecated and replaced by the name field.
     *     @type string $zone
     *           Deprecated. The name of the Google Compute Engine
     *           [zone](https://cloud.google.com/compute/docs/zones#available) in which the
     *           cluster resides. This field has been deprecated and replaced by the name
     *           field.
     *     @type string $clusterId
     *           Deprecated. The name of the cluster to upgrade.
     *           This field has been deprecated and replaced by the name field.
     *     @type string $name
     *           The name (project, location, cluster) of the cluster to set monitoring.
     *           Specified in the format `projects/&#42;/locations/&#42;/clusters/*`.
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\Cloud\Container\V1\Operation
     *
     * @throws ApiException if the remote call fails
     */
    public function setMonitoringService($monitoringService, array $optionalArgs = [])
    {
        $request = new SetMonitoringServiceRequest();
        $requestParamHeaders = [];
        $request->setMonitoringService($monitoringService);
        if (isset($optionalArgs['projectId'])) {
            $request->setProjectId($optionalArgs['projectId']);
            $requestParamHeaders['project_id'] = $optionalArgs['projectId'];
        }

        if (isset($optionalArgs['zone'])) {
            $request->setZone($optionalArgs['zone']);
            $requestParamHeaders['zone'] = $optionalArgs['zone'];
        }

        if (isset($optionalArgs['clusterId'])) {
            $request->setClusterId($optionalArgs['clusterId']);
            $requestParamHeaders['cluster_id'] = $optionalArgs['clusterId'];
        }

        if (isset($optionalArgs['name'])) {
            $request->setName($optionalArgs['name']);
            $requestParamHeaders['name'] = $optionalArgs['name'];
        }

        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('SetMonitoringService', Operation::class, $optionalArgs, $request)->wait();
    }

    /**
     * Enables or disables Network Policy for a cluster.
     *
     * Sample code:
     * ```
     * $clusterManagerClient = new ClusterManagerClient();
     * try {
     *     $networkPolicy = new NetworkPolicy();
     *     $response = $clusterManagerClient->setNetworkPolicy($networkPolicy);
     * } finally {
     *     $clusterManagerClient->close();
     * }
     * ```
     *
     * @param NetworkPolicy $networkPolicy Required. Configuration options for the NetworkPolicy feature.
     * @param array         $optionalArgs  {
     *     Optional.
     *
     *     @type string $projectId
     *           Deprecated. The Google Developers Console [project ID or project
     *           number](https://developers.google.com/console/help/new/#projectnumber).
     *           This field has been deprecated and replaced by the name field.
     *     @type string $zone
     *           Deprecated. The name of the Google Compute Engine
     *           [zone](https://cloud.google.com/compute/docs/zones#available) in which the
     *           cluster resides. This field has been deprecated and replaced by the name
     *           field.
     *     @type string $clusterId
     *           Deprecated. The name of the cluster.
     *           This field has been deprecated and replaced by the name field.
     *     @type string $name
     *           The name (project, location, cluster id) of the cluster to set networking
     *           policy. Specified in the format `projects/&#42;/locations/&#42;/clusters/*`.
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\Cloud\Container\V1\Operation
     *
     * @throws ApiException if the remote call fails
     */
    public function setNetworkPolicy($networkPolicy, array $optionalArgs = [])
    {
        $request = new SetNetworkPolicyRequest();
        $requestParamHeaders = [];
        $request->setNetworkPolicy($networkPolicy);
        if (isset($optionalArgs['projectId'])) {
            $request->setProjectId($optionalArgs['projectId']);
            $requestParamHeaders['project_id'] = $optionalArgs['projectId'];
        }

        if (isset($optionalArgs['zone'])) {
            $request->setZone($optionalArgs['zone']);
            $requestParamHeaders['zone'] = $optionalArgs['zone'];
        }

        if (isset($optionalArgs['clusterId'])) {
            $request->setClusterId($optionalArgs['clusterId']);
            $requestParamHeaders['cluster_id'] = $optionalArgs['clusterId'];
        }

        if (isset($optionalArgs['name'])) {
            $request->setName($optionalArgs['name']);
            $requestParamHeaders['name'] = $optionalArgs['name'];
        }

        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('SetNetworkPolicy', Operation::class, $optionalArgs, $request)->wait();
    }

    /**
     * Sets the autoscaling settings for the specified node pool.
     *
     * Sample code:
     * ```
     * $clusterManagerClient = new ClusterManagerClient();
     * try {
     *     $autoscaling = new NodePoolAutoscaling();
     *     $response = $clusterManagerClient->setNodePoolAutoscaling($autoscaling);
     * } finally {
     *     $clusterManagerClient->close();
     * }
     * ```
     *
     * @param NodePoolAutoscaling $autoscaling  Required. Autoscaling configuration for the node pool.
     * @param array               $optionalArgs {
     *     Optional.
     *
     *     @type string $projectId
     *           Deprecated. The Google Developers Console [project ID or project
     *           number](https://support.google.com/cloud/answer/6158840).
     *           This field has been deprecated and replaced by the name field.
     *     @type string $zone
     *           Deprecated. The name of the Google Compute Engine
     *           [zone](https://cloud.google.com/compute/docs/zones#available) in which the
     *           cluster resides. This field has been deprecated and replaced by the name
     *           field.
     *     @type string $clusterId
     *           Deprecated. The name of the cluster to upgrade.
     *           This field has been deprecated and replaced by the name field.
     *     @type string $nodePoolId
     *           Deprecated. The name of the node pool to upgrade.
     *           This field has been deprecated and replaced by the name field.
     *     @type string $name
     *           The name (project, location, cluster, node pool) of the node pool to set
     *           autoscaler settings. Specified in the format
     *           `projects/&#42;/locations/&#42;/clusters/&#42;/nodePools/*`.
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\Cloud\Container\V1\Operation
     *
     * @throws ApiException if the remote call fails
     */
    public function setNodePoolAutoscaling($autoscaling, array $optionalArgs = [])
    {
        $request = new SetNodePoolAutoscalingRequest();
        $requestParamHeaders = [];
        $request->setAutoscaling($autoscaling);
        if (isset($optionalArgs['projectId'])) {
            $request->setProjectId($optionalArgs['projectId']);
            $requestParamHeaders['project_id'] = $optionalArgs['projectId'];
        }

        if (isset($optionalArgs['zone'])) {
            $request->setZone($optionalArgs['zone']);
            $requestParamHeaders['zone'] = $optionalArgs['zone'];
        }

        if (isset($optionalArgs['clusterId'])) {
            $request->setClusterId($optionalArgs['clusterId']);
            $requestParamHeaders['cluster_id'] = $optionalArgs['clusterId'];
        }

        if (isset($optionalArgs['nodePoolId'])) {
            $request->setNodePoolId($optionalArgs['nodePoolId']);
            $requestParamHeaders['node_pool_id'] = $optionalArgs['nodePoolId'];
        }

        if (isset($optionalArgs['name'])) {
            $request->setName($optionalArgs['name']);
            $requestParamHeaders['name'] = $optionalArgs['name'];
        }

        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('SetNodePoolAutoscaling', Operation::class, $optionalArgs, $request)->wait();
    }

    /**
     * Sets the NodeManagement options for a node pool.
     *
     * Sample code:
     * ```
     * $clusterManagerClient = new ClusterManagerClient();
     * try {
     *     $management = new NodeManagement();
     *     $response = $clusterManagerClient->setNodePoolManagement($management);
     * } finally {
     *     $clusterManagerClient->close();
     * }
     * ```
     *
     * @param NodeManagement $management   Required. NodeManagement configuration for the node pool.
     * @param array          $optionalArgs {
     *     Optional.
     *
     *     @type string $projectId
     *           Deprecated. The Google Developers Console [project ID or project
     *           number](https://support.google.com/cloud/answer/6158840).
     *           This field has been deprecated and replaced by the name field.
     *     @type string $zone
     *           Deprecated. The name of the Google Compute Engine
     *           [zone](https://cloud.google.com/compute/docs/zones#available) in which the
     *           cluster resides. This field has been deprecated and replaced by the name
     *           field.
     *     @type string $clusterId
     *           Deprecated. The name of the cluster to update.
     *           This field has been deprecated and replaced by the name field.
     *     @type string $nodePoolId
     *           Deprecated. The name of the node pool to update.
     *           This field has been deprecated and replaced by the name field.
     *     @type string $name
     *           The name (project, location, cluster, node pool id) of the node pool to set
     *           management properties. Specified in the format
     *           `projects/&#42;/locations/&#42;/clusters/&#42;/nodePools/*`.
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\Cloud\Container\V1\Operation
     *
     * @throws ApiException if the remote call fails
     */
    public function setNodePoolManagement($management, array $optionalArgs = [])
    {
        $request = new SetNodePoolManagementRequest();
        $requestParamHeaders = [];
        $request->setManagement($management);
        if (isset($optionalArgs['projectId'])) {
            $request->setProjectId($optionalArgs['projectId']);
            $requestParamHeaders['project_id'] = $optionalArgs['projectId'];
        }

        if (isset($optionalArgs['zone'])) {
            $request->setZone($optionalArgs['zone']);
            $requestParamHeaders['zone'] = $optionalArgs['zone'];
        }

        if (isset($optionalArgs['clusterId'])) {
            $request->setClusterId($optionalArgs['clusterId']);
            $requestParamHeaders['cluster_id'] = $optionalArgs['clusterId'];
        }

        if (isset($optionalArgs['nodePoolId'])) {
            $request->setNodePoolId($optionalArgs['nodePoolId']);
            $requestParamHeaders['node_pool_id'] = $optionalArgs['nodePoolId'];
        }

        if (isset($optionalArgs['name'])) {
            $request->setName($optionalArgs['name']);
            $requestParamHeaders['name'] = $optionalArgs['name'];
        }

        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('SetNodePoolManagement', Operation::class, $optionalArgs, $request)->wait();
    }

    /**
     * Sets the size for a specific node pool.
     *
     * Sample code:
     * ```
     * $clusterManagerClient = new ClusterManagerClient();
     * try {
     *     $nodeCount = 0;
     *     $response = $clusterManagerClient->setNodePoolSize($nodeCount);
     * } finally {
     *     $clusterManagerClient->close();
     * }
     * ```
     *
     * @param int   $nodeCount    Required. The desired node count for the pool.
     * @param array $optionalArgs {
     *     Optional.
     *
     *     @type string $projectId
     *           Deprecated. The Google Developers Console [project ID or project
     *           number](https://support.google.com/cloud/answer/6158840).
     *           This field has been deprecated and replaced by the name field.
     *     @type string $zone
     *           Deprecated. The name of the Google Compute Engine
     *           [zone](https://cloud.google.com/compute/docs/zones#available) in which the
     *           cluster resides. This field has been deprecated and replaced by the name
     *           field.
     *     @type string $clusterId
     *           Deprecated. The name of the cluster to update.
     *           This field has been deprecated and replaced by the name field.
     *     @type string $nodePoolId
     *           Deprecated. The name of the node pool to update.
     *           This field has been deprecated and replaced by the name field.
     *     @type string $name
     *           The name (project, location, cluster, node pool id) of the node pool to set
     *           size.
     *           Specified in the format `projects/&#42;/locations/&#42;/clusters/&#42;/nodePools/*`.
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\Cloud\Container\V1\Operation
     *
     * @throws ApiException if the remote call fails
     */
    public function setNodePoolSize($nodeCount, array $optionalArgs = [])
    {
        $request = new SetNodePoolSizeRequest();
        $requestParamHeaders = [];
        $request->setNodeCount($nodeCount);
        if (isset($optionalArgs['projectId'])) {
            $request->setProjectId($optionalArgs['projectId']);
            $requestParamHeaders['project_id'] = $optionalArgs['projectId'];
        }

        if (isset($optionalArgs['zone'])) {
            $request->setZone($optionalArgs['zone']);
            $requestParamHeaders['zone'] = $optionalArgs['zone'];
        }

        if (isset($optionalArgs['clusterId'])) {
            $request->setClusterId($optionalArgs['clusterId']);
            $requestParamHeaders['cluster_id'] = $optionalArgs['clusterId'];
        }

        if (isset($optionalArgs['nodePoolId'])) {
            $request->setNodePoolId($optionalArgs['nodePoolId']);
            $requestParamHeaders['node_pool_id'] = $optionalArgs['nodePoolId'];
        }

        if (isset($optionalArgs['name'])) {
            $request->setName($optionalArgs['name']);
            $requestParamHeaders['name'] = $optionalArgs['name'];
        }

        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('SetNodePoolSize', Operation::class, $optionalArgs, $request)->wait();
    }

    /**
     * Starts master IP rotation.
     *
     * Sample code:
     * ```
     * $clusterManagerClient = new ClusterManagerClient();
     * try {
     *     $response = $clusterManagerClient->startIPRotation();
     * } finally {
     *     $clusterManagerClient->close();
     * }
     * ```
     *
     * @param array $optionalArgs {
     *     Optional.
     *
     *     @type string $projectId
     *           Deprecated. The Google Developers Console [project ID or project
     *           number](https://developers.google.com/console/help/new/#projectnumber).
     *           This field has been deprecated and replaced by the name field.
     *     @type string $zone
     *           Deprecated. The name of the Google Compute Engine
     *           [zone](https://cloud.google.com/compute/docs/zones#available) in which the
     *           cluster resides. This field has been deprecated and replaced by the name
     *           field.
     *     @type string $clusterId
     *           Deprecated. The name of the cluster.
     *           This field has been deprecated and replaced by the name field.
     *     @type string $name
     *           The name (project, location, cluster id) of the cluster to start IP
     *           rotation. Specified in the format `projects/&#42;/locations/&#42;/clusters/*`.
     *     @type bool $rotateCredentials
     *           Whether to rotate credentials during IP rotation.
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\Cloud\Container\V1\Operation
     *
     * @throws ApiException if the remote call fails
     */
    public function startIPRotation(array $optionalArgs = [])
    {
        $request = new StartIPRotationRequest();
        $requestParamHeaders = [];
        if (isset($optionalArgs['projectId'])) {
            $request->setProjectId($optionalArgs['projectId']);
            $requestParamHeaders['project_id'] = $optionalArgs['projectId'];
        }

        if (isset($optionalArgs['zone'])) {
            $request->setZone($optionalArgs['zone']);
            $requestParamHeaders['zone'] = $optionalArgs['zone'];
        }

        if (isset($optionalArgs['clusterId'])) {
            $request->setClusterId($optionalArgs['clusterId']);
            $requestParamHeaders['cluster_id'] = $optionalArgs['clusterId'];
        }

        if (isset($optionalArgs['name'])) {
            $request->setName($optionalArgs['name']);
            $requestParamHeaders['name'] = $optionalArgs['name'];
        }

        if (isset($optionalArgs['rotateCredentials'])) {
            $request->setRotateCredentials($optionalArgs['rotateCredentials']);
        }

        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('StartIPRotation', Operation::class, $optionalArgs, $request)->wait();
    }

    /**
     * Updates the settings of a specific cluster.
     *
     * Sample code:
     * ```
     * $clusterManagerClient = new ClusterManagerClient();
     * try {
     *     $update = new ClusterUpdate();
     *     $response = $clusterManagerClient->updateCluster($update);
     * } finally {
     *     $clusterManagerClient->close();
     * }
     * ```
     *
     * @param ClusterUpdate $update       Required. A description of the update.
     * @param array         $optionalArgs {
     *     Optional.
     *
     *     @type string $projectId
     *           Deprecated. The Google Developers Console [project ID or project
     *           number](https://support.google.com/cloud/answer/6158840).
     *           This field has been deprecated and replaced by the name field.
     *     @type string $zone
     *           Deprecated. The name of the Google Compute Engine
     *           [zone](https://cloud.google.com/compute/docs/zones#available) in which the
     *           cluster resides. This field has been deprecated and replaced by the name
     *           field.
     *     @type string $clusterId
     *           Deprecated. The name of the cluster to upgrade.
     *           This field has been deprecated and replaced by the name field.
     *     @type string $name
     *           The name (project, location, cluster) of the cluster to update.
     *           Specified in the format `projects/&#42;/locations/&#42;/clusters/*`.
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\Cloud\Container\V1\Operation
     *
     * @throws ApiException if the remote call fails
     */
    public function updateCluster($update, array $optionalArgs = [])
    {
        $request = new UpdateClusterRequest();
        $requestParamHeaders = [];
        $request->setUpdate($update);
        if (isset($optionalArgs['projectId'])) {
            $request->setProjectId($optionalArgs['projectId']);
            $requestParamHeaders['project_id'] = $optionalArgs['projectId'];
        }

        if (isset($optionalArgs['zone'])) {
            $request->setZone($optionalArgs['zone']);
            $requestParamHeaders['zone'] = $optionalArgs['zone'];
        }

        if (isset($optionalArgs['clusterId'])) {
            $request->setClusterId($optionalArgs['clusterId']);
            $requestParamHeaders['cluster_id'] = $optionalArgs['clusterId'];
        }

        if (isset($optionalArgs['name'])) {
            $request->setName($optionalArgs['name']);
            $requestParamHeaders['name'] = $optionalArgs['name'];
        }

        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('UpdateCluster', Operation::class, $optionalArgs, $request)->wait();
    }

    /**
     * Updates the master for a specific cluster.
     *
     * Sample code:
     * ```
     * $clusterManagerClient = new ClusterManagerClient();
     * try {
     *     $masterVersion = 'master_version';
     *     $response = $clusterManagerClient->updateMaster($masterVersion);
     * } finally {
     *     $clusterManagerClient->close();
     * }
     * ```
     *
     * @param string $masterVersion Required. The Kubernetes version to change the master to.
     *
     *                              Users may specify either explicit versions offered by Kubernetes Engine or
     *                              version aliases, which have the following behavior:
     *
     *                              - "latest": picks the highest valid Kubernetes version
     *                              - "1.X": picks the highest valid patch+gke.N patch in the 1.X version
     *                              - "1.X.Y": picks the highest valid gke.N patch in the 1.X.Y version
     *                              - "1.X.Y-gke.N": picks an explicit Kubernetes version
     *                              - "-": picks the default Kubernetes version
     * @param array  $optionalArgs  {
     *     Optional.
     *
     *     @type string $projectId
     *           Deprecated. The Google Developers Console [project ID or project
     *           number](https://support.google.com/cloud/answer/6158840).
     *           This field has been deprecated and replaced by the name field.
     *     @type string $zone
     *           Deprecated. The name of the Google Compute Engine
     *           [zone](https://cloud.google.com/compute/docs/zones#available) in which the
     *           cluster resides. This field has been deprecated and replaced by the name
     *           field.
     *     @type string $clusterId
     *           Deprecated. The name of the cluster to upgrade.
     *           This field has been deprecated and replaced by the name field.
     *     @type string $name
     *           The name (project, location, cluster) of the cluster to update.
     *           Specified in the format `projects/&#42;/locations/&#42;/clusters/*`.
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\Cloud\Container\V1\Operation
     *
     * @throws ApiException if the remote call fails
     */
    public function updateMaster($masterVersion, array $optionalArgs = [])
    {
        $request = new UpdateMasterRequest();
        $requestParamHeaders = [];
        $request->setMasterVersion($masterVersion);
        if (isset($optionalArgs['projectId'])) {
            $request->setProjectId($optionalArgs['projectId']);
            $requestParamHeaders['project_id'] = $optionalArgs['projectId'];
        }

        if (isset($optionalArgs['zone'])) {
            $request->setZone($optionalArgs['zone']);
            $requestParamHeaders['zone'] = $optionalArgs['zone'];
        }

        if (isset($optionalArgs['clusterId'])) {
            $request->setClusterId($optionalArgs['clusterId']);
            $requestParamHeaders['cluster_id'] = $optionalArgs['clusterId'];
        }

        if (isset($optionalArgs['name'])) {
            $request->setName($optionalArgs['name']);
            $requestParamHeaders['name'] = $optionalArgs['name'];
        }

        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('UpdateMaster', Operation::class, $optionalArgs, $request)->wait();
    }

    /**
     * Updates the version and/or image type for the specified node pool.
     *
     * Sample code:
     * ```
     * $clusterManagerClient = new ClusterManagerClient();
     * try {
     *     $nodeVersion = 'node_version';
     *     $imageType = 'image_type';
     *     $response = $clusterManagerClient->updateNodePool($nodeVersion, $imageType);
     * } finally {
     *     $clusterManagerClient->close();
     * }
     * ```
     *
     * @param string $nodeVersion  Required. The Kubernetes version to change the nodes to (typically an
     *                             upgrade).
     *
     *                             Users may specify either explicit versions offered by Kubernetes Engine or
     *                             version aliases, which have the following behavior:
     *
     *                             - "latest": picks the highest valid Kubernetes version
     *                             - "1.X": picks the highest valid patch+gke.N patch in the 1.X version
     *                             - "1.X.Y": picks the highest valid gke.N patch in the 1.X.Y version
     *                             - "1.X.Y-gke.N": picks an explicit Kubernetes version
     *                             - "-": picks the Kubernetes master version
     * @param string $imageType    Required. The desired image type for the node pool.
     * @param array  $optionalArgs {
     *     Optional.
     *
     *     @type string $projectId
     *           Deprecated. The Google Developers Console [project ID or project
     *           number](https://support.google.com/cloud/answer/6158840).
     *           This field has been deprecated and replaced by the name field.
     *     @type string $zone
     *           Deprecated. The name of the Google Compute Engine
     *           [zone](https://cloud.google.com/compute/docs/zones#available) in which the
     *           cluster resides. This field has been deprecated and replaced by the name
     *           field.
     *     @type string $clusterId
     *           Deprecated. The name of the cluster to upgrade.
     *           This field has been deprecated and replaced by the name field.
     *     @type string $nodePoolId
     *           Deprecated. The name of the node pool to upgrade.
     *           This field has been deprecated and replaced by the name field.
     *     @type string $name
     *           The name (project, location, cluster, node pool) of the node pool to
     *           update. Specified in the format
     *           `projects/&#42;/locations/&#42;/clusters/&#42;/nodePools/*`.
     *     @type string[] $locations
     *           The desired list of Google Compute Engine
     *           [zones](https://cloud.google.com/compute/docs/zones#available) in which the
     *           node pool's nodes should be located. Changing the locations for a node pool
     *           will result in nodes being either created or removed from the node pool,
     *           depending on whether locations are being added or removed.
     *     @type WorkloadMetadataConfig $workloadMetadataConfig
     *           The desired workload metadata config for the node pool.
     *     @type UpgradeSettings $upgradeSettings
     *           Upgrade settings control disruption and speed of the upgrade.
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\Cloud\Container\V1\Operation
     *
     * @throws ApiException if the remote call fails
     */
    public function updateNodePool($nodeVersion, $imageType, array $optionalArgs = [])
    {
        $request = new UpdateNodePoolRequest();
        $requestParamHeaders = [];
        $request->setNodeVersion($nodeVersion);
        $request->setImageType($imageType);
        if (isset($optionalArgs['projectId'])) {
            $request->setProjectId($optionalArgs['projectId']);
            $requestParamHeaders['project_id'] = $optionalArgs['projectId'];
        }

        if (isset($optionalArgs['zone'])) {
            $request->setZone($optionalArgs['zone']);
            $requestParamHeaders['zone'] = $optionalArgs['zone'];
        }

        if (isset($optionalArgs['clusterId'])) {
            $request->setClusterId($optionalArgs['clusterId']);
            $requestParamHeaders['cluster_id'] = $optionalArgs['clusterId'];
        }

        if (isset($optionalArgs['nodePoolId'])) {
            $request->setNodePoolId($optionalArgs['nodePoolId']);
            $requestParamHeaders['node_pool_id'] = $optionalArgs['nodePoolId'];
        }

        if (isset($optionalArgs['name'])) {
            $request->setName($optionalArgs['name']);
            $requestParamHeaders['name'] = $optionalArgs['name'];
        }

        if (isset($optionalArgs['locations'])) {
            $request->setLocations($optionalArgs['locations']);
        }

        if (isset($optionalArgs['workloadMetadataConfig'])) {
            $request->setWorkloadMetadataConfig($optionalArgs['workloadMetadataConfig']);
        }

        if (isset($optionalArgs['upgradeSettings'])) {
            $request->setUpgradeSettings($optionalArgs['upgradeSettings']);
        }

        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('UpdateNodePool', Operation::class, $optionalArgs, $request)->wait();
    }
}
