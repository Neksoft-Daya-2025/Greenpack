$updates = json_decode(file_get_contents('/home/u968429559/greenpack-backups/feedback-v3-20261106/updates.json'), true, 512, JSON_THROW_ON_ERROR);
foreach ($updates as $change) {
    if (get_post_meta($change['id'], '_elementor_data', true) !== $change['expected']) {
        throw new Exception('Concurrent editor change on page ' . $change['id']);
    }
}
if (get_page_by_path('flota-auto') && get_page_by_path('flota-auto')->ID !== 12844) {
    throw new Exception('Fleet slug is already occupied');
}
foreach ($updates as $change) {
    update_post_meta($change['id'], '_elementor_data', wp_slash($change['elementor']));
    if (get_post_meta($change['id'], '_elementor_data', true) !== $change['elementor']) {
        throw new Exception('Page save verification failed: ' . $change['id']);
    }
    delete_post_meta($change['id'], '_elementor_element_cache');
    clean_post_cache($change['id']);
    echo 'Updated page ' . $change['id'] . "\n";
}
$result = wp_update_post(['ID' => 12844, 'post_name' => 'flota-auto'], true);
if (is_wp_error($result)) throw new Exception($result->get_error_message());
global $wpdb;
$rows = $wpdb->get_results("SELECT pm.meta_id, pm.post_id, pm.meta_key, pm.meta_value FROM {$wpdb->postmeta} pm JOIN {$wpdb->posts} p ON p.ID=pm.post_id WHERE p.post_status='publish' AND pm.meta_key IN ('_elementor_data','_menu_item_url') AND pm.meta_value LIKE '%/flota-auto-electrice/%'", ARRAY_A);
file_put_contents('/home/u968429559/greenpack-backups/feedback-v3-20261106/old-fleet-links.json', wp_json_encode($rows));
foreach ($rows as $row) {
    $new = str_replace('/flota-auto-electrice/', '/flota-auto/', $row['meta_value']);
    update_metadata_by_mid('post', $row['meta_id'], wp_slash($new));
    delete_post_meta($row['post_id'], '_elementor_element_cache');
}
if (function_exists('wpfc_clear_all_cache')) wpfc_clear_all_cache();
echo 'Updated fleet links: ' . count($rows) . "\nFleet: " . get_permalink(12844) . "\n";
