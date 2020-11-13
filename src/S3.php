<?php

/**
 * Client used to interact with Amazon Simple Storage Service (Amazon S3).
 *
 * @author Mert Metin <mert@proximify.ca>
 * @copyright Copyright (c) 2020, Proximify Inc
 * @license   MIT
 * @version   1.0 UNIWeb Module
 * @see https://aws.amazon.com/s3/
 */

namespace Proximify;

use Aws\S3\S3Client;  
use Aws\Exception\AwsException;
use Aws\Credentials\Credentials;
use Exception;

class S3
{
    /**
     * The client for accessing the Amazon S3 web service
     */
    public static $client;

    public static function validate($credentials): void
    {
        if (empty($credentials['key']) || empty($credentials['secret']))
            throw new Exception('AWS credentials are required to use buckets.');
    }

    /**
     * Creates a new S3 client instance with the options
     */
    public static function init(array $credentials = [], array $options = []): void
    {
        self::validate($credentials);

        $key = $credentials['key'];
        $secret = $credentials['secret'];

        self::$client = new S3Client([
            'version'     => 'latest',
            'region'      =>  'ca-central-1',
            'credentials' => new Credentials($key, $secret)
        ]);
    }

    /**
     * Creates a new S3 bucket
     * 
     * @param string $bucketName Bucket to create
     * @return string $effectiveUri Bucket's URL
     */
    public static function create(string $bucketName): string
    {
        if (!S3Client::isBucketDnsCompatible($bucketName))
            throw new Exception('The bucket name is invalid.');
        
        if (self::$client->doesBucketExist($bucketName))
            throw new Exception('The bucket with this name already exists.');

        try {
            $result = self::$client->createBucket([
                'Bucket' => $bucketName,
            ]);
        } catch (AwsException $e) {
            return 'Error: ' . $e->getAwsErrorMessage();
        }

        $effectiveUri = $result['@metadata']['effectiveUri'];

        return $effectiveUri;
    }


    /**
     * Returns a list of all buckets owned by the
     *  authenticated sender of the request
     * 
     * @return array $buckets Buckets
     */
    public static function list(): array
    {
         try {
            $buckets = self::$client->listBuckets();
        } catch (AwsException $e) {
            return 'Error: ' . $e->getAwsErrorMessage();
        }

        $buckets = $buckets->toArray();

        return $buckets;
    }   

    /**
     * Deletes the S3 bucket
     * 
     * @param string $bucketName Bucket to delete
     * @return string $effectiveUri Bucket's URL
     */
    public static function delete(string $bucketName): string
    {
        //  The Bucket must be empty before deleting it.
        self::empty($bucketName);

        try {
            $result = self::$client->deleteBucket([
                'Bucket' => $bucketName,
            ]);
        } catch (AwsException $e) {
            return 'Error: ' . $e->getAwsErrorMessage();
        }

        $effectiveUri = $result['@metadata']['effectiveUri'];

        return $effectiveUri;
    }
    
    /**
     * Efficiently deletes many objects from a single Amazon S3 
     *  bucket using an iterator that yields keys
     * 
     * @param string $bucketName Bucket to empty
     */
    public static function empty($bucketName): void
    {
        $batch = \Aws\S3\BatchDelete::
            fromListObjects(self::$client, ['Bucket' => $bucketName]);
        $batch->delete();
    }

    /**
     * Adds a file to a bucket
     *
     * @param string $bucketName Bucket to add an object
     * @param string $file Path of the file
     * @param $path The path to add the file
     * 
     * @return string $effectiveUri Object's URL
     */
    public static function put(string $bucketName, 
        string $file, $path = NULL): string
    {
        if (!file_exists($file))
            throw new Exception('The file doesn\'t exist.');

        $basename =  basename($file);
        $path = ($path) ?  $path . '/' . $basename : $basename;

        try {
            $result = self::$client->putObject([
                'Bucket' => $bucketName,
                'Key' => $path,
                'SourceFile' => $file,
            ]);
        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }

        $effectiveUri = $result['@metadata']['effectiveUri'];

        return $effectiveUri;
    }


    /**
     * Removes the null version (if there is one) of an object and inserts 
     * a delete marker, which becomes the latest version of the object
     * 
     * @param string $bucketName Bucket to delete the object
     * @param string $file Path of the file
     * @param $path The path to delete the file from
     * 
     * @return string $effectiveUri Object's URL
     */
    public static function deleteObject(string $bucketName, string $file): string
    {
        try {
            $result = self::$client->deleteObject([
                'Bucket' => $bucketName,
                'Key'    => $file
            ]);
        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }

        $effectiveUri = $result['@metadata']['effectiveUri'];

        return $effectiveUri;
    }
}