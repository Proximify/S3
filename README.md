# Amazon S3

Amazon Simple Storage Service, or S3 in short, is a service to store and retrieve any amount of data, at any time, from anywhere on the web.


<!-- The TOC can be provided inline as nested bullets or in a separate file. Regardless, this starter file should have links to other root-level doc files so that a reader can navigate all the documentation by reading the text and clicking on hyperlinks within it. -->

## Table of contents
-  See [table of contents](docs/toc.md).

## Installation

<pre>
composer require proximify/s3
</pre>

## API

Check out the [API documentation](docs/api.md).

## Example

### Create a bucket

<pre>
$bucketName = 'yourUniqueBucketName';
$credetials = [
    'key' => 'API_KEY',
    'secret' => 'API_SECRET'
];

S3::init($credentials);
$result = S3::create($bucketName);
</pre>

## Options

The table below shows all the available options accepted by ```init``` function.

| Program  |  Description |
|---|---|
| `region`	| Bucket region. See all the available regions [here](https://docs.aws.amazon.com/AWSEC2/latest/UserGuide/using-regions-availability-zones.html) | 
---

## Testing

Go to dev directory and type:

<pre>
../vendor/bin/phpunit tests/
</pre>

<b>Note:</b> You will need AWS credentials to run the test suit. To get yours, follow the steps [here.](https://docs.aws.amazon.com/general/latest/gr/aws-sec-cred-types.html)

## Contributing

This project welcomes contributions and suggestions. Most contributions require you to agree to a Contributor License Agreement (CLA) declaring that you have the right to and actually do, grant us the rights to use your contribution. For details, visit our [Contributor License Agreement](https://github.com/Proximify/community/blob/master/docs/proximify-contribution-license-agreement.pdf).

When you submit a pull request, we will determine whether you need to provide a CLA and decorate the PR appropriately (e.g., label, comment). Simply follow the instructions provided. You will only need to do this once across all repositories using our CLA.

This project has adopted the [Proximify Open Source Code of Conduct](https://github.com/Proximify/community/blob/master/docs/code_of_conduct.md). For more information see the Code of Conduct FAQ or contact support@proximify.com with any additional questions or comments.

## License

Copyright (c) Proximify Inc. All rights reserved.

Licensed under the [GNU General Public License Version 2](https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html) license.

**Software component** is made by [Proximify](https://proximify.com). We invite the community to participate.