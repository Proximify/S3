### `init`

<pre>
public static function init(array $credentials, array $options): void
</pre>

#### Description

Creates a new S3 client instance with the options.

#### Parameters

| Option key   | Description                       |
| ------------ | --------------------------------- |
| **credentials** | AWS API credentials (key, secret) |
| **options**       | S3 options (e.g. region)        |

### `create`

<pre>
public static function create($bucketName): string
</pre>

#### Description

Creates a new S3 bucket.

#### Parameters

| Option key   | Description                       |
| ------------ | --------------------------------- |
| **bucketName** | Bucket to create |

### `delete`

<pre>
public static function delete($bucketName): string
</pre>

#### Description

Deletes the S3 bucket.

#### Parameters

| Option key   | Description                       |
| ------------ | --------------------------------- |
| **bucketName** | Name of the bucket to delete |

### `list`

<pre>
public static function list(): array
</pre>

#### Description

Returns a list of all buckets owned by the authenticated sender of the request.

### `empty`

<pre>
public static function empty($bucketName): void
</pre>

#### Description

Efficiently deletes many objects from a single Amazon S3 bucket using an iterator that yields keys.

#### Parameters

| Option key   | Description                       |
| ------------ | --------------------------------- |
| **bucketName** | Name of the bucket to empty |

### `put`

<pre>
public static function put(string $bucketName, string $file, $path = NULL):string
</pre>

#### Description
Adds a file to a bucket
#### Parameters

| Option key   | Description                       |
| ------------ | --------------------------------- |
| **bucketName** | Name of the bucket to put the object |
| **file** | File |
| **path (optional)** | Path to put the file |


### `downloadBucket`

<pre>
public static function downloadBucket(string $bucketName, string $localDir) :void
</pre>

#### Description
Downloads a bucket to the local filesystem
#### Parameters

| Option key   | Description                       |
| ------------ | --------------------------------- |
| **bucketName** | Name of the bucket to put the object |
| **localDir** | Local directory to download to |

### `download`

<pre>
public static function download(string $bucketName, string $localDir, string $path): void
</pre>

#### Description
Path in the bucket to download
#### Parameters

| Option key   | Description                       |
| ------------ | --------------------------------- |
| **bucketName** | Name of the bucket to put the object |
| **localDir** | Local directory to download to |
| **path** | Path in the bucket to download |


### `deleteObject`

<pre>
    public static function deleteObject($bucketName, $file): string
</pre>

#### Description
Removes the null version (if there is one) of an object and inserts a delete marker, which becomes the latest version of the object.
#### Parameters

| Option key   | Description                       |
| ------------ | --------------------------------- |
| **bucketName** | Name of the bucket to delete the object from |
| **file** | File to delete |
