<?php

namespace P4W\Plugin_Manager;

use Vaimo\UnifiedDiffPatcher\Patch\Applier;

class Patcher_PluginsForWP {

	/**
	 * @param string $patch_file The path to the patch (unified diff) file.
	 * @param string $target_dir The directory to which the patch should be applied.
	 *
	 * @return bool
	 */
	public function apply_patch( $patch_file, $target_dir ) {
		if ( ! is_readable( $patch_file ) ) {
			return false;
		}

		$target_dir = rtrim( $target_dir, DIRECTORY_SEPARATOR );
		if ( ! is_dir( $target_dir ) ) {
			return false;
		}

		$result  = false;
		$patcher = new Applier();
		$dir     = getcwd();

		chdir( $target_dir );

		if ( $patcher->validatePatch( $patch_file, 1 ) ) {
			$result = $patcher->processPatch( $patch_file, 1 );
		}

		chdir( $dir );

		return $result;
	}
}
