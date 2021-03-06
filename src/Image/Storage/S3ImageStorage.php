<?php
/**
 * Part of unidev project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

namespace Lyrasoft\Unidev\Image\Storage;

use Lyrasoft\Unidev\S3\S3Helper;

/**
 * The S3ImageStorage class.
 *
 * @since  1.0
 */
class S3ImageStorage implements ImageStorageInterface
{
	/**
	 * uploadRaw
	 *
	 * @param   string  $image
	 * @param   string  $path
	 *
	 * @return  string
	 */
	public function uploadRaw($image, $path)
	{
		S3Helper::putObject($image, S3Helper::getBucketName(), $path, \S3::ACL_PUBLIC_READ);

		return static::getRemoteUrl($path);
	}

	/**
	 * upload
	 *
	 * @param   string  $file
	 * @param   string  $path
	 *
	 * @return  string
	 */
	public function upload($file, $path)
	{
		S3Helper::upload($file, $path);

		return static::getRemoteUrl($path);
	}

	/**
	 * delete
	 *
	 * @param   string  $path
	 *
	 * @return  boolean
	 */
	public function delete($path)
	{
		return S3Helper::delete($path);
	}

	/**
	 * getHost
	 *
	 * @return  string
	 */
	public function getHost()
	{
		return S3Helper::getHost();
	}

	/**
	 * getRemoteUrl
	 *
	 * @param   string $uri
	 *
	 * @return  string
	 */
	public function getRemoteUrl($uri)
	{
		return rtrim(static::getHost(), '/') . '/' . ltrim($uri, '/');
	}
}
