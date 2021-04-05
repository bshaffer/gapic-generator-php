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
 * https://github.com/google/googleapis/blob/master/google/cloud/retail/v2alpha/prediction_service.proto
 * and updates to that file get reflected here through a refresh process.
 *
 * @experimental
 */

namespace Google\Cloud\Retail\V2alpha\Gapic;

use Google\ApiCore\ApiException;
use Google\ApiCore\CredentialsWrapper;

use Google\ApiCore\GapicClientTrait;

use Google\ApiCore\RequestParamsHeaderDescriptor;
use Google\ApiCore\RetrySettings;
use Google\ApiCore\Transport\TransportInterface;
use Google\ApiCore\ValidationException;
use Google\Auth\FetchAuthTokenInterface;
use Google\Cloud\Retail\V2alpha\PredictRequest;
use Google\Cloud\Retail\V2alpha\PredictResponse;
use Google\Cloud\Retail\V2alpha\UserEvent;

/**
 * Service Description: Service for making recommendation prediction.
 *
 * This class provides the ability to make remote calls to the backing service through method
 * calls that map to API methods. Sample code to get started:
 *
 * ```
 * $predictionServiceClient = new PredictionServiceClient();
 * try {
 *     $placement = 'placement';
 *     $userEvent = new UserEvent();
 *     $response = $predictionServiceClient->predict($placement, $userEvent);
 * } finally {
 *     $predictionServiceClient->close();
 * }
 * ```
 */
class PredictionServiceGapicClient
{
    use GapicClientTrait;

    /**
     * The name of the service.
     */
    const SERVICE_NAME = 'google.cloud.retail.v2alpha.PredictionService';

    /**
     * The default address of the service.
     */
    const SERVICE_ADDRESS = 'retail.googleapis.com';

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
            'clientConfig' => __DIR__ . '/../resources/prediction_service_client_config.json',
            'descriptorsConfigPath' => __DIR__ . '/../resources/prediction_service_descriptor_config.php',
            'gcpApiConfigPath' => __DIR__ . '/../resources/prediction_service_grpc_config.json',
            'credentialsConfig' => [
                'defaultScopes' => self::$serviceScopes,
            ],
            'transportConfig' => [
                'rest' => [
                    'restClientConfigPath' => __DIR__ . '/../resources/prediction_service_rest_client_config.php',
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
     *           as "<uri>:<port>". Default 'retail.googleapis.com:443'.
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
     * Makes a recommendation prediction.
     *
     * Sample code:
     * ```
     * $predictionServiceClient = new PredictionServiceClient();
     * try {
     *     $placement = 'placement';
     *     $userEvent = new UserEvent();
     *     $response = $predictionServiceClient->predict($placement, $userEvent);
     * } finally {
     *     $predictionServiceClient->close();
     * }
     * ```
     *
     * @param string    $placement    Required. Full resource name of the format:
     *                                {name=projects/&#42;/locations/global/catalogs/default_catalog/placements/*}
     *                                The id of the recommendation engine placement. This id is used to identify
     *                                the set of models that will be used to make the prediction.
     *
     *                                We currently support three placements with the following IDs by default:
     *
     *                                * `shopping_cart`: Predicts products frequently bought together with one or
     *                                more  products in the same shopping session. Commonly displayed after
     *                                `add-to-cart` events, on product detail pages, or on the shopping cart
     *                                page.
     *
     *                                * `home_page`: Predicts the next product that a user will most likely
     *                                engage with or purchase based on the shopping or viewing history of the
     *                                specified `userId` or `visitorId`. For example - Recommendations for you.
     *
     *                                * `product_detail`: Predicts the next product that a user will most likely
     *                                engage with or purchase. The prediction is based on the shopping or
     *                                viewing history of the specified `userId` or `visitorId` and its
     *                                relevance to a specified `CatalogItem`. Typically used on product detail
     *                                pages. For example - More products like this.
     *
     *                                * `recently_viewed_default`: Returns up to 75 products recently viewed by
     *                                the specified `userId` or `visitorId`, most recent ones first. Returns
     *                                nothing if neither of them has viewed any products yet. For example -
     *                                Recently viewed.
     *
     *                                The full list of available placements can be seen at
     *                                https://console.cloud.google.com/recommendation/catalogs/default_catalog/placements
     * @param UserEvent $userEvent    Required. Context about the user, what they are looking at and what action
     *                                they took to trigger the predict request. Note that this user event detail
     *                                won't be ingested to userEvent logs. Thus, a separate userEvent write
     *                                request is required for event logging.
     * @param array     $optionalArgs {
     *     Optional.
     *
     *     @type int $pageSize
     *           Maximum number of results to return per page. Set this property
     *           to the number of prediction results needed. If zero, the service will
     *           choose a reasonable default. The maximum allowed value is 100. Values
     *           above 100 will be coerced to 100.
     *     @type string $pageToken
     *           The previous PredictResponse.next_page_token.
     *     @type string $filter
     *           Filter for restricting prediction results with a length limit of 5,000
     *           characters. Accepts values for tags and the `filterOutOfStockItems` flag.
     *
     *           * Tag expressions. Restricts predictions to products that match all of the
     *           specified tags. Boolean operators `OR` and `NOT` are supported if the
     *           expression is enclosed in parentheses, and must be separated from the
     *           tag values by a space. `-"tagA"` is also supported and is equivalent to
     *           `NOT "tagA"`. Tag values must be double quoted UTF-8 encoded strings
     *           with a size limit of 1,000 characters.
     *
     *           * filterOutOfStockItems. Restricts predictions to products that do not
     *           have a
     *           stockState value of OUT_OF_STOCK.
     *
     *           Examples:
     *
     *           * tag=("Red" OR "Blue") tag="New-Arrival" tag=(NOT "promotional")
     *           * filterOutOfStockItems  tag=(-"promotional")
     *           * filterOutOfStockItems
     *
     *           If your filter blocks all prediction results, nothing will be returned. If
     *           you want generic (unfiltered) popular products to be returned instead, set
     *           `strictFiltering` to false in `PredictRequest.params`.
     *     @type bool $validateOnly
     *           Use validate only mode for this prediction query. If set to true, a
     *           dummy model will be used that returns arbitrary products.
     *           Note that the validate only mode should only be used for testing the API,
     *           or if the model is not ready.
     *     @type array $params
     *           Additional domain specific parameters for the predictions.
     *
     *           Allowed values:
     *
     *           * `returnProduct`: Boolean. If set to true, the associated product
     *           object will be returned in the `results.metadata` field in the
     *           prediction response.
     *           * `returnScore`: Boolean. If set to true, the prediction 'score'
     *           corresponding to each returned product will be set in the
     *           `results.metadata` field in the prediction response. The given
     *           'score' indicates the probability of an product being clicked/purchased
     *           given the user's context and history.
     *           * `strictFiltering`: Boolean. True by default. If set to false, the service
     *           will return generic (unfiltered) popular products instead of empty if
     *           your filter blocks all prediction results.
     *     @type array $labels
     *           The labels for the predict request.
     *
     *           * Label keys can contain lowercase letters, digits and hyphens, must start
     *           with a letter, and must end with a letter or digit.
     *           * Non-zero label values can contain lowercase letters, digits and hyphens,
     *           must start with a letter, and must end with a letter or digit.
     *           * No more than 64 labels can be associated with a given request.
     *
     *           See https://goo.gl/xmQnxf for more information on and examples of labels.
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\Cloud\Retail\V2alpha\PredictResponse
     *
     * @throws ApiException if the remote call fails
     */
    public function predict($placement, $userEvent, array $optionalArgs = [])
    {
        $request = new PredictRequest();
        $requestParamHeaders = [];
        $request->setPlacement($placement);
        $request->setUserEvent($userEvent);
        $requestParamHeaders['placement'] = $placement;
        if (isset($optionalArgs['pageSize'])) {
            $request->setPageSize($optionalArgs['pageSize']);
        }

        if (isset($optionalArgs['pageToken'])) {
            $request->setPageToken($optionalArgs['pageToken']);
        }

        if (isset($optionalArgs['filter'])) {
            $request->setFilter($optionalArgs['filter']);
        }

        if (isset($optionalArgs['validateOnly'])) {
            $request->setValidateOnly($optionalArgs['validateOnly']);
        }

        if (isset($optionalArgs['params'])) {
            $request->setParams($optionalArgs['params']);
        }

        if (isset($optionalArgs['labels'])) {
            $request->setLabels($optionalArgs['labels']);
        }

        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('Predict', PredictResponse::class, $optionalArgs, $request)->wait();
    }
}
