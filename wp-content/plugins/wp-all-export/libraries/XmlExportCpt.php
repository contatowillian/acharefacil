<?php


use Wpae\App\Service\VariationOptions\VariationOptionsFactory;

final class XmlExportCpt
{
    private static $userData = array();

    public static function prepare_data($entry, $exportOptions,
                                        $xmlWriter, &$acfs, &$woo, &$woo_order, $implode_delimiter, $preview, $is_item_data = false, $subID = false)
    {
        $variationOptionsFactory = new  VariationOptionsFactory();
        $variationOptions = $variationOptionsFactory->createVariationOptions(PMXE_EDITION);
	    if($entry instanceof \WP_Post) {
		    $entry = $variationOptions->preprocessPost($entry);
	    }

        $article = array();

	    if(!isset($entry->ID)) {
		    $entryId = $entry->order_id ?? $entry->id;
		    $entry->ID = $entry->id;
	    } else {
		    $entryId = $entry->order_id ?? $entry->ID;
	    }

        // associate exported post with import
        if (!$is_item_data and wp_all_export_is_compatible() && isset($exportOptions['is_generate_import']) && isset($exportOptions['import_id'])) {

	        $postRecord = new \PMXI_Post_Record();
            $postRecord->clear();
            $postRecord->getBy(array(
                'post_id' => $entryId,
                'import_id' => $exportOptions['import_id'],
            ));

            if ($postRecord->isEmpty()) {
                $postRecord->set(array(
                    'post_id' => $entryId,
                    'import_id' => $exportOptions['import_id'],
                    'unique_key' => $entryId,
                    'product_key' => $entryId
                ))->save();
            }
            unset($postRecord);
        }

        $is_xml_export = false;

        if (!empty($xmlWriter) && $exportOptions['export_to'] == XmlExportEngine::EXPORT_TYPE_XML && !in_array($exportOptions['xml_template_type'], array('custom', 'XmlGoogleMerchants'))) {
            $is_xml_export = true;
        }

        if (isset($exportOptions['ids']) && is_array($exportOptions['ids'])) {
            foreach ($exportOptions['ids'] as $ID => $value) {
	            if(is_array($exportOptions['cpt'] ?? '') && in_array('shop_order', $exportOptions['cpt'])) {
		            $pType = 'shop_order';
	            } else {
		            $pType = $entry->post_type ?? $entry->type;
	            }

                if ($is_item_data and $subID != $ID) continue;

                // skip shop order items data
                if ($pType == "shop_order" and strpos($exportOptions['cc_label'][$ID], "item_data__") !== false and !$is_item_data) continue;

                $fieldName = apply_filters('wp_all_export_field_name', wp_all_export_parse_field_name($exportOptions['cc_name'][$ID]), XmlExportEngine::$exportID);
                $fieldValue = str_replace("item_data__", "", $exportOptions['cc_value'][$ID]);
                $fieldLabel = str_replace("item_data__", "", $exportOptions['cc_label'][$ID]);
                $fieldSql = $exportOptions['cc_sql'][$ID];
                $fieldPhp = $exportOptions['cc_php'][$ID];
                $fieldCode = $exportOptions['cc_code'][$ID];
                $fieldType = $exportOptions['cc_type'][$ID];
                $fieldOptions = $exportOptions['cc_options'][$ID];
                $fieldSettings = empty($exportOptions['cc_settings'][$ID]) ? $fieldOptions : $exportOptions['cc_settings'][$ID];

                $fieldSnippet = (!empty($fieldPhp) and !empty($fieldCode)) ? $fieldCode : false;

                if (empty($fieldName) or empty($fieldType) or !is_numeric($ID)) continue;

                $element_name = (!empty($fieldName)) ? $fieldName : 'untitled_' . $ID;
                $element_name_ns = '';

                if ($is_xml_export) {
                    $element_name = (!empty($fieldName)) ? preg_replace('/[^a-z0-9_:-]/i', '', $fieldName) : 'untitled_' . $ID;

                    if (strpos($element_name, ":") !== false) {
                        $element_name_parts = explode(":", $element_name);
                        $element_name_ns = (empty($element_name_parts[0])) ? '' : $element_name_parts[0];
                        $element_name = (empty($element_name_parts[1])) ? 'untitled_' . $ID : preg_replace('/[^a-z0-9_-]/i', '', $element_name_parts[1]);
                    }
                }


                switch ($fieldType) {
                    case 'id':
                        // For ID columns make first element in lowercase for Excel export
                        if ($element_name == 'ID' && !$ID && isset($exportOptions['export_to']) && $exportOptions['export_to'] == 'csv' && isset($exportOptions['export_to_sheet']) && $exportOptions['export_to_sheet'] != 'csv') {
                            $element_name = 'id';
                        }
                        wp_all_export_write_article($article, $element_name, apply_filters('pmxe_post_id', pmxe_filter($entry->ID, $fieldSnippet), $entry->ID));
                        break;
                    case 'permalink':
                        wp_all_export_write_article($article, $element_name, apply_filters('pmxe_post_guid', pmxe_filter(get_permalink(), $fieldSnippet), $entry->ID));
                        break;
                    case 'post_type':
                        if ($entry->post_type == 'product_variation') $pType = 'product';
                        wp_all_export_write_article($article, $element_name, apply_filters('pmxe_post_type', pmxe_filter($pType, $fieldSnippet), $entry->ID));
                        break;
                    case 'title':
                        $val = apply_filters('pmxe_post_title', pmxe_filter($entry->post_title, $fieldSnippet));
                        wp_all_export_write_article($article, $element_name, ($preview) ? trim(preg_replace('~[\r\n]+~', ' ', htmlspecialchars($val))) : $val, $entry->ID);
                        break;
                    case 'content':
                        $postContent = $entry->post_content;

                        $field_settings = (!empty($fieldSettings)) ? json_decode($fieldSettings, true) : false;
                        if (empty($field_settings) or $field_settings['export_images_from_gallery']) {
                            // search for images in galleries
                            $galleries = array();
                            if (preg_match_all('%\[gallery[^\]]*ids="([^\s\]]*)"[^\]]*\]%is', $postContent, $matches, PREG_PATTERN_ORDER)) {
                                $galleries = array_unique(array_filter($matches[1]));
                            }
                            if (!empty($galleries)) {
                                foreach ($galleries as $key => $gallery) {
                                    $gallery_images = array();
                                    $imgs = array_unique(array_filter(explode(",", $gallery)));
                                    if (!empty($imgs)) {
                                        foreach ($imgs as $img) {
                                            if (is_numeric($img)) {
                                                $gallery_images[] = wp_get_attachment_url($img) . "|" . wp_get_attachment_caption($img);
                                            }
                                        }
                                    }
                                    $gallery_images = array_unique($gallery_images);
                                    $postContent = str_replace("ids=\"" . implode(",", $imgs) . "\"", "ids=\"" . implode(",", $gallery_images) . "\"", $postContent);
                                }
                            }
                        }

                        if (isset($exportOptions['export_to']) && $exportOptions['export_to'] == XmlExportEngine::EXPORT_TYPE_XML && $exportOptions['xml_template_type'] == 'custom') {
                            $postContent = str_replace('[', '**OPENSHORTCODE**', $postContent);
                            $postContent = str_replace(']', '**CLOSESHORTCODE**', $postContent);
                        }

                        $val = apply_filters('pmxe_post_content', pmxe_filter($postContent, $fieldSnippet), $entry->ID);
                        wp_all_export_write_article($article, $element_name, ($preview) ? trim(preg_replace('~[\r\n]+~', ' ', htmlspecialchars($val))) : $val);
                        break;

                    // Media Attachments
                    case 'attachments':
                    case 'attachment_id':
                    case 'attachment_url':
                    case 'attachment_filename':
                    case 'attachment_path':
                    case 'attachment_title':
                    case 'attachment_caption':
                    case 'attachment_description':
                    case 'attachment_alt':

                        XmlExportMediaGallery::getInstance($entry->ID);

                        $attachment_data = XmlExportMediaGallery::get_attachments($fieldType);

                        wp_all_export_write_article($article, $element_name, apply_filters('pmxe_' . $fieldType, pmxe_filter(implode($implode_delimiter, $attachment_data), $fieldSnippet), $entry->ID));

                        break;

                    // Media Images
                    case 'media':
                    case 'image_id':
                    case 'image_url':
                    case 'image_filename':
                    case 'image_path':
                    case 'image_title':
                    case 'image_caption':
                    case 'image_description':
                    case 'image_alt':
                    case 'image_featured':

                        $field_options = json_decode($fieldOptions, true);

                        XmlExportMediaGallery::getInstance($entry->ID);

                        $images_data = XmlExportMediaGallery::get_images($fieldType, $field_options);

                        $images_separator = empty($field_options['image_separator']) ? $implode_delimiter : $field_options['image_separator'];

                        wp_all_export_write_article($article, $element_name, apply_filters('pmxe_' . $fieldType, pmxe_filter(implode($images_separator, $images_data), $fieldSnippet), $entry->ID));

                        break;


                    case 'date':
                        $post_date = prepare_date_field_value($fieldSettings, get_post_time('U', true, $entry->ID), "Ymd");
                        wp_all_export_write_article($article, $element_name, apply_filters('pmxe_post_date', pmxe_filter($post_date, $fieldSnippet), $entry->ID));
                        break;
                    case 'post_modified':
                        $post_date = prepare_date_field_value($fieldSettings, get_post_modified_time('U', true, $entry->ID), "Ymd");
                        wp_all_export_write_article($article, $element_name, apply_filters('pmxe_post_modified_date', pmxe_filter($post_date, $fieldSnippet), $entry->ID));
                        break;
                    case 'parent':
                        wp_all_export_write_article($article, $element_name, apply_filters('pmxe_post_parent', pmxe_filter($entry->post_parent, $fieldSnippet), $entry->ID));
                        break;
                    case 'parent_slug':
                        $val = '';
                        if ($entry->post_parent != 0) {
                            $pages = get_post_ancestors($entry->ID);
                            $slugs = array();
                            if (!empty($pages)) {
                                foreach ($pages as $page) {
                                    $the_post = get_post($page);
                                    $slugs[] = $the_post->post_name;
                                }
                                $val = implode("/", array_reverse($slugs));
                            } else {
                                $the_post = get_post($entry->ID);
                                $val = $the_post->post_name;
                            }
                        } else {
                            $val = $entry->post_parent;
                        }
                        wp_all_export_write_article($article, $element_name, apply_filters('pmxe_post_parent_slug', pmxe_filter($val, $fieldSnippet), $entry->ID));
                        break;
                    case 'comment_status':
                        wp_all_export_write_article($article, $element_name, apply_filters('pmxe_comment_status', pmxe_filter($entry->comment_status, $fieldSnippet), $entry->ID));
                        break;
                    case 'ping_status':
                        wp_all_export_write_article($article, $element_name, apply_filters('pmxe_ping_status', pmxe_filter($entry->ping_status, $fieldSnippet), $entry->ID));
                        break;
                    case 'template':
                        wp_all_export_write_article($article, $element_name, apply_filters('pmxe_post_template', pmxe_filter(get_post_meta($entry->ID, '_wp_page_template', true), $fieldSnippet), $entry->ID));
                        break;
                    case 'order':
                        wp_all_export_write_article($article, $element_name, apply_filters('pmxe_menu_order', pmxe_filter($entry->menu_order, $fieldSnippet), $entry->ID));
                        break;
                    case 'status':
                        wp_all_export_write_article($article, $element_name, apply_filters('pmxe_post_status', pmxe_filter($entry->post_status, $fieldSnippet), $entry->ID));
                        break;
                    case 'format':
                        wp_all_export_write_article($article, $element_name, apply_filters('pmxe_post_format', pmxe_filter(get_post_format($entry->ID), $fieldSnippet), $entry->ID));
                        break;
                    case 'author':
                        wp_all_export_write_article($article, $element_name, apply_filters('pmxe_post_author', pmxe_filter($entry->post_author, $fieldSnippet), $entry->ID));
                        break;
                    case 'author_username':
                        $userData = self::getUserdata($entry->post_author);
                        if (is_object($userData)) {
                            $userDataValue = $userData->user_login;
                        } else {
                            $userDataValue = '';
                        }

                        wp_all_export_write_article($article, $element_name, apply_filters('pmxe_post_author', pmxe_filter($userDataValue, $fieldSnippet), $entry->ID));
                        break;
                    case 'author_email':
                        $userData = self::getUserdata($entry->post_author);
                        if (is_object($userData)) {
                            $userDataValue = $userData->user_email;
                        } else {
                            $userDataValue = '';
                        }

                        wp_all_export_write_article($article, $element_name, apply_filters('pmxe_post_author', pmxe_filter($userDataValue, $fieldSnippet), $entry->ID));
                        break;
                    case 'author_first_name':
                        $userData = self::getUserdata($entry->post_author);
                        if (is_object($userData)) {
                            $userDataValue = $userData->first_name;
                        } else {
                            $userDataValue = '';
                        }

                        wp_all_export_write_article($article, $element_name, apply_filters('pmxe_post_author', pmxe_filter($userDataValue, $fieldSnippet), $entry->ID));
                        break;
                    case 'author_last_name':
                        $userData = self::getUserdata($entry->post_author);
                        if (is_object($userData)) {
                            $userDataValue = $userData->last_name;
                        } else {
                            $userDataValue = '';
                        }

                        wp_all_export_write_article($article, $element_name, apply_filters('pmxe_post_author', pmxe_filter($userDataValue, $fieldSnippet), $entry->ID));
                        break;
                    case 'slug':
                        wp_all_export_write_article($article, $element_name, apply_filters('pmxe_post_slug', pmxe_filter($entry->post_name, $fieldSnippet), $entry->ID));
                        break;
                    case 'excerpt':
                        $val = apply_filters('pmxe_post_excerpt', pmxe_filter($entry->post_excerpt, $fieldSnippet), $entry->ID);
                        wp_all_export_write_article($article, $element_name, ($preview) ? trim(preg_replace('~[\r\n]+~', ' ', htmlspecialchars($val))) : $val);
                        break;
                    case 'cf':
                        if (!empty($fieldValue)) {

	                        // Clear the meta values from the previous iteration.
	                        $cur_meta_values = null;

	                        $val = "";

	                        // Retrieve meta from *wc_orders_meta table if order export and HPOS enabled. Ensure a valid order
	                        // object is returned.
	                        if ( $pType === 'shop_order' && PMXE_Plugin::hposEnabled() && $order = wc_get_order( $entry->order_id ?? $entry->ID )) {

		                        $metaName = 'get' . $fieldValue;

		                        if(method_exists('WC_Order', $metaName)) {
			                        $cur_meta_values = $order->$metaName();
		                        }else {
			                        $cur_meta_values = $order->get_meta( $fieldValue );
		                        }
	                        }

	                        // Retrieve meta from *postmeta table if no value was found above.
	                        if ( empty( $cur_meta_values ) ) {
		                        $cur_meta_values = get_post_meta( $entry->order_id ?? $entry->ID, $fieldValue );
	                        }

                            if (!empty($cur_meta_values) and is_array($cur_meta_values)) {
                                foreach ($cur_meta_values as $key => $cur_meta_value) {
                                    if (empty($val)) {
                                        $val = maybe_serialize($cur_meta_value);
                                    } else {
                                        $val = $val . $implode_delimiter . maybe_serialize($cur_meta_value);
                                    }
                                }
                                $val = pmxe_filter($val, $fieldSnippet);
                                wp_all_export_write_article($article, $element_name, ($preview) ? trim(preg_replace('~[\r\n]+~', ' ', htmlspecialchars($val))) : $val);
                            }

                            if (empty($cur_meta_values)) {
                                if (empty($article[$element_name])) {
                                    wp_all_export_write_article($article, $element_name, apply_filters('pmxe_custom_field', pmxe_filter('', $fieldSnippet), $fieldValue, $entry->ID));
                                }
                            }
                        }
                        break;

                    case 'acf':

                        if(XmlExportEngine::get_addons_service()->isAcfAddonActive()) {

                            if (!empty($fieldLabel) and class_exists('acf')) {

                            global $acf;

                            $field_options = unserialize($fieldOptions);

                            if (!$is_xml_export) {
                                switch ($field_options['type']) {
                                    case 'textarea':
                                    case 'oembed':
                                    case 'wysiwyg':
                                    case 'wp_wysiwyg':
                                    case 'date_time_picker':
                                    case 'date_picker':

                                        $field_value = get_field($fieldLabel, $entry->ID, false);

                                        break;

                                    default:

                                        $field_value = get_field($fieldLabel, $entry->ID);

                                        break;
                                }
                            } else {
                                $field_value = get_field($fieldLabel, $entry->ID);
                            }

                                XmlExportACF::export_acf_field(
                                    $field_value,
                                    $exportOptions,
                                    $ID,
                                    $entry->ID,
                                    $article,
                                    $xmlWriter,
                                    $acfs,
                                    $element_name,
                                    $element_name_ns,
                                    $fieldSnippet,
                                    $field_options['group_id'],
                                    $preview
                                );
                            }
                        }

                        break;

                    case 'woo':

                        if ($is_xml_export) {
                            if (XmlExportEngine::get_addons_service()->isWooCommerceAddonActive() || XmlExportEngine::get_addons_service()->isWooCommerceProductAddonActive()) {
                                XmlExportEngine::$woo_export->export_xml($xmlWriter, $entry, $exportOptions, $ID);
                            }
                        } else {
                            if (XmlExportEngine::get_addons_service()->isWooCommerceAddonActive() || XmlExportEngine::get_addons_service()->isWooCommerceProductAddonActive()) {
                                XmlExportEngine::$woo_export->export_csv($article, $woo, $entry, $exportOptions, $ID);
                            }
                        }

                        break;

                    case 'woo_order':

                        if ($is_xml_export) {
                            if (XmlExportEngine::get_addons_service()->isWooCommerceAddonActive() || XmlExportEngine::get_addons_service()->isWooCommerceOrderAddonActive()) {
                                XmlExportEngine::$woo_order_export->export_xml($xmlWriter, $entry, $exportOptions, $ID, $preview);
                            }
                        } else {
                            if (XmlExportEngine::get_addons_service()->isWooCommerceAddonActive() || XmlExportEngine::get_addons_service()->isWooCommerceOrderAddonActive()) {
                                XmlExportEngine::$woo_order_export->export_csv($article, $woo_order, $entry, $exportOptions, $ID, $preview);
                            }
                        }

                        break;

                    case 'attr':

                        if (!empty($fieldValue)) {
                            if ($entry->post_type != 'product_variation') {
                                $txes_list = get_the_terms($entry->ID, $fieldValue);
                                if (!is_wp_error($txes_list) and !empty($txes_list)) {
                                    $attr_new = array();
                                    foreach ($txes_list as $t) {
                                        $attr_new[] = $t->name;
                                    }
                                    wp_all_export_write_article($article, $element_name, apply_filters('pmxe_woo_attribute', pmxe_filter(implode($implode_delimiter, $attr_new), $fieldSnippet), $entry->ID, $fieldValue));
                                } else {
                                    // Write empty value (so the functions are still applied)
                                    wp_all_export_write_article($article, $element_name, pmxe_filter('', $fieldSnippet));
                                }
                            } else {
                                $attribute_pa = apply_filters('pmxe_woo_attribute', get_post_meta($entry->ID, 'attribute_' . strtolower(urlencode($fieldValue)), true), $entry->ID, $fieldValue);
                                $term = get_term_by('slug', $attribute_pa, $fieldValue);
                                if ($term and !is_wp_error($term)) {
                                    $attribute_pa = pmxe_filter($term->name, $fieldSnippet);
                                } else {
                                    // Write empty value (so the functions are still applied)
                                    $attribute_pa = pmxe_filter('', $fieldSnippet);
                                }

                                wp_all_export_write_article($article, $element_name, $attribute_pa);
                            }

                            // if ( ! in_array($element_name, $attributes)) $attributes[] = $element_name;
                        }
                        break;

                    case 'cats':

                        if (!empty($fieldValue)) {

                            // get categories from parent product in case when variation exported
                            if ($fieldLabel != 'product_shipping_class') {
                                // get categories from parent product in case when variation exported
                                $entry_id = ($entry->post_type == 'product_variation') ? $entry->post_parent : $entry->ID;
                            } else {
                                $entry_id = $entry->ID;
                            }

                            // switch to post language if WPML installed
                            if (class_exists('SitePress')) {
                                $post_type = get_post_type($entry_id);
                                $post_type = apply_filters('wpml_element_type', $post_type);
                                $post_language_details = apply_filters('wpml_element_language_details',
                                    null,
                                    array(
                                        'element_id' => $entry_id,
                                        'element_type' => $post_type
                                    )
                                );
                                $language_code = empty($post_language_details->language_code) ? '' : $post_language_details->language_code;
                                $current_language = apply_filters('wpml_current_language', null);
                                do_action('wpml_switch_language', $language_code);
                            }

                            $txes_list = get_the_terms($entry_id, $fieldValue);

                            $hierarchy_groups = array();

                            if (!is_wp_error($txes_list) and !empty($txes_list)) {
                                $txes_ids = array();

                                foreach ($txes_list as $t) {
                                    $txes_ids[] = $t->term_id;
                                }

                                foreach ($txes_list as $t) {
                                    if (wp_all_export_check_children_assign($t->term_id, $fieldValue, $txes_ids)) {
                                        $ancestors = get_ancestors($t->term_id, $fieldValue);
                                        if (count($ancestors) > 0) {
                                            $hierarchy_group = array();
                                            for ($i = count($ancestors) - 1; $i >= 0; $i--) {
                                                $term = get_term_by('id', $ancestors[$i], $fieldValue);
                                                if ($term) {
                                                    $hierarchy_group[] = $term->name;
                                                }
                                            }
                                            $hierarchy_group[] = $t->name;
                                            $hierarchy_groups[] = implode('>', $hierarchy_group);
                                        } else {
                                            $hierarchy_groups[] = $t->name;
                                        }
                                    }
                                }

                                // if ( empty($hierarchy_groups) ) $hierarchy_groups = '';
                            }

                            wp_all_export_write_article($article, $element_name, apply_filters('pmxe_post_taxonomy', pmxe_filter(implode($implode_delimiter, $hierarchy_groups), $fieldSnippet), $entry->ID));

                            // if ( ! in_array($element_name, $taxes)) $taxes[] = $element_name;

                            if ($fieldLabel == 'product_type') {

                                if ($entry->post_type == 'product_variation') $article[$element_name] = 'variable';

                            }

                            // swith to current language if WPML installed
                            if (class_exists('SitePress')) {
                                do_action('wpml_switch_language', $current_language);
                            }
                        }

                        break;

                    case 'sql':

                        if (!empty($fieldSql)) {
                            global $wpdb;
                            $val = $wpdb->get_var($wpdb->prepare(stripcslashes(str_replace("%%ID%%", "%d", $fieldSql)), $entry->ID));
                            if (!empty($fieldPhp) and !empty($fieldCode)) {
                                // if shortcode defined
                                if (strpos($fieldCode, '[') === 0) {
                                    $val = do_shortcode(str_replace("%%VALUE%%", $val, $fieldCode));
                                } else {
                                    $val = eval('return ' . stripcslashes(str_replace("%%VALUE%%", $val, $fieldCode)) . ';');
                                }
                            }
                            wp_all_export_write_article($article, $element_name, apply_filters('pmxe_sql_field', $val, $element_name, $entry->ID));
                        }
                        break;

                    case 'wpml_trid':

                        $post_type = get_post_type($entry->ID);

                        $post_type = apply_filters('wpml_element_type', $post_type);

                        $post_language_details = apply_filters('wpml_element_language_details',
                            null,
                            array(
                                'element_id' => $entry->ID,
                                'element_type' => $post_type
                            )
                        );

                        $trid = empty($post_language_details->trid) ? '' : $post_language_details->trid;

                        wp_all_export_write_article($article, $element_name, apply_filters('pmxe_trid_field', $trid, $element_name, $entry->ID));

                        break;

                    case 'wpml_lang':

                        $post_type = get_post_type($entry->ID);

                        $post_type = apply_filters('wpml_element_type', $post_type);

                        $post_language_details = apply_filters('wpml_element_language_details',
                            null,
                            array(
                                'element_id' => $entry->ID,
                                'element_type' => $post_type
                            )
                        );

                        $language_code = empty($post_language_details->language_code) ? '' : $post_language_details->language_code;

                        wp_all_export_write_article($article, $element_name, apply_filters('pmxe_trid_field', $language_code, $element_name, $entry->ID));

                        break;

                    default:
                        # code...
                        break;

                }
                if ($is_xml_export and isset($article[$element_name])) {
                    $element_name_in_file = XmlCsvExport::_get_valid_header_name($element_name);

	                $element_name_in_file = str_replace(' ', '', $element_name_in_file);
	                $element_name_in_file = str_replace('-', '_', $element_name_in_file);
	                $element_name_in_file = str_replace('/', '_', $element_name_in_file);

	                if(is_numeric(substr($element_name_in_file, 0, 1))){
		                $element_name_in_file = 'prepend_' . $element_name_in_file;
	                }

	                $xmlWriter = apply_filters('wp_all_export_add_before_element', $xmlWriter, $element_name_in_file, XmlExportEngine::$exportID, $entry->ID);

                    $xmlWriter->beginElement($element_name_ns, $element_name_in_file, null);
                    $xmlWriter->writeData($article[$element_name], $element_name_in_file);
                    $xmlWriter->closeElement();

                    $xmlWriter = apply_filters('wp_all_export_add_after_element', $xmlWriter, $element_name_in_file, XmlExportEngine::$exportID, $entry->ID);
                }
            }
        }

        return $article;
    }

    public static function prepare_import_template($exportOptions, &$templateOptions, &$cf_list, &$attr_list, &$taxs_list, $element_name, $ID)
    {
        $options = $exportOptions;

        $element_type = $options['cc_type'][$ID];

        $is_xml_template = $options['export_to'] == 'xml';

        $implode_delimiter = XmlExportEngine::$implode;

        switch ($element_type) {
            case 'id':
                if ($element_name == 'ID' && !$ID && $exportOptions['export_to'] == 'csv' && $exportOptions['export_to_sheet'] != 'csv') {
                    $element_name = 'id';
                }
                $templateOptions['unique_key'] = '{' . $element_name . '[1]}';
                $templateOptions['tmp_unique_key'] = '{' . $element_name . '[1]}';
                $templateOptions['single_product_id'] = '{' . $element_name . '[1]}';
                break;
            case 'title':
                $templateOptions[$element_type] = '{' . $element_name . '[1]}';
                $templateOptions['is_update_' . $options['cc_type'][$ID]] = 1;
                $templateOptions['single_product_id_first_is_variation'] = '{' . $element_name . '[1]}';
                break;
            case 'content':
            case 'author':
                $templateOptions[$element_type] = '{' . $element_name . '[1]}';
                $templateOptions['is_update_' . $options['cc_type'][$ID]] = 1;
                break;
            case 'slug':
                $templateOptions['post_slug'] = '{' . $element_name . '[1]}';
                $templateOptions['is_update_' . $options['cc_type'][$ID]] = 1;
                break;
            case 'parent_slug':
                $templateOptions['is_multiple_page_parent'] = 'no';
                $templateOptions['single_page_parent'] = '{' . $element_name . '[1]}';
                $templateOptions['is_update_parent'] = 1;
                break;
            case 'parent':
                $templateOptions['single_product_parent_id'] = '{' . $element_name . '[1]}';
                $templateOptions['single_product_id_first_is_parent_id'] = '{' . $element_name . '[1]}';
                break;
            case 'excerpt':
                $templateOptions['post_excerpt'] = '{' . $element_name . '[1]}';
                $templateOptions['is_update_' . $options['cc_type'][$ID]] = 1;
                break;
            case 'status':
                $templateOptions['status_xpath'] = '{' . $element_name . '[1]}';
                $templateOptions['is_update_status'] = 1;
                break;
            case 'comment_status':
                $templateOptions['comment_status_xpath'] = '{' . $element_name . '[1]}';
                $templateOptions['is_update_comment_status'] = 1;
                break;
            case 'date':
                $templateOptions[$element_type] = '{' . $element_name . '[1]}';
                $templateOptions['is_update_dates'] = 1;
                break;
            case 'order':
                $templateOptions[$element_type] = '{' . $element_name . '[1]}';
                $templateOptions['is_update_menu_order'] = 1;
                $templateOptions['single_product_menu_order'] = '{' . $element_name . '[1]}';
                break;
            case 'post_type':

                if (empty($options['cpt'])) {
                    $templateOptions['is_override_post_type'] = 1;
                    $templateOptions['post_type_xpath'] = '{' . $element_name . '[1]}';
                }
                break;

            case 'cf':

                if (!empty($options['cc_value'][$ID])) {
                    $exclude_cf = array('_thumbnail_id');

                    if (strpos($options['cc_value'][$ID], 'attribute_') === 0 and !in_array($options['cc_value'][$ID], $attr_list)) {
                        $templateOptions['attribute_name'][] = str_replace('attribute_', '', $options['cc_value'][$ID]);
                        $templateOptions['attribute_value'][] = '{' . $element_name . '[1]}';
                        $templateOptions['in_variations'][] = "1";
                        $templateOptions['is_visible'][] = "1";
                        $templateOptions['is_taxonomy'][] = "0";
                        $templateOptions['create_taxonomy_in_not_exists'][] = "0";
                        $attr_list[] = $options['cc_value'][$ID];
                    } elseif (!in_array($options['cc_value'][$ID], $cf_list) and !in_array($options['cc_value'][$ID], $exclude_cf)) {
                        $cf_list[] = $options['cc_value'][$ID];

                        $templateOptions['custom_name'][] = $options['cc_value'][$ID];
                        $templateOptions['custom_value'][] = '{' . $element_name . '[1]}';
                        $templateOptions['custom_format'][] = 0;
                    }
                }

                break;

            case 'attr':

                if (!empty($options['cc_value'][$ID]) and !in_array($options['cc_value'][$ID], $attr_list)) {
                    $templateOptions['attribute_name'][] = str_replace('pa_', '', $options['cc_value'][$ID]);
                    $templateOptions['attribute_value'][] = '{' . $element_name . '[1]}';
                    $templateOptions['in_variations'][] = "1";
                    $templateOptions['is_visible'][] = "1";
                    $templateOptions['is_taxonomy'][] = "1";
                    $templateOptions['create_taxonomy_in_not_exists'][] = "1";
                    $attr_list[] = $options['cc_value'][$ID];
                }

                break;
            case 'cats':
                if (!empty($options['cc_value'][$ID])) {
                    switch ($options['cc_label'][$ID]) {
                        case 'product_type':
                            $templateOptions['is_multiple_product_type'] = 'no';
                            $templateOptions['single_product_type'] = '{' . $element_name . '[1]}';
                            break;
                        case 'product_shipping_class':
                            $templateOptions['is_multiple_product_shipping_class'] = 'no';
                            $templateOptions['single_product_shipping_class'] = '{' . $element_name . '[1]}';
                            break;
                        default:
                            $taxonomy = $options['cc_value'][$ID];
                            $templateOptions['tax_assing'][$taxonomy] = 1;

                            if (is_taxonomy_hierarchical($taxonomy)) {
                                $templateOptions['tax_logic'][$taxonomy] = 'hierarchical';
                                $templateOptions['tax_hierarchical_logic_entire'][$taxonomy] = 1;
                                $templateOptions['multiple_term_assing'][$taxonomy] = 1;
                                $templateOptions['tax_hierarchical_delim'][$taxonomy] = '>';
                                $templateOptions['is_tax_hierarchical_group_delim'][$taxonomy] = 1;
                                $templateOptions['tax_hierarchical_group_delim'][$taxonomy] = $is_xml_template ? '|' : $implode_delimiter;
                                $templateOptions['tax_hierarchical_xpath'][$taxonomy] = array('{' . $element_name . '[1]}');
                            } else {
                                $templateOptions['tax_logic'][$taxonomy] = 'multiple';
                                $templateOptions['multiple_term_assing'][$taxonomy] = 1;
                                $templateOptions['tax_multiple_xpath'][$taxonomy] = '{' . $element_name . '[1]}';
                                $templateOptions['tax_multiple_delim'][$taxonomy] = $is_xml_template ? '|' : $implode_delimiter;
                            }
                            $taxs_list[] = $taxonomy;
                            break;
                    }
                }
                break;
        }
    }

    static function getUserdata($userId)
    {
        if (!isset(self::$userData[$userId])) {
            self::$userData[$userId] = get_userdata($userId);
        }
        return self::$userData[$userId];
    }
}

